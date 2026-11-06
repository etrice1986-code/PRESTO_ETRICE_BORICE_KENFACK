
<nav class="navbar navbar-expand-lg shadow-sm sticky-top px-3 py-2">

  <div class="container-fluid d-flex justify-content-between align-items-center">
    
    <div class="d-flex align-items-center">
      <a class="navbar-brand text-primary fw-bold fs-3" href="{{ route('home') }}" style="letter-spacing: -0.5px;">
        presto<span class="text-secondary">.</span>
      </a>
      
      <div class="collapse navbar-collapse ms-3" id="navbarNav">
        <ul class="navbar-nav border-start ps-3">
          <li class="nav-item">
            
            <a class="nav-link px-3 active fw-semibold" aria-current="page" href="{{ route('home') }}">
              <i class="bi bi-house-door-fill me-1"></i> {{ __('ui.home') }}
            </a>
          </li>
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle px-3 fw-semibold text-muted" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-tags-fill me-1"></i> {{ __('ui.categories') }}
            </a>
            <ul class="dropdown-menu shadow border-0 mt-2 p-2" style="border-radius: 10px;">
              @foreach($categories as $category)
                <li>
                  <a class="dropdown-item rounded py-2" href="{{ route('category.show', $category) }}">
                    {{ __('ui.' . $category->name) }}
                  </a>
                </li>
              @endforeach
            </ul>
          </li>

          @auth
          <li class="nav-item">
            <a class="nav-link px-3 fw-semibold text-muted" href="{{ route('article.create') }}">
              <i class="bi bi-plus-circle-fill me-1"></i> {{ __('ui.insertAnnouncement') }}
            </a>
          </li>
          @endauth
        </ul>
      </div>
    </div>

   <div class="d-none d-md-flex flex-grow-1 justify-content-center mx-4" style="max-width: 500px;">
  <form id="search-form" action="{{ route('article.index') }}" method="GET" class="w-100 position-relative">
    <div class="input-group">
      <span class="input-group-text bg-light border-0 text-muted ps-3 pe-2" style="border-radius: 20px 0 0 20px;">
        <i class="bi bi-search"></i>
      </span>
      <input id="search-input" type="text" name="search" value="{{ request()->get('search') }}" class="form-control bg-light border-0 py-2 shadow-none" placeholder="{{ __('ui.searchPlaceholder') }}" style="border-radius: 0 20px 20px 0; font-size: 14px;" autocomplete="off">
    </div>
  </form>
</div>

    <div class="d-flex align-items-center">
      
      <button class="navbar-toggler border-0 bg-light p-2 me-2 rounded-circle d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      @auth
        @php
            
            $unreadCount = \App\Models\Message::where('recipient_id', Auth::id())
                ->where('is_read', false)
                ->count();
        @endphp

        
      <a class="nav-link position-relative d-none d-sm-inline-flex align-items-center p-2 rounded-circle border shadow-sm bg-body me-2 text-muted" href="{{ route('messages.index') }}" style="width: 40px; height: 40px; justify-content: center;">
          <i class="bi bi-chat-left-text fs-5"></i>
          @if($unreadCount > 0)
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.65rem; padding: 0.35em 0.5em; z-index: 10;">
                  {{ $unreadCount }}
                  <span class="visually-hidden">Nuovi messaggi</span>
              </span>
          @endif
      </a>

        
        <div class="dropdown">
          <button class="btn user-dropdown-btn rounded-pill px-3 py-2 d-flex align-items-center gap-2 border shadow-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold text-uppercase" style="width: 28px; height: 28px; font-size: 13px;">
              {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <span class="fw-semibold d-none d-sm-inline" style="font-size: 14px;">{{ Auth::user()->name }}</span>
            
            @if($unreadCount > 0)
                <span class="d-sm-none badge rounded-circle bg-danger p-1 position-absolute top-0 start-0 translate-middle"></span>
            @endif
          </button>
          
          <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 p-2" style="border-radius: 10px; min-width: 220px;">
            
            <!--  CHAT MOBILE:  -->
            <li class="d-sm-none">
                <a href="{{ route('messages.index') }}" class="dropdown-item rounded py-2 d-flex justify-content-between align-items-center fw-bold">
                    <span><i class="bi bi-chat-left-text me-2 text-primary"></i> I miei messaggi</span>
                    @if($unreadCount > 0)
                        <span class="badge bg-danger rounded-pill">{{ $unreadCount }}</span>
                    @endif
                </a>
            </li>
            <li class="d-sm-none"><hr class="dropdown-divider text-muted"></li>

                        @if(Auth::user()->is_revisor)
                <li>
                    <a href="{{ route('revisor.index') }}" class="dropdown-item rounded py-2 text-primary fw-bold">
                        <i class="bi bi-shield-check me-2"></i> {{ __('ui.revisorDashboard') }}
                    </a>
                </li>
                
                
                @if(Auth::user()->isSuperAdmin())
                    <li>
                        <a href="{{ route('revisor.list') }}" class="dropdown-item rounded py-2 text-danger fw-bold">
                            <i class="bi bi-gear-fill me-2"></i> Gestisci Team
                        </a>
                    </li>
                @endif
                
                <li><hr class="dropdown-divider text-muted"></li>
            @else
                <li>
                    <a href="{{ route('careers') }}" class="dropdown-item rounded py-2">
                        <i class="bi bi-briefcase-fill me-2 text-warning"></i> {{ __('ui.workWithUs') }}
                    </a>
                </li>
                <li><hr class="dropdown-divider text-muted"></li>
            @endif


            <li>
              <a href="{{ route('article.my') }}" class="dropdown-item rounded py-2 {{ request()->routeIs('article.my') ? 'active fw-bold' : '' }}">
                <i class="bi bi-card-list me-2"></i>I miei annunci
              </a>
            </li>

            <li>
              <a href="{{ route('article.create') }}" class="dropdown-item rounded py-2">
                <i class="bi bi-plus-lg me-2 text-success"></i> {{ __('ui.createAnArticle') }}
              </a>
            </li>
            <li><hr class="dropdown-divider text-muted"></li>
            <li>
              <a class="dropdown-item text-danger rounded py-2" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('form-logout').submit();">
                <i class="bi bi-box-arrow-right me-2"></i> {{ __('ui.logout') }}
              </a>
              <form action="{{ route('logout') }}" method="POST" id="form-logout" class="d-none">@csrf</form>
            </li>
          </ul>
        </div>
      @else 
        <div class="d-flex gap-2">
          <a href="{{ route('login') }}" class="btn btn-light fw-semibold text-primary px-3 rounded-pill" style="font-size: 14px;">
              {{ __('ui.login') }}
          </a>
          <a href="{{ route('register') }}" class="btn btn-primary fw-semibold px-3 rounded-pill" style="font-size: 14px;">
              {{ __('ui.register') }}
          </a>
        </div>
      @endauth

      {{--button dark-mode --}}
      <button id="theme-toggle" class="btn btn-theme-toggle rounded-circle p-2 border shadow-sm ms-2" type="button" title="Cambia modalità">
          <i class="bi bi-moon-fill text-dark d-block-light"></i>
          <i class="bi bi-sun-fill text-warning d-block-dark"></i>
      </button>

      {{-- bandiere --}}
      <x-flags />

    </div>
  </div>
</nav>
