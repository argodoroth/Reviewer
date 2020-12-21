@extends('layouts.app')

@section('title','Games')

@section('content')
    <ul>
       <li>name: {{$game->name}}</li>
       <li>user: {{$game->user->name}}</li>
       <li>release date: {{$game->release_date ?? 'unknown'}}</li>
       <li>publisher: {{$game->publisher}}</li>
       <li>developer: {{$game->developer}}</li>
    </ul>
    
    <form action="{{route('games.destroy',['id' => $game->id])}}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
    
@endsection