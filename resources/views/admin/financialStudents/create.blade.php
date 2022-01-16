@extends('layouts.admin')

@section('css')
    <style>
        .tr-not-paid{
            background-color: #cedee7;
        }
    </style>
@endsection

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title"></h3>
            <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('financial_titles.index')}}">Receipts</a></li>
                    <li class="breadcrumb-item active">{{ $title->title_en }}</li>
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

            <div class="card-body" id="add_student_to_financial_title">
                <p class="text-danger text-center">
                    You cannot add a student who has not paid their last payment in this ({{ $title->title_en }})
                    <br>
                    So we only show students who are not registered to pay at this title
                </p>
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table" id="table_students_financial_title">
                                <thead>
                                    <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Value of last paid</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($students as $student)
                                    <tr class="student @if($student->last_financial() && !$student->last_financial()->status)tr-not-paid @endif" data-student-id="{{ $student->id }}">
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" @if(!$student->last_financial() || $student->last_financial()->status) checked @else disabled @endif>
                                            </div>
                                        </td>
                                        <td>{{ $student->id }}</td>
                                        <td>{{ $student->name }}</td>
                                        @if (count($student->financials))

                                            <td>{{ $student->last_financial()->value }}</td>
                                            <td>{{ $student->last_financial()->title->title_en }}</td>
                                            <td>
                                                @if ($student->last_financial()->status)
                                                    Paid
                                                    @else
                                                    Not Paid
                                                @endif
                                            </td>

                                            @else
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button class="btn btn-primary" data-action="add-students">Add</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>

        $(function(){

            var students_checked = [];

            updateStudents();

            $('#table_students_financial_title').on('click', '.form-check-input', function(){
                updateStudents();
            });

            $('#add_student_to_financial_title').on('click', '[data-action="add-students"]', function(){
                var button = $("#add_student_to_financial_title button[data-action='add-students']");
                $(button).attr('disabled', true);
                $(button).html('Loading...');

                var posted_data = {
                    _token: $("meta[name='csrf-token']").attr("content"),
                    student_ids_checked: JSON.stringify(students_checked)
                };

                $.post($("meta[name='BASE_URL']").attr("content") + '/en/admin/financial/titles/' + {{$title->id}} + "/students", posted_data, function (response) {
                    toastr.success(response.message);
                    window.location.reload();
                })
                .fail(function (response) {
                    toastr.error(response.responseJSON.message);
                })
                .always(function() {
                    $(button).attr('disabled', false);
                    $(button).html('Add');
                });
            });

            function updateStudents(){
                students_checked = [];

                $('#table_students_financial_title tbody tr').each(function(){
                    var $this = $(this);

                    if($this.find('.form-check-input').is(":checked")){
                        students_checked.push(Number($this.attr('data-student-id')));
                    }
                });
            }
        });
    </script>

@endsection
