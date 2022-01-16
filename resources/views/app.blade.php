<!DOCTYPE html>
<html lang="en" dir="rtl">

    @include('landing.layouts.header')
    @yield('css')
    <body>
        <div class="d-none" id="current-lang">{{Lang::locale()}}</div>
        <div class="preloader bg-blue">
            <div class="preloader-wrapper">
                <div class="loader-content book">
                    <figure class="page"></figure>
                    <figure class="page"></figure>
                    <figure class="page"></figure>
                </div>
                <h3>{{__('content.loading')}} ...</h3>
            </div>
        </div>
        @yield('content')

        <div class="scroll-top scroll-top-secondcolor" id="scrolltop">
            <div class="scroll-top-inner">
                <span><i class="flaticon-up-arrow"></i></span>
            </div>
        </div>

        @include('landing.layouts.footer')

        <script>
            var lang = $('#current-lang').html();
            if(lang == 'ar'){
                $('html').children().css("direction", "rtl");
                var langCss = document.getElementById('arabic-css');
                langCss.href = "{{asset('/public/web/css/rtl.css')}}";
                $('.lang-name').html('العربية')
            }else{
                $('html').children().css("direction", "ltr");
                var langCss = document.getElementById('english-css');
                langCss.href = "{{asset('/public/web/css/custom-en.css')}}";
                $('.lang-name').html('English')
            }

            $('.language-dropdown-menu').on('click', '[data-action="change-language-to-en"]', function(){
                var url = $(location).attr("href");
                if(url.indexOf('/en') != -1){
                    window.location.href = url;
                }else{
                    if(url.indexOf('/ar') == -1){
                        window.location.href = url + 'en'
                    }else{
                        window.location.href = url.replace("/ar", "/en");
                    }
                }
            });

            $('.language-dropdown-menu').on('click', '[data-action="change-language-to-ar"]', function(){
                var url = $(location).attr("href");
                if(url.indexOf('/ar') != -1){
                    window.location.href = url;
                }else{
                    if(url.indexOf('/en') == -1){
                        window.location.href = url + 'ar'
                    }else{
                        window.location.href = url.replace("/en", "/ar");
                    }
                }
            });
        </script>

        @yield('script')
    </body>
</html>
