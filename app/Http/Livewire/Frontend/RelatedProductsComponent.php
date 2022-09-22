<?php

namespace App\Http\Livewire\Frontend;

use Gloudemans\Shoppingcart\Facades\Cart;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\Product;

class RelatedProductsComponent extends Component
{
    use LivewireAlert;

    public $relatedProducts;

    public function mount($relatedProducts)
    {
        $this->relatedProducts = $relatedProducts;
    }

    public function render()
    {
        return view('livewire.frontend.related-products-component');
    }

    public function addToCart($id)
    {
        $product = Product::whereId($id)->active()->hasQuantity()->firstOrFail();
        $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->id;
        });

        if ($duplicates->isNotEmpty()) {
            $this->alert('error', 'Product Already Exist!');
        } else {
            Cart::instance('default')->add($product->id, $product->name, 1, $product->price)
                ->associate(Product::class);
            $this->quantity = 1;
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
            $this->alert('error', 'Product Already Exist!');
        } else {
            Cart::instance('wishlist')->add($product->id, $product->name, 1, $product->price)
                ->associate(Product::class);
            $this->emit('updateCart');
            $this->alert('success', 'Product added in your wishlist successfully');
        }
    }
}
