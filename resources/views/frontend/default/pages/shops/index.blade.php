*@extends('frontend.default.layouts.master')

@section('title')
    {{ localize('Shop') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('breadcrumb-contents')
    <div class="breadcrumb-content">
        <h2 class="mb-2 text-center">{{ localize('All Shops') }}</h2>
        <nav>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item fw-bold" aria-current="page"><a
                        href="{{ route('home') }}">{{ localize('Home') }}</a></li>
                <li class="breadcrumb-item fw-bold" aria-current="page">{{ localize('Shops') }}</li>
            </ol>
        </nav>
    </div>
@endsection

@section('contents')
    <!--breadcrumb-->
    @include('frontend.default.inc.breadcrumb')
    <!--breadcrumb-->

    <!--campaign section start-->
    <section class="tt-campaigns ptb-100">
        <div class="container">
            <div class="row g-4">


                @forelse ($shops as $shop)
                	@php
                        $productsCount = \App\Models\Product::where('shop_id', $shop->id)->count();
                    @endphp
                    <div class="col-lg-4 col-md-6">
                        <div class="card shadow-lg border-0 tt-coupon-single tt-gradient-top"
                            style="object-fit: cover; background:
          url('{{ uploadedAsset($shop->shop_logo) }}')no-repeat center
          center / cover">
                            <div class="card-body text-center py-5 px-4">
                                
                                <div class="coupon-row">
                                   
                                    <span class="copy-text"
                                        data-clipboard-text="{{ $shop->shop_name }}">

                                        <a href="{{ route('shops.products',[$shop->id]) }}&shop={{localize($shop->slug)}}">{{ localize($shop->shop_name) }}</a>

                                    </span>
                                </div>
                                <ul class=" d-inline-block gap-2 mt-3">
                                    <li class="list-inline-item bg-white position-relative z-1 rounded-2">
                                        <h5 class="mb-1 fs-sm"><a href="{{ route('shops.products',[$shop->id]) }}&shop={{localize($shop->slug)}}">{{$productsCount}} {{ localize('Articles') }}</a></h5>
                                        <!-- <span class="gshop-subtitle fs-xxs d-block"></span> -->
                                    </li>
                                    
                                </ul>

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 col-md-6 mx-auto">

                        <img src="{{ asset('frontend/default/assets/img/no-data-found.png') }}" class="img-fluid"
                            alt="">
                    </div>
                @endforelse
            </div>
            <ul class="d-flex align-items-center gap-3 mt-7">
            	{{ $shops->appends(request()->input())->links() }}
            </ul>
        </div>
    </section>
    <!--campaign section end-->
@endsection
