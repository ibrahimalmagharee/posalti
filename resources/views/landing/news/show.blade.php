@extends('app')
@section('content')
@include('landing.header')

    <!-- blog-details-section -->
    <div class="blog-details-section pt-150 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 pb-30 order-lg-2">
                    <div class="blog-details-item desk-pad-left-20">
                        <article class="blog-details-box mb-30">
                            <div class="blog-post-image text-left">
                                <img src="{{$new->image_path}}" alt="blog">
                                <div class="blog-post-category">{{Lang::locale() == 'ar' ? $new->category->name_ar : $new->category->name_en}}</div>
                            </div>
                            <div class="blog-post-details">
                                <ul class="course-entry-list">
                                    {{-- <li><i class="flaticon-man"></i> {{$new->user->name}}</li> --}}
                                    <li><i class="flaticon-online-learning-1"></i> {{$new->created_at->format('Y-m-d')}}</li>
                                </ul>
                                <h3>{{Lang::locale() == 'ar' ? $new->title_ar : $new->title_en}}</h2>
                                <blockquote class="blockquote"> <!-- We have different variations of blockquote design. Use class "blockquote-secondcolor" or "blockquote-thirdcolor" to get color variations of the blockquote. -->
                                    <div class="blockquote-inner">
                                        {!! Lang::locale() == 'ar' ? $new->content_ar : $new->content_en !!}
                                    </div>
                                </blockquote>
                                {{-- <div class="blog-image-grid mt-4">
                                    <div class="more-image">
                                        <h4>المزيد من الصور</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="blog-grid-image">
                                                <img src="{{asset('/public/web/images/blogs/blog2.png')}}" alt="blog">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="blog-grid-image">
                                                <img src="{{asset('/public/web/images/blogs/blog3.jpg')}}" alt="blog">
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="blog-action">
                                {{-- <p class="blog-action-tag"><i class="flaticon-tag"></i> Studuent, Learners</p> --}}
                                <div class="blog-share">
                                    <p>{{__('content.share')}}</p>
                                    <ul class="social-list">

                                        <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https://bawsalati.com/ar/news/{{ Lang::locale() == 'ar' ? $new->slug_ar : $new->slug_en }}"><img src="{{asset('/public/web/images/facebook.png')}}" alt="social"></a></li>
                                        <li><a target="_blank" href="http://twitter.com/share?url=https://bawsalati.com/ar/news/{{ Lang::locale() == 'ar' ? $new->slug_ar : $new->slug_en }}"><img src="{{asset('/public/web/images/twitter.png')}}" alt="social"></a></li>
                                        {{-- <li><a href="#"><img src="{{asset('/public/web/images/linkedin.png')}}" alt="social"></a></li>
                                        <li><a href="#"><img src="{{asset('/public/web/images/instagram.png')}}" alt="social"></a></li>
                                        <li><a href="#"><img src="{{asset('/public/web/images/youtube.png')}}" alt="social"></a></li>
                                        <li><a href="#"><img src="{{asset('/public/web/images/skype.png')}}" alt="social"></a></li> --}}
                                    </ul>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-12 col-lg-4 pb-30 order-lg-1">
                    <div class="sidebar-item mb-40">
                        <div class="sidebar-title">
                            <h3>{{__('content.Our latest news')}}</h3>
                        </div>
                        <div class="blog-recent-content">
                            @foreach ($news as $new)
                                <div class="blog-recent-content-item">
                                    <div class="blog-recent-content-image">
                                        <a href="{{Lang::locale() == 'ar' ? $new->slug_ar : $new->slug_en}}">
                                            <img src="{{$new->image_path}}" alt="recent">
                                        </a>
                                    </div>
                                    <div class="blog-recent-content-details">
                                        <ul class="course-entry-list">
                                            <li><i class="flaticon-online-learning-1"></i> {{$new->created_at->format('Y-m-d')}}</li>
                                        </ul>
                                        <h3><a href="{{Lang::locale() == 'ar' ? $new->slug_ar : $new->slug_en}}">{{Lang::locale() == 'ar' ? $new->title_ar : $new->title_en}} </a></h3>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a href="{{route('news')}}"><button class="btn btn-primary w-100 mt-4 btn-them-color-red">{{__('content.Show more')}}</button></a>
                    </div>
                    {{-- <div class="sidebar-item">
                        <div class="sidebar-title">
                            <h3>الكلمات الدلالية</h3>
                        </div>
                        <div class="sidebar-content">
                            <ul class="sidebar-tag">
                                <li><a href="#">التعليم</a></li>
                                <li><a href="#">أخبار تقنية</a></li>
                                <li><a href="#">الطلاب</a></li>
                            </ul>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- .end blog-details-section -->

@include('landing.footer')
@endsection
