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
                <li class="breadcrumb-item"><a href="{{route('news.index')}}">News</a>
                </li>
                <li class="breadcrumb-item active">{{isset($new)?'Update':'Add'}}
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
                <form class="form" action="{{isset($new)?route('news.update',$new->slug_en):route('news.store')}}" method="post" id="newsForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <label for="projectinput1">Category</label>
                                <select class="select2-language form-control select-custom" name="category_id" id="select2-language">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{isset($activity)?$activity->category_id == $category->id?'selected':'':''}} >{{$category->name_en}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1">Title in English</label>
                                    <input type="text" id="name" class="form-control" placeholder="Title in English" name="title_en" value="{{isset($new)?$new->title_en:old('title_en')}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1">Title in Arabic</label>
                                    <input type="text" id="name" class="form-control" placeholder="Title in Arabic" name="title_ar" value="{{isset($new)?$new->title_ar:old('title_ar')}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            <label for="projectinput1">Content in English</label>
                                <div class="form-group">
                                    <textarea type="text" class="form-control ckeditor"  name="content_en" id="content" required  placeholder="Content in English">{{isset($new)?$new->content_en:old('content_en')}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            <label for="projectinput1">Content in Arabic</label>
                                <div class="form-group">
                                    <textarea type="text" class="form-control ckeditor"  name="content_ar" id="content" required  placeholder="Content in Arabic">{{isset($new)?$new->content_ar:old('content_ar')}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <img src="https://cdn.shopify.com/app-store/listing_images/bd8e69a3e7e7f8a886a62cffb893d8d2/icon/CNjlo7P0lu8CEAE=.jpg" width="50%"  height="50%" id="preview" class="img-thumbnail">
                            </div>
                            <div class="ml-2 mt-1 col-sm-6">
                                <div id="msg"></div>
                                <input type="file" name="image" class="file" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="hidden" name="slug_en" id="action" value="slug_en">
                        <input type="hidden" name="slug_ar" id="action" value="slug_ar">
                        <button class="btn btn-primary" type="submit"><i class="la la-save"></i> {{isset($new)?'Update':'Save'}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 @endsection
 @section('script')
 <script>
     $(document).on("click", ".browse", function() {
        var file = $(this).parents().find(".file");
        file.trigger("click");
        });
        $('input[type="file"]').change(function(e) {
        var fileName = e.target.files[0].name;
        $("#file").val(fileName);

        var reader = new FileReader();
        reader.onload = function(e) {
            // get loaded data and render thumbnail.
            document.getElementById("preview").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
        });
 </script>
 @endsection
