@extends('layouts.app')

@section('title','Create game')

@section('content')
<form method="POST" enctype="multipart/form-data" id="upload-image" action="{{route('images.store')}}" >
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <input type="file" name="image" placeholder="Choose image" id="image">
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
{{$image = App\Models\Image::find(1)}}
<img src="storage\app\images\RSskqScZSJwMJY2MpHioUued1RqdTw0Yhg6tMkni.png" alt="Smiley" width ="400" height ="400">
@endsection