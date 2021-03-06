<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\User;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource for a specific game
     *
     * @return \Illuminate\Http\Response
     */
    public function apiIndex(){
        $reviews = Review::all();
        foreach($reviews as $review){
            //passes through username to be displayed with reviews
            $review->username = User::find($review->user_id)->name;
        }
        return $reviews;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function apiStore(Request $request, Game $game)
    {
        $validated = $request->validate([
            'title' => 'required|max:100',
            'description' => 'required|max:100',
            'rating' => 'required|integer|between:1,10',
            'user' => 'required|integer'
        ]);
        //Makes game object then saves to database
        $a = Review::get()->where('user_id', $validated['user'])->where('game_id',$game->id)->first();
        $updated = true;
        if ($a == null){
            $a = new Review;
            $updated = false;
        }
        $a->title = $validated['title'];
        $a->description = $validated['description'];
        $a->rating = $validated['rating'];
        $a->user_id = $validated['user'];
        $a->game_id = $game->id;
        $a->save();

        //pass extra information to AJAX functionality
        $a->username = User::find($a->user_id)->name;
        $a->updated = $updated;
        return $a;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
