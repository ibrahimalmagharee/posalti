@extends('layouts.admin')

@section('content')
    <div class="content-body mt-2">
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-12">
                <a href="{{route('admin.index')}}">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <img src="{{asset('/public/uploads/dashboard/admin.jpg')}}"  width="50px" />
                                    </div>
                                    <div class="media-body text-right">
                                        <h3>{{$admin_count}}</h3>
                                        <span>Admin</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
                <a href="{{route('client.index')}}">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <img src="{{asset('/public/uploads/dashboard/customer.jpg')}}"  width="50px" />
                                    </div>
                                    <div class="media-body text-right">
                                        <h3>{{$client_count}}</h3>
                                        <span>Customers</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
                <a href="{{route('news.index')}}">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <img src="{{asset('/public/uploads/dashboard/news.png')}}"  width="50px" />
                                    </div>
                                    <div class="media-body text-right">
                                        <h3>{{$news_count}}</h3>
                                        <span>News</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection

