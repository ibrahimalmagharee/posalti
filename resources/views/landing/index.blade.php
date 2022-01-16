@extends('app')
@section('content')
@include('landing.header')

    <!-- header -->
    {{-- <header class="header-bg-two">
        <div class="header-carousel-shapes">
            <div class="header-carousel-shape animation-tab-none">
                <img src="{{asset('/public/web/images/shapes/shape-5.png')}}" alt="shape">
            </div>
            <div class="header-carousel-shape animation-tab-none">
                <img src="{{asset('/public/web/images/shapes/shape-6.png')}}" alt="shape">
            </div>
            <div class="header-carousel-shape animation-tab-none">
                <img src="{{asset('/public/web/images/shapes/shape-7.png')}}" alt="shape">
            </div>
            <div class="header-carousel-shape animation-tab-none">
                <img src="{{asset('/public/web/images/shapes/shape-8.png')}}" alt="shape">
            </div>
            <div class="header-carousel-shape animation-tab-none">
                <img src="{{asset('/public/web/images/shapes/shape-9.png')}}" alt="shape">
            </div>
        </div> --}}
        <div class="container-fluid desk-plr-0">
            <div class="header-carousel-two swiper-container">
                <div class="swiper-wrapper">
                    <div class="header-carousel-two-item header-carousel-two-bg1 swiper-slide">
                        <div class="row align-items-center desk-mlr-0">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 desk-plr-0">
                                <div class="header-content header-content-full header-content-secondcolor desk-pad-left-15 desk-pad-right-30">
                                    <div class="header-content-text">
                                        <h1>{{__('content.bawsalati')}}</h1>
                                        <p class="mb-2">{{__('content.weareeducationalsupplementstofamilyandschoolefforts')}}</p>
                                        <p>{{__('content.ourvisionistobeaworldleadingeducationalinstitutioninholisticpersonaldevelopment')}}</p>
                                    </div>
                                    <div class="header-button-group">
                                        <div class="header-button-item">
                                            <a href="{{route('register')}}" class="btn main-btn-2 btn-secondcolor custom-hight">{{__('content.registernowinwebsite')}} <i class="flaticon-edit"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-sm-12 col-md-12 col-lg-10 col-xl-6 desk-plr-0 d-none-mobile">
                                <img src="{{asset('/public/web/images/index/logo-w.png')}}" alt="logo" class="logo">
                            </div> --}}
                        </div>
                    </div>
                    {{-- <div class="header-carousel-two-item header-carousel-two-bg2 swiper-slide">
                        <div class="row align-items-center desk-mlr-0">
                            <div class="col-sm-12 col-md-12 col-lg-10 col-xl-6 desk-plr-0">
                                <div class="header-content header-content-full header-content-secondcolor desk-pad-left-15 desk-pad-right-30">
                                    <div class="header-content-text">
                                        <h1>{{__('content.bawsalati')}} <span>{{__('content.simplymydestination')}}</span></h1>
                                        <small>{{__('content.whybawsalati')}}</small>
                                        <p>{{__('content.answerwhybawsalati')}}</p>
                                    </div>
                                    <div class="header-button-group">
                                        <div class="header-button-item">
                                            <a href="{{route('register')}}" class="btn main-btn-2 btn-secondcolor custom-hight">{{__('content.registernowinbawsalati')}} <i class="flaticon-edit"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="header-swiper-pagination swiper-pagination"></div>
            </div>
        </div>
    </header>
     <!-- offer-section -->
     <section class="offer-section pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-3 text-center">
                    <a href="{{route('about')}}" class="a-image-index">
                        <img src="{{asset('/public/web/images/index/11.png')}}" alt="">
                        <span>{{__('content.aboutus')}}</span>
                    </a>
                </div>
                <div class="col-6 col-md-3 text-center">
                    <a href="{{route('news')}}" class="a-image-index">
                        <img src="{{asset('/public/web/images/index/33.png')}}" alt="">
                        <span>{{__('content.ournew')}}</span>
                    </a>
                </div>
                <div class="col-6 col-md-3 text-center">
                    <a href="https://fato.me/s/bawsalati" class="a-image-index" target="_blank">
                        <img src="{{asset('/public/web/images/index/22.png')}}" alt="">
                        <span>{{__('content.ourstore')}}</span>
                    </a>
                </div>
                <div class="col-6 col-md-3 text-center">
                    <a href="{{route('contact')}}" class="a-image-index">
                        <img src="{{asset('/public/web/images/index/44.png')}}" alt="">
                        <span>{{__('content.contactus')}}</span>
                    </a>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-12 col-sm-6 col-lg-3 pb-30">
                    <div class="offer-card offer-card-thirdcolor">
                        <div class="offer-card-inner">
                            <div class="offer-card-thumb">
                                <img src="{{asset('/public/web/images/aboutus.png')}}" alt="shape">
                            </div>
                            <div class="offer-card-content">
                                <h3>{{__('content.aboutus')}}</h3>
                                <p>{{__('content.whoisbawsalati')}}</p>
                            </div>
                            <a href="{{route('about')}}" class="offer-redirect-link"><i class="flaticon-right-arrow"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 pb-30">
                    <div class="offer-card offer-card-thirdcolor">
                        <div class="offer-card-inner">
                            <div class="offer-card-thumb">
                                <img src="{{asset('/public/web/images/new.png')}}" alt="shape">
                            </div>
                            <div class="offer-card-content">
                                <h3>{{__('content.ournew')}}</h3>
                                <p>{{__('content.followoureducationalarticles')}}</p>
                            </div>
                            <a href="#" class="offer-redirect-link"><i class="flaticon-right-arrow"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 pb-30">
                    <div class="offer-card offer-card-thirdcolor">
                        <div class="offer-card-inner">
                            <div class="offer-card-thumb">
                                <img src="{{asset('/public/web/images/store.png')}}" alt="shape">
                            </div>
                            <div class="offer-card-content">
                                <h3>{{__('content.ourstore')}}</h3>
                                <p>{{__('content.viewalltrainingmaterials')}}</p>
                            </div>
                            <a href="#" class="offer-redirect-link"><i class="flaticon-right-arrow"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 pb-30">
                    <div class="offer-card offer-card-thirdcolor">
                        <div class="offer-card-inner">
                            <div class="offer-card-thumb">
                                <img src="{{asset('/public/web/images/contactus.png')}}" alt="shape">
                            </div>
                            <div class="offer-card-content">
                                <h3>{{__('content.contactus')}}</h3>
                                <p>{{__('content.weprovide')}}</p>
                            </div>
                            <a href="{{route('contact')}}" class="offer-redirect-link"><i class="flaticon-right-arrow"></i></a>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
    <!-- .end offer-section -->
     <!-- about-section -->
     {{-- <div class="about-section bg-thirdcolor-light pt-80 pb-70 position-relative mt-40">
        <div class="record-animate-shapes">
            <div class="record-animate-shape animation-tab-none">
                <img src="{{asset('/public/web/images/shapes/shape-2.png')}}" alt="shape">
            </div>
        </div>
        <div class="container position-relative">
            <div class="record-grid">
                <div class="record-grid-item">
                    <div class="record-grid-item-inner record-grid-item-inner-secondcolor">
                        <div class="record-item-number">
                            <div class="counter">200</div>
                            <span>+</span>
                        </div>
                        <div class="record-item-text">
                            <p>{{__('content.numberofevents')}}</p>
                        </div>
                    </div>
                </div>
                <div class="record-grid-item">
                    <div class="record-grid-item-inner record-grid-item-inner-secondcolor">
                        <div class="record-item-number">
                            <div class="counter">199</div>
                            <span>+</span>
                        </div>
                        <div class="record-item-text">
                            <p>{{__('content.numberoftrainingcourses')}}</p>
                        </div>
                    </div>
                </div>
                <div class="record-grid-item">
                    <div class="record-grid-item-inner record-grid-item-inner-secondcolor">
                        <div class="record-item-number">
                            <div class="counter">150</div>
                            <span>+</span>
                        </div>
                        <div class="record-item-text">
                            <p>{{__('content.numberofusers')}}</p>
                        </div>
                    </div>
                </div>
                <div class="record-grid-item">
                    <div class="record-grid-item-inner record-grid-item-inner-secondcolor">
                        <div class="record-item-number">
                            <div class="counter">20</div>
                            <span>+</span>
                        </div>
                        <div class="record-item-text">
                            <p>{{__('content.numberofproducts')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- .end about-section -->
    <!-- .end header -->
    @include('landing.footer')
@endsection
