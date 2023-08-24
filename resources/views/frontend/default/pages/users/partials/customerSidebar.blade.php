<div class="account-nav bg-white rounded py-5">
    <h6 class="mb-4 px-4">{{ localize('Manage My Account') }}</h6>
    <ul class="nav nav-tabs border-0 d-block account-nav-menu" role="tablist">
        <li>
            <a href="{{ route('customers.dashboard') }}" class="{{ areActiveRoutes(['customers.dashboard'], 'active') }}">
                <span class="me-2">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M3.33333 1.99341H6C6.35362 1.99341 6.69276 2.13388 6.94281 2.38393C7.19286 2.63398 7.33333 2.97312 7.33333 3.32674V5.99341C7.33333 6.34703 7.19286 6.68617 6.94281 6.93622C6.69276 7.18627 6.35362 7.32674 6 7.32674H3.33333C2.97971 7.32674 2.64057 7.18627 2.39052 6.93622C2.14048 6.68617 2 6.34703 2 5.99341V3.32674C2 2.97312 2.14048 2.63398 2.39052 2.38393C2.64057 2.13388 2.97971 1.99341 3.33333 1.99341Z"
                            fill="#212B36"></path>
                        <path
                            d="M10 1.99341H12.6667C13.0203 1.99341 13.3594 2.13388 13.6095 2.38393C13.8595 2.63398 14 2.97312 14 3.32674V5.99341C14 6.34703 13.8595 6.68617 13.6095 6.93622C13.3594 7.18627 13.0203 7.32674 12.6667 7.32674H10C9.64638 7.32674 9.30724 7.18627 9.05719 6.93622C8.80714 6.68617 8.66667 6.34703 8.66667 5.99341V3.32674C8.66667 2.97312 8.80714 2.63398 9.05719 2.38393C9.30724 2.13388 9.64638 1.99341 10 1.99341Z"
                            fill="#212B36"></path>
                        <path
                            d="M6 8.66008H3.33333C2.97971 8.66008 2.64057 8.80055 2.39052 9.0506C2.14048 9.30065 2 9.63979 2 9.99341V12.6601C2 13.0137 2.14048 13.3528 2.39052 13.6029C2.64057 13.8529 2.97971 13.9934 3.33333 13.9934H6C6.35362 13.9934 6.69276 13.8529 6.94281 13.6029C7.19286 13.3528 7.33333 13.0137 7.33333 12.6601V9.99341C7.33333 9.63979 7.19286 9.30065 6.94281 9.0506C6.69276 8.80055 6.35362 8.66008 6 8.66008Z"
                            fill="#212B36"></path>
                        <path
                            d="M10 8.66008H12.6667C13.0203 8.66008 13.3594 8.80055 13.6095 9.0506C13.8595 9.30065 14 9.63979 14 9.99341V12.6601C14 13.0137 13.8595 13.3528 13.6095 13.6029C13.3594 13.8529 13.0203 13.9934 12.6667 13.9934H10C9.64638 13.9934 9.30724 13.8529 9.05719 13.6029C8.80714 13.3528 8.66667 13.0137 8.66667 12.6601V9.99341C8.66667 9.63979 8.80714 9.30065 9.05719 9.0506C9.30724 8.80055 9.64638 8.66008 10 8.66008Z"
                            fill="#212B36"></path>
                    </svg>
                </span>
                {{ localize('Dashboard') }}
            </a>
        </li>
        <li>
            <a href="{{ route('customers.orderHistory') }}"
                class="{{ areActiveRoutes(['customers.orderHistory'], 'active') }}">
                <span class="me-2">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5 12C5 12.5523 4.55228 13 4 13C3.44772 13 3 12.5523 3 12C3 11.4477 3.44772 11 4 11C4.55228 11 5 11.4477 5 12Z"
                            fill="#212B36"></path>
                        <path
                            d="M7 11.94C7 11.4209 7.42085 11 7.94 11H20.06C20.5791 11 21 11.4209 21 11.94V12.06C21 12.5791 20.5791 13 20.06 13H7.94C7.42085 13 7 12.5791 7 12.06V11.94Z"
                            fill="#212B36"></path>
                        <path
                            d="M3 16.94C3 16.4209 3.42085 16 3.94 16H20.06C20.5791 16 21 16.4209 21 16.94V17.06C21 17.5791 20.5791 18 20.06 18H3.94C3.42085 18 3 17.5791 3 17.06V16.94Z"
                            fill="#212B36"></path>
                        <path
                            d="M3 6.94C3 6.42085 3.42085 6 3.94 6H20.06C20.5791 6 21 6.42085 21 6.94V7.06C21 7.57915 20.5791 8 20.06 8H3.94C3.42085 8 3 7.57915 3 7.06V6.94Z"
                            fill="#212B36"></path>
                    </svg>
                </span>
                {{ localize('Order History') }}
            </a>
        </li>

        @if (getSetting('enable_reward_points') == 1)
            <li>
                <a href="{{ route('customers.rewardPoints') }}"
                    class="{{ areActiveRoutes(['customers.rewardPoints'], 'active') }}">
                    <span class="me-2">

                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-award">
                            <circle cx="12" cy="8" r="7"></circle>
                            <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                        </svg>

                    </span>
                    {{ localize('Reward Points') }}
                </a>
            </li>
        @endif

        <li>
            <a href="{{ route('customers.walletHistory') }}"
                class="{{ areActiveRoutes(['customers.walletHistory'], 'active') }}">
                <span class="me-2">

                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-credit-card">
                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2">
                        </rect>
                        <line x1="1" y1="10" x2="23" y2="10"></line>
                    </svg>
                </span>
                {{ localize('Wallet History') }}
            </a>
        </li>


        @if (getSetting('enable_refund_system') == 1)
            <li>
                <a href="{{ route('customers.refunds') }}"
                    class="{{ areActiveRoutes(['customers.refunds'], 'active') }}">
                    <span class="me-2">

                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-arrow-left">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                    </span>
                    {{ localize('Refund History') }}
                </a>
            </li>
        @endif
        <li>
            <a href="{{ route('customers.trackOrder') }}"
                class="{{ areActiveRoutes(['customers.trackOrder'], 'active') }}">
                <span class="me-2">

                    <svg width="16" height="20" viewBox="0 0 16 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M7.64077 4.84662C5.83139 4.84662 4.35938 6.31863 4.35938 8.12801C4.35938 9.93738 5.83139 11.4094 7.64077 11.4094C9.45014 11.4094 10.9222 9.93738 10.9222 8.12801C10.9222 6.31863 9.45014 4.84662 7.64077 4.84662ZM7.64077 9.53431C6.86531 9.53431 6.23447 8.90342 6.23447 8.12801C6.23447 7.35256 6.86536 6.72171 7.64077 6.72171C8.41622 6.72171 9.04706 7.3526 9.04706 8.12801C9.04711 8.90342 8.41622 9.53431 7.64077 9.53431Z"
                            fill="#212B36" />
                        <path
                            d="M7.64095 0.490906C3.42769 0.490906 0 3.91691 0 8.12802V8.33319C0 10.4566 1.2053 12.9162 3.58242 15.6439C5.29261 17.6062 6.98091 18.9762 7.05197 19.0335L7.64091 19.5091L8.22989 19.0335C8.30095 18.9762 9.98934 17.6062 11.6994 15.6439C14.0766 12.9162 15.2819 10.4566 15.2819 8.33319V8.12802C15.2819 3.91686 11.8542 0.490906 7.64095 0.490906ZM13.4068 8.12802V8.33319C13.4068 9.96191 12.3339 12.0567 10.3041 14.391C9.28875 15.5587 8.26158 16.519 7.64072 17.0696C7.02459 16.5234 6.00816 15.5733 4.99608 14.4119C2.9543 12.0692 1.87509 9.96711 1.87509 8.33319V8.12802C1.87509 4.95083 4.46166 2.366 7.64095 2.366C10.8203 2.366 13.4068 4.95083 13.4068 8.12802Z"
                            fill="#212B36" />
                    </svg>

                </span>
                {{ localize('Track Order') }}
            </a>
        </li>

        <li>
            <a href="{{ route('customers.address') }}"
                class="{{ areActiveRoutes(['customers.address'], 'active') }}">
                <span class="me-2">

                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M15.8169 7.5581C15.3974 7.13867 8.74938 0.4906 8.44188 0.183105C8.19787 -0.0610351 7.80212 -0.0610351 7.5581 0.183105C7.22179 0.519409 0.59558 7.1455 0.183105 7.5581C-0.0610351 7.80212 -0.0610351 8.19787 0.183105 8.44201C0.427124 8.68603 0.822875 8.68603 1.06689 8.44201L1.22912 8.27978V15.375C1.22912 15.7202 1.50903 16 1.85412 16H14.1459C14.491 16 14.7709 15.7202 14.7709 15.375V8.27978L14.933 8.44201C15.1771 8.68603 15.5729 8.68603 15.8169 8.44201C16.061 8.19787 16.061 7.80212 15.8169 7.5581ZM9.83336 14.75H6.16674V11.0834H9.83336V14.75ZM13.5209 14.75H11.0834V10.4584C11.0834 10.1132 10.8036 9.83337 10.4584 9.83337H5.54174C5.19653 9.83337 4.91674 10.1132 4.91674 10.4584V14.75H2.47925V7.02978L7.99999 1.50891L13.5209 7.02978V14.75Z"
                            fill="#5D6374" />
                    </svg>
                </span>
                {{ localize('Address Book') }}
            </a>
        </li>

        <li>
            <a href="{{ route('customers.profile') }}"
                class="{{ areActiveRoutes(['customers.profile'], 'active') }}">
                <span class="me-2">
                    <svg width="12" height="16" viewBox="0 0 12 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M6.00007 7.6714C3.96403 7.6714 2.30762 6.0148 2.30762 3.97855C2.30762 1.94251 3.96407 0.286133 6.00007 0.286133C8.03629 0.286133 9.69289 1.94255 9.69289 3.97855C9.69289 6.0148 8.03629 7.6714 6.00007 7.6714ZM6.00007 1.47569C4.61996 1.47569 3.49717 2.59848 3.49717 3.97855C3.49717 5.35887 4.61996 6.48185 6.00007 6.48185C7.38036 6.48185 8.50334 5.35887 8.50334 3.97855C8.50334 2.59848 7.38036 1.47569 6.00007 1.47569Z"
                            fill="#5D6374" />
                        <path
                            d="M8.30755 15.7138H3.69245C1.65642 15.7138 0 14.0573 0 12.0213C0 9.98527 1.65645 8.32886 3.69245 8.32886H8.30755C10.3436 8.32886 12 9.98527 12 12.0213C12 14.0573 10.3436 15.7138 8.30755 15.7138ZM3.69245 9.51841C2.31234 9.51841 1.18955 10.6412 1.18955 12.0213C1.18955 13.4014 2.31234 14.5242 3.69245 14.5242H8.30755C9.68766 14.5242 10.8104 13.4014 10.8104 12.0213C10.8104 10.6412 9.68766 9.51841 8.30755 9.51841H3.69245Z"
                            fill="#5D6374" />
                    </svg>
                </span>
                {{ localize('Updated Profile') }}
            </a>
        </li>

        <li>
            <a href="{{ route('logout') }}">
                <span class="me-2">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M6.99256 4.80345e-05C6.90051 0.000953881 6.80954 0.0200661 6.72486 0.056324C6.64018 0.092582 6.56345 0.145268 6.49906 0.211345C6.43467 0.277423 6.38388 0.355642 6.34961 0.441455C6.31533 0.527268 6.29825 0.618997 6.29932 0.711451V6.33816C6.29937 6.5248 6.37322 6.70381 6.50463 6.83576C6.63605 6.96772 6.81426 7.04181 7.00008 7.04181C7.1859 7.04181 7.36411 6.96772 7.49552 6.83576C7.62694 6.70381 7.70079 6.5248 7.70084 6.33816V0.711451C7.70193 0.617724 7.68435 0.524709 7.64914 0.437903C7.61394 0.351097 7.56181 0.272215 7.49582 0.205936C7.42983 0.139657 7.35131 0.0873274 7.26489 0.0519641C7.17846 0.0166007 7.08587 -0.00104732 6.99256 4.80345e-05ZM11.0768 1.4105C11.054 1.40984 11.0312 1.4103 11.0084 1.41187C10.87 1.42367 10.7382 1.47658 10.6298 1.56383C10.5214 1.65107 10.4413 1.7687 10.3997 1.90181C10.3581 2.03491 10.3568 2.17749 10.396 2.31132C10.4353 2.44515 10.5133 2.56423 10.6201 2.65342C11.8328 3.68778 12.6 5.22732 12.6 6.95615C12.6 10.0778 10.1044 12.5938 7.00349 12.5938C3.90258 12.5938 1.40151 10.0778 1.40152 6.95615C1.40152 5.23732 2.15898 3.70824 3.35954 2.67401C3.42949 2.61404 3.48699 2.5408 3.52876 2.45851C3.57053 2.37622 3.59576 2.28649 3.603 2.19441C3.61024 2.10233 3.59935 2.00976 3.57096 1.92191C3.54256 1.83406 3.49722 1.75268 3.43751 1.68243C3.37781 1.61218 3.30491 1.55443 3.22298 1.51248C3.14106 1.47052 3.0517 1.44514 2.96003 1.43787C2.86835 1.4306 2.77615 1.44156 2.68869 1.47009C2.60122 1.49861 2.52021 1.54414 2.45027 1.60412C0.951587 2.89516 6.5878e-06 4.81954 0 6.95615C-6.29675e-06 10.8366 3.14463 14.0002 7.0035 14.0002C10.8624 14.0002 14.0002 10.8366 14.0002 6.95615C14.0001 4.80707 13.0392 2.87479 11.5253 1.58353C11.4008 1.47453 11.2419 1.41324 11.0768 1.4105Z"
                            fill="#5D6374" />
                    </svg>
                </span>
                {{ localize('Log out') }}
            </a>
        </li>
    </ul>
</div>
