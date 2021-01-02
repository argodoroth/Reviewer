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
        $img->imageable_type = 'App\Models\Game';
        $img->imageable_id = 1;
        $img->save();
        return redirect('image-upload')->with('message','Image Uploaded successfully');
    }
}
