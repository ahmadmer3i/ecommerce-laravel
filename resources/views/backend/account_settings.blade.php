@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">
                Account Settings
            </h6>
            <div class="ml-auto">

            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.update_account_settings') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text"
                                   class="form-control"
                                   id="first_name"
                                   name="first_name"
                                   value="{{ old('first_name', auth()->user()->first_name) }}"
                            />
                            @error('first_name') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text"
                                   class="form-control"
                                   id="last_name"
                                   name="last_name"
                                   value="{{ old('last_name', auth()->user()->last_name) }}"
                            />
                            @error('last_name') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text"
                                   name="username"
                                   class="form-control"
                                   id="username"
                                   value="{{ old('username', auth()->user()->username) }}"
                            />
                            @error('username') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="email">Username</label>
                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   id="email"
                                   value="{{ old('email', auth()->user()->email) }}"
                            />
                            @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="text"
                                   name="mobile"
                                   class="form-control"
                                   id="mobile"
                                   value="{{ old('mobile', auth()->user()->mobile) }}"
                            />
                            @error('mobile') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   id="password"
                                   value="{{ old('password') }}"
                            />
                            @error('password') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col-12">
                        <label for="user-image">User Image</label>
                        <br>
                        <div class="file-loading">
                            <input type="file" name="user_image" id="user-image" class="file-input-new">

                        </div>
                        @error('user_image')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
        @endsection
        @section('script')
            <script>
                $(function () {
                    $("#user-image").fileinput({
                        theme: "fa5",
                        maxFileCount: 1,
                        allowedFileTypes: ['image'],
                        showCancel: true,
                        showRemove: false,
                        showUpload: false,
                        overwriteInitial: false,
                        initialPreview: [
                            @if(auth()->user()->user_image != '')
                                "{{ asset('assets/users/'.auth()->user()->user_image) }}"
                            @endif
                        ],
                        initialPreviewAsData: true,
                        initialPreviewFileType: 'image',
                        initialPreviewConfig: [
                                @if(auth()->user()->user_image != '')
                            {
                                caption: "{{ auth()->user()->user_image }}",
                                siz: '1111',
                                width: "120px",
                                url: "{{ route('admin.remove_image', ['admin_id'=> auth()->id(), '_token'=>csrf_token()])}}",
                                key: {{ auth()->id() }}
                            }
                            @endif
                        ]
                    })
                });
            </script>
@endsection
