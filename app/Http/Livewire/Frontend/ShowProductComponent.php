<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ShowProductComponent extends Component
{
    use LivewireAlert;

    public $quantity = 1;
    public $product;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.frontend.show-product-component');
    }

    public function increaseQuantity()
    {
        if ($this->product->quantity > $this->quantity) {
            $this->quantity++;
        } else {
            $this->alert('warning', 'This is maximum quantity you can add!');
        }

    }

    public function decreaseQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart()
    {
        $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) {
            return $cartItem->id === $this->product->id;
        });

        if ($duplicates->isNotEmpty()) {
            $this->alert('error', 'Product Already Exist!');
        } else {
            Cart::instance('default')->
            add($this->product->id, $this->product->name, $this->quantity, $this->product->price)
                ->associate(Product::class);
            $this->quantity = 1;
            $this->emit('updateCart');
            $this->alert('success', 'Product added in your cart successfully');
        }

    }

    public function addToWishlist()
    {
        $duplicates = Cart::instance('wishlist')->search(function ($cartItem, $rowId) {
            return $cartItem->id === $this->product->id;
        });
        if ($duplicates->isNotEmpty()) {
            $this->alert('error', 'Product Already Exist!');
        } else {
            Cart::instance('wishlist')->add($this->product->id, $this->product->name, 1, $this->product->price)
                ->associate(Product::class);
            $this->emit('updateCart');
            $this->alert('success', 'Product added in your wishlist successfully');
        }
    }
}
