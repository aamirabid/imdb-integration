<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    //
    public $movieModel;
    public function __construct(){
        $this->movieModel= new Movie();
    }
    public function index(Request $request){
        try {
            return $this->movieModel->getMoviesByFilter($request);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function moviePreview($id){
        try {
            return $this->movieModel->getMoviePreview($id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function addVote(Request $request){
        try {
            return $this->movieModel->addVote($request);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
