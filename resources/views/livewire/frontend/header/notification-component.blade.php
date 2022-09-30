<div>
    <a href="#"
       class="nav-link dropdown-toggle without-after {{ request()->routeIs('customer.profile')  ? 'active' :''}}"
       id="notificationDropdown" data-toggle="dropdown"
       aria-haspopup="true" aria-expanded="false">
        <span class="badge badge-danger badge-counter">{{ $unreadNotificationCount }}</span>
        <i class="fas fa-user-alt mr-1 text-gray"></i>
    </a>
    <div class="dropdown-menu mt-3 notification-dropdown" aria-labelledby="notificationDropdown">
        @forelse($unReadNotifications as $notification)
            @if($notification->type == 'App\Notifications\Frontend\Customer\OrderThanksNotification')
                <a class="dropdown-item d-flex align-items-center" wire:click="markAsRead('{{ $notification->id }}')">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">23/19</div>
                        <span
                            class="font-weight-bold">Order {{ $notification->data['order_ref'] }} Completed Successfully</span>
                    </div>
                </a>
            @endif
            @if($notification->type == 'App\Notifications\Frontend\Customer\OrderCreatedNotification')
                <a class="dropdown-item d-flex align-items-center" wire:click="markAsRead('{{ $notification->id }}')">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">23/19</div>
                        <span
                            class="font-weight-bold">Order {{ $notification->data['order_ref'] }} status is {{ $notification->data['last_transaction'] }}</span>
                    </div>
                </a>
            @endif

        @empty
            <div class="text-center dropdown-item">
                No Notifications Found!
            </div>
        @endforelse
    </div>

</div>
