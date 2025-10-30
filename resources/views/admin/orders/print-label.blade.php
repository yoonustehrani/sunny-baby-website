<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>چاپ فاکتور</title>
    @vite(['resources/css/fonts.css'])
    <link rel="stylesheet" href="{{ asset('css/label.min.css') }}">
</head>
<body>
    @foreach ($orders as $order)
    <div data-id="factors" class="min-factor page-break" dir="rtl">
        <header class="header-factor">
            <div class="flex-center">

                <!-- نمایش لوگو -->
                <div class="factor-logo">
                    @if ($order->type == \App\Enums\OrderType::AFFILIATE_ORDER)
                        @if ($order?->user?->business && $order?->user?->business?->logo)
                            <img 
                                style="height: 80px;width: auto;"
                                src="{{ asset($order?->user?->business?->logo->url) }}"
                                alt="logo">
                        @endif
                    @else
                        <img 
                            style="height: 80px;width: auto;"
                            src="{{ asset('images/logo/sunny-baby-logo.webp') }}"
                            alt="logo">
                    @endif
                </div>

                <!-- نمایش عنوان فاکتور -->
                <div class="factor-title">
                </div>

                <!-- نمایش تاریخ و بارکد -->
                <div class="factor-dates">

                    <span class="factor-number">
                        شماره سفارش : <span>{{ $order->getKey() }}</span>
                    </span>
                    <span class="factor-date_times">
                        تاریخ سفارش : <i>{{ jalali($order->updated_at) }}</i>
                    </span>
                    {{-- TODO: Barcode --}}
                    {{-- <span class="factor-barcode">
                        <img alt="87407"
                            src="https://www.sunnybaby.ir/wp-content/themes/parskala/inc/factor-pars/template/factor-barcode.php?text=87407">
                    </span> --}}
                </div>
            </div>
        </header>
        <main>
            <section class="main-factor">

                <div class="order-seller">
                    <table class="tab-order">
                        <!-- هدر برگه -->
                        <tbody>
                            <tr>
                                <th class="tab-head seller">گیرنده</th>
                                <th class="tab-head shoper ">فرستنده</th>
                            </tr>

                            <tr>
                                <!-- خریدار-->
                                <th class="tab-main seller">
                                    @if ($order->shipment)
                                        @if ($order->shipment->address)
                                            @php
                                                $address = $order->shipment->address;
                                            @endphp
                                            <span class="mleft"><i>نام:</i> {{ $address->fullname }}</span>
                                            <span><i>استان:</i> {{ $address->city->province->name }}</span>
                                            <span><i>شهر:</i> {{ $address->city->name }}</span>
                                            <span><i>کد پستی:</i> {{ $address->zip }}</span>
                                            <span><i>شماره تماس:</i> {{ $address->phone_number }}</span>
                                            <!-- <span><i>ایمیل:</i> </span> -->
                                            <span class="bloked"><i>نشانی:</i> تهرانپارس خ نقدی پلاک۱۶</span>
                                        @endif
                                    @endif
                                </th>
                                <!-- فروشنده -->
                                <th class="tab-main shoper">
                                    @if ($order->type == \App\Enums\OrderType::AFFILIATE_ORDER)
                                        @if ($order?->user?->business && $order?->user?->business?->logo)
                                            <span class="mleft"><i>نام:</i> {{ $order->user->business->brand_name }}</span>
                                            <span><i>استان:</i> خراسان رضوی</span>
                                            <span><i>شهر:</i> مشهد</span>
                                            <span><i>کد پستی:</i>9167911939</span>
                                            <span><i>تلفن:</i> {{ $order->user->business->support_phone_number }}</span>
                                            <span class="bloked"><i>نشانی:</i> میدان 17 شهریور مجتمع تجاری رضا همکف پلاک 27</span>
                                        @endif
                                    @else
                                        <span class="mleft"><i>نام:</i> فروشگاه سانی بی بی</span>
                                        <span><i>استان:</i> خراسان رضوی</span>
                                        <span><i>شهر:</i> مشهد</span>
                                        <span><i>کد پستی:</i>9167911939</span>
                                        <span><i>تلفن:</i> 09155528922</span>
                                        <span class="bloked"><i>نشانی:</i> میدان 17 شهریور مجتمع تجاری رضا همکف پلاک 27</span>
                                    @endif
                                </th>
                            </tr>
                        </tbody>
                    </table>
                    <table class="order-dates">
                        <tbody>
                            <tr class="head-dates">
                                <th>ردیف</th>
                                <th>کد کالا</th>
                                @if ($order->type != App\Enums\OrderType::AFFILIATE_ORDER)
                                    <th>نام محصول</th>
                                    <th>مبلغ واحد</th>
                                    <th>تخفیف واحد</th>
                                    <th>تعداد</th>
                                    <th>مبلغ کل</th>
                                @else
                                    <th colspan="3">نام محصول</th>
                                    <th colspan="2">تعداد</th>
                                @endif
                            </tr>
                            @foreach ($order->items as $item)
                                <tr class="head-dates while">
                                    <th width="7%">{{ $loop->index + 1 }}</th>
                                    <th width="12%">{{ $item->product->sku ?: '---' }}</th>
                                    <th class="alin-right " @if ($order->type == App\Enums\OrderType::AFFILIATE_ORDER)
                                        colspan="3"
                                    @endif>
                                        <div class="">
                                            @if ($item->product->parent && ! $item->product->title)
                                                <p style="width: 100%; padding: 0px; margin: 0px;">{{ $item->product->parent->title }}</p>
                                                <p style="width: 100%; padding: 0px; margin: 0px; font-weight: bold;">{{ $item->product->variant_title }}</p>
                                            @else
                                                {{ $item->product->title }}
                                            @endif
                                            {{-- <img
                                                src="https://www.sunnybaby.ir/wp-content/uploads/2025/04/photo_2025-04-16_15-22-56.jpg"
                                                width="30" style="margin-left:10px;"> --}}
                                        </div>
                                    </th>
                                    @if ($order->type != App\Enums\OrderType::AFFILIATE_ORDER)
                                        <th>{{ format_price($item->unit_price) }}</th>
                                        <th>{{ format_price($item->unit_discount) }}</th>
                                        <th>{{ $item->quantity }}</th>
                                        <th>{{ format_price($item->total) }}</th>
                                    @else
                                        <th>{{ $item->quantity }}</th>
                                    @endif
                                </tr>
                            @endforeach
                            @if ($order->type != App\Enums\OrderType::AFFILIATE_ORDER)
                            <tr class="head-dates while">
                                <th colspan="2">حمل و نقل:</th>
                                <th colspan="1">
                                    @if ($order?->shipment?->carrier_class)
                                        {{ app($order?->shipment?->carrier_class)->getName() }}
                                    @endif
                                </th>
                                <th colspan="2">روش پرداخت:</th>
                                <th colspan="2">پرداخت امن زرین پال</th>
                            </tr>
                            <tr class="head-dates grye">
                                <th colspan="3">مجموع:</th>
                                <th colspan="4">{{ format_price($order->subtotal) }}</th>
                            </tr>
                            <tr class="head-dates grye">
                                <th colspan="3">مجموع تخفیف:</th>
                                <th colspan="4">{{ format_price($order->total_discount) }}</th>
                            </tr>
                            <tr class="head-dates grye">
                                <th colspan="3">قابل پرداخت:</th>
                                <th colspan="4">{{ format_price($order->total) }}</th>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="factor-note">
                        ممنون از این که سانی بی بی رو برای خرید سیسمونی کوچولوتون انتخاب کردید ❤ </div>
                    <!-- مهر و امضای فروشگاه و فروشنده -->
                </div>
            </section>
        </main>
    </div>
    @endforeach
</body>
</html>