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

                    <form action="{{ route('vendor.waiters.update') }}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        
                        
                        <!--slider info start-->
                        <div class="card mb-4" id="section-1">
                            <div class="card-body">

                                <input type="hidden" name="waiter_id" value="{{$waiter->id}}">

                                <div class="mb-4">
                                    <label for="title" class="form-label">{{ localize('Serveur Name') }}</label>
                                    <input type="text" name="name" id="name"
                                        placeholder="{{ localize('Serveur name') }}" class="form-control"
                                         required value="{{$waiter->name}}">
                                        <span class="fs-sm text-muted">
                                        {{ localize('Serveur name is required and recommended to be unique.') }}
                                    </span>
                                </div>
                                <div class="mb-4">
                                    <label for="title" class="form-label">{{ localize('Serveur LastName') }}</label>
                                    <input type="text" name="lastname" id="lastname"
                                        placeholder="{{ localize('Serveur lastname') }}" class="form-control"
                                         required value="{{$waiter->lastname}}">
                                        <span class="fs-sm text-muted">
                                        {{ localize('Serveur lastname is required and recommended to be unique.') }}
                                    </span>
                                </div>

                                <div class="mb-4">
                                    <label for="text" class="form-label">{{ localize('Serveur address') }}</label>
                                    <input type="text" name="adresse" id="adresse"
                                        placeholder="{{ localize('Serveur address') }}" class="form-control" required value="{{$waiter->adresse}}">
                                </div>
                                

                                <div class="mb-4">
                                    <label for="text" class="form-label">{{ localize('contact') }}</label>
                                    <input type="number" name="contact" id="contact"
                                        placeholder="{{ localize('contact') }}" class="form-control" value="{{$waiter->contact}}">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">{{ localize('Serveur photo') }}</label>
                                    <div class="tt-image-drop rounded">
                                        <span class="fw-semibold">{{ localize('Choose serveur logo') }}</span>
                                        <!-- choose media -->
                                        <div class="tt-product-thumb show-selected-files mt-3">
                                            <div class="avatar avatar-xl cursor-pointer choose-media"
                                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
                                                onclick="showMediaManager(this)" data-selection="single">
                                                <input type="hidden" name="photo" value="{{$waiter->photo}}">

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
                            <h5 class="mb-4">{{ localize('Serveur Configuration') }}</h5>
                            <div class="tt-vertical-step">
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="#section-1" class="active">{{ localize('Serveur informations') }}</a>
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