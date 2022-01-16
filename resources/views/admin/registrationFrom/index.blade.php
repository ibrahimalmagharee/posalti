@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"></h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Registrations form Students
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
        <div class="content-body">
            <section id="dom">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-head">
                                <div class="card-header">
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                                    <div class="heading-elements">
                                    </div>
                                </div>
                            </div>
                            <div class="card-content collapse show" id="viewCourse">
                                <div class="card-body card-dashboard table-responsive">
                                    <table class="table registration-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>User</th>
                                                <th>First Name</th>
                                                <th>Second Name</th>
                                                <th>Last Name</th>
                                                <th>Birth date</th>
                                                <th>School Name</th>
                                                <th>Educational Level</th>
                                                <th>Mobile Number</th>
                                                <th>Parent Name</th>
                                                <th>Parent Mobile Number</th>
                                                <th>Parent Name 2</th>
                                                <th>Parent Mobile Number 2</th>
                                                <th>Created at</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                    <div class="justify-content-center d-flex"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('script')

<script type="text/javascript">
    CKEDITOR.config.language = 'en';
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //Show Table
        var  registrationTable = $('.registration-table').DataTable({
            "language": {
                "url": "{{asset('/public/datatables-en.json')}}"
            },
            'pagingType': 'full_numbers',
            'lengthMenu': [
                [6, 10, 20, 30, 40, -1],
                [6, 10, 20, 30, 40, 'All']
            ],
            processing: true,
            serverSide: true,
            ajax: "{{route("registraions.index")}}",
            dom: "Blfrtip",
            buttons: [
                {
                    text: 'Download Excel',
                    extend: 'excelHtml5',
                },
            ],

            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'user_id',
                    name: 'user_id',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'first_name',
                    name: 'first_name',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'second_name',
                    name: 'second_name',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'last_name',
                    name: 'last_name',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'birth_date',
                    name: 'birth_date',
                },
                {
                    data: 'school_name',
                    name: 'school_name',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'educational_level',
                    name: 'educational_level',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'mobile_number',
                    name: 'mobile_number',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'father_name',
                    name: 'father_name',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'father_mobile_number',
                    name: 'father_mobile_number',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'father_name1',
                    name: 'father_name1',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'father_mobile_number1',
                    name: 'father_mobile_number1',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                },
            ]
        });
    });
</script>
@endsection
