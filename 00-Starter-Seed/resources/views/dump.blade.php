@extends('layouts.master', ['isLoggedIn' => $isLoggedIn])

@section('content')
    <pre>{{var_dump($user)}}</pre>
@stop
