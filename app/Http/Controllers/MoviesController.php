<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class MoviesController extends Controller
{
    

    public function index(Request $request) {

        if (isset($request->query) & !empty($request->get('query')))
        {
            $word = $request->get('query');
            $popularMovies = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/search/movie?query='.$word.'&page=1')
                ->json()['results'];
        }


        else
        {
            $popularMovies = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/movie/popular?language=fr-FR')
                ->json()['results'];
        }
        //dump($popularMovies);

        $genreMovie = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list?language=fr-FR')
            ->json()['genres'];    

        $genres = collect($genreMovie)->mapWithKeys(function ($genre){
            return [$genre['id'] => $genre['name']];

        });

        //dump($key) ;
            
        
        return view('movies.index', compact('popularMovies','genres'));
    }

public function show(Request $request,$id)
    {
    $movie = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3//movie/'.$id.'?language=fr-FR')
            ->json();  

            //dump($movie);

    $acteurs = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3//movie/'.$id.'/credits?language=fr-FR')
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

public function acteurs(Request $request){

    
    if (isset($request->query) & !empty($request->get('query')))
        {
            $word = $request->get('query');
            $popularActeurs = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/search/person?query='.$word.'&page=1')
                ->json()['results'];
        }

        /*
        $currentPage = Paginator::resolveCurrentPage();
        $col = collect($acteurFilm);
        $perPage = 8;
        $currentPageItems = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $items = new Paginator($currentPageItems, count($col), $perPage);
        $items->setPath($request->url());
        $items->appends($request->all());
       */
    
        //dump($acteurFilm);


    return View('movies.acteur', compact('popularActeurs'));

}

public function showActeur( Request $request,$id){

        
    $acteurInfo = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/person/'.$id.'?language=fr-FR')
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


    return View('movies.showActeur', compact('acteurInfo','items'));

}




}
