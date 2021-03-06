<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\User;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    /**
     * Pass list of games from database to the index view
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::orderBy('name','asc')->get();
        return view('games.index', ['games' => $games]);//games.index is view in games folder
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('games.create');
    }

    /**
     * Validates input data, stores game then redirects to index page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'publisher' => 'required|max:100',
            'developer' => 'required|max:100',
            'release_date' => 'nullable|date'
        ]);

        //Makes game object then saves to database
        $a = new Game;
        $a->name = $validated['name'];
        $a->publisher = $validated['publisher'];
        $a->developer = $validated['developer'];
        $a->release_date = $validated['release_date'];
        $a->user_id = Auth::id();
        $a->save();

        return redirect()->route('games.index')->with('message','New game created.');
    }

    /**
     * Display the passed in game object in a view
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        //Make a view and pass it the value of game
        return view ('games.show', ['game' => $game]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        return view ('games.edit', ['game' => $game]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'publisher' => 'required|max:100',
            'developer' => 'required|max:100',
            'release_date' => 'nullable|date'
        ]);
        if(Auth::id() == $game->user_id){
            $game->name = $validated['name'];
            $game->publisher = $validated['publisher'];
            $game->developer = $validated['developer'];
            $game->release_date = $validated['release_date'];
            $game->save();
        }

        return redirect()->route('games.show',['game'=>$game])->with('message','Game edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $game = Game::findOrFail($id);
        $game->delete();

        return redirect()->route('games.index')->with('message', 'Game was deleted.');
    }

    public function page() {
        return view ('games.show', ['game' => $game]);
    }
}
