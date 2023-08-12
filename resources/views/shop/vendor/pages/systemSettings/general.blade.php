@extends('shop.vendor.layouts.master')

@section('title')
    {{ localize('General Settings') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')
    <section class="tt-section pt-4">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card tt-page-header">
                        <div class="card-body d-lg-flex align-items-center justify-content-lg-between">
                            <div class="tt-page-title">
                                <h2 class="h5 mb-lg-0">{{ localize('General Settings') }}</h2>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <!--left sidebar-->
                <div class="col-xl-9 order-2 order-md-2 order-lg-2 order-xl-1">
                    <form action="{{ route('vendor.settings.update') }}" method="POST" enctype="multipart/form-data"
                        class="pb-650">
                        @csrf

                        <!--general settings-->
                        <div class="card mb-4" id="section-1">
                            <div class="card-body">
                                <h5 class="mb-4">{{ localize('General Informations') }}</h5>

                                <div class="mb-3">
                                    <label for="shop_name" class="form-label">{{ localize('Shop Name') }}</label>
                                    <input type="text" id="shop_name" name="shop_name" class="form-control"
                                        value="{{ auth()->user()->shop->shop_name }}">
                                </div>

                                <div class="mb-3">
                                    <label for="slug"
                                        class="form-label">{{ localize('Url') }}</label>
                                    <input type="text" id="slug" name="slug" class="form-control"
                                        value="{{ auth()->user()->shop->slug }}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="shop_address" class="form-label">{{ localize('Shop Address') }}</label>
                                    <input type="text" id="shop_address" name="shop_address" class="form-control"
                                        value="{{ auth()->user()->shop->shop_address }}">
                                </div>
                            </div>
                        </div>
                        <!--general settings-->



                        <!--logo settings-->
                        <div class="card mb-4" id="section-3">
                            <div class="card-body">
                                <h5 class="mb-4">{{ localize('Shop Logo & Favicon') }}</h5>
                                <div class="mb-3">
                                    <label for="admin_panel_logo"
                                        class="form-label">{{ localize('Shop Logo') }}</label>
                                    <input type="hidden" name="types[]" value="admin_panel_logo">
                                    <div class="tt-image-drop rounded">
                                        <span class="fw-semibold">{{ localize('Choose Dashboard Logo') }}</span>
                                        <!-- choose media -->
                                        <div class="tt-product-thumb show-selected-files mt-3">
                                            <div class="avatar avatar-xl cursor-pointer choose-media"
                                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
                                                onclick="showMediaManager(this)" data-selection="single">
                                                <input type="hidden" name="image"
                                                    value="{{ auth()->user()->shop->shop_logo }}">
                                                <div class="no-avatar rounded-circle">
                                                    <span><i data-feather="plus"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- choose media -->
                                    </div>
                                </div>

                            </div>
                        </div>
                       

                        <!--seo meta description start-->
                        <div class="card mb-4" id="section-5">
                            <div class="card-body">
                                <h5 class="mb-4">{{ localize('Configuration') }}</h5>

                                <div class="mb-4">
                                    <div class="d-flex align-items-center">
                                        <div class="row w-100 g-2">
                                           
                                                <div class="col-6 col-md-4">
                                                    <div class="alert alert-secondary d-flex flex-wrap mb-0 py-2">
                                                        <label class="flex-grow-1 cursor-pointer"
                                                            for="">
                                                            {{ localize('Cash payout') }}
                                                        </label>

                                                        <div class="form-check form-switch mb-0">
                                                            <input type="checkbox"
                                                                class="form-check-input permission-checkbox"
                                                                name="is_cash_payout" {{auth()->user()->shop->is_cash_payout == 1 ? 'checked' : ' '}} id="is_cash_payout"
                                                                value="1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <div class="alert alert-secondary d-flex flex-wrap mb-0 py-2">
                                                        <label class="flex-grow-1 cursor-pointer"
                                                            for="">
                                                            {{ localize('Bank payout') }}
                                                        </label>

                                                        <div class="form-check form-switch mb-0">
                                                            <input type="checkbox"
                                                                class="form-check-input permission-checkbox"
                                                                name="is_bank_payout" {{auth()->user()->shop->is_bank_payout == 1 ? 'checked' : ' '}} id="is_bank_payout"
                                                                value="1">
                                                        </div>
                                                    </div>
                                                </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="global_meta_description"
                                        class="form-label">{{ localize('Bank name') }}</label>
                                    <input type="text" class="form-control" name="bank_name" value="{{ auth()->user()->shop->bank_name }}">
                                </div>

                                <div class="mb-4">
                                    <label for="global_meta_keywords"
                                        class="form-label">{{ localize('Bank Account name') }}</label>
                                    <input type="text" class="form-control" name="bank_acc_name" placeholder="{{localize('current account')}}" value="{{ auth()->user()->shop->bank_acc_name }}">
                                </div>
                                <div class="mb-4">
                                    <label for="global_meta_keywords"
                                        class="form-label">{{ localize('Bank Account number') }}</label>
                                    <input type="text" class="form-control" name="bank_acc_no" value="{{ auth()->user()->shop->bank_acc_no }}"> 
                                </div>

                                
                            </div>
                        </div>
                        <!--seo meta description end-->

                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">
                                <i data-feather="save" class="me-1"></i> {{ localize('Save Configuration') }}
                            </button>
                        </div>
                    </form>
                </div>

                <!--right sidebar-->
                <div class="col-xl-3 order-1 order-md-1 order-lg-1 order-xl-2">
                    <div class="card tt-sticky-sidebar">
                        <div class="card-body">
                            <h5 class="mb-4">{{ localize('Configure General Settings') }}</h5>
                            <div class="tt-vertical-step">
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="#section-1" class="active">{{ localize('General Information') }}</a>
                                    </li>
                                    <li>
                                        <a href="#section-3">{{ localize('Dashborad Logo & Favicon') }}</a>
                                    </li>
                                    
                                    <li>
                                        <a href="#section-5">{{ localize('Configuration') }}</a>
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
    <script>
        "use strict";

        // runs when the document is ready --> for media files
        $(document).ready(function() {
            getChosenFilesCount();
            showSelectedFilePreviewOnLoad();
        });
    </script>
@endsection
