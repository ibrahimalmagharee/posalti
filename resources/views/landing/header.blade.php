<div class="fixed-top">
    <div class="navbar-area navbar-area-two">
        <!-- mobile menu -->
        <div class="mobile-nav">
            <a href="{{route('index')}}" class="mobile-brand text-left">
                <img src="{{asset('/public/web/images/logo-index.png')}}" alt="logo" class="logo" style="width: 25%">
            </a>
            <div class="navbar-option">
                <div class="navbar-option-item navbar-option-language dropdown language-option"> <!-- "language-option" class is used for language switcher -->
                    <button class="dropdown-toggle" type="button" id="language3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="flaticon-worldwide"></i>
                        <span class="lang-name"></span>  <!-- "lang-name" class is used for language switcher -->
                    </button>
                    <div class="dropdown-menu language-dropdown-menu" aria-labelledby="language3">  <!-- "language-dropdown-menu" class is used for language switcher -->
                        <a class="dropdown-item" href="#" data-action="change-language-to-en">
                            English
                        </a>
                        <a class="dropdown-item" href="#" data-action="change-language-to-ar">
                            العربيّة
                        </a>
                    </div>
                </div>
            </li>
                <div class="navbar-option-item navbar-option-language dropdown mobile-hide language-option"> <!-- "language-option" class is used for language switcher -->
                    <button class="dropdown-toggle" type="button" id="language1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="flaticon-worldwide"></i>
                        <span class="lang-name"></span>  <!-- "lang-name" class is used for language switcher -->
                    </button>
                    <div class="dropdown-menu language-dropdown-menu" aria-labelledby="language1">  <!-- "language-dropdown-menu" class is used for language switcher -->
                        <a class="dropdown-item" href="#" data-action="change-language-to-en">
                            English
                        </a>
                        <a class="dropdown-item" href="#" data-action="change-language-to-ar">
                            العربيّة
                        </a>
                    </div>
                </div>
                <div class="navbar-option-item navbar-option-cart mobile-hide">
                    <a href="{{route('index')}}"><i class="flaticon-shopping-cart"></i>
                        {{-- <span class="option-badge option-badge-secondcolor">2</span> --}}
                    </a>
                </div>

                @if(Auth::check())
                    <div class="navbar-option-item navbar-option-account dropdown">
                        <button class="dropdown-toggle btn-auth-account" type="button" id="authUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="flaticon-user"></i>
                        </button>
                        <div class="dropdown-menu user-dropdown-menu" aria-labelledby="authUser">

                            @if (Auth::user()->last_financial())
                                @if (!Auth::user()->last_financial()->status)
                                    <a class="dropdown-item checkout" href="{{route('payment.index')}}">
                                        {{__('content.Checkout')}} @if(Lang::locale() == 'ar') {{Auth::user()->last_financial()->title->title_ar}} @else {{Auth::user()->last_financial()->title->title_en}} @endif
                                        ({{Auth::user()->last_financial()->value}} QAR)
                                    </a>
                                @endif
                            @endif

                            <a class="dropdown-item" href="{{route('user.studentRegisterForm')}}">
                                {{__('content.School students form')}}
                            </a>

                            <a class="dropdown-item" href="{{route('user.accountInformation')}}">
                                {{__('content.Edit account')}}
                            </a>

                            <a class="dropdown-item" href="{{route('user.password')}}">
                                {{__('content.Change password')}}
                            </a>

                            <hr class="hr-dropdown-user">
                            <a class="dropdown-item" href="#">
                                <form class="form-logout-user" method="post" action="{{ route('logout') }}">
                                    @csrf
                                    <i class="flaticon-sign-out"></i><button type="submit" class="btn-logout">{{__('content.Logout')}}</button>
                                </form>
                            </a>
                        </div>
                    </div>
                    @else

                    <div class="navbar-option-item navbar-option-account">
                        <a href="{{route('login')}}"><i class="flaticon-user"></i></a>
                    </div>
                @endif
            </div>
        </div>
        <!-- desktop menu -->
        <div class="main-nav">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand text-left" href="{{route('index')}}" style="width: 15%">
                        <img src="{{asset('/public/web/images/logo-index.png')}}" alt="logo" class="logo" style="width: 50%">
                    </a>
                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a href="{{route('index')}}" class="nav-link font-weight-bold">{{__('content.homepage')}}</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://fato.me/s/bawsalati" class="nav-link font-weight-bold" target="_blank">{{__('content.ourstore')}}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('news')}}" class="nav-link font-weight-bold">{{__('content.ournew')}}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('about')}}" class="nav-link font-weight-bold">{{__('content.aboutus')}}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('contact')}}" class="nav-link font-weight-bold">{{__('content.contactus')}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="navbar-option">

                        <div class="nnavbar-option-item navbar-option-language dropdown language-option"> <!-- "language-option" class is used for language switcher -->
                            <button class="dropdown-toggle" type="button" id="language2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="flaticon-worldwide"></i>
                                <span class="lang-name"></span>  <!-- "lang-name" class is used for language switcher -->
                            </button>
                            <div class="dropdown-menu language-dropdown-menu" aria-labelledby="language2">  <!-- "language-dropdown-menu" class is used for language switcher -->
                                <a class="dropdown-item" href="#" data-action="change-language-to-en">
                                    English
                                </a>
                                <a class="dropdown-item" href="#" data-action="change-language-to-ar">
                                    العربيّة
                                </a>
                            </div>
                        </div>

                        <div class="navbar-option-item navbar-option-cart">
                            <a href="#"><i class="flaticon-shopping-cart"></i>
                                {{-- <span class="option-badge option-badge-secondcolor">2</span> --}}
                            </a>
                        </div>

                        @if(Auth::check())
                            <div class="navbar-option-item navbar-option-account dropdown">
                                <button class="dropdown-toggle btn-auth-account" type="button" id="authUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="flaticon-user"></i>
                                </button>
                                <div class="dropdown-menu user-dropdown-menu" aria-labelledby="authUser">
                                    @if (Auth::user()->last_financial())
                                        @if (!Auth::user()->last_financial()->status)
                                            <a class="dropdown-item checkout" href="{{route('payment.index')}}">
                                                {{__('content.Checkout')}} @if(Lang::locale() == 'ar') {{Auth::user()->last_financial()->title->title_ar}} @else {{Auth::user()->last_financial()->title->title_en}} @endif
                                                ({{Auth::user()->last_financial()->value}} QAR)
                                            </a>
                                        @endif
                                    @endif
                                    <a class="dropdown-item" href="{{route('user.studentRegisterForm')}}">
                                        {{__('content.School students form')}}
                                    </a>

                                    <a class="dropdown-item" href="{{route('user.accountInformation')}}">
                                        {{__('content.Edit account')}}
                                    </a>

                                    <a class="dropdown-item" href="{{route('user.password')}}">
                                        {{__('content.Change password')}}
                                    </a>

                                    <hr class="hr-dropdown-user">
                                    <a class="dropdown-item" href="#">
                                        <form class="form-logout-user" method="post" action="{{ route('logout') }}">
                                            @csrf
                                            <i class="flaticon-sign-out"></i><button type="submit" class="btn-logout">{{__('content.Logout')}}</button>
                                        </form>
                                    </a>
                                </div>
                            </div>
                            @else
                            <div class="navbar-option-item navbar-option-authentication">
                                <a href="{{route('login')}}" class="btn main-btn-2 btn-secondcolor">{{__('content.login')}}</a>
                            </div>
                        @endif
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
