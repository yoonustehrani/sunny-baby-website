<footer id="footer" class="footer md-pb-70">
    <div class="footer-wrap">
        <div class="footer-body">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="footer-infor">
                            <div class="tw:w-48">
                                {{-- footer-logo --}}
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset('images/logo/sunnybaby-logo.webp') }}" alt="">
                                </a>
                            </div>
                            <ul>
                                <li>
                                    <p>آدرس: مشهد - میدان ۱۷ شهریور - مجتمع تجاری رضا - طبقه همکف پلاک ۲۷</p>
                                </li>
                                <li>
                                    <p>شماره تماس: <a href="tel:09155528922" dir="ltr" class="block [direction:ltr]">۰۹۱۵ ۵۵۲ ۸۹۲۲</a></p>
                                </li>
                            </ul>
                            <a href="https://nshn.ir/23rb1FsipJdS35" target="_blank" class="tf-btn btn-line">روی نقشه<i class="icon icon-arrow1-top-left"></i></a>
                            <ul class="tf-social-icon d-flex gap-10">
                                <li><a href="index.html#" class="box-icon w_34 round social-facebook social-line"><i class="icon fs-14 icon-fb"></i></a></li>
                                <li><a href="index.html#" class="box-icon w_34 round social-twiter social-line"><i class="icon fs-12 icon-Icon-x"></i></a></li>
                                <li><a href="index.html#" class="box-icon w_34 round social-instagram social-line"><i class="icon fs-14 icon-instagram"></i></a></li>
                                <li><a href="index.html#" class="box-icon w_34 round social-tiktok social-line"><i class="icon fs-14 icon-tiktok"></i></a></li>
                                <li><a href="index.html#" class="box-icon w_34 round social-pinterest social-line"><i class="icon fs-14 icon-pinterest-1"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-12 footer-col-block">
                        <div class="footer-heading footer-heading-desktop">
                            <h6>@lang('Useful links')</h6>
                        </div>
                        <div class="footer-heading footer-heading-moblie">
                            <h6>@lang('Useful links')</h6>
                        </div>
                        <ul class="footer-menu-list tf-collapse-content">
                            <li>
                                <a href="privacy-policy.html" class="footer-menu_item">@lang('Privacy Policy')</a>
                            </li>
                            <li> 
                                <a href="shipping-delivery.html" class="footer-menu_item">@lang('Shipping')</a>
                            </li>
                            <li> 
                                <a href="terms-conditions.html" class="footer-menu_item">@lang('Terms & Conditions')</a>
                            </li>
                            <li> 
                                <a href="faq-1.html" class="footer-menu_item">@lang('FAQ’s')</a>
                            </li>
                            <li> 
                                <a href="compare.html" class="footer-menu_item">@lang('Compare')</a>
                            </li>
                            <li> 
                                <a href="wishlist.html" class="footer-menu_item">@lang('My Wishlist')</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xl-3 col-md-6 col-12 footer-col-block">
                        <div class="footer-heading footer-heading-desktop">
                            <h6>@lang('About us')</h6>
                        </div>
                        <div class="footer-heading footer-heading-moblie">
                            <h6>@lang('About us')</h6>
                        </div>
                        <ul class="footer-menu-list tf-collapse-content">
                            <li>
                                <a href="about-us.html" class="footer-menu_item">@lang('Our Story')</a>
                            </li>
                            <li> 
                                <a href="our-store.html" class="footer-menu_item">@lang('Visit Our Store')</a>
                            </li>
                            <li> 
                                <a href="{{ route('pages.contact') }}" class="footer-menu_item">@lang('Contact Us')</a>
                            </li>
                            <li> 
                                <a href="login.html" class="footer-menu_item">@lang('Account')</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xl-3 col-md-6 col-12">
                        <a referrerpolicy="origin" target="_blank" href="https://trustseal.enamad.ir/?id=480265&amp;Code=cnt7CHEqfsvVriqVZMkrhgtLpu4zwMjv">
                            <img referrerpolicy="origin" src="{{ asset('images/footer/enamad-one-star.png') }}" alt="نماد اعتماد الکترونیکی" class="tw:cursor-pointer">
                            <noscript>
                                <img referrerpolicy='origin' src='{{ asset('images/footer/enamad-one-star.png') }}' alt='نماد اعتماد الکترونیکی' class="tw:cursor-pointer" >
                            </noscript>
                        </a>
                        {{-- <div class="footer-newsletter footer-col-block">
                            <div class="footer-heading footer-heading-desktop">
                                <h6>Sign Up for Email</h6>
                            </div>
                            <div class="footer-heading footer-heading-moblie">
                                <h6>Sign Up for Email</h6>
                            </div>
                            <div class="tf-collapse-content">
                                <div class="footer-menu_item">Sign up to get first dibs on new arrivals, sales, exclusive content, events and more!</div>
                                <form class="form-newsletter subscribe-form" id="" action="index.html#" method="post" accept-charset="utf-8" data-mailchimp="true">
                                    <div class="subscribe-content">
                                        <fieldset class="email">
                                            <input type="email" name="email-form" class="subscribe-email" placeholder="Enter your email...." tabindex="0" aria-required="true">
                                        </fieldset>
                                        <div class="button-submit">
                                            <button id="" class="subscribe-button tf-btn btn-sm radius-3 btn-fill btn-icon animate-hover-btn" type="button">Subscribe<i class="icon icon-arrow1-top-left"></i></button>
                                        </div>
                                    </div>
                                    <div class="subscribe-msg"></div>
                                </form>
                                <div class="tf-cur">
                                    <div class="tf-currencies">
                                        <select class="image-select center style-default type-currencies">
                                            <option data-thumbnail="images/country/fr.svg">EUR <span>€ | France</span></option>
                                            <option data-thumbnail="images/country/de.svg">EUR <span>€ | Germany</span></option>
                                            <option selected data-thumbnail="images/country/us.svg">USD <span>$ | United States</span></option>
                                            <option data-thumbnail="images/country/vn.svg">VND <span>₫ | Vietnam</span></option>
                                        </select>
                                    </div>
                                    <div class="tf-languages">
                                        <select class="image-select center style-default type-languages">
                                            <option>English</option>
                                            <option>العربية</option>
                                            <option>简体中文</option>
                                            <option>اردو</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="footer-bottom-wrap d-flex gap-20 flex-wrap justify-content-between align-items-center">
                            <div class="footer-menu_item" dir="ltr">© 2024 {{ config('app.name') }}. All Rights Reserved</div>
                            <div class="tw:flex tw:items-center tw:gap-3">
                                <img class="tw:h-5 tw:w-auto" src="images/footer/zp-logo.svg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>