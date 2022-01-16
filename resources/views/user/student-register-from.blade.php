
@extends('app')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
    <style>
        .datepicker .table-condensed{
            border-collapse: collapse;
	        border-spacing: 0;
        }

        .datepicker .table-condensed thead th{
            padding: 0.25rem 0;
            text-align: center;
            font-size: 0.75rem;
            font-weight: 400;
            color: #78909C;
        }

        .datepicker .table-condensed tbody td{
            width: 2.5rem;
            text-align: center;
            padding: 0;
            border-radius: 0.25rem;
            line-height: 2rem;
            transition: 0.3s all;
            color: #546E7A;
            font-size: 0.875rem;
            text-decoration: none;
        }
        .datepicker .table-condensed tbody td:hover{
            background-color: #E0F2F1;
        }

    </style>
@endsection
@section('content')
    @include('landing.header')
    <div class="authentication-section pt-150 pb-70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-12 pb-30">
                    <div class="authentication-item">
                        <h3>{{__('content.Student registration form')}}</h3>
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
                            <form method="POST" action="{{ route('user.store.studentRegisterForm') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-20">
                                            <label for="">{{__('content.first_name')}}</label>
                                            <div class="input-group">
                                                <input type="text" name="first_name" class="form-control" required value="{{ old('first_name') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-20">
                                            <label for="">{{__('content.second_name')}}</label>
                                            <div class="input-group">
                                                <input type="text" name="second_name" class="form-control" required value="{{ old('second_name') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-20">
                                            <label for="">{{__('content.last_name')}}</label>
                                            <div class="input-group">
                                                <input type="text" name="last_name" class="form-control" required value="{{ old('last_name') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-20">
                                            <label for="">{{__('content.mobilenumberstudent')}}</label>
                                            <div class="input-group">
                                                <input type="number" name="mobile_number" class="form-control" required value="{{ old('mobile_number') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-20">
                                            <label for="birth_date">{{__('content.birth_date')}}</label>
                                            <div class="input-group">
                                                <input type="date" id="birth_date" name="birth_date" class="form-control" required value="{{ old('birth_date') }}" value="0000-00-00">
                                            </div>
                                            {{-- <div class="input-group date">
                                                <input name="birth_date" type="text" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                            </div> --}}
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-20">
                                            <label for="">{{__('content.school_name')}}</label>
                                            <div class="input-group">
                                                <input type="text" name="school_name" class="form-control" required value="{{ old('school_name') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">{{__('content.The current school stage')}}</label>
                                            <div class="input-group">
                                                <select class="form-control" name="educational_level" required>
                                                    <option value="G1" @if (old('educational_level') == "G1") {{'selected'}} @endif>G1</option>
                                                    <option value="G2" @if (old('educational_level') == "G2") {{'selected'}} @endif>G2</option>
                                                    <option value="G3" @if (old('educational_level') == "G3") {{'selected'}} @endif>G3</option>
                                                    <option value="G4" @if (old('educational_level') == "G4") {{'selected'}} @endif>G4</option>
                                                    <option value="G5" @if (old('educational_level') == "G5") {{'selected'}} @endif>G5</option>
                                                    <option value="G6" @if (old('educational_level') == "G6") {{'selected'}} @endif>G6</option>
                                                    <option value="G7" @if (old('educational_level') == "G7") {{'selected'}} @endif>G7</option>
                                                    <option value="G8" @if (old('educational_level') == "G8") {{'selected'}} @endif>G8</option>
                                                    <option value="G9" @if (old('educational_level') == "G9") {{'selected'}} @endif>G9</option>
                                                    <option value="G10" @if (old('educational_level') == "G10") {{'selected'}} @endif>G10</option>
                                                    <option value="G11" @if (old('educational_level') == "G11") {{'selected'}} @endif>G11</option>
                                                    <option value="G12" @if (old('educational_level') == "G12") {{'selected'}} @endif>G12</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-20">
                                            <label for="">{{__('content.father_name')}}</label>
                                            <div class="input-group">
                                                <input type="text" name="father_name1" class="form-control" value="{{ old('father_name1') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-20">
                                            <label for="">{{__('content.father_mobile_number')}}</label>
                                            <div class="input-group">
                                                <input type="text" name="father_mobile_number1" class="form-control" value="{{ old('father_mobile_number1') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-20">
                                            <label for="">{{__('content.father_name')}} ({{__('content.optional')}})</label>
                                            <div class="input-group">
                                                <input type="text" name="father_name" class="form-control" value="{{ old('father_name') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-20">
                                            <label for="">{{__('content.father_mobile_number')}} ({{__('content.optional')}})</label>
                                            <div class="input-group">
                                                <input type="text" name="father_mobile_number" class="form-control" value="{{ old('father_mobile_number') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-20">
                                            <label for="">{{__('content.A picture of the Qatari ID card')}}</label>
                                            <div class="input-group">
                                                <input type="file" name="personal_picture" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-20">
                                            <input type="checkbox" name="agree_to_terms" required @if ( old('agree_to_terms') == true) {{'checked'}}@endif>
                                            <label for="">{{__('content.Agree to the terms of registration')}}</label> <span><a href="{{route('user.termsofregistration')}}">({{__('content.Click here')}})</a></span>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn main-btn btn-secondcolor full-width">{{__('content.send')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('landing.footer')
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $('.input-group.date').datepicker({
            todayBtn: true
        });
    </script>
@endsection
