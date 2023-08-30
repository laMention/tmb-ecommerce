<!-- Shops -->
@php
    $shopsActiveRoutes = ['shop.shops.index', 'shop.shops.create', 'shop.shops.edit'];
@endphp

@canany(['shops','add_shop'])
<li class="side-nav-title side-nav-item nav-item">
    <span class="tt-nav-title-text">{{ localize('Shops Management') }}</span>
</li>
 
<li class="side-nav-item nav-item {{areActiveRoutes($shopsActiveRoutes, 'tt-menu-item-active') }}">
    <a data-bs-toggle="collapse" href="#manageShop"
        aria-expanded="{{ areActiveRoutes($shopsActiveRoutes, 'true') }}" aria-controls="manageShop"
        class="side-nav-link tt-menu-toggle">
        <span class="tt-nav-link-icon"><i data-feather="database"></i></span>
        <span class="tt-nav-link-text">{{ localize('Shops') }}</span>
    </a>
    <div class="collapse {{ areActiveRoutes($shopsActiveRoutes, 'show') }}" id="manageShop">
        <ul class="side-nav-second-level">
            @can('shops')
            <li
                class="{{areActiveRoutes(['shop.shops.index'], 'tt-menu-item-active')}}">
                <a href="{{ route('shop.shops.index') }}">{{ localize('Shops') }}</a>
            </li>
            @endcan

            @can('add_shop')
            <li class="{{ areActiveRoutes(['shop.shops.create'], 'tt-menu-item-active') }}">
                <a href="{{ route('shop.shops.create') }}"
                    class="{{ areActiveRoutes(['shop.shops.createe']) }}">{{ localize('Add shops') }}</a>
            </li>
            @endcan
      
            
           
        </ul>
    </div>
</li>
@endcan

@can('shop_staff')
<li class="side-nav-item nav-item">
    <a href="{{route('shop.shops.shopsEmployees')}}" class="side-nav-link">
        <span class="tt-nav-link-icon"> <i data-feather="users"></i></span>
        <span class="tt-nav-link-text">{{ localize('Shops staffs') }}</span>
    </a>
</li>
@endcan

 <!-- Waiters included -->
 @include('shop.backend.waiters.partials.sidebarWaiter')
