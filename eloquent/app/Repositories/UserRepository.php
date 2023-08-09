<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use Auth0\Laravel\{UserRepositoryAbstract, UserRepositoryContract};
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

final class UserRepository extends UserRepositoryAbstract implements UserRepositoryContract
{
    public function fromAccessToken(array $user): ?Authenticatable
    {
        /*
            $user = [ // Example of a decoded access token
                "iss"   => "https://example.auth0.com/",
                "aud"   => "https://api.example.com/calendar/v1/",
                "sub"   => "auth0|123456",
                "exp"   => 1458872196,
                "iat"   => 1458785796,
                "scope" => "read write",
            ];
        */

        $identifier = $user['sub'] ?? $user['auth0'] ?? null;

        if (null === $identifier) {
            return null;
        }

        return User::where('auth0', $identifier)->first();
    }

    public function fromSession(array $user): ?Authenticatable
    {
        /*
            $user = [ // Example of a decoded ID token
                "iss"         => "http://example.auth0.com",
                "aud"         => "client_id",
                "sub"         => "auth0|123456",
                "exp"         => 1458872196,
                "iat"         => 1458785796,
                "name"        => "Jane Doe",
                "email"       => "janedoe@example.com",
            ];
        */

        // Determine the Auth0 identifier for the user from the $user array.
        $identifier = $user['sub'] ?? $user['auth0'] ?? null;

        // Collect relevant user profile information from the $user array for use later.
        $profile = [
            'auth0' => $identifier,
            'name' => $user['name'] ?? '',
            'email' => $user['email'] ?? '',
            'email_verified' => in_array($user['email_verified'], [1, true], true),
        ];

        // Check if a cache of the user exists in memory to avoid unnecessary database queries.
        $cached = $this->withoutRecording(fn () => Cache::get('auth0_user_' . $identifier));

        if ($cached) {
            // Immediately return a cached user if one exists.
            return $cached;
        }

        $user = null;

        // Check if the user exists in the database by Auth0 identifier.
        if (null !== $identifier) {
            $user = User::where('auth0', $identifier)->first();
        }

        // Optional: if the user does not exist in the database by Auth0 identifier, you could fallback to matching by email.
        if (null === $user && isset($user['email'])) {
            $user = User::where('email', $user['email'])->first();
        }

        // If a user was found, check if any updates to the local record are required.
        if (null !== $user) {
            $updates = [];

            if ($user->auth0 !== $profile['auth0']) {
                $updates['auth0'] = $profile['auth0'];
            }

            if ($user->name !== $profile['name']) {
                $updates['name'] = $profile['name'];
            }

            if ($user->email !== $profile['email']) {
                $updates['email'] = $profile['email'];
            }

            $emailVerified = in_array($user->email_verified, [1, true], true);

            if ($emailVerified !== $profile['email_verified']) {
                $updates['email_verified'] = $profile['email_verified'];
            }

            if ([] !== $updates) {
                $user->update($updates);
                $user->save();
            }

            if ([] === $updates && null !== $cached) {
                return $user;
            }
        }

        if (null === $user) {
            // Local password column is not necessary or used by Auth0 authentication, but may be expected by some applications/packages.
            $profile['password'] = Hash::make(Str::random(32));

            // Create the user.
            $user = User::create($profile);
        }

        // Cache the user for 30 seconds.
        $this->withoutRecording(fn () => Cache::put('auth0_user_' . $identifier, $user, 30));

        return $user;
    }

    /**
     * Workaround for Laravel Telescope potentially causing an infinite loop.
     * See: https://github.com/auth0/laravel-auth0/docs/Telescope.md
     *
     * @param callable $callback
     */
    private function withoutRecording($callback): mixed
    {
        $telescope = '\Laravel\Telescope\Telescope';

        if (class_exists($telescope)) {
            return "$telescope"::withoutRecording($callback);
        }

        return call_user_func($callback);
    }
}
