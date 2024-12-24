<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Hello, world!</title>
  
  <style>
    .form-outline i {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
  }
  
  </style>
    
  </head>
  <body>
   

    
  <nav class="navbar fixed navbar-expand-md navbar-dark text-withe bg-dark shadow py-2">
    <div class="container">
    <a href="/movies" class="navbar-brand d-flex align-items-left">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-film" viewBox="0 0 16 16">
  <path d="M0 1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm4 0v6h8V1zm8 8H4v6h8zM1 1v2h2V1zm2 3H1v2h2zM1 7v2h2V7zm2 3H1v2h2zm-2 3v2h2v-2zM15 1h-2v2h2zm-2 3v2h2V4zm2 3h-2v2h2zm-2 3v2h2v-2zm2 3h-2v2h2z"/>
</svg>
        <strong>Films</strong>
      </a>
    <div class="navbar-collapse collapse" id="collapsingNavbar3">
        <ul class="navbar-nav justify-content-center">
            <li class="nav-item active">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
        </ul>
        <ul class="nav navbar-nav w-100 justify-content-end">
          
            <div data-mdb-input-init class="form-outline  me-3 ">
            <form action="/movies" id="search-moviess"  method="get">
              <input type="text" class="form-control ps-5 rounded-pill" placeholder="Search Films" name="query" style="max-width:200px;" />
              <i class="bi-search ms-3"></i>
            </form>
            </div>
            <div data-mdb-input-init class="form-outline  me-3">
            <form action="/acteurs" id="search-moviess"  method="get">
              <input type="text" class="form-control ps-5 rounded-pill " placeholder="Search Acteurs" name="query" style="max-width:200px;"/>
              <i class="bi-search ms-3"></i>
            </form>
            </div>

        </ul>
    </div>
    </div>
</nav>

<main>

<div class="container mt-4 mb-2">
  <div class="row text-center align-items-center t-20">
    <div class="col mb-2">
        <img src="{{ 'https://image.tmdb.org/t/p/w342/'.$movie['poster_path'] }}" >
    </div>
    <div class="col align-items-center mb-2">
        <h2 class="card-header mb-2"> {{ $movie['title'] }}</h2>
        {{ $movie['overview'] }}
        <div class="card-header text-white bg-primary mt-4">
                       Genre
                    
                    </div>
                    <div class="card" >
                        <ul class="list-group list-group-flush">
                        @foreach($movie['genres'] as $genre)

                            <p>{{ $genre['name'] }}</p>
                        @endforeach
                        </ul>
                    </div>

    </div>
  </div>
</div>
</div>
</div>


    <section class="bg-light py-4 my-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-3 text-primary">Principaux acteurs</h2>
            </div>
          @foreach($items as $acteur)
          <div class="col-md-6 col-lg-3">
                <div class="card my-6">

                    <img src="{{ 'https://image.tmdb.org/t/p/w342/'.$acteur['profile_path'] }}" class="card-image-top" alt="thumbnail">

                    <div class="card-body">
                        <h5 class="card-title">{{ $acteur['name'] }}</h5>
                        
                        <a href="{{route('showActeur', ['id' => $acteur['id'] ]) }}" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
          @endforeach
          </div>
          {{ $items->links() }}
     </div>
</section>


</main>


  





<footer class="text-body-secondary py-5">
  <div class="container">
    <p class="float-end mb-1">
      <a href="#">Back to top</a>
    </p>
   
  </div>
</footer>
<script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    </body>
</html>