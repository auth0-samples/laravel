@extends('layouts.app')

@section('menu')
    <a href="{{ url('/') }}" class="btn btn-default">Home</a>
    <a href="{{ route('logout') }}" class="btn btn-success">Logout</a>
@endsection

@section('content')
    <h1>Profile</h1>

    <pre class="text-left">{{ $user }}</pre>
@endsection
