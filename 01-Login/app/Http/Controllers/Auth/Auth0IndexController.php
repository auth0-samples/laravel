<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class Auth0IndexController extends Controller
{
    /**
     * Redirect to the Auth0 hosted login page
     *
     * @return mixed
     */
    public function login()
    {
        return \App::make('auth0')->login(null, null, ['scope' => 'openid name email email_verified'], 'code');
    }

    /**
     * Log out of our app
     *
     * @return mixed
     */
    public function logout()
    {
        \Auth::logout();
        $logoutUrl = sprintf(
            'https://%s/v2/logout?client_id=%s&returnTo=%s',
            env('AUTH0_DOMAIN'),
            env('AUTH0_CLIENT_ID'),
            env('APP_URL'));
        return  \Redirect::intended($logoutUrl);
    }

    /**
     * Display the user's Auth0 data
     *
     * @return mixed
     */
    public function profile()
    {
        if ( ! \Auth::check() ) {
            return redirect()->route('login');
        } else {
            return view('profile')->with('user', print_r( \Auth::user()->getUserInfo(), true ));
        }

    }
}