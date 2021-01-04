@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection
@section('title','Edit game')

@section('content')
    <form method="POST" action="{{route('games.update',['game'=>$game])}}">
        @csrf
        <p>Name: <input type="text" name="name" value={{$game->name}}></p>
        <p>Publisher: <input type="text" name="publisher" value={{$game->publisher}}></p>
        <p>Developer: <input type="text" name="developer" value={{$game->developer}}></p>
        <p>Release date: <input type="date" name="release_date" value={{$game->release_date}}></p>
        <input type="submit" value="Submit">
        <a href="{{route('games.show',['game'=>$game])}}">Cancel </a>
@endsection