<!-- Shops -->
@php
    $shopsActiveRoutes = ['admin.shops.index', 'admin.shops.create', 'admin.shops.edit'];
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
                class="{{areActiveRoutes(['admin.shops.index'], 'tt-menu-item-active')}}">
                <a href="{{ route('admin.shops.index') }}">{{ localize('Shops') }}</a>
            </li>
            @endcan

            @can('add_shop')
            <li class="{{ areActiveRoutes(['admin.shops.create'], 'tt-menu-item-active') }}">
                <a href="{{ route('admin.shops.create') }}"
                    class="{{ areActiveRoutes(['admin.shops.createe']) }}">{{ localize('Add shops') }}</a>
            </li>
            @endcan
      
            
           
        </ul>
    </div>
</li>
@endcan

@can('shop_staff')
<li class="side-nav-item nav-item">
    <a href="{{route('admin.shops.shopsEmployees')}}" class="side-nav-link">
        <span class="tt-nav-link-icon"> <i data-feather="users"></i></span>
        <span class="tt-nav-link-text">{{ localize('Shops staffs') }}</span>
    </a>
</li>
@endcan
