<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

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

public function show(Request $request,$id)
    {
    $movie = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3//movie/'.$id)
            ->json();  

            //dump($movie);

    $acteurs = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3//movie/'.$id.'/credits')
        ->json()['cast'];

    //$act = collect($acteurs);
    //$act->paginate(5);

        $currentPage = Paginator::resolveCurrentPage();
        $col = collect($acteurs);
        $perPage = 8;
        $currentPageItems = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $items = new Paginator($currentPageItems, count($col), $perPage);
        $items->setPath($request->url());
        $items->appends($request->all());

        //dump($col);

    
        return view('movies.show', compact('movie','items'));
}

public function acteur(Request $request){

    $id = $request->id;
    $page = $request->page;
    
    $acteurInfo = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/person/'.$id)
        ->json();  

    //dump($acteurInfo);

    $acteurFilm = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/person/'.$id.'/combined_credits')
        ->json()['cast'];

        $currentPage = Paginator::resolveCurrentPage();
        $col = collect($acteurFilm);
        $perPage = 8;
        $currentPageItems = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $items = new Paginator($currentPageItems, count($col), $perPage);
        $items->setPath($request->url());
        $items->appends($request->all());
       
    
        //dump($acteurFilm);


    return View('movies.acteur', compact('acteurInfo','items'));

}




}
