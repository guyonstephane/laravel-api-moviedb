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
    <a href="/movies" class="navbar-brand d-flex align-items-left ">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-film" viewBox="0 0 16 16">
  <path d="M0 1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm4 0v6h8V1zm8 8H4v6h8zM1 1v2h2V1zm2 3H1v2h2zM1 7v2h2V7zm2 3H1v2h2zm-2 3v2h2v-2zM15 1h-2v2h2zm-2 3v2h2V4zm2 3h-2v2h2zm-2 3v2h2v-2zm2 3h-2v2h2z"/>
</svg>
        <strong class="p-2">Films</strong>
      </a>
    <div class="navbar-collapse collapse" id="collapsingNavbar3">
        <ul class="navbar-nav justify-content-center">
            <li class="nav-item active">
              <a class="nav-link" href="/top">Top films</a>
            </li>
            <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Genre
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="/genre?with_genres=878">Science Fiction</a></li>
            <li><a class="dropdown-item" href="/genre?with_genres=28">Action</a></li>
            <li><a class="dropdown-item" href="/genre?with_genres=12">Aventure</a></li>
            <li><a class="dropdown-item" href="/genre?with_genres=37">Western</a></li>
            <li><a class="dropdown-item" href="/genre?with_genres=36">Histoire</a></li>
            <li><a class="dropdown-item" href="/genre?with_genres=35">Comédie</a></li>
          </ul>
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



  

  <div class="album py-5 bg-body-tertiary">
    <div class="container">
      @if (count($topMovies)== 0)
        <h4>Aucun résultat trouvé</h4></p>
      @else
        <h4>Films les plus populaires</h4></p>
      @endif
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      @foreach($topMovies as $movie)  
      <div class="col">
          <div class="card shadow-sm">
          <img src="{{ 'https://image.tmdb.org/t/p/w500/'.$movie['poster_path'] }}" >
            <div class="card-body lh-sm">
            
              <p class="card-text lh-sm">
                <a href="{{ route('movies.show',$movie['id']) }}">
                  <strong>{{ $movie['title'] }}</strong>
                </a>
              </p>
              
             
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">
                   <a href="{{ route('movies.show',$movie['id']) }}">
                    View
                   </a>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

</main>

<footer class="text-body-secondary py-5">
  <div class="container">
    <p class="float-end mb-1">
      <a href="#">Back to top</a>
    </p>
    <p class="mb-1">Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
    <p class="mb-0">New to Bootstrap? <a href="/">Visit the homepage</a> or read our <a href="/docs/5.3/getting-started/introduction/">getting started guide</a>.</p>
  </div>
</footer>
<script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>