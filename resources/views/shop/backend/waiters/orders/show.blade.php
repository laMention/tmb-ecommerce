@extends('shop.vendor.layouts.master')

@section('title')
    {{ localize('Commande sur place') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')

    <section class="tt-section pt-4">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card tt-page-header">
                        <div class="card-body d-lg-flex align-items-center justify-content-lg-between">
                            <div class="tt-page-title">
                                <h2 class="h5 mb-lg-0">{{ localize('Commande sur place') }}</h2>

                                @if($order->order->delivery_status == orderDeliveredStatus())
                      
                                  <span class="badge bg-success">Terminé</span>

                                @elseif($order->order->delivery_status == orderCancelledStatus())
                                  
                                  <span class="badge bg-danger">Annulé</span>

                                @else
                                  <span class="badge bg-info">En attente</span>
                                @endif
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

                                <input type="hidden" name="waiter_id" value="{{$order->id}}">

                                <div class="mb-4">
                                    <label for="title" class="form-label">{{ localize('Code commande') }}</label>
                                    <input type="text" name="name" id="name"
                                        placeholder="{{ localize('Code commande') }}" class="form-control"
                                         disabled value="{{$order->order_code}}">
                                </div>
                                <div class="mb-4">
                                    <label for="title" class="form-label">Montant</label>
                                    <input type="text" name="lastname" id="lastname"
                                        placeholder="Montant" class="form-control"
                                         disabled value="{{$order->grand_total_amount}}">
                                
                                </div>                                

                                <div class="mb-4">
                                    <label for="text" class="form-label">Table N0</label>
                                    <input type="number" name="contact" id="contact"
                                        placeholder="Table" class="form-control" value="{{$order->table->num_table}}">
                                </div>

                                
                            </div>
                    </div>
                        <!--slider info end-->
                   
                        
                    <div class="card mb-4" id="section-5">
                        <div class="row g-4">
                        <div class="col-12">
                            <div class="card mb-4" id="section-1">
                                <form class="app-search" action="{{ Request::fullUrl() }}" method="GET">
                                    <div class="card-header border-bottom-0">
                                        <div class="row justify-content-between g-3">
                                            <div class="col-auto flex-grow-1">
                                                <div class="tt-search-box">
                                               
                                                </div>
                                            </div>
                                            
                                           
                                        </div>
                                    </div>
                                </form>
                                @php
                        


                                    $order_items = App\Models\OrderItem::where('shop_id',auth()->user()->shop->id)->where('order_id',$order->order->id)->paginate(15);
                                @endphp


                                <table class="table tt-footable border-top" data-use-parent-width="true">
                                    <thead>
                                        <tr>
                                            <th class="text-center">S/L</th>
                                            <th class="text-center">Item</th>
                                            <th>Price</th>
                                            <th>Quantité</th>
                                            
                                            <th >Total
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                         @foreach ($order_items as $key => $item)
                                            
                                            <tr>
                                                <td class="text-center">
                                                    {{ ++$key }}
                                                </td>
                                                <td>
                                                    {{ $item->name }}
                                                </td>
                                                
                                                <td>
                                                    {{$item->unit_price}}
                                                </td>
                                                
                                                <td>
                                                  {{$item->qty}}
                                                </td>
                                                <td>

                                                    {{$item->total_price}}
                                                </td>
                                                
                                                
                                                <!-- <td class="text-end">
                                                    <div class="form-check form-switch d-flex justify-content-end">
                                                        <input type="checkbox" onchange="updateStatusCmdServer(this)"
                                                            class="form-check-input"
                                                            @if ($order->statut) checked @endif
                                                            value="{{ $order->id }}">
                                                    </div>
                                                </td> -->
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!--pagination start-->
                                <div class="d-flex align-items-center justify-content-between px-4 pb-4">
                                    <span>{{ localize('Showing') }}
                                        {{ $order_items->firstItem() }}-{{ $order_items->lastItem() }} {{ localize('of') }}
                                        {{ $order_items->total() }} {{ localize('results') }}</span>
                                    <nav>
                                        {{ $order_items->appends(request()->input())->links() }}
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