

<div id="quickviewqrcode_modal" class="modal fade">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ localize('QR Code') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body text-center ">
                <input type="hidden" id="url" value="{{env('APP_URL').'/shop-product/'.auth()->user()->shop->id.'&shop='.auth()->user()->shop->slug}}">
                <div id="qrCode" class="justify-content-center pl-5 pb-3" style="    padding-left: 65px;"></div>
                
                <div class="justify-content-center pb-3">
                    <a href="{{env('APP_URL').'/shop-product/'.auth()->user()->shop->id.'&shop='.auth()->user()->shop->slug}}" target="_blank" class="btn btn-danger mt-2">{{ ucwords(auth()->user()->shop->shop_name) }}</a>
                </div>
            </div>

        </div>
    </div>
</div>
