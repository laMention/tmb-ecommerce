<ul class="tt-side-nav">

    <!-- dashboard -->
    <li class="side-nav-item nav-item">
        <a href="{{ route('admin.dashboard') }}" class="side-nav-link">
            <span class="tt-nav-link-icon"><i data-feather="pie-chart"></i></span>
            <span class="tt-nav-link-text">{{ localize('Dashboard') }}</span>
        </a>
    </li>

    <!-- products -->
    
        <li class="side-nav-item nav-item {{ areActiveRoutes($productsActiveRoutes, 'tt-menu-item-active') }}">
            <a data-bs-toggle="collapse" href="#sidebarProducts"
                aria-expanded="{{ areActiveRoutes($productsActiveRoutes, 'true') }}" aria-controls="sidebarProducts"
                class="side-nav-link tt-menu-toggle">
                <span class="tt-nav-link-icon"><i data-feather="shopping-bag"></i></span>
                <span class="tt-nav-link-text">{{ localize('Products') }}</span>
            </a>

            <div class="collapse {{ areActiveRoutes($productsActiveRoutes, 'show') }}" id="sidebarProducts">
                <ul class="side-nav-second-level">

                        <li
                            class="{{ areActiveRoutes(['admin.products.index', 'admin.products.create', 'admin.products.edit'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.products.index') }}"
                                class="{{ areActiveRoutes(['admin.products.index', 'admin.products.create', 'admin.products.edit']) }}">{{ localize('All Products') }}</a>
                        </li>
                    
                        <li
                            class="{{ areActiveRoutes(['admin.categories.index', 'admin.categories.create', 'admin.categories.edit'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.categories.index') }}"
                                class="{{ areActiveRoutes(['admin.categories.index', 'admin.categories.create', 'admin.categories.edit']) }}">{{ localize('All Categories') }}</a>
                        </li>
                    
                        <li
                            class="{{ areActiveRoutes(
                                ['admin.variations.index', 'admin.variations.edit', 'admin.variationValues.index', 'admin.variationValues.edit'],
                                'tt-menu-item-active',
                            ) }}">
                            <a href="{{ route('admin.variations.index') }}"
                                class="{{ areActiveRoutes([
                                    'admin.variations.index',
                                    'admin.variations.edit',
                                    'admin.variationValues.index',
                                    'admin.variationValues.edit',
                                ]) }}">{{ localize('All Variations') }}</a>
                        </li>
                   
                        <li class="{{ areActiveRoutes(['admin.brands.index', 'admin.brands.edit'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.brands.index') }}"
                                class="{{ areActiveRoutes(['admin.brands.index', 'admin.brands.edit']) }}">{{ localize('All Brands') }}</a>
                        </li>
                   
                        <li class="{{ areActiveRoutes(['admin.units.index', 'admin.units.edit'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.units.index') }}"
                                class="{{ areActiveRoutes(['admin.units.index']) }}">{{ localize('All Units') }}</a>
                        </li>
                   

                        <li class="{{ areActiveRoutes(['admin.taxes.index', 'admin.taxes.edit'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.taxes.index') }}"
                                class="{{ areActiveRoutes(['admin.taxes.index']) }}">{{ localize('All Taxes') }}</a>
                        </li>
                    
                </ul>
            </div>
        </li>
    

    <!-- pos -->
    

    <!-- orders -->
    
        <li
            class="side-nav-item nav-item {{ areActiveRoutes(['admin.orders.index', 'admin.orders.show'], 'tt-menu-item-active') }}">
            <a href="{{ route('admin.orders.index') }}"
                class="side-nav-link {{ areActiveRoutes(['admin.orders.index', 'admin.orders.show']) }}">
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
    

    <!-- stock -->
   
        <li class="side-nav-item nav-item {{ areActiveRoutes($stockActiveRoutes, 'tt-menu-item-active') }}">
            <a data-bs-toggle="collapse" href="#manageStock"
                aria-expanded="{{ areActiveRoutes($stockActiveRoutes, 'true') }}" aria-controls="manageStock"
                class="side-nav-link tt-menu-toggle">
                <span class="tt-nav-link-icon"><i data-feather="database"></i></span>
                <span class="tt-nav-link-text">{{ localize('Stocks') }}</span>
            </a>
            <div class="collapse {{ areActiveRoutes($stockActiveRoutes, 'show') }}" id="manageStock">
                <ul class="side-nav-second-level">

                        <li class="{{ areActiveRoutes(['admin.stocks.create'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.stocks.create') }}"
                                class="{{ areActiveRoutes(['admin.stocks.create']) }}">{{ localize('Add Stock') }}</a>
                        </li>
                    
                        <li
                            class="{{ areActiveRoutes(['admin.locations.index', 'admin.locations.create', 'admin.locations.edit'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.locations.index') }}">{{ localize('All Locations') }}</a>
                        </li>
                    
                </ul>
            </div>
        </li>
    


    
    <!-- Rewards & Wallet -->
   
        <li class="side-nav-item nav-item {{ areActiveRoutes($rewardsActiveRoutes, 'tt-menu-item-active') }}">
            <a data-bs-toggle="collapse" href="#manageRewards"
                aria-expanded="{{ areActiveRoutes($rewardsActiveRoutes, 'true') }}" aria-controls="manageRewards"
                class="side-nav-link tt-menu-toggle">
                <span class="tt-nav-link-icon"><i data-feather="award"></i></span>
                <span class="tt-nav-link-text">{{ localize('Rewards & Wallet') }}</span>
            </a>
            <div class="collapse {{ areActiveRoutes($rewardsActiveRoutes, 'show') }}" id="manageRewards">
                <ul class="side-nav-second-level">

                    
                        <li class="{{ areActiveRoutes(['admin.rewards.configurations'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.rewards.configurations') }}"
                                class="{{ areActiveRoutes(['admin.rewards.configurations']) }}">{{ localize('Reward Configurations') }}</a>
                        </li>
                    

                        <li class="{{ areActiveRoutes(['admin.rewards.setPoints'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.rewards.setPoints') }}">{{ localize('Set Reward Points') }}</a>
                        </li>
                    

                        <li class="{{ areActiveRoutes(['admin.wallet.configurations'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.wallet.configurations') }}"
                                class="{{ areActiveRoutes(['admin.wallet.configurations']) }}">{{ localize('Wallet Configurations') }}</a>
                        </li>
                    
                </ul>
            </div>
        </li>


    <!-- Shops included -->
    
    

    <!-- staffs -->
    
        <li
            class="side-nav-item nav-item {{ areActiveRoutes(['admin.staffs.index', 'admin.staffs.create', 'admin.staffs.edit'], 'tt-menu-item-active') }}">
            <a href="{{ route('admin.staffs.index') }}" class="side-nav-link">
                <span class="tt-nav-link-icon"> <i data-feather="user-check"></i></span>
                <span class="tt-nav-link-text">{{ localize('Employee Staffs') }}</span>
            </a>
        </li>
    

    <!-- Contents -->
    <li class="side-nav-title side-nav-item nav-item">
        <span class="tt-nav-title-text">{{ localize('Contents') }}</span>
    </li>

   

    <!-- Reports -->
    <li class="side-nav-title side-nav-item nav-item">
        <span class="tt-nav-title-text">{{ localize('Reports') }}</span>
    </li>

    <!-- reports -->
    @php
        $reportActiveRoutes = ['admin.reports.orders', 'admin.reports.sales', 'admin.reports.categorySales', 'admin.reports.salesAmount', 'admin.reports.deliveryStatus'];
    @endphp

    @canany(['order_reports', 'product_sale_reports', 'category_sale_reports', 'sales_amount_reports',
        'delivery_status_reports'])
        <li class="side-nav-item nav-item {{ areActiveRoutes($reportActiveRoutes, 'tt-menu-item-active') }}">
            <a data-bs-toggle="collapse" href="#reports"
                aria-expanded="{{ areActiveRoutes($reportActiveRoutes, 'true') }}" aria-controls="reports"
                class="side-nav-link tt-menu-toggle">
                <span class="tt-nav-link-icon"><i data-feather="bar-chart"></i></span>
                <span class="tt-nav-link-text">{{ localize('Reports') }}</span>
            </a>
            <div class="collapse {{ areActiveRoutes($reportActiveRoutes, 'show') }}" id="reports">
                <ul class="side-nav-second-level">

                    @can('order_reports')
                        <li class="{{ areActiveRoutes(['admin.reports.orders'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.reports.orders') }}"
                                class="{{ areActiveRoutes(['admin.reports.orders']) }}">{{ localize('Orders Report') }}</a>
                        </li>
                    @endcan

                    @can('product_sale_reports')
                        <li class="{{ areActiveRoutes(['admin.reports.sales'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.reports.sales') }}"
                                class="{{ areActiveRoutes(['admin.reports.sales']) }}">{{ localize('Product Sales') }}</a>
                        </li>
                    @endcan

                    @can('category_sale_reports')
                        <li class="{{ areActiveRoutes(['admin.reports.categorySales'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.reports.categorySales') }}"
                                class="{{ areActiveRoutes(['admin.reports.categorySales']) }}">{{ localize('Category Wise Sales') }}</a>
                        </li>
                    @endcan

                    @can('sales_amount_reports')
                        <li class="{{ areActiveRoutes(['admin.reports.salesAmount'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.reports.salesAmount') }}"
                                class="{{ areActiveRoutes(['admin.reports.salesAmount']) }}">{{ localize('Sales Amount Report') }}</a>
                        </li>
                    @endcan

                    @can('delivery_status_reports')
                        <li class="{{ areActiveRoutes(['admin.reports.deliveryStatus'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.reports.deliveryStatus') }}"
                                class="{{ areActiveRoutes(['admin.reports.deliveryStatus']) }}">{{ localize('Delivery Status Report') }}</a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcan


    <!-- Settings -->
    <li class="side-nav-title side-nav-item nav-item">
        <span class="tt-nav-title-text">{{ localize('Settings') }}</span>
    </li>

    <!-- Appearance -->
   
        <li class="side-nav-item nav-item {{ areActiveRoutes($appearanceActiveRoutes, 'tt-menu-item-active') }}">
            <a data-bs-toggle="collapse" href="#Appearance"
                aria-expanded="{{ areActiveRoutes($appearanceActiveRoutes, 'true') }}" aria-controls="Appearance"
                class="side-nav-link tt-menu-toggle">
                <span class="tt-nav-link-icon"><i data-feather="layout"></i></span>
                <span class="tt-nav-link-text">{{ localize('Appearance') }}</span>
            </a>
            <div class="collapse {{ areActiveRoutes($appearanceActiveRoutes, 'show') }}" id="Appearance">
                <ul class="side-nav-second-level">

                    
                        <li class="{{ areActiveRoutes($homepageActiveRoutes, 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.appearance.homepage.hero') }}"
                                class="{{ areActiveRoutes($homepageActiveRoutes) }}">{{ localize('Homepage') }}</a>
                        </li>
                   
                        <li class="{{ areActiveRoutes(['admin.appearance.products.index'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.appearance.products.index') }}"
                                class="{{ areActiveRoutes(['admin.appearance.products.index']) }}">{{ localize('Products Page') }}</a>
                        </li>
                    
                        <li
                            class="{{ areActiveRoutes(['admin.appearance.products.details', 'admin.appearance.products.details.editWidget'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.appearance.products.details') }}"
                                class="{{ areActiveRoutes(['admin.appearance.products.details']) }}">{{ localize('Product Details') }}</a>
                        </li>
                    

                        <li class="{{ areActiveRoutes($aboutUsActiveRoutes, 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.appearance.about-us.index') }}"
                                class="{{ areActiveRoutes($aboutUsActiveRoutes) }}">{{ localize('About Us') }}</a>
                        </li>
                   
                        <li class="{{ areActiveRoutes(['admin.appearance.header'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.appearance.header') }}"
                                class="{{ areActiveRoutes(['admin.appearance.header']) }}">{{ localize('Header') }}</a>
                        </li>
                    
                        <li class="{{ areActiveRoutes(['admin.appearance.footer'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.appearance.footer') }}"
                                class="{{ areActiveRoutes(['admin.appearance.footer']) }}">{{ localize('Footer') }}</a>
                        </li>
                    
                </ul>
            </div>
        </li>
  


    <!-- Roles & Permission -->
    
    <li class="side-nav-item nav-item {{ areActiveRoutes($rolesActiveRoutes, 'tt-menu-item-active') }}">
        <a href="{{ route('admin.roles.index') }}" class="side-nav-link">
            <span class="tt-nav-link-icon"><i data-feather="unlock"></i></span>
            <span class="tt-nav-link-text">{{ localize('Roles & Permissions') }}</span>
        </a>
    </li>
    

  
</ul>
