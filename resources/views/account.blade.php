@extends('layouts.app')

@section('title',$user->name)

@section('content')
    <p>name: {{$user->name}}</p>
    <p>email: {{$user->email}}</p>
@endsection