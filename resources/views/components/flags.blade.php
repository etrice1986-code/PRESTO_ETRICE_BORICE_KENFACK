<div class="d-flex align-items-center gap-2 border-start ps-3 ms-2">
   
    <a href="{{ route('setLocale', 'it') }}" class="btn btn-link p-0 shadow-none border-0 transition-flag {{ App::getLocale() == 'it' ? 'opacity-100 scale-110' : 'opacity-50' }}" title="Italiano">
        <x-flag-country-it style="width: 24px; height: 24px; border-radius: 50%; object-fit: cover;" />
    </a>

    
    <a href="{{ route('setLocale', 'en') }}" class="btn btn-link p-0 shadow-none border-0 transition-flag {{ App::getLocale() == 'en' ? 'opacity-100 scale-110' : 'opacity-50' }}" title="English">
        <x-flag-country-gb style="width: 24px; height: 24px; border-radius: 50%; object-fit: cover;" />
    </a>


    <a href="{{ route('setLocale', 'es') }}" class="btn btn-link p-0 shadow-none border-0 transition-flag {{ App::getLocale() == 'es' ? 'opacity-100 scale-110' : 'opacity-50' }}" title="Español">
        <x-flag-country-es style="width: 24px; height: 24px; border-radius: 50%; object-fit: cover;" />
    </a>
</div>
