@extends('app')
@section('content')
    <div class="main-wrap">
        @include('landing.header')
        <div class="about-wrapper pb-lg--7 pt-lg--7 pt-5 pb-7">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="text-grey-900 fw-700 font-xxl pb-2 mb-0 mt-3 d-block lh-3 text-center">{!! $data->text !!}</h2>
                    </div>
                </div>
                <div class="row">
                    @foreach ($data->images as $image)
                        <div class="col-md-4 mb-3">
                            <a href="#"><img src="{{asset('/public/uploads/dependence/'. $image->name)}}" alt="about" class="img-fluid rounded-lg"></a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @include('landing.sections.brands')
        @include('landing.footer')
    </div>
@endsection
