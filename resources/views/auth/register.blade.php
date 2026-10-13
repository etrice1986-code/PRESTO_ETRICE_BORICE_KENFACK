<x-layout>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-5">

                <div class="card shadow-lg border-0 rounded-4 p-4">
                    <h1 class="fw-bold text-center mb-4">Registrati</h1>

                    <form action="{{ route('register') }}" method="POST">
                        @csrf

                        
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nome utente</label>
                            <input type="text" id="name" name="name"
                                   class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback fw-medium">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                       
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input type="email" id="email" name="email"
                                   class="form-control form-control-lg rounded-3 @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback fw-medium">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input type="password" id="password" name="password"
                                   class="form-control form-control-lg rounded-3 @error('password') is-invalid @enderror">
                            @error('password')
                                <div class="invalid-feedback fw-medium">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Conferma Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold">Conferma Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   class="form-control form-control-lg rounded-3 @error('password_confirmation') is-invalid @enderror">
                            @error('password_confirmation')
                                <div class="invalid-feedback fw-medium">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary btn-lg px-4 rounded-3">
                                Registrati
                            </button>

                            <p class="m-0 text-end">
                                <span class="fw-semibold">Hai già un account?</span><br>
                                <a href="{{ route('login') }}" class="btn btn-outline-warning btn-sm mt-1">
                                    Fai il login
                                </a>
                            </p>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

</x-layout>
