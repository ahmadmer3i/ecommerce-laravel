<div>
    <div class="row align-items-stretch mb-4">
        <div class="col-sm-5 pr-sm-0">
            <div
                class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white">
                <span class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                <div class="quantity">
                    <button wire:click="decreaseQuantity" class="p-0"><i class="fas fa-caret-left"></i></button>
                    <input class="form-control border-0 shadow-0 p-0" type="text" wire:model="quantity">
                    <button wire:click="increaseQuantity" class="p-0"><i class="fas fa-caret-right"></i></button>
                </div>
            </div>
        </div>
        <div class="col-sm-3 pl-sm-0">
            <a class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0 text-white"
               wire:click="addToCart">
                Add to cart
            </a>
        </div>
    </div>
    <a class="btn btn-link text-dark p-0 mb-4" wire:click="addToWishlist">
        <i class="far fa-heart mr-2"></i>Add to wish list
    </a>
</div>
