@php
    $tablesActiveRoutes = ['vendor.table.index', 'vendor.table.create', 'vendor.table.edit'];
@endphp



<li class="side-nav-title side-nav-item nav-item">
    <span class="tt-nav-title-text">{{ localize('Tables Management') }}</span>
</li>

<li class="side-nav-item nav-item {{ areActiveRoutes($tablesActiveRoutes, 'tt-menu-item-active') }}">
    <a href="{{ route('vendor.table.index') }}" class="side-nav-link">
        <span class="tt-nav-link-icon"><i data-feather="unlock"></i></span>
        <span class="tt-nav-link-text">{{ localize('Tables') }}</span>
    </a>
</li>
