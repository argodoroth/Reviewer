<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index()
    {
        return view('image');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);
        
        $name = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->store('public/images');
        $img = new Image;
        $img->name = $name;
        $img->path = $path;
        $img->save();
        return redirect('image-upload')->with('message','Image Uploaded successfully');
    }

    
    public function loadImage($filename)
    {
        $path = storage_path('storage/app/public/images/'. $filename);

        if (!Storage::exists($path)) {
            abort(404);
        }

        $file = Storage::get($path);
        $type = Storage::mimeType($path);

        $response = Response::make($file, 200);

        $response->header("Content-Type", $type);

        return $response;

    }
}
