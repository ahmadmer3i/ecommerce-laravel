<?php

namespace App\Http\Livewire\Frontend\Customer;

use App\Models\Order;
use App\Models\OrderTransaction;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class OrdersComponent extends Component
{
    use LivewireAlert;

    public $showOrder = false;
    public $order;

    public function render()
    {
        return view('livewire.frontend.customer.orders-component', [
            'orders' => auth()->user()->orders,
        ]);
    }

    public function displayOrder($id)
    {
        $this->order = Order::with('products')->find($id);
        $this->showOrder = true;

    }

    public function requestReturnOrder($id)
    {
        $order = Order::whereId($id)->first();
        $order->update(
            [ 'order_status' => Order::REFUND_REQUESTED ]
        );
        $order->transactions()->create([
            'transaction' => OrderTransaction::REFUND_REQUESTED,
            'transaction_number' => $order->transactions()->whereTransaction(OrderTransaction::PAYMENT_COMPLETED)->first()->transaction_number,
        ]);
        $this->alert('success', 'Your request has been sent successfully');
    }
}
