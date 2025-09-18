<x-layouts.default title="Contact Us">
    <x-header />
    <!-- page-title -->
    <div class="tf-page-title">
        <div class="container-full">
            <div class="heading text-center">@lang('Payment confirmation')</div>
        </div>
    </div>
    <!-- /page-title -->

    <!-- page-cart -->
    <section class="flat-spacing-11">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <h5 class="fw-5 mb_20">@lang('Payment confirmation')</h5>
                    <div class="tf-page-cart-checkout">
                        <div class="d-flex align-items-center justify-content-between mb_15">
                            <div class="fs-18">تاریخ</div>
                            <p>01/01/2024</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb_15">
                            <div class="fs-18">روش پرداختی</div>
                            <p>Visa</p>
                        </div>
                        {{-- <div class="d-flex align-items-center justify-content-between mb_15">
                            <div class="fs-18">شماره کارت</div>
                            <p>**** **** **** 9999</p>
                        </div> --}}
                        <div class="d-flex align-items-center justify-content-between mb_15">
                            <div class="fs-18">شماره تلفن</div>
                            <p>(212) 555-1234</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb_24">
                            <div class="fs-22 fw-6">قابل پرداخت</div>
                            <span class="total-value">$188.00 USD</span>
                        </div>
                        <div class="d-flex gap-10">
                            <a href="checkout.html"
                                class="tf-btn w-100 btn-outline animate-hover-btn rounded-0 justify-content-center">
                                <span>انصراف</span>
                            </a>
                            <a href="payment-confirmation.html#"
                                class="tf-btn w-100 btn-fill animate-hover-btn radius-3 justify-content-center">
                                <span>تایید</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- page-cart -->
</x-layouts.default>