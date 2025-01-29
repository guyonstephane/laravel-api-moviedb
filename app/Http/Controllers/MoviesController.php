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
            $acts = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3//movie/'.$id.'/credits?language=fr-FR')
            ->json()  ;
            
            $acteurs = [];
            
            if(isset($acts['cast'])) {
                foreach($acts['cast'] as $acteur)
                 $acteurs[ ]= $acteur;  
            }
            //dump($acteurs);
    //$acteurs = Http::withToken(config('services.tmdb.token'))
     //   ->get('https://api.themoviedb.org/3//movie/'.$id.'/credits?language=fr-FR')
       // ->json()['cast'];
   
        $acteurM = [];
    foreach($acteurs as $acteur){
        if(isset($acteur['profile_path'])){
            $acteurM[]=$acteur;
        }
    }

   

        $currentPage = Paginator::resolveCurrentPage();
        $col = collect($acteurM);
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

    //dump($acteurFilm);
    $actFilms = [];
    foreach($acteurFilm as $film){
        if($film['poster_path'] != null)
        $actFilms[] = $film ;
    }

        $currentPage = Paginator::resolveCurrentPage();
        $col = collect($actFilms);
        $perPage = 8;
        $currentPageItems = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $items = new Paginator($currentPageItems, count($col), $perPage);
        $items->setPath($request->url());
        $items->appends($request->all());
              
    
        //dump($acteurFilm);


    return View('movies.showActeur', compact('acteurInfo','items'));

}

public function topRated() {

    $topMovies = Http::withToken(config('services.tmdb.token'))
    ->get('https://api.themoviedb.org/3/movie/top_rated?language=fr-FR')
    ->json()['results'];
    
    dump($topMovies);

     
    
    return view('movies.top', compact('topMovies'));
}

public function genres(Request $request) {

    if (isset($request->with_genres) & !empty($request->get('with_genres')))
    {
        $word = $request->get('with_genres');
        $topMovies = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/discover/movie?with_genres='.$word)
        ->json()['results'];
    
       
    }

    else
    {
        $topMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/popular?language=fr-FR')
            ->json()['results'];
    }
    
    return view('movies.genre', compact('topMovies'));
}


}
