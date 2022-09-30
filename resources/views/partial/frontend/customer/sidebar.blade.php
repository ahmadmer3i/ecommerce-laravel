<div class="card border-0 rounded-0 py-lg-4 bg-light">
    <div class="card-body">
        <h5 class="text-uppercase mb-4">Navigation</h5>
        <div class="py-2 px-4 mb-3 {{ request()->routeIs('customer.dashboard') ? 'bg-dark text-light':'bg-light' }}">
            <a href="{{ route('customer.dashboard') }}">
                <strong class="small text-uppercase font-weight-bold">
                    Dashboard
                </strong>
            </a>
        </div>
        <div class="py-2 px-4 mb-3 {{ request()->routeIs('customer.profile') ? 'bg-dark text-light':'bg-light' }}">
            <a href="{{ route('customer.profile') }}">
                <strong class="small text-uppercase font-weight-bold">
                    Profile
                </strong>
            </a>
        </div>
        <div class="py-2 px-4 mb-3 {{ request()->routeIs('customer.addresses') ? 'bg-dark text-light':'bg-light' }}">
            <a href="{{ route('customer.addresses') }}">
                <strong class="small text-uppercase font-weight-bold">
                    Addresses
                </strong>
            </a>
        </div>
        <div class="py-2 px-4 mb-3 {{ request()->routeIs('customer.orders') ? 'bg-dark text-light':'bg-light' }}">
            <a href="{{ route('customer.orders') }}">
                <strong class="small text-uppercase font-weight-bold">
                    Orders
                </strong>
            </a>
        </div>
        <div class="py-2 px-4 mb-3 bg-light">
            <a href="javascript:void(0)"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                <strong class="small text-uppercase font-weight-bold">
                    Logout
                </strong>
            </a>
            <form action="{{ route('logout') }}" id="logout-form" method="post" class="d-none">
                @csrf
            </form>
        </div>
    </div>

</div>
