<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'publisher',
        'developer',
        'release_date'];

    public function reviews(){
        return $this->hasMany('App\Models\Review');
    }

    public function users(){
        return $this->belongsToMany('App\Models\User');
    }
}
