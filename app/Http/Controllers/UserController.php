<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Player;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Pass list of games from database to the index view
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //Make a view and pass it the value of game
        return view ('account', ['user' => $user]);
    }

    public function gamertag(Request $request){
        $validated = $request->validate([
            'gamertag' => 'required|max:100',
        ]);
        $user = Auth::user();
        if ($user->player == null){
            $player = new Player;
            $player->user_id = Auth::id();
            $player->gamertag = $validated['gamertag'];
            $player->save();
        }
        return redirect()->route('users.show',['user'=>Auth::user()]);
    }

    public function setCreator(Request $request){
        $user = Auth::user();
        $user->isCreator = 'true';
        $user->save();
        return redirect()->route('users.show',['user'=>Auth::user()]);
    }
}
