<div class="d-flex">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('frontend.cart') }}">
            <i class="fas fa-dolly-flatbed mr-1 text-gray"></i>
            <small class="text-gray">({{ $cartCount == 0 ? '0' : $cartCount }})</small>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('frontend.wishlist') }}">
            <i class="far fa-heart mr-1"></i>
            <small class="text-gray">({{ $wishlistCount == 0 ? '0' : $wishlistCount }})</small>
        </a>
    </li>
</div>
