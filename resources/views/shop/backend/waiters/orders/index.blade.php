@extends('shop.vendor.layouts.master')

@section('title')
    {{ localize('Commandes sur place') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection


@section('contents')
  <section class="tt-section pt-4">
    <div class="container">
      <div class="row mb-3">
        <div class="col-12">
          <div class="card tt-page-header">
              <div class="card-body d-lg-flex align-items-center justify-content-lg-between">
                  <div class="tt-page-title">
                      <h2 class="h5 mb-lg-0">{{ localize('Commandes sur place') }}</h2>
                  </div>
                  <div class="tt-action">
                      
                    <!-- <a href="{{ route('vendor.waiters.create') }}" class="btn btn-primary"><i
                      data-feather="plus"></i> {{ localize('Commandes sur place') }}</a> -->
                      
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
                          <button type="submit" class="btn btn-primary">
                              <i data-feather="search" width="18"></i>
                              {{ localize('Rechercher') }}
                          </button>
                      </div>
                  </div>
              </div>
            </form>

            <table class="table tt-footable border-top" data-use-parent-width="true">
              <thead>
                <tr>
                    <th >{{ localize('S/L') }}</th>
                    <th >{{ localize('Code commande') }}</th>
                    <th>{{ localize('Client') }}</th>
                    <th>{{ localize('Montant commande') }}</th>
                    <th >{{ localize('Nombre articles') }}</th>
                    <th  >{{ localize('N° Table') }}
                    </th>
                    <th>
                      Status
                    </th>
                    <th></th>
                    <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($orders as $key => $order)
                <tr>
                  <td>
                    {{ $key + 1 + ($orders->currentPage() - 1) * $orders->perPage() }}
                  </td>
                  <td>
                    <a href="#">{{$order->order_code}}</a>
                  </td>
                  <td>
                      {{ $order->user->name .' '.$order->user->lastname}}
                          
                  </td>
                  <td>
                      {{ $order->grand_total_amount ?? 0 }}
                  </td>
                  <td>
                      {{ count($order->order->orderItems) ?? 0 }}
                  </td>
                  <td>
                      {{ $order->table->num_table ?? localisze('n/a') }}
                  </td>
                  <td>
                    @if($order->order->delivery_status == orderDeliveredStatus())
                      
                      <span class="badge bg-success">Terminé</span>

                    @elseif($order->order->delivery_status == orderCancelledStatus())
                      
                      <span class="badge bg-danger">Annulé</span>

                    @else
                      <span class="badge bg-info">En attente</span>
                    @endif
                  </td>
                  
                  <td>
                     <div class="dropdown tt-tb-dropdown">
                        <button type="button" class="btn p-0" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i data-feather="more-vertical"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end shadow">
                          <a class="dropdown-item"
                            href="{{ route('vendor.onplaceOrder.show', ['id' => $order->id, 'lang_key' => env('DEFAULT_LANGUAGE')] ) }}&localize">
                            <!-- <i data-feather="edit-3" class="me-2"></i>{{ localize('Edit') }} -->
                              <i class="fa fa-edit" class="me-2"></i>

                            {{ localize('Show') }}
                          </a>

                         <!--  <a href="#" class="dropdown-item confirm-delete"
                              data-href="{{ route('vendor.onplaceOrder.delete', $order->id) }}"
                              title="{{ localize('Delete') }}">
                              <i data-feather="trash-2" class="me-2"></i>
                              <i class="fa fa-trash" class="me-2"></i>
                              {{ localize('Delete') }}
                          </a> -->

                        </div>
                      </div>
                  </td>
                  
                </tr>

                @endforeach
              </tbody>
            </table>
            <div class="d-flex align-items-center justify-content-between px-4 pb-4">
              <span>{{ localize('Affichage') }}
                  {{ $orders->firstItem() }}-{{ $orders->lastItem() }} {{ localize('of') }}
                  {{ $orders->total() }} {{ localize('resultats') }}</span>
              <nav>
                  {{ $orders->appends(request()->input())->links() }}
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