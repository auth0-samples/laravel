@extends('layouts.master', ['isLoggedIn' => $isLoggedIn])

@section('content')
    {{var_dump($user)}}
@stop