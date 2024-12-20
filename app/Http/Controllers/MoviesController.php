<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class MoviesController extends Controller
{
    

    public function index() {

        $popularMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/popular')
            ->json()['results'];

        $genreMovie = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];    

        $genres = collect($genreMovie)->mapWithKeys(function ($genre){
            return [$genre['id'] => $genre['name']];

        });

        //dump($genres) ;
            
        
        return view('movies.index', compact('popularMovies','genres'));
    }

public function show($id){
    $movie = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3//movie/'.$id)
            ->json();  

            //dump($movie);

    $acteurs = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3//movie/'.$id.'/credits')
        ->json()['cast'];  

    //dump($acteurs);
        

           

            return view('movies.show', compact('movie','acteurs'));
}

public function acteur(Request $request){

    $id = $request->id;
    
    $acteurInfo = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/person/'.$id)
        ->json();  

    //dump($acteurInfo);

    $acteurFilm = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/person/'.$id.'/combined_credits')
        ->json()['cast']; 
    
        dump($acteurFilm);


    return View('movies.acteur', compact('acteurInfo','acteurFilm'));

}
}
