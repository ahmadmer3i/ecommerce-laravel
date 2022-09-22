<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class FeaturedProduct extends Component
{
    use LivewireAlert;

    public function render()
    {
        return view('livewire.frontend.featured-product', [ 'featured_products' => Product::with('firstMedia')
            ->inRandomOrder()->Featured()->Active()->HasQuantity()->ActiveCategory()->take(8)->get() ]);
    }

    public function addToCart($id)
    {
        $product = Product::whereId($id)->active()->hasQuantity()->firstOrFail();
        $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->id;
        });
        if ($duplicates->isNotEmpty()) {
            $this->alert('error', 'Product Already Exists');
        } else {
            Cart::instance('default')
                ->add($product->id, $product->name, 1, $product->price)
                ->associate(Product::class);
            $this->emit('updateCart');
            $this->alert('success', 'Product added in your cart successfully');
        }
    }

    public function addToWishlist($id)
    {
        $product = Product::whereId($id)->active()->hasQuantity()->firstOrFail();
        $duplicates = Cart::instance('wishlist')->search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->id;
        });
        if ($duplicates->isNotEmpty()) {
            $this->alert('error', 'Product Already Exists');
        } else {
            Cart::instance('wishlist')
                ->add($product->id, $product->name, 1, $product->price)
                ->associate(Product::class);
            $this->emit('updateCart');
            $this->alert('success', 'Product added in your wishlist successfully');
        }
    }
}
