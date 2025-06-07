<section class="tw:flex tw:justify-center tw:mb-12">
    <div class="tw:bg-alabaster-dark tw:shadow-md tw:rounded-2xl tw:w-10/12 tw:lg:w-4/5 tw:py-8 tw:px-4">
        <div class="tw:w-fit tw:mx-auto">
            <div class="flat-title">
                <span class="title wow fadeInUp tw:font-bold" data-wow-delay="0s">دسته بندی بر اساس جنسیت</span>
                <p class="sub-title wow fadeInUp" data-wow-delay="0s">دخترانه، پسرانه، و اسپرت. همه مدلش رو موجود داریم.
                </p>
            </div>
        </div>
        <div
        {{--  --}}
            class="tw:-mt-6 tw:w-full tw:px-4 tw:md:w-4/5 tw:mx-auto tw:flex-wrap tw:flex tw:items-center tw:justify-center tw:gap-4 tw:md:gap-12 tw:py-6">
            <x-rec-item>
                <img class="tw:size-12 tw:md:size-16" height="50px" width="50px" loading="lazy" src="{{ asset('icons/baby-boy.svg') }}"
                    alt="baby boy icon">
                <span class="tw:text-base tw:md:text-xl">پسرانه</span>
            </x-rec-item>
            <x-rec-item>
                <img class="tw:size-12 tw:md:size-16" height="50px" width="50px" loading="lazy" src="{{ asset('icons/baby-girl.svg') }}"
                    alt="baby girl icon">
                <span class="tw:text-base tw:md:text-xl">دخترانه</span>
            </x-rec-item>
            <x-rec-item>
                <img class="tw:size-12 tw:md:size-16" height="50px" width="50px" loading="lazy" src="{{ asset('icons/unisex.svg') }}" alt="unisex icon">
                <span class="tw:text-base tw:md:text-xl">اسپرت</span>
            </x-rec-item>
        </div>
    </div>
</section>