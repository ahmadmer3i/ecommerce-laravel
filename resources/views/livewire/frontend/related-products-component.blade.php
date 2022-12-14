<div wire:ignore.self class="row">
    <!-- PRODUCT-->
    @forelse($relatedProducts as $relatedProduct)
        <div class="col-lg-3 col-sm-6">
            <div class="product text-center skel-loader">
                <div class="d-block mb-3 position-relative">
                    <a class="d-block" href="{{ route('frontend.product', $relatedProduct->slug) }}">
                        <img class="img-fluid w-100"
                             src="{{ asset('assets/products/'.$relatedProduct->firstMedia->file_name) }}"
                             alt="{{ $relatedProduct->name }}">
                    </a>
                    <div class="product-overlay">
                        <ul class="mb-0 list-inline">
                            <li class="list-inline-item m-0 p-0">
                                <a class="btn btn-sm btn-outline-dark"
                                   wire:click.prevent="addToWishlist('{{$relatedProduct->id}}')">
                                    <i class="far fa-heart"></i>
                                </a>
                            </li>
                            <li class="list-inline-item m-0 p-0">
                                <a class="btn btn-sm btn-dark text-white"
                                   wire:click.prevent="addToCart('{{$relatedProduct->id}}')">
                                    Add to cart
                                </a>
                            </li>
                            <li class="list-inline-item mr-0">
                                <a class="btn btn-sm btn-outline-dark"
                                   wire:click.prevent="$emit('showProductModalAction', '{{ $relatedProduct->slug }}')"
                                   data-target="#productView"
                                   data-toggle="modal">
                                    <i class="fas fa-expand"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <h6><a class="reset-anchor"
                       href="{{ route('frontend.product', $relatedProduct->slug) }}">{{ $relatedProduct->name }}</a>
                </h6>
                <p class="small text-muted">${{ $relatedProduct->price }}</p>
            </div>
        </div>
    @empty
    @endforelse
    <!-- PRODUCT-->
</div>
