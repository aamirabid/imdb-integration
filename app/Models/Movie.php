<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable=['movieId','averageVote'];

    public function votes(){
        return $this->hasMany(MovieVotes::class,'movieId');
    }

    private function getAverageVote($id){
        $totalVotes=10;
        $arrayOfVotes=[
            1 => MovieVotes::where('movieId',$id)->where('vote',1)->get()->count(),
            2 => MovieVotes::where('movieId',$id)->where('vote',2)->get()->count(),
            3 => MovieVotes::where('movieId',$id)->where('vote',3)->get()->count(),
            4 => MovieVotes::where('movieId',$id)->where('vote',4)->get()->count(),
            5 => MovieVotes::where('movieId',$id)->where('vote',5)->get()->count(),
            6 => MovieVotes::where('movieId',$id)->where('vote',6)->get()->count(),
            7 => MovieVotes::where('movieId',$id)->where('vote',8)->get()->count(),
            8 => MovieVotes::where('movieId',$id)->where('vote',8)->get()->count(),
            9 => MovieVotes::where('movieId',$id)->where('vote',9)->get()->count(),
            10 =>MovieVotes::where('movieId',$id)->where('vote',10)->get()->count()
        ];
        $partial=0;
        foreach ($arrayOfVotes as $key => $value) {
            $partial+=$key*$value;
        }
        return $partial / $totalVotes;
    }

    public function getMoviesByFilter($request){
        if(!$request->queryTxt){
            return null;
        }
        return getRequest('/imdbSearchByName',['query'=>$request->queryTxt],$request->queryTxt);
    }
    public function getMoviePreview($id){
        return [
            'preview'=>getRequest('/imdbSearchById',['movieId'=>$id],$id),
            'averageVote'=> Movie::where('movieId',$id)->first()
        ];
    }
    public function addVote($request){
        $movie=Movie::where('movieId',$request->movieId)->first();
        if(!$movie){
            $movie=Movie::create(['movieId'=>$request->movieId]);
        }
        $movie->votes()->create(['vote'=>$request->vote,'userIp'=>$request->ip()]);
        $movie->averageVote=$this->getAverageVote($movie->id);
        $movie->save();
        return $movie;
    }

    public static function calculateAverageVotes(){
        $movies=Movie::all();
        foreach ($movies as $movie) {
            $movie->averageVote=self::getAverageVote($movie->id);
            $movie->save();
        }
    }

}
