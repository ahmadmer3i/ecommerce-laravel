@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">
                Edit review on product {{ $productReview->product->name }}
            </h6>
            <div class="ml-auto">
                <a href="{{ route('admin.product_reviews.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">
                        Reviews
                    </span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.product_reviews.update', $productReview->id) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $productReview->name) }}"
                                   class="form-control"/>
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   value="{{ old('email', $productReview->email) }}"
                                   class="form-control"/>
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="rating">Rating</label>
                        <select name="rating" id="rating" class="form-control form-select">
                            <option value="">---</option>

                            <option
                                value="1"
                                {{ old('patent_id', $productReview->rating) == '1' ? 'selected' : null  }}>
                                1
                            </option>
                            <option
                                value="2"
                                {{ old('patent_id', $productReview->rating) == '2' ? 'selected' : null  }}>
                                2
                            </option>
                            <option
                                value="3"
                                {{ old('patent_id', $productReview->rating) == '3' ? 'selected' : null  }}>
                                3
                            </option>
                            <option
                                value="4"
                                {{ old('patent_id', $productReview->rating) == '4' ? 'selected' : null  }}>
                                4
                            </option>
                            <option
                                value="5"
                                {{ old('patent_id', $productReview->rating) == '5' ? 'selected' : null  }}>
                                5
                            </option>

                        </select>
                        @error('rating') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="product_id">Product</label>
                            <input type="text" class="form-control" readonly
                                   id="product_id" name="product_id"
                                   value="{{ $productReview->product->name }}">
                            <input type="hidden" name="product_id" value="{{$productReview->product_id}}" readonly>
                            @error('product_id') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="user_id">Customer</label>
                            <input type="text" class="form-control" readonly name="user_id" id="user_id"
                                   value="{{ $productReview->user_id != '' ? $productReview->user->name : ''}}">
                            <input type="hidden" name="user_id" value="{{$productReview->user_id ?? ''}}" readonly>
                            @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="status">Status</label>
                        <select name="status" class="form-control form-select" id="status">
                            <option value="1" {{ old('status', $productReview->status) == "1" ? 'selected' : null }}>
                                Active
                            </option>
                            <option value="0" {{ old('status', $productReview->status) == "0" ? 'selected' : null }}>
                                Inactive
                            </option>
                        </select>
                        @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control"
                                   id="title" name="title"
                                   value="{{ $productReview->title }}">
                            @error('title') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea type="text" class="form-control"
                                  id="message" name="message">{{ $productReview->message }}</textarea>
                        @error('message') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Update Review</button>
                </div>
            </form>
        </div>
    </div>
@endsection
