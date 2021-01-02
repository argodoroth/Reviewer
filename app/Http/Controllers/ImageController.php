<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use App\Models\Game;
use App\Models\User;

class ImageController extends Controller
{
    public function index()
    {
        return view('image');
    }

    public function storeGame(Request $request, Game $game)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);
        
        $name = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->store('public/images');
        $path = str_ireplace("public", "storage", $path);
        $img = new Image;
        $img->name = $name;
        $img->path = $path;
        $img->imageable_type = 'App\Models\Game';
        $img->imageable_id = $game->id;
        $img->save();
        return view('games.show',['game'=>$game])->with('message','Image Uploaded successfully');
    }

    public function storeUser(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);
        
        $name = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->store('public/images');
        $path = str_ireplace("public", "storage", $path);
        $img = new Image;
        $img->name = $name;
        $img->path = $path;
        $img->imageable_type = 'App\Models\User';
        $img->imageable_id = $user->id;
        $img->save();
        return view('account',['user'=>$user])->with('message','Image Uploaded successfully');
    }
}
