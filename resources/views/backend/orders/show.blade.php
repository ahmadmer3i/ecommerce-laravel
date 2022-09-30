@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Order ({{ $order->ref_id }})</h6>
            <div class="ml-auto">
                <form action="{{ route('admin.orders.update', $order->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-row align-items-center">
                        <label for="order_status" class="sr-only">Order Status</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Order Status</div>
                            </div>
                            <select name="order_status" id="order_status" class="form-control"
                                    style="outline-style: none;" onchange="this.form.submit()">
                                <option value="">Choose Action</option>
                                @foreach($order_status_array as $key => $value)
                                    <option value="{{ $key }}">
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="d-flex">
            <div class="col-8">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>Ref. ID</th>
                            <td>{{ $order->ref_id }}</td>
                            <th>Customer</th>
                            <td>
                                <a href="{{ route('admin.customers.show', $order->user_id) }}">
                                    {{ $order->user->full_name }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>
                                <a href="{{ route('admin.customer_addresses.show', $order->user_address_id) }}">
                                    {{ $order->user_address->address_title }}
                                </a>
                            </td>
                            <th>Shipping Company</th>
                            <td>{{ $order->shipping_company->name . '('.$order->shipping_company->code. ')'}}</td>
                        </tr>
                        <tr>
                            <th>Created Date</th>
                            <td>{{ $order->created_at->format('d-m-Y h:i a') }}</td>
                            <th>Order Status</th>
                            <td>{!! $order->statusWithLabel() !!}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-4">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>Subtotal</th>
                            <td>{{ $order->currency() . $order->subtotal }}</td>
                        </tr>
                        <tr>
                            <th>Discount Code</th>
                            <td>{{ $order->discount_code }}</td>
                        </tr>
                        <tr>
                            <th>Discount</th>
                            <td>{{ $order->currency() . $order->discount }}</td>
                        </tr>
                        <tr>
                            <th>Shipping</th>
                            <td>{{ $order->currency() . $order->shipping }}</td>
                        </tr>
                        <tr>
                            <th>tax</th>
                            <td>{{ $order->currency() . $order->tax }}</td>
                        </tr>
                        <tr>
                            <th>Amount</th>
                            <td>{{ $order->currency().$order->total }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Transactions
            </h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Transaction</th>
                    <th>Payment Method</th>
                    <th>Transaction Number</th>
                    <th>Payment Result</th>
                    <th>Action Date</th>
                </tr>
                </thead>
                <tbody>
                @forelse($order->transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->status() }}</td>
                        <td>{{ $transaction->transaction = 0 ? $order->payment_method->name : null }}</td>
                        <td>{{ $transaction->transaction_number }}</td>
                        <td>{{ $transaction->payment_result }}</td>
                        <td>{{ $transaction->created_at->format('Y-m-d h:i a') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">NO TRANSACTIONS FOUND</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Details</h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                </tr>
                </thead>
                <tbody>
                @forelse($order->products as $product)
                    <tr>
                        <td><a href="{{ route('admin.products.show', $product->id) }}">{{ $product->name }}</a></td>
                        <td>{{ $product->pivot->quantity }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">NO PRODUCTS FOUND</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
