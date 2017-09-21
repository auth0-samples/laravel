<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{

  public function __construct()
  {

  }

  public function index()
  {
    $isLoggedIn = \Auth::check();
    return view('index')
      ->with('isLoggedIn', $isLoggedIn);
  }

  public function login()
  {
    return \App::make('auth0')->login(null, null, ['scope' => 'openid profile email'], 'code');
  }

  public function logout()
  {
    \Auth::logout();
    return  \Redirect::intended('/');
  }

  public function dump()
  {
    $isLoggedIn = \Auth::check();
    return view('dump')
      ->with('isLoggedIn', $isLoggedIn)
      ->with('user',\Auth::user()->getUserInfo())
      ->with('accessToken',\Auth::user()->getAuthPassword());
  }
}