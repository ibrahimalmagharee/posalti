@extends('layouts.admin')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title"></h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('news.index')}}">News</a></li>
                        <li class="breadcrumb-item active"> Show new for - {{$new->title_en}}</li>
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
                            <h4 class="card-title text-center"><strong> Show new for
                                    - {{$new->title_en}} </strong></h4>
                            <a class="heading-elements-toggle"><i
                                    class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="category">Category</label>
                                                <input type="text" id="category" class="form-control" value="{{$new->category->name_en}}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title_en">Title in English</label>
                                                <input type="text" id="title_en" class="form-control" value="{{$new->title_en}}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title_ar">Title in Arabic</label>
                                                <input type="text" id="title_ar" class="form-control" value="{{$new->title_ar}}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="content_en">Content in English</label>
                                                <p>{!! $new->content_en !!}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="content_ar">Content in Arabic</label>
                                                <p>{!! $new->content_ar !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="created_by">Created by</label>
                                                <input type="text" id="created_by" class="form-control" value="{{$new->user->name}}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="created_at">Created at</label>
                                                <input type="text" id="created_at" class="form-control" value="{{$new->created_at}}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <img src="{{$new->image_path}}" alt="" width="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
