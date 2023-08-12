@extends('backend.layouts.master')

@section('title')
    {{ localize('Add Shop') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')

    <section class="tt-section pt-4">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card tt-page-header">
                        <div class="card-body d-lg-flex align-items-center justify-content-lg-between">
                            <div class="tt-page-title">
                                <h2 class="h5 mb-lg-0">{{ localize('Add Shop') }}</h2>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4 g-4">
                <!--left sidebar-->
                <div class="col-xl-9 order-2 order-md-2 order-lg-2 order-xl-1">

                    <form action="{{ route('admin.shops.store') }}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <input type="hidden" name="user_type" value="vendor">
                        <input type="hidden" name="role_id" value="{{$roles[0]->id}}">
                        
                        <!--slider info start-->
                        <div class="card mb-4" id="section-1">
                            <div class="card-body">

                                <div class="mb-4">
                                    <label for="text" class="form-label"><sup class="text-danger">*</sup>{{ localize('You are by default '. ucfirst($roles[0]->name)) }}</label>
                                </div>

                                <div class="mb-4">
                                    <label for="title" class="form-label">{{ localize('Shop Name') }}</label>
                                    <input type="text" name="shop_name" id="shop_name"
                                        placeholder="{{ localize('Shop name') }}" class="form-control"
                                         required>
                                        <span class="fs-sm text-muted">
                                        {{ localize('Shop name is required and recommended to be unique.') }}
                                    </span>
                                </div>

                                <div class="mb-4">
                                    <label for="text" class="form-label">{{ localize('Shop address') }}</label>
                                    <input type="text" name="shop_address" id="shop_address"
                                        placeholder="{{ localize('Shop address') }}" class="form-control" required>
                                </div>
                                

                                <div class="mb-4">
                                    <label for="text" class="form-label">{{ localize('Commission') }}</label>
                                    <input type="number" name="admin_commission_percentage" id="admin_commission_percentage"
                                        placeholder="{{ localize('Commission') }}" class="form-control" min="0">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">{{ localize('Shop Logo') }}</label>
                                    <div class="tt-image-drop rounded">
                                        <span class="fw-semibold">{{ localize('Choose shop logo') }}</span>
                                        <!-- choose media -->
                                        <div class="tt-product-thumb show-selected-files mt-3">
                                            <div class="avatar avatar-xl cursor-pointer choose-media"
                                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
                                                onclick="showMediaManager(this)" data-selection="single">
                                                <input type="hidden" name="image" >
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
                        <div class="card mb-4" id="section-2">
                            <div class="card-body">


                                <div class="mb-4">
                                    <label for="title" class="form-label">{{ localize('Manager Name') }}</label>
                                    <input type="text" name="name" id="name"
                                        placeholder="{{ localize('Manager name') }}" class="form-control"
                                         required>
                                        <span class="fs-sm text-muted">
                                        {{ localize('Manager name is required and recommended to be unique.') }}
                                    </span>
                                </div>

                                <div class="mb-4">
                                    <label for="text" class="form-label">{{ localize('Manager phone') }}</label>
                                    <input type="text" name="phone" id="phone"
                                        placeholder="{{ localize('Manager phone') }}" class="form-control" required>
                                </div>

                                <div class="mb-4">
                                    <label for="text" class="form-label">{{ localize('Manager email address') }}</label>
                                    <input type="text" name="email_address" id="email_address"
                                        placeholder="{{ localize('Email address') }}" class="form-control" required>
                                </div>

                            </div>
                        </div>

                        <div class="card mb-4" id="section-3">
                            <div class="card-body">


                                <div class="mb-4 ">
                                    <span class="eye eye-icon"><i class="fa-solid fa-eye"></i></span>
                                    <span class="eye eye-slash"><i class="fa-solid fa-eye-slash"></i></span>

                                    <div class="input-field check-password">
                                        <label for="title" class="form-label">{{ localize('Manager Account password') }}</label>
                                        <input type="password" name="password" id="password"
                                            placeholder="{{ localize('Manager account password') }}" class="form-control"
                                             required>
                                            
                                            <span class="fs-sm text-muted">
                                            {{ localize('Least 8 characters.') }}
                                            {{ localize('For more security, it is recommanded to use symbols, letters, numbers into your password.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>


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
                            <h5 class="mb-4">{{ localize('About Us Configuration') }}</h5>
                            <div class="tt-vertical-step">
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="#section-1" class="active">{{ localize('Shop informations') }}</a>
                                    </li>

                                    <li>
                                        <a href="#section-2" class="">{{ localize('Manager informations') }}</a>
                                    </li>

                                    <li>
                                        <a href="#section-3" class="">{{ localize('Account password') }}</a>
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