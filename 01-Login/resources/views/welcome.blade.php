@extends('layouts.app')

@section('content')
    <h1>Auth0 <span class="a0-u--red">❤</span> Laravel</h1>

    <h4>
        <a href="https://github.com/auth0-samples/auth0-laravel-php-web-app">GitHub</a>
        <span class="a0-u--sep"></span>
        <a href="https://auth0.com/docs/quickstart/webapp/laravel">QuickStart</a>
        <span class="a0-u--sep"></span>
        <a href="https://auth0.com/about">Why Auth0?</a>
        <span class="a0-u--sep"></span>
        <a href="https://auth0.com/docs">Docs</a>
    </h4>
@endsection

@section('menu')
    @auth
        <a href="{{ route('profile') }}" class="btn btn-default">Profile</a>
        <a href="{{ route('logout') }}" id="qsLogoutBtn" class="btn btn-success">Logout</a>
    @else
        <a href="{{ route('login') }}" id="qsLoginBtn" class="btn btn-success">Login/Signup</a>
    @endauth
@endsection
