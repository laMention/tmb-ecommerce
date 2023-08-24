<section class="featured-products pt-120 pb-200 bg-shade position-relative overflow-hidden z-1">
    <img src="{{ staticAsset('frontend/default/assets/img/shapes/roll-1.png') }}" alt="roll"
        class="position-absolute roll-1 z--1" data-parallax='{"y": -120}'>
    <img src="{{ staticAsset('frontend/default/assets/img/shapes/roll-2.png') }}" alt="roll"
        class="position-absolute roll-2 z--1" data-parallax='{"y": 120}'>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="section-title text-center mb-4">
                    <h3 class="mb-2">{{ localize('Entreprises') }}</h3>
                    <p class="mb-0">{{ getSetting('Vous pourriez aimer') }}</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center g-4">
                @php
                    
                    $shops = \App\Models\Shop::where(['is_approved'=>1,'is_published'=>1,'etat' => 1])->latest()->limit(8)->get();
                @endphp

                @foreach ($shops as $shop)
                    @php
                        $productsCount = \App\Models\Product::where('shop_id', $shop->id)->count();
                    @endphp
                    <div class="col-xxl-2 col-lg-3 col-md-4 col-sm-6">
                        <div
                            class="gshop-animated-iconbox py-5 px-4 text-center border rounded-3 position-relative overflow-hidden {{ $loop->even ? 'color-2' : '' }}">
                            <div
                                class="animated-icon d-inline-flex align-items-center justify-content-center rounded-circle position-relative">
                                <img src="{{ uploadedAsset($shop->shop_logo) }}"
                                    alt="" class="img-fluid">
                            </div>

                            <a href="{{ route('shops.products',[$shop->id]) }}&shop={{localize($shop->slug)}}"
                                class="text-dark fs-sm fw-bold d-block mt-3">{{ localize($shop->shop_name) }}</a>
                            {{-- <span
                                class="total-count position-relative ps-3 fs-sm fw-medium doted-primary">{{ $productsCount }}
                                {{ localize('Articles') }}</span> --}}

                            <a href="{{ route('shops.products',[$shop->id]) }}&shop={{localize($shop->slug)}}"
                                class="explore-btn position-absolute"><i class="fa-solid fa-arrow-up"></i></a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex align-items-center justify-content-between gap-3 mb-5 flex-wrap">
                <a class="explore-btn text-secondary fw-bold" href="{{ route('shops.index') }}">Voir tout <i class="fas fa-arrow-right"></i></a>
            </div>
    </div>
    <img src="{{ staticAsset('frontend/default/assets/img/shapes/bg-shape-2.png') }}" alt="bg shape"
        class="position-absolute start-0 bottom-0 w-100 z--1">
</section>
