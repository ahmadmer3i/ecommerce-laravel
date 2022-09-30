<?php

namespace App\Http\Livewire\Backend\Navbar;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class NotificationComponent extends Component
{
    use LivewireAlert;

    public $unreadNotificationCount = 0;
    public $unReadNotifications;

    public function getListeners(): array
    {

        $userId = auth()->id();
        return [
//            "echo-notification:App.Models.User.{$userId},notification" => 'mount',
//            "echo:App.Models.User.{$userId},notification" => 'mount',
//            "echo-private:App.Models.User.{$userId},.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated" => 'mount',
            "echo-notification:App.Models.User.{$userId},.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated" => 'mount',
//            "echo-notification:App.Models.User.{$userId},notification" => 'mount',
        ];
    }

    public function mount()
    {
        $this->unReadNotifications = auth()->user()->unreadNotifications()->get();
        $this->unreadNotificationCount = auth()->user()->unreadNotifications->count();

    }

    public function render()
    {
        return view('livewire.backend.navbar.notification-component');
    }

    public function notificationsReceived()
    {
        $this->unreadNotificationCount = auth()->user()->unreadNotifications->count();
        $notification = auth()->user()->unreadNotifications->first();
//        dd($notification->data[ 'order_url' ]);
        $this->alert('success', "A new order with amount " . $notification->data[ 'amount' ] . " from " . $notification->data[ 'customer_name' ]);

    }


    public function markAsRead($id)
    {

        $notification = auth()->user()->unreadNotifications->where('id', $id)->first;
        $notification->markAsRead();
        return redirect()->to($notification->data->data[ 'order_url' ]);
    }
}
