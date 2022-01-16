@extends('app')
@section('content')
    @include('landing.header')

        <section class="about-section pt-120 pb-50">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-5 pb-30">
                        <div class="max-600 desk-mr-auto desk-pad-left-30">
                            <div class="about-section-title section-title section-title-left section-title-shapeless position-relative">
                                <div class="overlay-text">
                                    {{-- <h3 class="font-family-3">{{__('content.whoarewe')}}</h3> --}}
                                </div>
                                <h2>{{__('content.aboutus')}}</h2>
                                <div>{{__('content.weareeducationalsupplementstofamilyandschoolefforts')}}</div>
                                <div>{{__('content.ourvisionistobeaworldleadingeducationalinstitutioninholisticpersonaldevelopment')}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-7 pb-30">
                        <div class="contact-information-item">
                            <div class="contact-information-image text-center">

                                {{-- <div class="circle circle-right-top">
                                    <div class="font-weight-bold">{{__('content.designingstudytours')}}</div>
                                </div>

                                <div class="circle circle-left-top">
                                    <div class="font-weight-bold">{{__('content.conductinginteractiveworkshops')}}</div>
                                </div>

                                <div class="circle circle-number5">
                                    <div class="font-weight-bold">{{__('content.organizing living learning programs')}}</div>
                                </div>

                                <div class="circle circle-center">
                                    <div class="font-weight-bold">{{__('content.ourspecialty')}}</div>
                                </div>

                                <div class="circle circle-right-bottom">
                                    <div class="font-weight-bold">{{__('content.startingandadvisingschoolclubs')}}</div>
                                </div>

                                <div class="circle circle-left-bottom">
                                    <div class="font-weight-bold">{{__('content.individualandgroupmentoring')}}</div>
                                </div> --}}

                                <img class="image-specialtyar" src="{{asset('/public/web/images/specialtyar.png')}}" alt="contact">
                                <img class="image-specialtyen" src="{{asset('/public/web/images/specialtyen.png')}}" alt="contact">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- <section class="testimonial-section ptb-50 position-relative">
            <div class="container">
                <div class="section-title">
                    <h2>{{__('content.officials')}}</h2>
                </div>
                <div class="testimonial-carousel swiper-container">
                    <div class="swiper-wrapper">
                        <div class="testimonial-carousel-item swiper-slide">
                            <div class="testimonial-carousel-thumb">
                                <img src="{{asset('/public/web/images/clients/client-1.jpg')}}" alt="client">
                            </div>
                            <div class="testimonial-carousel-content">
                                <h3 class="testimonial-client-name">الدكتور محمد سعيفان</h3>
                                <p class="testimonial-client-feedback">" تربية مشروع رائدٌ فريد، لديه رؤية عميقة طابعها رساليّ ملهِم ومقنِع، وبرامجه علميّة وعمليّة وطموحة، وخططه استراتيجيّة وتشغيليّة تصقلها التّجرِبة، وتزيدها إحكامًا. والأفق رحبٌ أمام هذا المشروع؛ ليحلّق من المحليّة إلى العالميّة نحو طالب رشيد، ومربٍّ قويّ أمين؛ فكلّ الشّكر والتّقدير لصاحب الفكرة الملهِمة، وللقائمين على تربية، والعاملين عليها </p>
                            </div>
                        </div>
                        <div class="testimonial-carousel-item swiper-slide">
                            <div class="testimonial-carousel-thumb">
                                <img src="{{asset('/public/web/images/clients/client-2.jpg')}}" alt="client">
                            </div>
                            <div class="testimonial-carousel-content">
                                <h3 class="testimonial-client-name">الأستاذ أحمد المالكي</h3>
                                <p class="testimonial-client-feedback">وتعاونهم المستمر مع جهات من أجل إرساء معاني التربية الصحيحة وصناعة جيل من الأطفال والشباب المميزين ، فهم القادة الذين ننتظر منهم كلّ إبداع )</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-carousel-control">
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="testimonial-section p-tb-100 position-relative">
            <div class="container">
                <div class="section-title section-title-shapeless section-title-lineless section-title-secondcolor">
                    <h2>{{__('content.whatdidtheysayaboutus?')}}</h2>
                </div>
                <div class="testimonial-carousel-two swiper-container">
                    <div class="swiper-wrapper">
                        <div class="testimonial-content-item testimonial-content-item-secondcolor swiper-slide">
                            <div class="testimonial-carousel-header">
                                <div class="testimonial-header-text font-family-3"></div>
                                <div class="testimonial-header-thumb">
                                    <img src="{{asset('/public/web/images/clients/client-1.jpg')}}" alt="client">
                                </div>
                            </div>
                            <div class="testimonial-carousel-content-two">
                                <h3>الدكتور محمد سعيفان</h3>
                                <p>" تربية مشروع رائدٌ فريد، لديه رؤية عميقة طابعها رساليّ ملهِم ومقنِع، وبرامجه علميّة وعمليّة وطموحة، وخططه استراتيجيّة وتشغيليّة تصقلها التّجرِبة، وتزيدها إحكامًا. والأفق رحبٌ أمام هذا المشروع؛ ليحلّق من المحليّة إلى العالميّة نحو طالب رشيد، ومربٍّ قويّ أمين؛ فكلّ الشّكر والتّقدير لصاحب الفكرة الملهِمة، وللقائمين على تربية، والعاملين عليها </p>
                            </div>
                        </div>
                        <div class="testimonial-content-item testimonial-content-item-secondcolor swiper-slide">
                            <div class="testimonial-carousel-header">
                                <div class="testimonial-header-text font-family-3"></div>
                                <div class="testimonial-header-thumb">
                                    <img src="{{asset('/public/web/images/clients/client-2.jpg')}}" alt="client">
                                </div>
                            </div>
                            <div class="testimonial-carousel-content-two">
                                <h3>الأستاذ اسماعيل الآغا</h3>
                                <p>" تربية مشروع رائدٌ فريد، لديه رؤية عميقة طابعها رساليّ ملهِم ومقنِع، وبرامجه علميّة وعمليّة وطموحة، وخططه استراتيجيّة وتشغيليّة تصقلها التّجرِبة، وتزيدها إحكامًا. والأفق رحبٌ أمام هذا المشروع؛ ليحلّق من المحليّة إلى العالميّة نحو طالب رشيد، ومربٍّ قويّ أمين؛ فكلّ الشّكر والتّقدير لصاحب الفكرة الملهِمة، وللقائمين على تربية، والعاملين عليها </p>
                            </div>
                        </div>
                        <div class="testimonial-content-item testimonial-content-item-secondcolor swiper-slide">
                            <div class="testimonial-carousel-header">
                                <div class="testimonial-header-text font-family-3"></div>
                                <div class="testimonial-header-thumb">
                                    <img src="{{asset('/public/web/images/clients/client-3.jpg')}}" alt="client">
                                </div>
                            </div>
                            <div class="testimonial-carousel-content-two">
                                <h3>البروفيسور محمد أحمد</h3>
                                <p>" تربية مشروع رائدٌ فريد، لديه رؤية عميقة طابعها رساليّ ملهِم ومقنِع، وبرامجه علميّة وعمليّة وطموحة، وخططه استراتيجيّة وتشغيليّة تصقلها التّجرِبة، وتزيدها إحكامًا. والأفق رحبٌ أمام هذا المشروع؛ ليحلّق من المحليّة إلى العالميّة نحو طالب رشيد، ومربٍّ قويّ أمين؛ فكلّ الشّكر والتّقدير لصاحب الفكرة الملهِمة، وللقائمين على تربية، والعاملين عليها </p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination swiper-pagination-secondcolor"></div>
                </div>
            </div>
        </section> --}}

        <section class="partner-section pt-30 pb-50">
            <div class="container">
                <div class="section-title">
                    <h2>{{__('content.successpartners')}}</h2>
                </div>
                <div class="partner-carousel swiper-container">
                    <div class="swiper-wrapper">
                        <div class="partner-item swiper-slide">
                            <a target="_blank" href="https://www.facebook.com/"><img src="{{asset('/public/web/images/partners/1586861795.png')}}" alt="partner"></a>
                        </div>
                        <div class="partner-item swiper-slide">
                            <a target="_blank" href="https://www.facebook.com/"><img src="{{asset('/public/web/images/partners/1586861834.png')}}" alt="partner"></a>
                        </div>
                        <div class="partner-item swiper-slide">
                            <a target="_blank" href="https://www.facebook.com/"><img src="{{asset('/public/web/images/partners/1586861914.png')}}" alt="partner"></a>
                        </div>
                        <div class="partner-item swiper-slide">
                            <a target="_blank" href="https://www.facebook.com/"><img src="{{asset('/public/web/images/partners/1587058573.jpg')}}" alt="partner"></a>
                        </div>
                        <div class="partner-item swiper-slide">
                            <a target="_blank" href="https://www.facebook.com/"><img src="{{asset('/public/web/images/partners/1587058537.jpg')}}" alt="partner"></a>
                        </div>
                        <div class="partner-item swiper-slide">
                            <a target="_blank" href="https://www.facebook.com/"><img src="{{asset('/public/web/images/partners/1587058513.jpg')}}" alt="partner"></a>
                        </div>
                        <div class="partner-item swiper-slide">
                            <a target="_blank" href="https://www.facebook.com/"><img src="{{asset('/public/web/images/partners/1587059781.jpg')}}" alt="partner"></a>
                        </div>
                        <div class="partner-item swiper-slide">
                            <a target="_blank" href="https://www.facebook.com/"><img src="{{asset('/public/web/images/partners/1587063595.jpg')}}" alt="partner"></a>
                        </div>
                        <div class="partner-item swiper-slide">
                            <a target="_blank" href="https://www.facebook.com/"><img src="{{asset('/public/web/images/partners/1587196721.png')}}" alt="partner"></a>
                        </div>
                        <div class="partner-item swiper-slide">
                            <a target="_blank" href="https://www.facebook.com/"><img src="{{asset('/public/web/images/partners/1587196742.jpeg')}}" alt="partner"></a>
                        </div>
                    </div>
                </div>
            </div>
        </section
    @include('landing.footer')
@endsection
