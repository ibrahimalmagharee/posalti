@extends('app')
@section('content')
    @include('landing.header')
        <div class="authentication-section pt-150 pb-70">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-12 pb-30">
                        @if (Session::has('success'))
                            <div class="alert alert-primary text-center">
                                <p>{{ Session::get('success') }}</p>
                            </div>
                        @endif
                        <div class="authentication-item">
                            <h3>{{__('content.login')}}</h3>
                            <div class="authentication-form">
                                @if ($errors->any())
                                    <div class="alert alert-danger" id="Error">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('user.login') }}">
                                    @csrf
                                    <div class="form-group mb-20">
                                        <div class="input-group">
                                            <input type="email" name="email" class="form-control" required placeholder="{{__('content.email')}}">
                                        </div>
                                    </div>
                                    <div class="form-group mb-20">
                                        <div class="input-group">
                                            <input type="password" name="password" class="form-control" required placeholder="{{__('content.password')}}">
                                        </div>
                                    </div>
                                    <button class="btn main-btn btn-secondcolor full-width">{{__('content.login')}}</button>
                                </form>
                                <div class="col-sm-12 p-0 text-left mt-3">
                                    <h6 class="text-grey-500 font-xsss fw-500 mt-0 mb-0 lh-32">{{__('content.youdonthaveanaccount')}} <a href="{{route('register')}}" class="fw-700 ml-1">{{__('content.register')}}</a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @include('landing.footer')
@endsection
