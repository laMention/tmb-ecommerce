@php
    $waitersActiveRoutes = ['vendor.waiters.index', 'vendor.waiters.create', 'vendor.waiters.edit'];
@endphp



<li class="side-nav-title side-nav-item nav-item">
    <span class="tt-nav-title-text">{{ localize('Gestion des serveurs') }}</span>
</li>

<li
            class="side-nav-item nav-item {{ areActiveRoutes(['vendor.waiters.index', 'vendor.waiters.create'], 'tt-menu-item-active') }}">
            <a href="{{ route('vendor.waiters.index') }}"
                class="side-nav-link {{ areActiveRoutes(['vendor.waiters.index'], 'tt-menu-item-active') }}">
                <span class="tt-nav-link-icon"><i data-feather="shopping-cart"></i></span>
                <span class="tt-nav-link-text">
                    <span>{{ localize('Serveurs') }}</span>

                    @php
                        $newServeursCount = \App\Models\Serveur::where('shop_id',auth()->user()->shop_id)->where('etat',1)->count();
                    @endphp

                    @if ($newServeursCount > 0)
                        <small class="badge bg-danger">{{ $newServeursCount }}</small>
                    @endif
                </span>
            </a>
        </li>


<!-- <li class="side-nav-item nav-item ">
    <a data-bs-toggle="collapse" href="#manageWaiter"
        aria-expanded="true" aria-controls="manageWaiter"
        class="side-nav-link tt-menu-toggle">
        <span class="tt-nav-link-icon"><i data-feather="database"></i></span>
        <span class="tt-nav-link-text">{{ localize('Serveurs') }}</span>
    </a>
    <div class="collapse " id="manageWaiter">
        <ul class="side-nav-second-level">
           
            
            
            <li class="{{ areActiveRoutes(['vendor.waiters.create'], 'tt-menu-item-active') }}">
                <a href="{{route('vendor.waiters.create')}}"
                    class="">{{ localize('Ajouter un serveur') }}</a>
            </li>
        
           
        </ul>
    </div>
</li> -->


{{-- <li class="side-nav-item nav-item ">
    <a data-bs-toggle="collapse" href="#manageWaiterOrder"
        aria-expanded="true" aria-controls="manageWaiterOrder"
        class="side-nav-link tt-menu-toggle">
        <span class="tt-nav-link-icon"><i data-feather="database"></i></span>
        <span class="tt-nav-link-text">{{ localize('Orders') }}</span>
    </a>
    <div class="collapse " id="manageWaiterOrder">
        <ul class="side-nav-second-level">
           
            <li
                class="tt-menu-item-active">
                <a href="#">{{ localize('Waiters Orders') }}</a>
            </li>
           
            <li class="tt-menu-item-active">
                <a href="#"
                    class="">{{ localize('In pending') }}</a>
            </li>
            
            
           
        </ul>
    </div>
</li> --}}

