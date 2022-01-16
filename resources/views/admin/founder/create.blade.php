@extends('layouts.admin')

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title"></h3>
            <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">الرئيسية</a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('founder.index')}}">مسؤولون الشركة</a>
                </li>
                <li class="breadcrumb-item active">{{isset($founder)?'تعديل':'اضافة'}}
                </li>
                </ol>
            </div>
            </div>
        </div>
        <div class="content-header-right col-md-6 col-12">
            <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown"></div>
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
                <form class="form" action="{{isset($founder)?route('founder.update',$founder->id):route('founder.store')}}" method="post" id="founderForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label>صورة المسؤول</label>
                                <label id="projectinput7" class="file center-block">
                                    <input type="file" id="image" name="image">
                                    <span class="file-custom"></span>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="name">اسم المسؤول</label>
                                <div class="form-group">
                                    <input type="text" name="name" id="name">
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="content">كلمة المسؤول</label>
                                <div class="form-group">
                                        <textarea type="text" class="form-control ckeditor"   name="content" id="content" required  placeholder="كلمة المسؤول">{{isset($founder)?$founder->content:old('founder')}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button class="btn btn-primary" type="submit"><i class="la la-save"></i> {{isset($founder)?'تعديل':'حفظ'}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 @endsection
