@php
    $waitersActiveRoutes = ['vendor.waiters.index', 'vendor.waiters.create', 'vendor.waiters.edit'];
@endphp



<li class="side-nav-title side-nav-item nav-item">
    <span class="tt-nav-title-text">{{ localize('Waiters Management') }}</span>
</li>

<li class="side-nav-item nav-item ">
    <a data-bs-toggle="collapse" href="#manageWaiter"
        aria-expanded="true" aria-controls="manageWaiter"
        class="side-nav-link tt-menu-toggle">
        <span class="tt-nav-link-icon"><i data-feather="database"></i></span>
        <span class="tt-nav-link-text">{{ localize('Waiters') }}</span>
    </a>
    <div class="collapse " id="manageWaiter">
        <ul class="side-nav-second-level">
           
            <li
                class="{{ areActiveRoutes(['vendor.waiters.index'], 'tt-menu-item-active') }}">
                <a href="{{route('vendor.waiters.index')}}">{{ localize('Waiters') }}</a>
            </li>
            
            <li class="{{ areActiveRoutes(['vendor.waiters.create'], 'tt-menu-item-active') }}">
                <a href="{{route('vendor.waiters.create')}}"
                    class="">{{ localize('Add waiter') }}</a>
            </li>
            
           
           
        </ul>
    </div>
</li>

@php
    $ordersPlaceActiveRoutes = ['vendor.onplaceOrder.index','vendor.onplaceOrder.show'];
@endphp


<li class="side-nav-item nav-item ">
    <a data-bs-toggle="collapse" href="#manageWaiterOrder"
        aria-expanded="true" aria-controls="manageWaiterOrder"
        class="side-nav-link tt-menu-toggle">
        <span class="tt-nav-link-icon"><i data-feather="database"></i></span>
        <span class="tt-nav-link-text">{{ localize('Orders') }}</span>
    </a>
    <div class="collapse " id="manageWaiterOrder">
        <ul class="side-nav-second-level">
           
            <li
                class="{{ areActiveRoutes(['vendor.onplaceOrder.index'], 'tt-menu-item-active') }}">
                <a href="{{route('vendor.onplaceOrder.index')}}">{{ localize('Commandes Sur place') }}</a>
            </li>
           
            <!-- <li class="tt-menu-item-active">
                <a href="#" class="">{{ localize('In pending') }}</a>
            </li> -->
            
            
           
        </ul>
    </div>
</li>
