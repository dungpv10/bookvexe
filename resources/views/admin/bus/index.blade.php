@extends('admin.layouts.dashboard')

@section('content')

    <div class="col-md-12">

        <div class="table-responsive">

            <table class="table table-bordered " id="bus_table">

            </table>

        </div>

    </div>
@stop
@section('js')
    <script type="text/javascript">
        var busTable;
        $(function() {

            busTable = $('#bus_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": '{!! route('bus.datatable') !!}'
                },
                columns: [
                    { data: 'bus_name', name: 'bus_name', title: 'Tên xe buýt' },
                    { data: 'bus_reg_number', name: 'bus_reg_number', title: 'Biển đăng ký buýt' },
                    { data: 'busType', name: 'busType.bus_type_name', title: 'Kiểu xe buýt', orderable : false },
                    { data: 'number_seats', name: 'number_seats', title: 'Chỗ ngồi' },
                    { data: 'start_point', name: 'start_point', title: 'Điểm bắt đầu' },
                    { data: 'start_time', name: 'start_time', title: 'Thời gian bắt đầu'},
                    { data: 'end_point', name: 'end_point', title: 'Điểm kết thúc'},
                    { data: 'end_time', name: 'end_time', title: 'Thời gian kết thúc'},
                    { data: 'id', name: 'id', title: 'Action', searchable: false,className: 'text-center', "orderable": false,
                        render: function(data, type, row, meta){
                            var busId = "'" + data + "'";
                            var urlEdit = '{!! route('bus.index') !!}' + '/' + data + '/edit';
                            var actionLink = '<a href="javascript:;" data-toggle="tooltip" title="Xoá '+ row['bus_name'] +'!" onclick="deleteBusById('+ busId +')"><i class=" fa-2x fa fa-trash" aria-hidden="true"></i></a>';
                            actionLink += '&nbsp;&nbsp;&nbsp;<a href="' + urlEdit + '" data-toggle="tooltip" title="Sửa '+ row['bus_name'] +'!" ><i class="fa fa-2x fa-pencil-square-o" aria-hidden="true"></i></a>';
                            return actionLink;
                        }
                    }
                ]
            });

        });
        function deleteBusById(id) {
            swal({
                title: "Bạn có muốn xóa bus này?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: 'Bỏ qua',
                confirmButtonText: "Đồng ý",
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '{!! route('bus.index') !!}' + '/' + id,
                        method: 'DELETE'
                    }).success(function(data){
                        console.log(data);
                        if(data.code == 200)
                        {
                            swal(
                                'Đã Xoá!',
                                'Bạn đã xoá thành công người dùng!',
                                'success'
                            ).then(function(){
                                busTable.ajax.reload();
                            })
                        }
                        else {
                            swal(
                                'Thất bại',
                                'Thao tác thất bại',
                                'error'
                            ).then(function(){
                                busTable.ajax.reload();
                            })
                        }
                    }).error(function(data){
                        swal(
                            'Thất bại',
                            'Thao tác thất bại',
                            'error'
                        ).then(function(){
                            busTable.ajax.reload();
                        })
                    });
                    // result.dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
                } else if (result.dismiss === 'cancel') {
                    swal(
                        'Bỏ Qua',
                        'Bạn đã không xoá bus nữa',
                        'error'
                    )
                }
            });
        }
    </script>
@stop
