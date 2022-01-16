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
                <li class="breadcrumb-item"><a href="{{route('financial_titles.index')}}">Receipts</a>
                </li>
                <li class="breadcrumb-item active">{{isset($title)?'Update':'Add'}}
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
                <form class="form" action="{{isset($title)?route('financial_titles.update',$title->id):route('financial_titles.store')}}" method="post">
                    @csrf

                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Title En</label>
                                    <input type="text" class="form-control" placeholder="Title En" name="title_en" value="{{isset($title)?$title->title_en:old('title_en')}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Title Ar</label>
                                    <input type="text" class="form-control" placeholder="Title Ar" name="title_ar" value="{{isset($title)?$title->title_ar:old('title_ar')}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Value</label>
                                    <input type="number" class="form-control" placeholder="Value" name="value" value="{{isset($title)?$title->value:old('value')}}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button class="btn btn-primary" type="submit"><i class="la la-save"></i> {{isset($title)?'Update':'Save'}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 @endsection
