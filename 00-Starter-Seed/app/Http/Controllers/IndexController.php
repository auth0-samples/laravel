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
    $isLoggedIn = \Auth::check();
    $auth0Config = config('laravel-auth0');
    return view('login')
      ->with('isLoggedIn', $isLoggedIn)
      ->with('auth0Config',$auth0Config);
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
      ->with('user',\Auth::user()->getUserInfo());
  }
}