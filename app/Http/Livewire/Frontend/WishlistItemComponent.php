<?php

namespace App\Http\Livewire\Frontend;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class WishlistItemComponent extends Component
{
    public $item;

    public function render()
    {
        return view('livewire.frontend.wishlist-item-component', [
            'wishlistItem' => Cart::instance('wishlist')->get($this->item),
        ]);
    }

    public function moveToCart($rowId)
    {
        $this->emit('moveToCart', $rowId);
    }

    public function removeFromWishlist($rowId)
    {
        $this->emit('removeFromWishlist', $rowId);
    }
}
