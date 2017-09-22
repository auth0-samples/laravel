<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Auth0\Login\LaravelCacheWrapper;
use Auth0\Login\Contract\Auth0UserRepository as Auth0UserRepositoryContract; 
use Auth0\Login\Repository\Auth0UserRepository as Auth0UserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind( 
            Auth0UserRepositoryContract::class, 
            Auth0UserRepository::class 
        ); 
        
        // $this->app->bind(
        //     '\Auth0\SDK\Helpers\Cache\CacheHandler',
        //     function() {
        //         static $cacheWrapper = null; 
        //         if ($cacheWrapper === null) {
        //             $cache = Cache::store();
        //             $cacheWrapper = new LaravelCacheWrapper($cache);
        //         }
        //         return $cacheWrapper;
        //     });

    }
}
