@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection

@section('title','Create game')

@section('content')
    <div id="mainItem" class="card" style="width: 60rem;">
        <div class="card-body">
            <h2 class="card-title"><b>Create Game</b></h2>
        </div>
        <form method="POST" action="{{route('games.store')}}">
            @csrf
                <ul class="list-group list-group-flush">
                <li class="list-group-item">Name: <input type="text" name="name" value={{old('name')}}></li>
                <li class="list-group-item">Publisher: <input type="text" name="publisher" value={{old('publisher')}}></li>
                <li class="list-group-item">Developer: <input type="text" name="developer" value={{old('developer')}}></li>
                <li class="list-group-item">Release date: <input type="date" name="release_date" value={{old('release_date')}}></li>
            </ul>
            <div class="card-body">
                <input type="submit" value="Submit">
                <a href="{{route('games.index')}}">Cancel </a>
            </div>
        </form>
    </div>
@endsection