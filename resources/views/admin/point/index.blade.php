@extends('admin.layouts.dashboard')

@section('content')
    <div class="col-md-3">
    </div>
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border margin-bottom-10">
                <h3 class="box-title">Danh sách điểm dừng</h3>
                <button class="btn btn-primary" type="button" onclick="showViewCreatePoint()">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>Thêm mới
                </button>
            </div>
            <div class="table-responsive">

                <table class="table table-bordered " id="point_table">

                </table>

            </div>
        </div>
    </div>
    <div class="modal fade" id="createPointModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="box-title">Tạo mới điểm dừng</h3>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script type="text/javascript">
        var pointTable;
        $(function() {
            pointTable = $('#point_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": '{!! route('point.datatable') !!}'
                },
                columns: [
                    { data: 'busId', name: 'busId', title: 'Tên xe', orderable : false },
                    { data: 'boardingPoint', name: 'boardingPoint', title: 'Điểm lên xe'},
                    { data: 'dropPoint', name: 'dropPoint', title: 'Điểm xuống xe'},
                    { data: 'startTime', name: 'startTime', title: 'Thời gian chạy'},
                    { data: 'landmark', name: 'landmark', title: 'Dấu đất'},
                    { data: 'address', name: 'address', title: 'Địa chỉ'},
                    { data: 'id', name: 'id', title: 'Action', searchable: false,className: 'text-center', "orderable": false,
                        render: function(data, type, row, meta){
                            var pointId = "'" + data + "'";
                            var actionLink = '<a href="javascript:;" data-toggle="tooltip" title="Xoá '+ row['boardingPoint'] +'!" onclick="deletePointById('+ pointId +')"><i class=" fa-2x fa fa-trash" aria-hidden="true"></i></a>';
                            actionLink += '&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="showViewEditPoint('+ pointId +')" data-toggle="tooltip" title="Sửa '+ row['boardingPoint'] +'!" ><i class="fa fa-2x fa-pencil-square-o" aria-hidden="true"></i></a>';
                            actionLink += '&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="showBusDetailPoint('+ pointId +')" class="show-detail" data-toggle="tooltip" title="View detail" ><i class="fa fa-2x fa-sign-in" aria-hidden="true"></i></a>';
                            return actionLink;
                        }
                    }
                ]
            });
        });
        // DELETE point
        function deletePointById(id) {
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
                        url: '{!! route('points.index') !!}' + '/' + id,
                        method: 'DELETE'
                    }).success(function(data){
                        if(data.code == 200)
                        {
                            swal(
                                'Đã Xoá!',
                                'Bạn đã xoá thành công người dùng!',
                                'success'
                            ).then(function(){
                                pointTable.ajax.reload();
                            })
                        }
                        else {
                            swal(
                                'Thất bại',
                                'Thao tác thất bại',
                                'error'
                            ).then(function(){
                                pointTable.ajax.reload();
                            })
                        }
                    }).error(function(data){
                        swal(
                            'Thất bại',
                            'Thao tác thất bại',
                            'error'
                        ).then(function(){
                            pointTable.ajax.reload();
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
        // SHOW create point
        function showViewCreatePoint() {
            $.ajax({
                url: '{!! route('points.create') !!}',
                method: 'GET'
            }).success(function(data){
                $('#createPointModal .modal-body').html(data).promise().done(function(){
                    $('.select2').select2({
                        placeholder: "Chọn Bus Type",
                    });
                    $('.select2-container--default').css({width: '100%'});
                    $(".datetimepicker").datetimepicker({
                        format: 'LT'
                    });

                    //$('#amenities').tagsinput();

                    $('#frmCreateNewPoint').bootstrapValidator({});
                });
            }).error(function(data){

            });
            $("#createPointModal").modal();
        }
    </script>
@stop
