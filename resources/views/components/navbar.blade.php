<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top px-3 py-2">
  <div class="container-fluid d-flex justify-content-between align-items-center">
    
    <div class="d-flex align-items-center">
      <a class="navbar-brand text-primary fw-bold fs-3" href="{{ route('home') }}" style="letter-spacing: -0.5px;">
        presto<span class="text-secondary">.</span>
      </a>
      
      <div class="collapse navbar-collapse ms-3" id="navbarNav">
        <ul class="navbar-nav border-start ps-3">
          <li class="nav-item">
            <a class="nav-link px-3 active fw-semibold text-dark" aria-current="page" href="{{ route('home') }}">
              <i class="bi bi-house-door-fill me-1"></i> Home
            </a>
          </li>
          @auth
          <li class="nav-item">
            <a class="nav-link px-3 fw-semibold text-muted" href="{{ route('article.create') }}">
              <i class="bi bi-plus-circle-fill me-1"></i> Inserisci Annuncio
            </a>
          </li>
          @endauth
        </ul>
      </div>
    </div>

    <div class="d-none d-md-flex flex-grow-1 justify-content-center mx-4" style="max-width: 500px;">
      <form action="#" method="GET" class="w-100 position-relative">
        <div class="input-group">
          <span class="input-group-text bg-light border-0 text-muted ps-3 pe-2" style="border-radius: 20px 0 0 20px;">
            <i class="bi bi-search"></i>
          </span>
          <input type="text" name="search" class="form-control bg-light border-0 py-2 shadow-none" placeholder="Cerca su Presto..." style="border-radius: 0 20px 20px 0; font-size: 14px;">
        </div>
      </form>
    </div>

    <div class="d-flex align-items-center">
      
      <button class="navbar-toggler border-0 bg-light p-2 me-2 rounded-circle d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      @auth
      
        <div class="dropdown">
          <button class="btn btn-light rounded-pill px-3 py-2 d-flex align-items-center gap-2 border shadow-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold text-uppercase" style="width: 28px; height: 28px; font-size: 13px;">
              {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <span class="fw-semibold d-none d-sm-inline" style="font-size: 14px;">{{ Auth::user()->name }}</span>
          </button>
          
          <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 p-2" style="border-radius: 10px; min-width: 200px;">
            <li>
              <a href="{{ route('article.create') }}" class="dropdown-item rounded py-2">
                <i class="bi bi-plus-lg me-2 text-success"></i> Crea un articolo
              </a>
            </li>
            <li><hr class="dropdown-divider text-muted"></li>
            <li>
              <a class="dropdown-item text-danger rounded py-2" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('form-logout').submit();">
                <i class="bi bi-box-arrow-right me-2"></i> Esci da Presto
              </a>
              <form action="{{ route('logout') }}" method="POST" id="form-logout" class="d-none">@csrf</form>
            </li>
          </ul>
        </div>
      @else 
       
        <div class="d-flex gap-2">
          <a href="{{ route('login') }}" class="btn btn-light fw-semibold text-primary px-3 rounded-pill" style="font-size: 14px;">Accedi</a>
          <a href="{{ route('register') }}" class="btn btn-primary fw-semibold px-3 rounded-pill" style="font-size: 14px;">Registrati</a>
        </div>
      @endauth

    </div>
  </div>
</nav>
