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
        return  \Redirect::intended('/');
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