@extends('layouts.admin')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title"></h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                        <li class="breadcrumb-item active"> Edit profile for - {{Auth::user()->name}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <section id="dom">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-center"><strong> Edit profile for
                                    - {{Auth::user()->name}} </strong></h4>
                            <a class="heading-elements-toggle"><i
                                    class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">

                                </ul>
                            </div>
                        </div>

                        <div class="card-content collapse show">
                            <div class="card-body">
                                <form class="form" id="categoryFormLocale" method="post"
                                        action="{{route('admin.profile.update')}}"
                                        enctype="multipart/form-data">
                                    @csrf
                                    <h4 class="form-section"><i class="ft-home"></i> Edit profile for
                                        - {{auth::user()->name}}</h4>
                                    <input type="hidden" name="id" value="{{Auth::user()->id}}">

                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">Name</label>
                                                    <input type="text" id="name" class="form-control" placeholder="" name="name" value="{{Auth::user()->name}}">
                                                    @error('name')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">Email</label>
                                                    <input type="email" id="email" class="form-control" placeholder="" name="email" value="{{Auth::user()->email}}">
                                                    @error('email')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
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
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">New password</label>
                                                    <input type="password" id="password" class="form-control" placeholder="New password" name="password">
                                                    @error('password')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">Confirm new password</label>
                                                    <input type="password" id="password_confirmation" class="form-control" placeholder="Confirm new password" name="confirm_password">
                                                    @error('password')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="la la-check-square-o"></i> Update
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
