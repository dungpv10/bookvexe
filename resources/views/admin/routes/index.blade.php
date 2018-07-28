@extends('admin.layouts.dashboard')

@section('content')

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <select class="form-control" id="bus_id">
                    <option value="">Chọn xe</option>
                    @foreach($buses as $bus)
                        <option value="{{ $bus->id }}">{{ $bus->bus_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border margin-bottom-10">
                    <h3 class="box-title">Danh sách Tuyến</h3>
                    <button type="button" class="btn btn-primary" id="createRouteBtn">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>Thêm mới
                    </button>
                </div>


                <div class="table-responsive">

                    <table class="table table-bordered " id="route_table">

                    </table>

                </div>

            </div>
        </div>
    </div>


    <div class="modal fade bd-example-modal-lg" id="registerRouteModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="box-title">Tạo mới tuyến</h3>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade bd-example-modal-lg" id="editRouteModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="box-title">Sửa thông tin tuyến </h3>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>

@stop
@section('js')
	<script type="text/javascript">
    var routeTable;
    $(function() {
        $('#bus_id').select2({
            theme: 'bootstrap',
            with: '100%'
        });

        $('#bus_id').on('change', function(){
            routeTable.ajax.reload();
        });

        routeTable = $('#route_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                "url": '{!! route('routes.datatable') !!}',
                "method": "POST",
                "data": function ( d ) {
                    d.bus_id = $('#bus_id').val();
                }
            },
            columns: [
                { data: 'id', name: 'id', searchable: false, title: 'ID' },
                { data: 'route_name', name: 'route_name', title: 'Tên' },
                { data: 'price', name: 'price', title: 'Giá' },
                { data: 'from_place', name: 'from_place', title: 'Bắt đầu' },
                { data: 'arrived_place', name: 'arrived_place', title: 'Kết thúc'},
                { data: 'start_time', name: 'start_time', title: 'Giờ đi'},
                { data: 'arrived_time', name: 'arrived_time', title: 'Giờ đến'},
                { data: 'busName', name: 'buses.bus_name', title: 'Bus'},
                { data: 'created_at', name: 'created_at', title: 'Ngày tạo'},
                { data: 'updated_at', name: 'updated_at', title: 'Ngày cập nhật'},
                { data: 'id', name: 'id', title: 'Thao Tác', searchable: false,className: 'text-center', "orderable": false,
                    render: function(data, type, row, meta){
                        var routeId = "'" + row['id'] + "'";
                        let urlEdit = window.location.origin + '/admin/routes/' + data + '/edit';
                        let actionLink = '<a href="javascript:;" data-toggle="tooltip" title="Xoá '+ row['route_name'] +'!" onclick="deleteRouteById('+ routeId +')"><i class=" fa-2x fa fa-trash" aria-hidden="true"></i></a>';
                        actionLink += '&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="editRoute('+ routeId +')" data-toggle="tooltip" title="Sửa '+ row['route_name'] +'!" ><i class="fa fa-2x fa-pencil-square-o" aria-hidden="true"></i></a>';
                        return actionLink;
                    }
                }
            ]
        });

    });
    function deleteRouteById(id) {
        swal({
            title: "Bạn có muốn xóa tuyến  này?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: 'Bỏ qua',
            confirmButtonText: "Đồng ý",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: window.location.origin + '/admin/routes/' + id,
                    method: 'DELETE'
                }).success(function(data){
                    console.log(data);
                    if(data.code == 200)
                    {
                        swal(
                          'Đã Xoá!',
                          'Bạn đã xoá thành công tuyến !',
                          'success'
                        ).then(function(){
                            routeTable.ajax.reload();
                        })
                    }
                    else {
                        swal(
                            'Thất bại',
                            'Thao tác thất bại',
                            'error'
                        ).then(function(){
                            routeTable.ajax.reload();
                        })
                    }
                }).error(function(data){
                    swal(
                        'Thất bại',
                        'Thao tác thất bại',
                        'error'
                    ).then(function(){
                        routeTable.ajax.reload();
                    })
                });
            // result.dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
            } else if (result.dismiss === 'cancel') {
              swal(
                'Bỏ Qua',
                'Bạn đã không xoá tuyến  nữa',
                'error'
              )
            }
          });
    }


    var createRouter = "{{ route('routes.create') }}";

    $('#createRouteBtn').on('click', function () {
        $.get(createRouter).done(function(view){
            $('#registerRouteModal').find('.modal-body').html(view).promise().done(function(){
                $('#registerRouteModal').modal('show');
                $('#roles').select2({
                    placeholder: "Chọn quyền thành viên",
                });
                $('.select2-container--default').css({width: '100%'});
            });
            validateSetup('frmCreateRoute');

        }).fail(function(error){
            console.log(error);
        });

    });

    function validateSetup(formId) {
        $('#' + formId).bootstrapValidator({
            message: 'Dữ liệu nhập không đúng',
            fields: {
                name: {
                    message: 'Tên không đúng định dạng',
                    validators: {
                        notEmpty: {
                            message: 'Tên không được trống'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'Tên dài từ 6 tớ 30 ký tự'
                        }
                    }
                },
                username: {
                    message: 'Tên không đúng định dạng',
                    validators: {
                        notEmpty: {
                            message: 'Tên không được trống'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'Tên dài từ 6 tớ 30 ký tự'
                        }
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_]+$/,
                        message: 'Tên chỉ chữa chữ, số và dấu gạch dưới'
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'Email không được rỗng'
                        },
                        emailAddress: {
                            message: 'Không phải địa chỉ email'
                        }
                    }
                },
                dob: {
                    validators: {
                        date: {
                            format: 'YYYY-MM-DD',
                            message: 'Sai định dạng'
                        }
                    }
                }
            }
        });
    }

    function editRoute(uId) {
        $.ajax({
                url: '{!! route("users.index") !!}' +'/'+ uId + '/edit',
                method: 'GET'
            }).success(function(data){
                $('#editRouteModal .modal-body').html(data).promise().done(function(){

                    validateSetup('frmEditRoute');

                    $('#roles').select2({
                        placeholder: "Chọn quyền",
                    });
                    $('.select2-container--default').css({width: '100%'});
                    $('.datetimepicker').datetimepicker({
                        format: 'YYYY-MM-DD'
                    });
                });
            }).error(function(data){

            });
            $("#editRouteModal").modal();
    }

	</script>
@stop
