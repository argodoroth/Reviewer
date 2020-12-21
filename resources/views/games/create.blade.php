@extends('layouts.app')

@section('title','Create game')

@section('content')
    <form method="POST" action="{{route('games.store')}}">
        @csrf
        <p>Name: <input type="text" name="name" value={{old('name')}}></p>
        <p>Publisher: <input type="text" name="publisher" value={{old('publisher')}}></p>
        <p>Developer: <input type="text" name="developer" value={{old('developer')}}></p>
        <p>Release date: <input type="date" name="release_date" value={{old('release_date')}}></p>
        <p>User id: <select name='user_id'>
            @foreach($users as $user)
                <option value="{{$user->id}}"
                @if ($user->id == old('user_id'))
                    selected="selected"
                @endif
                >
                {{$user->name}}
                </option>
            @endforeach
        </select></p>
        <input type="submit" value="Submit">
        <a href="{{route('games.index')}}">Cancel </a>
@endsection