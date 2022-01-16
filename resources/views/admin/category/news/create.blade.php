@extends('layouts.admin')

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title"></h3>
            <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('category.news.index')}}">Categories</a>
                </li>
                <li class="breadcrumb-item active">{{isset($category)?'Update':'Add'}}
                </li>
                </ol>
            </div>
            </div>
        </div>
        <div class="content-header-right col-md-6 col-12">
            <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
            </div>
        </div>
    </div>

    <div class="card-content collapse show">
        <div class="card">
            @if ($errors->any())
                <div class="alert alert-danger" id="Error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card-body">
                <form class="form" action="{{isset($category)?route('category.news.update',$category->id):route('category.news.store')}}" method="post" id="newsForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name_en"> Name in English</label>
                                    <input type="text" id="name_en" class="form-control" placeholder="Name in English" name="name_en" value="{{isset($category)?$category->name_en:old('name_en')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name_ar"> Name in Arabic</label>
                                    <input type="text" id="name_ar" class="form-control" placeholder="Name in Arabic" name="name_ar" value="{{isset($category)?$category->name_ar:old('name_ar')}}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="hidden" name="type" id="action" value="news">
                        <button class="btn btn-primary" type="submit"><i class="la la-save"></i> {{isset($category)?'Upadte':'Save'}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 @endsection
