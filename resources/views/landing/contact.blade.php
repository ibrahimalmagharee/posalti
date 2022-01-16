@extends('app')
@section('content')
@include('landing.header')

    <section class="contact-information-section pt-150 pb-70">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-5 pb-30">
                    <div class="contact-information-item">
                        <div class="section-title section-title-shapeless section-title-left text-left">
                            <h2>{{__('content.forfurtherinformation')}} <span class="color-blue-theme">{{__('content.contactwithbawsalati')}}</span></h2>
                        </div>
                        <div class="contact-options">
                            <div class="contact-option-item">
                                {{-- <div class="contact-option-icon color-blue-theme"><i class="flaticon-phone-call"></i></div> --}}
                                <div class="contact-option-details">
                                    <p><img class="img-whatsapp" src="{{asset('/public/web/images/whatsapp.png')}}"/> {{__('content.mobilewithwhatsapp')}}: <a href="https://wa.me/97450012660" target="_blank">50012660</a></p>
                                    <p>{{__('content.email')}}: <a href="mailto:info@bawsalati.com">info@bawsalati.com</a></p>
                                    <p>{{__('content.telephone')}}: <a href="tel:0097444958251">44958251</a></p>
                                    <p>{{__('content.fax')}}: <a href="tel:0097444655841">44655841</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-7 pb-30">
                    <div class="contact-information-item">
                        <div class="contact-information-image text-right">
                            <img src="{{asset('/public/web/images/logo-index.png')}}" alt="contact" style="width: 50%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="contact-form-section pb-70">
        <div class="container">
            <div class="contact-form-box">
                <div class="sub-section-title text-center">
                    <h3 class="sub-section-title-heading">{{__('content.leaveyourmessage')}}</h3>
                    <p>{{__('content.youremailwillnotbepublished')}}</p>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger" id="Error">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-primary text-center">
                        <p>{{ Session::get('success') }}</p>
                    </div>
                @endif
                <form class="contact-form" method="POST" action="{{route('store.contact')}}">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-20">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="flaticon-user"></i></span>
                                    </div>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="{{__('content.name')}}" required data-error="الرجاء ادخال اسمك" />
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-20">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="flaticon-envelope"></i></span>
                                    </div>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="{{__('content.email')}}" required data-error="{{__('content.pleaseenteryouremail')}}" />
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="form-group mb-20">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="flaticon-envelope"></i></span>
                                    </div>
                                    <textarea name="message" class="form-control" id="message" rows="6" placeholder="{{__('content.message')}}"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-12 text-center">
                            <button class="btn main-btn btn-secondcolor" type="submit">{{__('content.sendmessage')}}</button>
                            <div id="msgSubmit"></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@include('landing.footer')
@endsection
