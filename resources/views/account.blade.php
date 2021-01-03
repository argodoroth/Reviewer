@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection
@section('title',$user->name)

@section('content')
    <div id="mainItem" class="card" style="width: 60rem;">
        @if($user->image != null)
            <img class="card-img-top" src={{"http://reviewer.test/" . $user->image->path}} width="100" height="100">
        @else
            <p>Upload User image:</p> 
            <form method="POST" enctype="multipart/form-data" id="upload-image" action="{{route('images.store.user',['user'=>$user])}}" >
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="file" name="image" placeholder="Upload Image" id="image">
                        @error('image')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                    </div>
                </div>     
            </form>
        @endif
        <div class="card-body">
            <h2 class="card-title"><b>{{$user->name}}</b></h2>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><b>Email:</b> {{$user->email}}</li>
            @if($user->player != null)
            <li class="list-group-item"><b>Gamertag:</b> {{$user->player->gamertag}}</li>
            @else
            <form method="POST" action="{{route('users.gamertag',['user'=>$user])}}">
                @csrf
                <li class="list-group-item">
                    <input type="text" name="gamertag" value={{old('gamertag')}}>
                    <input type="submit" value="Submit">
                </li>
            </form>
            @endif
        </ul>
    </div>
@endsection