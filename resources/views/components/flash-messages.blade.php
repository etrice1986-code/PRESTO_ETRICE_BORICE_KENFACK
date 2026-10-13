<div>
    @if (session()->has('successMessage'))
        <div class="alert alert-success">
           <h3 class="text-center">
            {{session('successMessage')}}
           </h3>
        </div>
    @endif

    @if (session()->has('errorMessage'))
        <div class="alert alert-danger">
           <h3 class="text-center">
            {{session('errorMessage')}}
           </h3>
        </div>
    @endif
</div>