@extends('shop.vendor.layouts.master')

@section('title')
    {{ localize('Tables') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection


@section('contents')
  <section class="tt-section pt-4">
    <div class="container">
      <div class="row mb-3">
        <div class="col-12">
          <div class="card tt-page-header">
              <div class="card-body d-lg-flex align-items-center justify-content-lg-between">
                  <div class="tt-page-title">
                      <h2 class="h5 mb-lg-0">{{ localize('Tables') }}</h2>
                  </div>
                  <div class="tt-action">
                      
                    <a href="{{ route('vendor.table.create') }}" class="btn btn-primary"><i
                      data-feather="plus"></i> {{ localize('Add tables') }}</a>
                      
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
                                      @isset($status)
                                       @if ($status == 0) selected @endif
                                      @endisset>
                                      {{ localize('Libre') }}</option>

                                  <option value="1"
                                      @isset($status)
                                       @if ($status == 1) selected @endif
                                      @endisset>
                                      {{ localize('Occupée') }}</option>

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
                  <th > S/L</th>
                    <th >{{ localize('Numero Table') }}</th>
                    <th>{{ localize('Nombre de chaises') }}</th>
                    <th >{{ localize('Places disponibles') }}
                    </th>
                    <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($tables as $key => $table)
                <tr>
                  <td>
                    {{ $key + 1 + ($tables->currentPage() - 1) * $tables->perPage() }}
                  </td>
                  
                  <td>
                     {{ $table->num_table }}
                  </td>
                  <td>
                      {{ $table->nombre_chaise }}
                  </td>
                  <td>
                      {{ $table->nb_place_dispo  }}
                  </td>
                  <td>
                     <div class="dropdown tt-tb-dropdown">
                        <button type="button" class="btn p-0" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i data-feather="more-vertical"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end shadow">
                          <a class="dropdown-item"
                            href="{{ route('vendor.table.show', ['id' => $table->id, 'lang_key' => env('DEFAULT_LANGUAGE')]) }}&localize">
                            <i data-feather="edit-3" class="me-2"></i>{{ localize('Show') }}
                              <!-- <i class="fa fa-edit" class="me-2"></i>

                            {{ localize('Show') }} -->
                          </a>

                          <a class="dropdown-item"
                            href="{{ route('vendor.table.edit', ['id' => $table->id, 'lang_key' => env('DEFAULT_LANGUAGE')]) }}&localize">
                            <i data-feather="edit-3" class="me-2"></i>{{ localize('Edit') }}
                              <!-- <i class="fa fa-edit" class="me-2"></i>

                            {{ localize('Edit') }} -->
                          </a> 

                          <a href="#" class="dropdown-item"
                              data-href="{{ route('vendor.table.reinitializeTable', $table->id) }}"
                              title="{{ localize('Réinitialiser place dispo') }}">
                              <!-- <i data-feather="refresh-2" class="me-2"></i> -->
                              <i class="fa fa-refresh" class="me-2"></i>
                              {{ localize('Réinitialiser place dispo') }}
                          </a>

                          <a href="#" class="dropdown-item confirm-delete"
                              data-href="{{ route('vendor.table.delete', $table->id) }}"
                              title="{{ localize('Delete') }}">
                              <i data-feather="trash-2" class="me-2"></i>
                              <i class="fa fa-trash" class="me-2"></i>
                              {{ localize('Delete') }}
                          </a>

                        </div>
                      </div>
                  </td>
                  
                  
                </tr>

                @endforeach
              </tbody>
            </table>
            <div class="d-flex align-items-center justify-content-between px-4 pb-4">
              <span>{{ localize('Affichage') }}
                  {{ $tables->firstItem() }}-{{ $tables->lastItem() }} {{ localize('of') }}
                  {{ $tables->total() }} {{ localize('resultats') }}</span>
              <nav>
                  {{ $tables->appends(request()->input())->links() }}
              </nav>
          </div>
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