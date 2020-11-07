<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'rating',
        'date_posted'];

    //public function game(){
        //return $this->belongsTo('App\Models\Game');
    //}
}
