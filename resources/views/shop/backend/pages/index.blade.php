@extends('backend.layouts.master')

@section('title')
    {{ localize('Shops') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')
    <section class="tt-section pt-4">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card tt-page-header">
                        <div class="card-body d-lg-flex align-items-center justify-content-lg-between">
                            <div class="tt-page-title">
                                <h2 class="h5 mb-lg-0">{{ localize('Shops') }}</h2>
                            </div>
                            <div class="tt-action">
                                
                              <a href="{{ route('admin.shops.create') }}" class="btn btn-primary"><i
                                data-feather="plus"></i> {{ localize('Add Shop') }}</a>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-12">
                    <div class="card mb-4" id="section-1">
                        <form class="app-search" action="{{ Request::fullUrl() }}" method="GET">
                            <div class="card-header border-bottom-0">
                                <div class="row justify-content-between g-3">
                                    <div class="col-auto flex-grow-1">
                                        <div class="tt-search-box">
                                            <div class="input-group">
                                                <span class="position-absolute top-50 start-0 translate-middle-y ms-2"> <i
                                                        data-feather="search"></i></span>
                                                <input class="form-control rounded-start w-100" type="text"
                                                    id="search" name="search" placeholder="{{ localize('Search') }}"
                                                    @isset($searchKey)
                                        value="{{ $searchKey }}"
                                        @endisset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="input-group">
                                            <select class="form-select select2" name="is_published"
                                                data-minimum-results-for-search="Infinity">
                                                <option value="">{{ localize('Sort by') }}</option>

                                                <option value="0"
                                                    @isset($is_published)
                                                     @if ($is_published == 0) selected @endif
                                                    @endisset>
                                                    {{ localize('Not Published') }}</option>

                                                <option value="1"
                                                    @isset($is_published)
                                                     @if ($is_published == 1) selected @endif
                                                    @endisset>
                                                    {{ localize('Published') }}</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="input-group">
                                            <select class="form-select select2" name="is_approved"
                                                data-minimum-results-for-search="Infinity">
                                                <option value="">{{ localize('Select status') }}</option>

                                                <option value="0"
                                                    @isset($is_approved)
                                                     @if ($is_approved == 0) selected @endif
                                                    @endisset>
                                                    {{ localize('Pending') }}</option>

                                                <option value="1"
                                                    @isset($is_approved)
                                                     @if ($is_approved == 1) selected @endif
                                                    @endisset>
                                                    {{ localize('Approved') }}</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary">
                                            <i data-feather="search" width="18"></i>
                                            {{ localize('Search') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <table class="table tt-footable border-top" data-use-parent-width="true">
                            <thead>
                                <tr>
                                    <th class="text-center">N0</th>
                                    <th class="text-center">{{ localize('Logo') }}</th>
                                    <th>{{ localize('Shop Name') }}</th>
                                    <th data-breakpoints="xs sm">{{ localize('Address') }}</th>
                                    <th data-breakpoints="xs sm">{{ localize('Manager') }}</th>
                                    <th data-breakpoints="xs sm">{{ localize('Is Approved') }}</th>
                                    <th data-breakpoints="xs sm md">{{ localize('Is published') }}</th></th>
                                    <th data-breakpoints="xs sm md" class="text-end">{{ localize('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shops as $key => $shop)
                                    <tr>
                                        <td class="text-center">
                                            {{ $key + 1 + ($shops->currentPage() - 1) * $shops->perPage() }}
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" class="d-flex align-items-center">
                                                <div class="avatar avatar-sm">
                                                    <img class="rounded-circle"
                                                        src="{{ uploadedAsset($shop->shop_logo) }}" alt=""
                                                        onerror="this.onerror=null;this.src='{{ asset('backend/assets/img/placeholder-thumb.png') }}';" />
                                                </div>
                                                
                                            </a>
                                        </td>
                                        <td>
                                            <h6 class="fs-sm mb-0 ms-2">{{ $shop->shop_name }}</h6>
                                        </td>
                                        <td>
                                            {{ $shop->shop_address }}
                                        </td>
                                        <td>
                                            {{ $shop->user->name }}
                                        </td>
                                        <td class="text-end">
                                            <div class="form-check form-switch">
                                                <input type="checkbox" onchange="updateShopStatus(this)"
                                                    class="form-check-input"
                                                    @if ($shop->is_approved) checked @endif
                                                    value="{{ $shop->id }}">
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <div class="form-check form-switch">
                                                <input type="checkbox" onchange="updateShopPublishStatus(this)"
                                                    class="form-check-input"
                                                    @if ($shop->is_published) checked @endif
                                                    value="{{ $shop->id }}">
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <div class="dropdown tt-tb-dropdown">
                                                <button type="button" class="btn p-0" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i data-feather="more-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end shadow">
                                                    
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.shops.edit', ['id' => $shop->id, 'lang_key' => env('DEFAULT_LANGUAGE')]) }}&localize">
                                                        <i data-feather="edit-3" class="me-2"></i>{{ localize('Edit') }}
                                                    </a>
                                                    

                                                   <!--  <a class="dropdown-item"
                                                        href="{{-- route('products.show', $product->slug) --}}"
                                                        target="_blank">
                                                        <i data-feather="eye"
                                                            class="me-2"></i>{{ localize('View Details') }}
                                                    </a> -->

                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.shops.delete', $shop->id) }}"
                                                        target="_blank">
                                                        <i data-feather="trash"
                                                            class="me-2"></i>{{ localize('Delete') }}
                                                    </a>


                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!--pagination start-->
                        <div class="d-flex align-items-center justify-content-between px-4 pb-4">
                            <span>{{ localize('Showing') }}
                                {{ $shops->firstItem() }}-{{ $shops->lastItem() }} {{ localize('of') }}
                                {{ $shops->total() }} {{ localize('results') }}</span>
                            <nav>
                                {{ $shops->appends(request()->input())->links() }}
                            </nav>
                        </div>
                        <!--pagination end-->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('scripts')
    <script>
        "use strict";

        function updateShopStatus(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }

            // alert(status)
            $.post('{{ route('admin.shops.updateShopStatus') }}', {
                    _token: '{{ csrf_token() }}',
                    id: el.value,
                    status: status
                },
                function(data) {
                    if (data == 1) {
                        notifyMe('success', '{{ localize('Status modifié avec succès') }}');

                    } else {
                        notifyMe('danger', '{{ localize('Something went wrong') }}');
                    }
                });
        }

        function updateShopPublishStatus(el) {
            if (el.checked) {
                var is_published = 1;
            } else {
                var is_published = 0;
            }

            // alert(is_published)
            $.post('{{ route('admin.shops.updateShopPublishStatus') }}', {
                    _token: '{{ csrf_token() }}',
                    id: el.value,
                    is_published: is_published
                },
                function(data) {

                    if (data == 1) {
                        notifyMe('success', '{{ localize('Publication modifié avec succès') }}');

                    } else {
                        notifyMe('danger', '{{ localize('Something went wrong') }}');
                    }
                });
        }
    </script>
@endsection
