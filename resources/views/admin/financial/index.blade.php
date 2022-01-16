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
                            <li class="breadcrumb-item active">Participants
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
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
                                        {{-- <a href="{{route('financial.create')}}" class="btn btn-primary btn-sm " id="add-financial"><i class="ft-plus white"></i>Add Customer</a> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="card-content collapse show" id="viewCourse">
                                <div class="card-body card-dashboard table-responsive">
                                    <table class="table financial-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>User</th>
                                                <th>Title</th>
                                                <th>Value for title</th>
                                                <th>Payment value</th>
                                                <th>Status</th>
                                                <th>Type Payment</th>
                                                <th>Payment Created at</th>
                                                <th>Created by</th>
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
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Confirm delete</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="delete_modal_form">
                    @csrf
                    {{method_field('delete')}}

                    <div class="modal-body">
                        <input type="hidden" id="delete_language">
                        <h5>Are you sure to delete this financial !!</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel">Cancel</button>
                        <button type="submit" class="btn btn-danger" id="delete">Delete</button>
                    </div>
                </form>
            </div>
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
        var  financialTable = $('.financial-table').DataTable({
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
            ajax: "{{route("financial.index")}}",
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
                    data: 'title_id',
                    name: 'title_id',
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
                    data: 'payment_value',
                    name: 'payment_value',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'type_payment',
                    name: 'type_payment',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'payment_created_at',
                    name: 'payment_created_at'
                },
                {
                    data: 'created_by',
                    name: 'created_by'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        //Delete

        $('body').on('click', '.deleteFinancial', function(ee) {
            ee.preventDefault();
            var id = $(this).data('id');
            $('#delete-modal').modal('show');
            $('#delete').click(function(e) {
                e.preventDefault();
                $.ajax({

                    url: '/en/admin/financial/' + id+'/delete',
                    type: 'delete',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    },
                    success: function(data) {
                        if (data.status === true) {
                            $('#delete-modal').modal('hide');
                            toastr.warning(data.msg);
                            financialTable.draw();
                        }
                    }
                });
            });

            $('#cancel').click(function() {
                $('#delete-modal').modal('hide');
            });
        });
    });
</script>
@endsection
