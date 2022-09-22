<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use App\Models\ProductCategory;
use Gloudemans\Shoppingcart\Facades\Cart;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ShopProductsComponent extends Component
{
    use WithPagination;
    use LivewireAlert;

    public $paginationLimit = 12;
    public $slug;
    public $sortingBy = 'default';
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        switch ($this->sortingBy) {
            case 'popularity':
                $sort_field = 'id';
                $sort_type = 'asc';
                break;
            case 'low-high':
                $sort_field = 'price';
                $sort_type = 'asc';
                break;
            case 'high-low':
                $sort_field = 'price';
                $sort_type = 'desc';
                break;
            default:
                $sort_field = 'id';
                $sort_type = 'asc';
        }
        $products = Product::with('firstMedia');
        if ($this->slug == '') {
            $products = $products->activeCategory();
        } else {
            $product_category = ProductCategory::whereSlug($this->slug)->whereStatus(true)->first();

            if (is_null($product_category->parent_id)) {
                $categoriesIds = ProductCategory::whereParentId($product_category->id)
                    ->whereStatus(true)
                    ->pluck('id')->toArray();
                $products = $products->whereHas('category', function ($query) use ($categoriesIds) {
                    $query->whereIn('id', $categoriesIds);
                });
            } else {
                $products = $products->with('category')->whereHas('category', function ($query) {
                    $query->where([
                        'slug' => $this->slug,
                        'status' => true,
                    ]);
                });
            }
        }
        $products = $products
            ->active()
            ->hasQuantity()
            ->orderBy($sort_field, $sort_type)
            ->paginate($this->paginationLimit);
        return view('livewire.frontend.shop-products-component', [ 'products' => $products ]);
    }

    public function addToCart($id)
    {
        $item = Product::whereId($id)->active()->hasQuantity()->firstOrFail();
        $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($item) {
            return $cartItem->id === $item->id;
        });

        if ($duplicates->isNotEmpty()) {
            $this->alert('error', 'Product Already Exist!');
        } else {
            Cart::instance('default')->add($item->id, $item->name, 1, $item->price)
                ->associate(Product::class);
            $this->emit('updateCart');
            $this->alert('success', 'Product added in your cart successfully');
        }

    }

    public function addToWishlist($id)
    {
        $item = Product::whereId($id)->active()->hasQuantity()->firstOrFail();
        $duplicates = Cart::instance('wishlist')->search(function ($cartItem, $rowId) use ($item) {
            return $cartItem->id === $item->id;
        });
        if ($duplicates->isNotEmpty()) {
            $this->alert('error', 'Product Already Exist!');
        } else {
            Cart::instance('wishlist')->add($item->id, $item->name, 1, $item->price)
                ->associate(Product::class);
            $this->emit('updateCart');
            $this->alert('success', 'Product added in your wishlist successfully');
        }
    }
}
