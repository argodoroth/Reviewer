@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection
@section('title',$user->name)

@section('content')
    @if($user->image !=null)
        <img src={{"http://reviewer.test/" . $user->image->path}} width ="40" height ="40">
        @elseif($user->id == Auth::id())
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
    <p>name: {{$user->name}}</p>
    <p>email: {{$user->email}}</p>
@endsection