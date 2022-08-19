<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieVotes extends Model
{
    use HasFactory;

    protected $fillable=['userIp','movieId','vote'];

    public function movie(){
        return $this->belongsTo(Movie::class,'movieId');
    }
}
