@extends('shop.vendor.layouts.master')

@section('title')
    {{ localize('Waiters') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')
    <section class="tt-section pt-4">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card tt-page-header">
                        <div class="card-body d-lg-flex align-items-center justify-content-lg-between">
                            <div class="tt-page-title">
                                <h2 class="h5 mb-lg-0">{{ localize('Serveurs') }}</h2>
                            </div>
                            <div class="tt-action">
                                
                              <a href="{{ route('vendor.waiters.create') }}" class="btn btn-primary"><i
                                data-feather="plus"></i> {{ localize('Add serveur') }}</a>
                                
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
                                            <select class="form-select select2" name="is_approved"
                                                data-minimum-results-for-search="Infinity">
                                                <option value="">{{ localize('Select status') }}</option>

                                                <option value="0"
                                                    @isset($is_approved)
                                                     @if ($is_approved == 0) selected @endif
                                                    @endisset>
                                                    {{ localize('Active') }}</option>

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
                                    <th class="text-center">{{ localize('S/L') }}</th>
                                    <th class="text-center">{{ localize('Code') }}</th>
                                    <th>{{ localize('Name') }}</th>
                                    <th>{{ localize('Contact') }}</th>
                                    <th data-breakpoints="xs sm">{{ localize('Adresse') }}</th>
                                    <!-- <th data-breakpoints="xs sm">{{ localize('Photo') }}</th> -->
                                    <th data-breakpoints="xs sm" class="text-end">{{ localize('Approved') }}
                                    </th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($waiters as $key => $waiter)
                                    
                                    <tr>
                                        <td class="text-center">
                                            {{ $key + 1 + ($waiters->currentPage() - 1) * $waiters->perPage() }}
                                        </td>
                                        <td>
                                            {{$waiter->code_poste}}
                                        </td>
                                        
                                        <td>
                                            <a href="javascript:void(0);" class="d-flex align-items-center">
                                                <div class="avatar avatar-sm">
                                                    <img class="rounded-circle"
                                                        src="{{ uploadedAsset($waiter->photo) }}" alt=""
                                                        onerror="this.onerror=null;this.src='{{ staticAsset('backend/assets/img/placeholder-thumb.png') }}';" />
                                                </div>
                                                <h6 class="fs-sm mb-0 ms-2">{{ $waiter->name .' '.$waiter->lastname}}
                                                </h6>
                                            </a>
                                        </td>
                                        
                                        <td>
                                            {{ $waiter->contact ?? localize('n/a') }}
                                        </td>
                                        <td>
                                            {{ $waiter->adresse  }}
                                        </td>
                                        <td class="text-end">
                                            
                                            <div class="form-check form-switch d-flex justify-content-end">
                                                <input type="checkbox" onchange="updateBanStatus(this)"
                                                    class="form-check-input"
                                                    @if ($waiter->is_approved) checked @endif
                                                    value="{{ $waiter->id }}">
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
                                                        href="{{ route('vendor.waiters.show', ['id' => $waiter->id, 'lang_key' => env('DEFAULT_LANGUAGE')]) }}&localize">
                                                        <!-- <i data-feather="eye-3" class="me-2"></i> -->
                                                        {{ localize('Show') }}
                                                    </a>

                                                    <a class="dropdown-item"
                                                        href="{{ route('vendor.waiters.edit', ['id' => $waiter->id, 'lang_key' => env('DEFAULT_LANGUAGE')]) }}&localize">
                                                        <!-- <i data-feather="edit-3" class="me-2"></i>{{ localize('Edit') }} -->
                                                        {{ localize('Edit') }}
                                                    </a>
                                               
                                                    <a href="#" class="dropdown-item confirm-delete"
                                                        data-href="{{ route('vendor.waiters.delete', $waiter->id) }}"
                                                        title="{{ localize('Delete') }}">
                                                        <!-- <i data-feather="trash-2" class="me-2"></i> -->
                                                        {{ localize('Delete') }}
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
                                {{ $waiters->firstItem() }}-{{ $waiters->lastItem() }} {{ localize('of') }}
                                {{ $waiters->total() }} {{ localize('results') }}</span>
                            <nav>
                                {{ $waiters->appends(request()->input())->links() }}
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

        function updateBanStatus(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('vendor.waiters.updateStatus') }}', {
                    _token: '{{ csrf_token() }}',
                    id: el.value,
                    status: status
                },
                function(data) {
                    if (data == 1) {
                        notifyMe('success', '{{ localize('Status updated successfully') }}');

                    } else {
                        notifyMe('danger', '{{ localize('Something went wrong') }}');
                    }
                });
        }
    </script>
@endsection
