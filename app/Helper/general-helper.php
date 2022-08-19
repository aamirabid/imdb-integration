<?php

use Illuminate\Support\Facades\Cache;
use App\Events\MoviesFetchedFromCache;
use Illuminate\Support\Facades\Http;

if (!function_exists('getRequest')) {
    function getRequest($endpoint,$payload,$key='inception'){
        if(Cache::has($key)){
            if(isset($payload['query'])){
                $mesg="New listing via search '{$payload['query']}'";
            }
            if(isset($payload['movieId'])){
                $mesg="Movie Preview of movieId '{$payload['movieId']}'";
            }
            event(new MoviesFetchedFromCache($mesg));
        }
        if (!Cache::has($key)) {
            $response= Http::withHeaders([
                'content-type' => 'application/json',
                'authorization' =>env("IMDB_AUTHORIZATION"),
            ])->get(env("IMDB_API_BASE").$endpoint, $payload);
            Cache::put($key, $response->json()['result'],3600);
        }
        return Cache::get($key);

    }
}

