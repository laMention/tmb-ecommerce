@extends('backend.layouts.master')

@section('title')
    {{ localize('Add Waiter') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')

    <section class="tt-section pt-4">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card tt-page-header">
                        <div class="card-body d-lg-flex align-items-center justify-content-lg-between">
                            <div class="tt-page-title">
                                <h2 class="h5 mb-lg-0">{{ localize('Add Serveur') }}</h2>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4 g-4">
                <!--left sidebar-->
                <div class="col-xl-9 order-2 order-md-2 order-lg-2 order-xl-1">
                        <!--slider info start-->
                    <div class="card mb-4" id="section-1">
                            <div class="card-body">

                                <input type="hidden" name="waiter_id" value="{{$waiter->id}}">

                                <div class="mb-4">
                                    <label for="title" class="form-label">{{ localize('Serveur Name') }}</label>
                                    <input type="text" name="name" id="name"
                                        placeholder="{{ localize('Serveur name') }}" class="form-control"
                                         required value="{{$waiter->name}}">
                                </div>
                                <div class="mb-4">
                                    <label for="title" class="form-label">{{ localize('Serveur LastName') }}</label>
                                    <input type="text" name="lastname" id="lastname"
                                        placeholder="{{ localize('Serveur lastname') }}" class="form-control"
                                         required value="{{$waiter->lastname}}">
                                
                                </div>                                

                                <div class="mb-4">
                                    <label for="text" class="form-label">{{ localize('contact') }}</label>
                                    <input type="number" name="contact" id="contact"
                                        placeholder="{{ localize('contact') }}" class="form-control" value="{{$waiter->contact}}">
                                </div>

                                
                            </div>
                    </div>
                        <!--slider info end-->
                    <div class="card mb-4" id="section-3">
                      @php
                        


                        $orders = App\Models\Order::where('etat',1)->where('shop_id',auth()->user()->shop->id)->get();
                      @endphp

                      <div class="card-body">
                        <form action="{{ route('vendor.order-waiters.attachOrderToServeur') }}" method="POST" enctype="multipart/form-data"> @csrf

                          <input type="hidden" name="waiter_id" value="{{$waiter->id}}">

                          <div class="mb-4">
                              <label for="title" class="form-label">{{ localize('Attribuer une commande') }}</label>
                              <select class="select2 form-control" multiple="multiple"  name="orders[]">
                                @foreach($orders as $order)

                                  @if($order_server->count() > 0)
                                    @foreach($order_server as $servod)
                                      @if($order->id != $servod->order_id)
                                        <option class="" value="{{$order->id}}">{{$order->orderGroup->order_code}}</option>
                                      @endif
                                    @endforeach
                                  @else
                                    <option class="" value="{{$order->id}}">{{$order->orderGroup->order_code}}</option>
                                  @endif
                                @endforeach
                              </select>
                             
                          </div>
                          <div class="row">
                            <div class="col-12">
                                <div class="mb-4">
                                    <button class="btn btn-primary" type="submit">
                                        <i data-feather="save" class="me-1"></i> {{ localize('Valider') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        </form>
                        
                      </div>
                    </div>
                        
                    <div class="card mb-4" id="section-5">
                        <div class="row g-4">
                        <div class="col-12">
                            <div class="card mb-4" id="section-1">
                                <form class="app-search" action="{{ Request::fullUrl() }}" method="GET">
                                    <div class="card-header border-bottom-0">
                                        <div class="row justify-content-between g-3">
                                            <div class="col-auto flex-grow-1">
                                                <div class="tt-search-box">
                                                    <!-- <div class="input-group">
                                                        <span class="position-absolute top-50 start-0 translate-middle-y ms-2"> <i
                                                                data-feather="search"></i></span>
                                                        <input class="form-control rounded-start w-100" type="text"
                                                            id="search" name="search" placeholder="{{ localize('Search') }}"
                                                            @isset($searchKey)
                                                value="{{ $searchKey }}"
                                                @endisset>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="input-group">
                                                    <select class="form-select select2" name="statut"
                                                        data-minimum-results-for-search="Infinity">
                                                        <option value="">{{ localize('Select status') }}</option>

                                                        <option value="0"
                                                            @isset($statut)
                                                             @if ($statut == 0) selected @endif
                                                            @endisset>
                                                            {{ localize('en attente') }}</option>

                                                        <option value="1"
                                                            @isset($statut)
                                                             @if ($statut == 1) selected @endif
                                                            @endisset>
                                                            {{ localize('Servi') }}</option>

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
                                            <th class="text-center">{{ localize('Order') }}</th>
                                            <th>{{ localize('Date et heure commande') }}</th>
                                            <th>{{ localize('Montant') }}</th>
                                            <th>{{ localize('N° Table') }}</th>
                                            
                                            <th data-breakpoints="xs sm" class="text-end">{{ localize('Statut') }}
                                            </th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                         @foreach ($order_server as $key => $order)
                                            
                                            <tr>
                                                <td class="text-center">
                                                    {{ ++$key }}
                                                </td>
                                                <td>
                                                    {{$order->order->orderGroup->order_code}}
                                                </td>
                                                
                                                <td>
                                                    {{$order->order->orderGroup->created_at}}
                                                </td>
                                                
                                                <td>
                                                  {{ 
                                                      $order->order->orderGroup->grand_total_amount ?? localize('n/a') 
                                                  }}
                                                </td>
                                                <td>

                                                    {{$order->order->table->num_table ?? localize('n/a') }}
                                                </td>
                                                
                                                <td class="text-end">
                                                    @if($order->statut == 0) 
                                                    <span class="badge bg-info rounded-pill">En attente</span>
                                                    @elseif($order->statut == 1) 
                                                      <span class="badge bg-success rounded-pill">Servi</span>
                                                    @else 
                                                      <span class="badge bg-danger rounded-pill">Annulé</span>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    <div class="form-check form-switch d-flex justify-content-end">
                                                        <input type="checkbox" onchange="updateStatusCmdServer(this)"
                                                            class="form-check-input"
                                                            @if ($order->statut) checked @endif
                                                            value="{{ $order->id }}">
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!--pagination start-->
                                <div class="d-flex align-items-center justify-content-between px-4 pb-4">
                                    <span>{{ localize('Showing') }}
                                        {{ $order_server->firstItem() }}-{{ $order_server->lastItem() }} {{ localize('of') }}
                                        {{ $order_server->total() }} {{ localize('results') }}</span>
                                    <nav>
                                        {{ $order_server->appends(request()->input())->links() }}
                                    </nav>
                                </div> 
                                <!--pagination end-->
                            </div>
                        </div>
                    </div>
                </div>


                       
                </div>

                <!--right sidebar-->
                <div class="col-xl-3 order-1 order-md-1 order-lg-1 order-xl-2">
                    <div class="card tt-sticky-sidebar">
                        <div class="card-body">
                            <h5 class="mb-4">{{ localize('Serveur Configuration') }}</h5>
                            <div class="tt-vertical-step">
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="#section-1" class="active">{{ localize('Serveur informations') }}</a>
                                    </li>
                                    <li>
                                        <a href="#section-3" >{{ localize('Attribuer une commande') }}</a>
                                    </li>
                                   <li>
                                        <a href="#section-5" class="">{{ localize('Serveur Orders') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection


@section('scripts')
    @include('backend.inc.product-scripts')

    <script>
        "use strict";

        function updateStatusCmdServer(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('vendor.order-waiters.updateStatus') }}', {
                    _token: '{{ csrf_token() }}',
                    id: el.value,
                    status: status
                },
                function(data) {
                    if (data == 1) {
                        notifyMe('success', '{{ localize('Marqué comme terminé') }}');

                    } else {
                        notifyMe('danger', '{{ localize("Quelque chose s\'est mal passée") }}');
                    }
                });
        }
    </script>
@endsection