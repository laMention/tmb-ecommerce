<div class="btn-group flex-wrap" role="group" aria-label="First group">
    @can('shipping_zones')
        <a href="{{ route('vendor.logisticZones.index') }}"
            class="btn btn-outline-primary {{ areActiveRoutes(['vendor.logisticZones.index']) }}">
            <i data-feather="disc" class="me-1"></i>{{ localize('Zones') }}
        </a>
    @endcan

    @can('shipping_cities')
        <a href="{{ route('vendor.cities.index') }}"
            class="btn btn-outline-primary {{ areActiveRoutes(['vendor.cities.index']) }}">
            <i data-feather="pocket" class="me-1"></i>{{ localize('Cities') }}
        </a>
    @endcan

    @can('shipping_states')
        <a href="{{ route('vendor.states.index') }}"
            class="btn btn-outline-primary {{ areActiveRoutes(['vendor.states.index']) }}">
            <i data-feather="pie-chart" class="me-1"></i>{{ localize('States') }}
        </a>
    @endcan

    @can('shipping_countries')
        <a href="{{ route('vendor.countries.index') }}"
            class="btn btn-outline-primary {{ areActiveRoutes(['vendor.countries.index']) }}">
            <i data-feather="globe" class="me-1"></i>{{ localize('Countries') }}
        </a>
    @endcan
</div>
