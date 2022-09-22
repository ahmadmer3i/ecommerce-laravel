<?php

namespace App\Http\Livewire\Frontend;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartItemComponent extends Component
{
    public $item;
    public $itemQuantity = 1;

    public function mount()
    {
        $this->itemQuantity = Cart::instance('default')->get($this->item)->qty ?? 1;
    }

    public function render()
    {
        return view('livewire.frontend.cart-item-component', [ 'cartItem' => Cart::instance('default')->get($this->item) ]);
    }

    public function increaseQty($rowId)
    {
        if ($this->itemQuantity > 0) {
            $this->itemQuantity = $this->itemQuantity + 1;
            Cart::instance('default')->update($rowId, $this->itemQuantity);
            $this->emit('updateCart');
        }
    }

    public function decreaseQty($rowId)
    {
        if ($this->itemQuantity > 1) {
            $this->itemQuantity = $this->itemQuantity - 1;
            Cart::instance('default')->update($rowId, $this->itemQuantity);
            $this->emit('updateCart');
        }

    }

    public function removeFromCart($rowId)
    {
        $this->emit('removeFromCart', $rowId);
    }
}
