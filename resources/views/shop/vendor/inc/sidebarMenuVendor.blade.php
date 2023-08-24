<ul class="tt-side-nav">

    <!-- dashboard -->
    <li class="side-nav-item nav-item">
        <a href="{{ route('vendor.dashboard') }}" class="side-nav-link">
            <span class="tt-nav-link-icon"><i data-feather="pie-chart"></i></span>
            <span class="tt-nav-link-text">{{ localize('Dashboard') }}</span>
        </a>
    </li>

    <!-- products -->
    @php
        $productsActiveRoutes = ['vendor.brands.index', 'vendor.brands.edit', 'vendor.units.index', 'vendor.units.edit', 'vendor.variations.index', 'vendor.variations.edit', 'vendor.variationValues.index', 'vendor.variationValues.edit', 'vendor.taxes.index', 'vendor.taxes.edit', 'vendor.categories.index', 'vendor.categories.create', 'vendor.categories.edit', 'vendor.products.index', 'vendor.products.create', 'vendor.products.edit'];
    @endphp
    @canany(['products', 'categories', 'variations', 'brands', 'units', 'taxes'])
        <li class="side-nav-item nav-item ">
            <a data-bs-toggle="collapse" href="#sidebarProducts"
                aria-expanded="true" aria-controls="sidebarProducts"
                class="side-nav-link tt-menu-toggle">
                <span class="tt-nav-link-icon"><i data-feather="shopping-bag"></i></span>
                <span class="tt-nav-link-text">{{ localize('Products') }}</span>
            </a>

            <div class="collapse " id="sidebarProducts">
                <ul class="side-nav-second-level">
                    @can('products')
                        <li
                            class="{{ areActiveRoutes(['vendor.products.index', 'vendor.products.create', 'vendor.products.edit'], 'tt-menu-item-active') }}">
                            <a href="{{ route('vendor.products.index') }}"
                                class="{{ areActiveRoutes(['vendor.products.index', 'vendor.products.create', 'vendor.products.edit']) }}">{{ localize('All Products') }}</a>
                        </li>
                    @endcan
                    @can('categories')
                        <li
                            class="{{ areActiveRoutes(['vendor.categories.index', 'vendor.categories.create', 'vendor.categories.edit'], 'tt-menu-item-active') }}">
                            <a href="{{ route('vendor.categories.index') }}"
                                class="{{ areActiveRoutes(['vendor.categories.index', 'vendor.categories.create', 'vendor.categories.edit']) }}">{{ localize('All Categories') }}</a>
                        </li>
                    @endcan
                    @can('variations')
                        <li
                            class="{{ areActiveRoutes(
                                ['vendor.variations.index', 'vendor.variations.edit', 'vendor.variationValues.index', 'vendor.variationValues.edit'],
                                'tt-menu-item-active',
                            ) }}">
                            <a href="{{ route('vendor.variations.index') }}"
                                class="{{ areActiveRoutes([
                                    'vendor.variations.index',
                                    'vendor.variations.edit',
                                    'vendor.variationValues.index',
                                    'vendor.variationValues.edit',
                                ]) }}">{{ localize('All Variations') }}</a>
                        </li>
                    @endcan
                    @can('brands')
                        <li class="{{ areActiveRoutes(['vendor.brands.index', 'vendor.brands.edit'], 'tt-menu-item-active') }}">
                            <a href="{{ route('vendor.brands.index') }}"
                                class="{{ areActiveRoutes(['vendor.brands.index', 'vendor.brands.edit']) }}">{{ localize('All Brands') }}</a>
                        </li>
                    @endcan
                    @can('units')
                        <li class="{{ areActiveRoutes(['vendor.units.index', 'vendor.units.edit'], 'tt-menu-item-active') }}">
                            <a href="{{ route('vendor.units.index') }}"
                                class="{{ areActiveRoutes(['vendor.units.index']) }}">{{ localize('All Units') }}</a>
                        </li>
                    @endcan

                    @can('taxes')

                        <li class="{{ areActiveRoutes(['vendor.taxes.index', 'vendor.taxes.edit'], 'tt-menu-item-active') }}">
                            <a href="{{ route('vendor.taxes.index') }}"
                                class="{{ areActiveRoutes(['vendor.taxes.index']) }}">{{ localize('All Taxes') }}</a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    
    @endcan
    <!-- pos -->
    

    <!-- orders -->
    @can('orders')
        <li
            class="side-nav-item nav-item {{ areActiveRoutes(['vendor.orders.index', 'vendor.orders.show'], 'tt-menu-item-active') }}">
            <a href="{{ route('vendor.orders.index') }}"
                class="side-nav-link {{ areActiveRoutes(['vendor.orders.index', 'vendor.orders.show']) }}">
                <span class="tt-nav-link-icon"><i data-feather="shopping-cart"></i></span>
                <span class="tt-nav-link-text">
                    <span>{{ localize('Orders') }}</span>

                    @php
                        $newOrdersCount = \App\Models\Order::isPlaced()->where('shop_id',auth()->user()->shop_id)->count();
                    @endphp

                    @if ($newOrdersCount > 0)
                        <small class="badge bg-danger">{{ localize('New') }}</small>
                    @endif
                </span>
            </a>
        </li>
    @endcan

    <!-- stock -->
    @php
        $stockActiveRoutes = ['vendor.stocks.create', 'vendor.locations.index', 'vendor.locations.create', 'vendor.locations.edit'];
    @endphp
    @canany(['add_stock', 'show_locations'])
        <li class="side-nav-item nav-item ">
            <a data-bs-toggle="collapse" href="#manageStock"
                aria-expanded="true" aria-controls="manageStock"
                class="side-nav-link tt-menu-toggle">
                <span class="tt-nav-link-icon"><i data-feather="database"></i></span>
                <span class="tt-nav-link-text">{{ localize('Stocks') }}</span>
            </a>
            <div class="collapse " id="manageStock">
                <ul class="side-nav-second-level">
                    @can('add_stock')
                        <li class="{{ areActiveRoutes(['vendor.stocks.create'], 'tt-menu-item-active') }}">
                            <a href="{{ route('vendor.stocks.create') }}"
                                class="{{ areActiveRoutes(['vendor.stocks.create']) }}">{{ localize('Add Stock') }}</a>
                        </li>
                    @endcan
                    @can('show_locations')
                        <li
                            class="{{ areActiveRoutes(['vendor.locations.index', 'vendor.locations.create', 'vendor.locations.edit'], 'tt-menu-item-active') }}">
                            <a href="{{ route('vendor.locations.index') }}">{{ localize('Rupture de stock') }}</a>
                        </li>
                    @endcan
                    
                </ul>
            </div>
        </li>
    
    @endcan

    
    <!-- Rewards & Wallet -->
   @php
        $refundsActiveRoutes = ['vendor.refund.configurations', 'vendor.refund.requests', 'vendor.refund.refunded', 'vendor.refund.rejected'];
    @endphp

    @canany(['refund_configurations', 'refund_requests', 'approved_refunds', 'rejected_refunds'])
        <li class="side-nav-item nav-item ">
            <a data-bs-toggle="collapse" href="#manageRewards"
                aria-expanded="true" aria-controls="manageRewards"
                class="side-nav-link tt-menu-toggle">
                <span class="tt-nav-link-icon"><i data-feather="award"></i></span>
                <span class="tt-nav-link-text">{{ localize('Rewards & Wallet') }}</span>
            </a>
            <div class="collapse " id="manageRewards">
                <ul class="side-nav-second-level">

                    @can('refund_configurations')
                        <li class="">
                            <a href="{{ route('vendor.rewards.configurations') }}"
                                class="{{ areActiveRoutes(['vendor.rewards.configurations']) }}">{{ localize('Reward Configurations') }}</a>
                        </li>
                    
                    @endcan
                    @can('refund_requests')
                        <li class="{{ areActiveRoutes(['vendor.rewards.setPoints'], 'tt-menu-item-active') }}">
                            <a href="{{ route('vendor.rewards.setPoints') }}">{{ localize('Set Reward Points') }}</a>
                        </li>
                    @endcan
                    @can('approved_refunds')
                        <li class="{{ areActiveRoutes(['vendor.wallet.configurations'], 'tt-menu-item-active') }}">
                            <a href="{{ route('vendor.wallet.configurations') }}"
                                class="{{ areActiveRoutes(['vendor.wallet.configurations']) }}">{{ localize('Wallet Configurations') }}</a>
                        </li>
                    @endcan
                    @can('rejected_refunds')
                        <li class="{{ areActiveRoutes(['vendor.refund.rejected'], 'tt-menu-item-active') }}">
                            <a href="{{ route('vendor.refund.rejected') }}">{{ localize('Rejected Refunds') }}</a>
                        </li>
                    @endcan
                    
                </ul>
            </div>
        </li>
    @endcan

    <!-- Shops included -->
    
    
    @can('shop_staff')
    <!-- staffs -->
    <li class="side-nav-title side-nav-item nav-item">
        <span class="tt-nav-title-text">{{ localize('Utilisateurs') }}</span>
    </li>

   
    <li
        class="side-nav-item nav-item {{ areActiveRoutes(['vendor.staffs.index', 'vendor.staffs.create', 'vendor.staffs.edit'], 'tt-menu-item-active') }}">
        <a href="{{ route('vendor.staffs.index') }}" class="side-nav-link">
            <span class="tt-nav-link-icon"> <i data-feather="user-check"></i></span>
            <span class="tt-nav-link-text">{{ localize('Employees') }}</span>
        </a>
    </li>  


    @endcan

    @include('shop/backend/waiters/partials/sidebarWaiter')
   
    @php
        $appearanceShopActiveRoutes = ['vendor.shops.edit', 'vendor.shops.editSettingShop'];
    @endphp


    <li class="side-nav-title side-nav-item nav-item">
        <span class="tt-nav-title-text">{{ localize('Settings') }}</span>
    </li>
    
    <!-- Appearance -->
    @can('edit_shop')
        <li class="side-nav-item nav-item ">
            <a href="{{ route('vendor.shops.edit') }}" class="side-nav-link">
                <span class="tt-nav-link-icon"><i data-feather="layout"></i></span>
                <span class="tt-nav-link-text">{{ localize('Générale') }}</span>
            </a>
        </li>
    @endcan

    <!-- Roles & Permission -->
    @php
        $rolesActiveRoutes = ['vendor.roles.index', 'vendor.roles.create', 'vendor.roles.edit'];
    @endphp
    @can('roles_and_permissions')
    <li class="side-nav-item nav-item ">
        <a href="{{ route('vendor.roles.index') }}" class="side-nav-link">
            <span class="tt-nav-link-icon"><i data-feather="unlock"></i></span>
            <span class="tt-nav-link-text">{{ localize('Roles & Permissions') }}</span>
        </a>
    </li>
    @endcan

    

    

  
</ul>
