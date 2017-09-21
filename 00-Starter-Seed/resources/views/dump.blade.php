@extends('layouts.master', ['isLoggedIn' => $isLoggedIn])

@section('content')
    <pre>{{var_dump($user)}}</pre>
    <pre>AccessToken: {{var_dump($accessToken)}}</pre>
@stop