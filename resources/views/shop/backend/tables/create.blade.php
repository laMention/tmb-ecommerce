@extends('shop.vendor.layouts.master')

@section('title')
    {{ localize('Add table') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')

    <section class="tt-section pt-4">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card tt-page-header">
                        <div class="card-body d-lg-flex align-items-center justify-content-lg-between">
                            <div class="tt-page-title">
                                <h2 class="h5 mb-lg-0">{{ localize('Add Table') }}</h2>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4 g-4">
                <!--left sidebar-->
                <div class="col-xl-9 order-2 order-md-2 order-lg-2 order-xl-1">

                    <form action="{{ route('vendor.table.store') }}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        
                        
                        <!--slider info start-->
                        <div class="card mb-4" id="section-1">
                            <div class="card-body">

                                

                                <div class="mb-4">
                                    <label for="title" class="form-label">{{ localize('Numéro de la table') }}</label>
                                    <input type="text" name="num_table" id="num_table"
                                        placeholder="{{ localize('Numéro de la table') }}" class="form-control"
                                         required>
                                        <span class="fs-sm text-muted">
                                        {{ localize('Le numéro de la table est requis.') }}
                                    </span>
                                </div>
                                <div class="mb-4">
                                    <label for="title" class="form-label">{{ localize('Nombre de chaise') }}</label>
                                    <input type="text" name="nombre_chaise" id="nombre_chaise"
                                        placeholder="{{ localize('Nombre de chaise') }}" class="form-control"
                                         required>
                                        <span class="fs-sm text-muted">
                                        {{ localize('Le nombre de chaise est requis.') }}
                                    </span>
                                </div>

                            </div>
                        </div>
                        <!--slider info end-->
                        


                        <div class="row">
                            <div class="col-12">
                                <div class="mb-4">
                                    <button class="btn btn-primary" type="submit">
                                        <i data-feather="save" class="me-1"></i> {{ localize('Save Changes') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!--right sidebar-->
                <div class="col-xl-3 order-1 order-md-1 order-lg-1 order-xl-2">
                    <div class="card tt-sticky-sidebar">
                        <div class="card-body">
                            <h5 class="mb-4">{{ localize('Table Configuration') }}</h5>
                            <div class="tt-vertical-step">
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="#section-1" class="active">{{ localize('Table informations') }}</a>
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
@endsection