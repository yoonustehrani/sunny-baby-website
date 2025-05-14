<x-layout title="Contact Us">
    <x-header />
    <div class="tf-page-title style-2">
        <div class="container-full">
            <div class="heading text-center">@lang("Contact Us")</div>
        </div>
    </div>
    <!-- map -->
    <section class="flat-spacing-9">
        <div class="container">
            <div class="tf-grid-layout gap-20 lg-col-2">
                <div class="w-100">
                    <iframe title="map-iframe" src="https://neshan.org/maps/iframe/places/238d15e5359c316f9b39fe22ad936c52#c36.276-59.619-17z-0p/36.27608580309134/59.61804482595416" width="100%" height="500" allowFullScreen loading="lazy" ></iframe>
                    {{-- {# <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d317859.6089702069!2d-0.075949!3d51.508112!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48760349331f38dd%3A0xa8bf49dde1d56467!2sTower%20of%20London!5e0!3m2!1sen!2sus!4v1719221598456!5m2!1sen!2sus" width="100%" height="894" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> #} --}}
                </div>
                <div class="tf-content-left has-mt">
                    <div class="sticky-top">
                        <h5 class="mb_20 tw:font-vazir">به فروشگاه ما سر بزنید</h5>
                        <div class="mb_20">
                            <p class="mb_15"><strong>آدرس</strong></p>
                            <p>مشهد - میدان ۱۷ شهریور - مجتمع تجاری رضا - طبقه همکف پلاک ۲۷</p>
                        </div>
                        <div class="mb_20">
                            <p class="mb_15"><strong>شماره تماس</strong></p>
                            <p class="tw:[direction:ltr] tw:text-right">۰۹۱۵ ۵۵۲ ۸۹۲۲</p>
                        </div>
                        <div class="mb_36">
                            <p class="mb_15"><strong>ساعات کاری فروشگاه</strong></p>
                            <p>بجز روزهای تعطیل - ساعت ۱۰ الی ۲۰</p>
                        </div>
                        <div>
                            <ul class="tf-social-icon d-flex gap-20 style-default">
                                <li><a href="#" class="box-icon link round social-facebook border-line-black"><i class="icon fs-14 icon-fb"></i></a></li>
                                <li><a href="#" class="box-icon link round social-twiter border-line-black"><i class="icon fs-12 icon-Icon-x"></i></a></li>
                                <li><a href="#" class="box-icon link round social-instagram border-line-black"><i class="icon fs-14 icon-instagram"></i></a></li>
                                <li><a href="#" class="box-icon link round social-tiktok border-line-black"><i class="icon fs-14 icon-tiktok"></i></a></li>
                                <li><a href="#" class="box-icon link round social-pinterest border-line-black"><i class="icon fs-14 icon-pinterest-1"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /map -->
    <!-- form -->
    <section class="bg_grey-7 flat-spacing-9">
        <div class="container">
            <div class="flat-title">
                <span class="title">فرم تماس با ما</span>
                <p class="sub-title text_black-2">اگر محصولات فوق‌العاده‌ای دارید که تولید می‌کنید یا می‌خواهید با ما همکاری کنید، از فرم زیر استفاده کنید.</p>
            </div>
            <div>
                <form class="mw-705 mx-auto text-center form-contact" id="contactform" action="#" method="post">
                    <div class="d-flex gap-15 mb_15">
                        <fieldset class="w-100">
                            <input type="text" name="name" id="name" required placeholder="نام *"/>
                        </fieldset>
                        <fieldset class="w-100">
                            <input type="email" name="phone" id="phone" required placeholder="شماره تماس *"/>
                        </fieldset>
                    </div>
                    <div class="mb_15">
                        <textarea placeholder="متن پیام" name="message" id="message" required cols="30" rows="10"></textarea>
                    </div>
                    <div class="send-wrap">
                        <button type="submit" class="tf-btn radius-3 btn-fill animate-hover-btn justify-content-center">ارسال</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /form -->
</x-layout>