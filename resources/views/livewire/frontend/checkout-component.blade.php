<div class="row">
    <div class="col-lg-8">
        <h2 class="h5 text-uppercase mb-4">Shipping addresses</h2>
        <div class="row">
            @forelse($addresses as $address)
                <div class="col-6 form-group">
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            id="address-{{$address->id}}"
                            class="custom-control-input"
                            wire:model="customer_address_id"
                            wire:click="updateShippingCompanies"
                            {{ intval($customer_address_id == $address->id ? 'checked' : '') }}
                            value="{{ $address->id }}"
                        />
                        <label for="address-{{$address->id}}" class="custom-control-label text-small">
                            <b>{{ $address->address_title }}</b>
                            <small>
                                {{ $address->address }}<br>
                                {{ $address->country->name }} - {{ $address->state->name }} - {{ $address->city->name }}
                            </small>
                        </label>
                    </div>
                </div>
            @empty
                <p>No Address Found</p>
                <a href="#">Add an address</a>
            @endforelse
        </div>
        @if($customer_address_id != '')
            <h2 class="h5 text-uppercase mb-4">Shipping way</h2>
            <div class="row">
                @forelse($shipping_companies as $shippingCompany)
                    <div class="col-6 form-group">
                        <div class="custom-control custom-radio">
                            <input
                                type="radio"
                                id="$shipping-company-{{$shippingCompany->id}}"
                                class="custom-control-input"
                                wire:model="shipping_company_id"
                                wire:click="updateShippingCost"
                                {{ intval($shipping_company_id == $shippingCompany->id ? 'checked' : '') }}
                                value="{{ $shippingCompany->id }}"
                            />
                            <label for="$shipping-company-{{$shippingCompany->id}}"
                                   class="custom-control-label text-small">
                                <b>{{ $shippingCompany->name }}</b>
                                <small>
                                    {{ $address->description }} - (${{ $shippingCompany->cost }})
                                </small>
                            </label>
                        </div>
                    </div>
                @empty
                    <p>No Shipping Companies Found</p>
                @endforelse
            </div>
        @endif
        @if($customer_address_id != '' && $shipping_company_id != '')
            <h2 class="h5 text-uppercase mb-4">Payment way</h2>
            <div class="row">
                @forelse($payment_methods as $payment_method)
                    <div class="col-6 form-group">
                        <div class="custom-control custom-radio">
                            <input
                                type="radio"
                                id="payment-method-{{$payment_method->id}}"
                                class="custom-control-input"
                                wire:model="payment_method_id"
                                wire:click="updatePaymentMethod()"
                                {{ intval($shipping_company_id == $payment_method->id ? 'checked' : '') }}
                                value="{{ $payment_method->id }}"
                            />
                            <label for="payment-method-{{$payment_method->id}}"
                                   class="custom-control-label text-small">
                                <b>{{ $payment_method->name }}</b>
                            </label>
                        </div>
                    </div>
                @empty
                    <p>No Payment Way Found</p>
                @endforelse
            </div>
        @endif
        @if($customer_address_id != '' && $shipping_company_id != '' && $payment_method_id != '')
            @if(Str::lower($payment_method_code) == 'ppex')
                <form action="{{ route('checkout.payment') }}" method="post">
                    @csrf
                    <input type="hidden" class="form-control" name="customer_address_id"
                           value="{{ old('customer_address_id', $customer_address_id) }}">
                    <input type="hidden" class="form-control" name="shipping_company_id"
                           value="{{ old('shipping_company_id', $shipping_company_id) }}">
                    <input type="hidden" class="form-control" name="payment_method_id"
                           value="{{ old('payment_method_id', $payment_method_id) }}">
                    <button type="submit" name="submit" class="btn btn-dark btn-sm btn-block">
                        Continue to checkout with PayPal
                    </button>
                </form>
            @endif
        @endif
    </div>
    <!-- ORDER SUMMARY-->
    <div class="col-lg-4">
        <div class="card border-0 rounded-0 p-lg-4 bg-light">
            <div class="card-body">
                <h5 class="text-uppercase mb-4">Your order</h5>
                <ul class="list-unstyled mb-0">
                    <li class="d-flex align-items-center justify-content-between"><strong
                            class="small font-weight-bold">Subtotal</strong><span
                            class="text-muted small">${{ $cart_subtotal }}</span></li>
                    <li class="border-bottom my-2"></li>
                    @if(session()->has('coupon'))
                        <li class="d-flex align-items-center justify-content-between">
                            <strong class="small font-weight-bold">Discount
                                <small>({{ getNumbers()->get('discount_code') }})</small>
                            </strong>
                            <span class="text-muted small">- ${{ $cart_discount }}</span>
                        </li>
                        <li class="border-bottom my-2"></li>
                    @endif
                    @if(session()->has('shipping'))
                        <li class="d-flex align-items-center justify-content-between">
                            <strong class="small font-weight-bold">Shipping
                                <small>({{ getNumbers()->get('shipping_code') }})</small>
                            </strong>
                            <span class="text-muted small">${{ $cart_shipping }}</span>
                        </li>
                        <li class="border-bottom my-2"></li>
                    @endif
                    <li class="d-flex align-items-center justify-content-between"><strong
                            class="small font-weight-bold">Tax</strong><span
                            class="text-muted small">${{ $cart_tax }}</span></li>
                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between"><strong
                            class="text-uppercase small font-weight-bold">Total</strong>
                        <span>${{ $cart_total }}</span>
                    </li>
                    <li class="border-bottom my-2"></li>
                    <li class="">
                        <form wire:submit.prevent="applyDiscount">
                            @if(!session()->has('coupon'))
                                <input type="text" wire:model="coupon_code" class="form-control"
                                       placeholder="Enter your coupon">

                            @endif
                            @if(session()->has('coupon'))
                                <button type="button" wire:click="removeCoupon" class="btn btn-danger btn-sm btn-block">
                                    <i class="fas fa-gift mr-2"></i>Remove coupon
                                </button>
                            @else
                                <button type="submit" class="btn btn-dark btn-sm btn-block">
                                    <i class="fas fa-gift mr-2"></i>Apply coupon
                                </button>
                            @endif

                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
