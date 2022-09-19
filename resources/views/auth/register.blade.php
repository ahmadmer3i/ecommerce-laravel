@extends('layouts.app')

@section('content')
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">Register</h1>
                </div>
                <div class="col-lg-6 text-lg-right">
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="row">
            <div class="col-6 offset-3">
                <h2 class="h5 text-uppercase mb-4">{{ __('Register') }}</h2>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first_name" class="text-small text-uppercase">{{ __('First Name') }}</label>
                                <input id="first_name" type="text"
                                       class="form-control form-control-lg" name="first_name"
                                       value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                @error('first_name')
                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="last_name" class="text-small text-uppercase">{{ __('Last Name') }}</label>
                                <input id="last_name" type="text"
                                       class="form-control form-control-lg" name="last_name"
                                       value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                                @error('last_name')
                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="username" class="text-small text-uppercase">{{ __('Username') }}</label>
                                <input id="username" type="text"
                                       class="form-control form-control-lg" name="username"
                                       value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email"
                                       class="text-small text-uppercase">{{ __('Email Address') }}</label>
                                <input id="email" type="email"
                                       class="form-control form-control-lg" name="email"
                                       value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="mobile"
                                       class="text-small text-uppercase">{{ __('Phone Number') }}</label>
                                <input id="mobile" type="text"
                                       class="form-control form-control-lg" name="mobile"
                                       value="{{ old('mobile') }}" required autocomplete="mobile" autofocus>

                                @error('mobile')
                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="password"
                                       class="text-small text-uppercase">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                       class="form-control form-control-lg" name="password"
                                       value="{{ old('password') }}" required autocomplete="password" autofocus>

                                @error('password')
                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="password_confirmation"
                                       class="text-small text-uppercase">{{ __('Confirm Password') }}</label>
                                <input id="password_confirmation" type="password"
                                       class="form-control form-control-lg" name="password_confirmation"
                                       value="{{ old('password_confirmation') }}" required
                                       autocomplete="password_confirmation" autofocus>

                                @error('password_confirmation')
                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Register') }}
                                </button>
                                @if(Route::has('login'))
                                    <a href="{{ route('login') }}"
                                       class="btn btn-link float-right">{{ __('Have an account?') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
