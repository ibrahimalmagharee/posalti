<footer>
    <div class="footer-upper pt-50 pb-40 bg-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-3">
                    <div class="footer-content-item">
                        <div class="footer-logo">
                            <a href="{{route('index')}}"><img src="{{asset('/public/web/images/index/logo-w.png')}}" alt="logo"></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-9">
                    <div class="footer-right pl-80">
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="footer-content-list footer-content-item">
                                    <div class="footer-content-title">
                                        <h3>{{__('content.links')}}</h3>
                                    </div>
                                    <ul class="footer-details footer-list footer-list-secondcolor">
                                        <li><a href="{{route('about')}}">{{__('content.aboutus')}}</a></li>
                                        <li><a href="{{route('news')}}">{{__('content.ournew')}}</a></li>
                                        <li><a href="#">{{__('content.ourstore')}}</a></li>
                                        <li><a href="{{route('contact')}}">{{__('content.contactus')}}</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="footer-content-list footer-content-item">
                                    <div class="footer-content-title">
                                        <h3>{{__('content.contactus')}}</h3>
                                    </div>
                                    <ul class="footer-details footer-list footer-list-secondcolor">
                                        <li><img class="img-whatsapp" src="{{asset('/public/web/images/whatsapp.png')}}"/><a href="{{$links[5]->link}}" target="_blank">{{__('content.mobilewithwhatsapp')}}: 50012660</a></li>
                                        <li><a href="mailto:info@bawsalati.com">{{__('content.email')}}: info@bawsalati.com</a></li>
                                        <li><a href="tel:0097444958251">{{__('content.telephone')}}: 44958251</a></li>
                                        <li><a href="tel:0097444655841">{{__('content.fax')}}: 44655841</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-lower bg-off-white">
        <div class="background-shapes">
            <div class="background-shape-item">
                <img src="{{asset('/public/web/images/shapes/curved-line.png')}}" alt="line">
            </div>
            <div class="background-shape-item">
                <img src="{{asset('/public/web/images/shapes/half-circle-shape.png')}}" alt="line">
            </div>
        </div>
        <div class="container">
            <div class="footer-lower-grid">
                <div class="footer-lower-item footer-lower-info">
                    <div class="footer-copyright-text footer-copyright-text-secondcolor">
                        <h3 class="text-footer-bottom">{{__('content.bawsalati')}} ©2021</h3>
                    </div>
                </div>
                <div class="footer-lower-item">
                    <ul class="social-list">
                        {{-- <li class="img-whatsapp"><a target="_blank" href="{{$links[5]->link}}"><img src="{{asset('/public/web/images/whatsapp.png')}}" alt="social"></a></li> --}}
                        {{-- <li><a href="{{$links[0]->link}}"><img src="{{asset('/public/web/images/facebook.png')}}" alt="social"></a></li>
                        <li><a href="{{$links[1]->link}}"><img src="{{asset('/public/web/images/twitter.png')}}" alt="social"></a></li>
                        <li><a href="{{$links[2]->link}}"><img src="{{asset('/public/web/images/linkedin.png')}}" alt="social"></a></li>
                        <li><a href="{{$links[3]->link}}"><img src="{{asset('/public/web/images/instagram.png')}}" alt="social"></a></li>
                        <li><a href="{{$links[4]->link}}"><img src="{{asset('/public/web/images/youtube.png')}}" alt="social"></a></li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
