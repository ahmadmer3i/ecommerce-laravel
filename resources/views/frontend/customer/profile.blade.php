@extends('layouts.app')
@section('content')
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-4 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">
                        {{ auth()->user()->full_name }} Profile
                    </h1>
                </div>
                <div class="col-lg-6 text-lg-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('customer.profile') }}">Profile</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="row">
            <div class="col-lg-8">
                {{-- <h2 class="h5 text-uppercase mb-4">
                     General Information
                 </h2>--}}
                <form action="{{ route('customer.update_profile') }}"
                      method="post"
                      enctype="multipart/form-data"
                      autocomplete="off">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-lg-12 text-center mb-4">
                            @if(auth()->user()->user_image != '')
                                <img src="{{ asset('assets/users/'.auth()->user()->user_image) }}"
                                     alt="{{ auth()->user()->username }}" class="img-thumbnail" width="120">
                                <div class="mt-2">
                                    <a href="{{ route('customer.remove_profile_image') }}"
                                       class="btn btn-sm btn-outline-danger">Remove image</a>
                                </div>
                            @else
                                <img src="{{ asset('assets/users/avatar.svg') }}"
                                     alt="{{ auth()->user()->username }}" class="img-thumbnail" width="120">
                            @endif
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="first_name" class="text-small text-uppercase">First Name</label>
                            <input type="text" class="form-control form-control-lg"
                                   value="{{ old('first_name', auth()->user()->first_name) }}" name="first_name"
                                   id="first_name">
                            @error('first_name') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="last_name" class="text-small text-uppercase">Last Name</label>
                            <input type="text" class="form-control form-control-lg"
                                   value="{{ old('$this->last_name', auth()->user()->last_name) }}" name="last_name"
                                   id="last_name">
                            @error('last_name') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="email" class="text-small text-uppercase">Email Address</label>
                            <input type="email" class="form-control form-control-lg" name="email" id="email"
                                   value="{{ old('$this->email', auth()->user()->email) }}">
                            @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="mobile" class="text-small text-uppercase">Mobile Number</label>
                            <input type="text" class="form-control form-control-lg" name="mobile" id="mobile"
                                   value="{{ old('mobile', auth()->user()->mobile) }}">
                            @error('mobile') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="password" class="text-small text-uppercase d-flex">Password <small
                                    class="ml-auto text-danger">(Optional)</small></label>
                            <input type="password" class="form-control form-control-lg" name="password" id="password">
                            @error('password') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="password_confirmation" class="text-small text-uppercase d-flex">Re-Password
                                <small
                                    class="ml-auto text-danger">(Optional)</small></label>
                            <input type="password" class="form-control form-control-lg"
                                   name="password_confirmation" id="password_confirmation">
                            @error('password_confirmation') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="user_image" class="text-small text-uppercase">Profile Image</label>
                            <input type="file" class="form-control form-control-lg"
                                   name="user_image" id="user_image">
                            @error('user_image') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-lg-12 form-group">
                            <button class="btn btn-dark" type="submit">Update Profile</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                @include('partial.frontend.customer.sidebar')
            </div>
        </div>
    </section>
@endsection
