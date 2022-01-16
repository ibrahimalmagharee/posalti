@extends('layouts.admin')

@section('content')
    <div class="content-wrapper" id="customer_datatable">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"></h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Students
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
                                        <a href="{{route('client.create')}}" class="btn btn-primary btn-sm " id="add-client"><i class="ft-plus white"></i>Add Student</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-content collapse show" id="viewCourse">
                                <div class="card-body card-dashboard table-responsive">
                                    <table class="table client-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Created by</th>
                                                <th>Value of last paid</th>
                                                <th>Status</th>
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
                        <h5>Are you sure to delete this customer !!</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel">Cancel</button>
                        <button type="submit" class="btn btn-danger" id="delete">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="amount-customer-modal" tabindex="-1" role="dialog" aria-labelledby="amountCustomerModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="amountCustomerModalLabel">Add amount to be paid to this student</h4>
                </div>

                <form id="add_amount_customer_modal_form">
                    @csrf
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select class="form-control" name="title_id" id="title_id">
                                            @foreach ($titles as $title)
                                                <option value="{{$title->id}}">{{ $title->title_en }} ({{$title->value}})</option>
                                            @endforeach
                                        </select>

                                        {{-- <label>Value</label>
                                        <input type="number" class="form-control" placeholder="Add amount to be paid" name="value" id="valueAmountToBePaidClient"> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel_amount_modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="addAmountToBePaidClient" data-action="addAmountToBePaidClient">Add</button>
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
        var  clientTable = $('.client-table').DataTable({
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
            ajax: "{{route("client.index")}}",
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
                    data: 'name',
                    name: 'name',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'email',
                    name: 'email',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'user_id',
                    name: 'user_id',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'last_financial_value',
                    name: 'last_financial_value'
                },
                {
                    data: 'last_financial_status',
                    name: 'last_financial_status'
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

        $('body').on('click', '.deleteClient', function(ee) {
            ee.preventDefault();
            var id = $(this).data('id');
            $('#delete-modal').modal('show');
            $('#delete').click(function(e) {
                e.preventDefault();
                $.ajax({

                    url: '/en/admin/client/' + id+'/delete',
                    type: 'delete',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    },
                    success: function(data) {
                        if (data.status === true) {
                            $('#delete-modal').modal('hide');
                            toastr.warning(data.msg);
                            clientTable.draw();
                        }
                    }
                });
            });

            $('#cancel').click(function() {
                $('#delete-modal').modal('hide');
            });
        });

        $('#customer_datatable').on('click', '.addAmountToBePaidClient', function(ee) {
            ee.preventDefault();

            var id = $(this).data('id');
            $('#amount-customer-modal').modal('show');

            $('#amount-customer-modal').off('click').on('click', '[data-action="addAmountToBePaidClient"]', function(e) {

                var button = $("#addAmountToBePaidClient");
                $(button).attr('disabled', true);
                $(button).html('Loading...');

                e.preventDefault();
                $.ajax({
                    url: '/en/admin/financial/store/' + id,
                    type: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id,
                        "user_id": id,
                        "title_id": $('#title_id option:checked').val()
                    },
                    success: function(data) {
                        toastr.success(data);
                        clientTable.draw();
                    }
                }).fail(function (jqXHR, textStatus, error) {
                    toastr.warning(jqXHR.responseText);
                })
                .always(function() {
                    $('#title_id').val('');
                    $('#amount-customer-modal').modal('hide');
                    $(button).attr('disabled', false);
                    $(button).html('Add');
                });
            });

            $('#cancel_amount_modal').click(function() {
                $('#amount-customer-modal').modal('hide');
            });
        });
    });
</script>
@endsection
