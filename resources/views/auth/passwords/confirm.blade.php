@extends('layouts.app')

@section('content')
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">{{ __('Confirm Password') }}</h1>
                </div>
                <div class="col-lg-6 text-lg-right">
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="row">
            <div class="col-6 offset-3">
                <h2 class="h5 text-uppercase mb-4">{{ __('Confirm Password') }}</h2>


                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <div class="col-12">
                        <div class="form-group">
                            <label for="password"
                                   class="text-uppercase text-small">{{ __('Password') }}</label>

                            <input id="password" type="password"
                                   class="form-control form-control-lg" name="password" required
                                   autocomplete="current-password">

                            @error('password')
                            <span class="text-danger" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-dark">
                                {{ __('Confirm Password') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
