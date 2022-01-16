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
                    <li class="breadcrumb-item active">News
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
                                    <a href="{{route('news.create')}}" class="btn btn-primary btn-sm"><i class="ft-plus white"></i>Add New</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-content collapse show" id="viewNews">
                            <div class="card-body card-dashboard table-responsive">
                                <table class="table news-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Title in English</th>
                                            <th>Title in Arabic</th>
                                            <th>Created by</th>
                                            <th>Created at</th>
                                            <th>Image</th>
                                            <th>Details</th>
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

    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Confirm Delete</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="delete_modal_form">
                    @csrf
                    {{method_field('delete')}}

                    <div class="modal-body">
                        <input type="hidden" id="delete_language">
                        <h5>Are you sure to delete this new !!</h5>
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
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //Show Table
            var newsTable = $('.news-table').DataTable({

                "language": {
                    "url": "{{asset('/public/datatables-en.json')}}"
                },
                'pagingType':'full_numbers',
                'lengthMenu':[[6,10,20,30,40,-1],[6,10,20,30,40,'All']],

                processing: true,
                serverSide: true,
                ajax: "{{route("news.index")}}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'category_id', name_en: 'category_id',orderable: false, searchable: false},
                    {data: 'title_en', name: 'title_en'},
                    {data: 'title_ar', name: 'title_ar'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'image', name: 'image'},
                    {data: 'show', name: 'show'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false},
                ]
            });

            //Delete
            $('body').on('click', '.deleteNew', function (event) {
                event.preventDefault();

                var id = $(this).data('id');
                $('#delete-modal').modal('show');

                $('#delete').click(function (e) {
                    e.preventDefault();
                    $.ajax({
                        url: '/en/admin/ournews/delete/' +id,
                        type: 'post',
                        data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                        },

                        success: function (data) {
                            console.log('success:', data);
                            if (data.status === true) {
                                $('#delete-modal').modal('hide');
                                toastr.warning(data.msg);
                                newsTable.draw();
                            }
                        }
                    });
                });

                $('#cancel').click(function () {
                    $('#delete-modal').modal('hide');
                });
            });
        });
    </script>
@endsection
