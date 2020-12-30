@extends('layouts.app')

@section('title','Create game')

@section('content')
    <form method="POST" action="{{route('games.store')}}">
        @csrf
        <p>Name: <input type="text" name="name" value={{old('name')}}></p>
        <p>Publisher: <input type="text" name="publisher" value={{old('publisher')}}></p>
        <p>Developer: <input type="text" name="developer" value={{old('developer')}}></p>
        <p>Release date: <input type="date" name="release_date" value={{old('release_date')}}></p>
        <input type="submit" value="Submit">
        <a href="{{route('games.index')}}">Cancel </a>
@endsection