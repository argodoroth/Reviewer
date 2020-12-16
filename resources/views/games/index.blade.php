@extends('layouts.app')

@section('title','Games')

@section('content')
    <p> Current posted Games: </p>
    <ul>
        @foreach ($games as $game)
            <li><a href="{{route('games.show', ['game' => $game])}}">{{$game->name}}</a></li>
        @endforeach
    </ul>

    <!--
    <a href={"{route('games.create')}}">Create Game</a>
    -->
@endsection