
@extends('app')
@section('content')
    @include('landing.header')

    <div class="authentication-section pt-150 pb-70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-12 pb-30">
                    <div class="authentication-item">
                        <h3>{{__('content.Edit account')}}</h3>
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
                            @if (Session::has('success'))
                                <div class="alert alert-primary text-center">
                                    <p>{{ Session::get('success') }}</p>
                                </div>
                            @endif
                            <form method="POST" action="{{ route('user.updateAccountInformation') }}">
                                @csrf
                                <div class="form-group mb-20">
                                    <div class="input-group">
                                        <input type="text" name="name" class="form-control" required placeholder="{{__('content.name')}}" value="{{\Auth::user()->name}}">
                                    </div>
                                </div>
                                <div class="form-group mb-20">
                                    <div class="input-group">
                                        <input type="email" name="email" class="form-control" required placeholder="{{__('content.email')}}" value="{{\Auth::user()->email}}">
                                    </div>
                                </div>
                                <button class="btn main-btn btn-secondcolor full-width">{{__('content.Edit')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('landing.footer')
@endsection
