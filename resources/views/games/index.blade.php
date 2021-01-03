@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection
@section('title','Games')

@section('content')
    <h3>Current posted Games: </h3>
    <ul class= "list-group">
        @foreach ($games as $game)
            <li class="list-group-item"><a href="{{route('games.show', ['game' => $game])}}">{{$game->name}}</a></li>
        @endforeach
    </ul>

    

@endsection