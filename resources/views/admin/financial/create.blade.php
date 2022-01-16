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
                <li class="breadcrumb-item"><a href="{{route('financial.index')}}">Participant</a>
                </li>
                <li class="breadcrumb-item active">{{isset($financial)?'Update':'Add'}}
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
                <form class="form" action="{{isset($financial)?route('financial.update',$financial->id):route('financial.store')}}" method="post" id="newsForm" enctype="multipart/form-data">
                    @csrf

                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>User</label>
                                    <input type="text" class="form-control" placeholder="Value" name="user_id" value="{{$financial->user->name}}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Title</label>
                                    <select class="form-control" name="title_id">
                                        @foreach ($titles as $title)
                                            <option value="{{$title->id}}" {{isset($financial)?$financial->title_id == $title->id ?'selected':'':''}}>{{ $title->title_en }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <input type="number" class="form-control" placeholder="Value" name="value" value="{{isset($financial)?$financial->value:old('value')}}"> --}}
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        <option value="0" {{isset($financial)?$financial->status == 0?'selected':'':''}}>Not paid</option>
                                        <option value="1" {{isset($financial)?$financial->status == 1?'selected':'':''}}>Paid</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button class="btn btn-primary" type="submit"><i class="la la-save"></i> {{isset($financial)?'Update':'Save'}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 @endsection
