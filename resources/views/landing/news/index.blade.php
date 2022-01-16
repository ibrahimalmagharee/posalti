@extends('app')
@section('content')
@include('landing.header')


    <!-- header -->
    {{-- <div class="pt-150 pb-50">
        <div class="container">
            <div class="header-page-content">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">News</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div> --}}
    <!-- .end header -->

    <!-- blog-section -->
    <section class="blog-section pt-150 pb-70">
        <div class="container">
            <div class="row">
                @foreach ($news as $new)
                    <div class="col-12 col-md-6 col-lg-4 pb-30">
                        <div class="course-flat-card course-flat-card">
                            <div class="course-card-thumb">
                                <a href="{{route('show.new', Lang::locale() == 'ar' ? $new->slug_ar : $new->slug_en)}}"><div class="img-news" style="background-image: url('{{$new->image_path}}')"></div></a>
                            </div>
                            <div class="course-card-content">
                                <ul class="course-entry-list">
                                    <li><i class="flaticon-open-book"></i> {{Lang::locale() == 'ar' ? $new->category->name_ar : $new->category->name_en}}</li>
                                    {{-- <li><i class="flaticon-man"></i> {{$new->user->name}}</li> --}}
                                </ul>
                                <h3>{{Lang::locale() == 'ar' ? $new->title_ar : $new->title_en}}</h3>
                                <p><a href="{{route('show.new',  Lang::locale() == 'ar' ? $new->slug_ar : $new->slug_en)}}" class="redirect-link color-them">{{__('content.read more')}} <i class="flaticon-right-arrow"></i></a></p>
                            </div>
                            <ul class="course-filter-list">
                                <li class="course-filter course-filter-focus background-color-them">{{$new->created_at->format('Y-m-d')}}</li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@include('landing.footer')
@endsection
