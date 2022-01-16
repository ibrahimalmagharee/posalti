
@extends('app')
@section('content')
    @include('landing.header')
    <div class="authentication-section pt-150 pb-70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-12 pb-30">
                    <div class="authentication-item">
                        <h3>{{__('content.Change password')}}</h3>
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
                            <form method="POST" action="{{ route('user.changePassword') }}">
                                @csrf
                                <div class="form-group mb-20">
                                    <div class="input-group">
                                        <input type="password" name="old_password" class="form-control" required placeholder="{{__('content.Old Password')}}">
                                    </div>
                                </div>

                                <div class="form-group mb-20">
                                    <div class="input-group">
                                        <input type="password" name="new_password" class="form-control" required placeholder="{{__('content.New Password')}}">
                                    </div>
                                </div>

                                <div class="form-group mb-20">
                                    <div class="input-group">
                                        <input type="password" name="confirm_password" class="form-control" required placeholder="{{__('content.Confirm new Password')}}">
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
