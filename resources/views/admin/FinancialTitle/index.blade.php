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
                            <li class="breadcrumb-item active">Receipts
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
                                        <a href="{{route('financial_titles.create')}}" class="btn btn-primary btn-sm"><i class="ft-plus white"></i>Add Title</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-content collapse show" id="viewCourse">
                                <div class="card-body card-dashboard table-responsive">
                                    <table class="table financialTitle-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title En</th>
                                                <th>Title Ar</th>
                                                <th>Value</th>
                                                <th>Settings</th>
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
        var  financialTitleTable = $('.financialTitle-table').DataTable({
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
            ajax: "{{route("financial_titles.index")}}",
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
                    data: 'title_en',
                    name: 'title_en',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'title_ar',
                    name: 'title_ar',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'value',
                    name: 'value',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    });
</script>
@endsection
