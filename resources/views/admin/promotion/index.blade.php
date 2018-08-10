@extends('admin.layouts.dashboard')
@section('content')
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border margin-bottom-10">
                <h3 class="box-title">Danh sách mã giảm giá</h3>
                <button class="btn btn-primary" type="button" onclick="showViewCreateBusType()">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm mới
                </button>
            </div>
            <div class="table-responsive">

                <table class="table table-bordered " id="bus_type_table">

                </table>

            </div>
        </div>
    </div>
    <div class="modal fade" id="editBusTypeModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="box-title">Sửa kiểu xe</h3>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="createPromotionModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="box-title">Thêm mã giảm giá</h3>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'promotions.store', 'method' => 'post']) !!}
                        <div class="form-group">
                            <label>Mã giảm giá</label>
                            <input type="text" class="form-control" name="code"/>
                        </div>

                        <div class="form-group">
                            <label>Số lượng </label>
                            <input type="text" class="form-control" name="amount"/>
                        </div>

                        <div class="form-group">
                            <label>Trạng thái </label>
                            {!! Form::select('status', $statuses, '', ['class' => 'form-control select2']) !!}
                        </div>

                        <div class="form-group">
                            <label>Nhà xe </label>
                            {!! Form::select('agent_id', $agents, '', ['class' => 'form-control select2']) !!}
                        </div>

                        <div class="form-group">
                            <label>Loại mã </label>
                            {!! Form::select('promotion_type', $promotionTypes, '', ['class' => 'form-control select2']) !!}
                        </div>

                        <div class="form-group">
                            <label>Ngày hết hạn </label>
                            <input type="text" class="form-control datepicker" name="expiry_date"/>
                        </div>

                        <div class="form-group text-right">
                            <button class="btn btn-primary">Tạo mới</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script type="text/javascript">

        $('.select2').css({width: '100%'}).select2();
        var promotionTable;
        $(document).ready(function() {
            $(window).keydown(function(event){
                if( (event.keyCode == 13) ) {
                    event.preventDefault();
                    return false;
                }
            });
        });
        $(function() {

            promotionTable = $('#bus_type_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": '{!! route('promotions.json_data') !!}'
                },
                order: [1, 'asc'],
                columns: [
                    {data: 'code', name: 'code', title: 'Mã giảm giá'},
                    {data: 'amount', name: 'amount', title: 'Số lượng'},
                    {data: 'agent.agent_name', name: 'amount', title: 'Thuộc nhà xe'},
                    {data: 'expiry_date', name: 'expiry_date', title: 'Ngày hết hạn'},
                    {data: 'promotion_type_name', name: 'promotion_type_name', title: 'Loại giảm giá', orderable: false},
                    {data: 'status_name', name: 'status_name', title: 'Trạng thái', orderable: false,
                        render: function(data, type, row, meta){
                            $active = '';
                            if (row['status'] == "1") {
                                $active = 'active';
                            }
                            return '<button onclick="activeUser('+ row['id'] +')" type="button" class="btn btn-lg btn-toggle ' + $active + '" data-toggle="button" aria-pressed="true" autocomplete="off"><div class="handle"></div></button>';
                        }
                    },
                    {data: 'id', name: 'id', 'title' : '', visible: false},
                    {data: 'status', name: 'status', 'title' : '', visible: false},
                    {
                        data: 'id',
                        name: 'id',
                        title: 'Action',
                        searchable: false,
                        className: 'text-center',
                        "orderable": false,
                        render: function (data, type, row, meta) {
                            var promotionId = row['id'];
                            var actionLink = '<a href="javascript:;" data-toggle="tooltip" title="Xoá ' + promotionId + '!" onclick="deletePromotion(' + promotionId + ')"><i class=" fa-2x fa fa-trash" aria-hidden="true"></i></a>';
                            actionLink += '&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="editPromotion(' + promotionId + ')" data-toggle="tooltip" title="Sửa ' + row['code'] + ' !" ><i class="fa fa-2x fa-pencil-square-o" aria-hidden="true"></i></a>';
                            return actionLink;
                        }
                    }
                ]
            });
        });
        function deletePromotion(id) {
            swal({
                title: "Bạn có muốn xóa mã khuyến mại này?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: 'Bỏ qua',
                confirmButtonText: "Đồng ý",
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: window.location.origin + '/admin/promotions/' + id,
                        method: 'DELETE'
                    }).success(function(data){
                        if(data.code == 200)
                        {
                            swal(
                                'Đã Xoá!',
                                'Bạn đã xoá thành công!',
                                'success'
                            ).then(function(){
                                promotionTable.ajax.reload();
                            })
                        }
                        else {
                            swal(
                                'Thất bại',
                                'Thao tác thất bại',
                                'error'
                            ).then(function(){
                                promotionTable.ajax.reload();
                            })
                        }
                    }).error(function(data){
                        swal(
                            'Thất bại',
                            'Thao tác thất bại',
                            'error'
                        ).then(function(){
                            promotionTable.ajax.reload();
                        })
                    });

                }
            });
        }
        // show edit bus type
        function editPromotion(id) {
            $.ajax({
                url: window.location.origin + '/admin/promotions/' + id + '/edit',
                method: 'GET'
            }).success(function(data){

            }).error(function(data){

            });

        }
        // show create bus type
        function showViewCreateBusType() {

            $("#createPromotionModal").modal('show');
        }
        // delete bus type in checkbox

    </script>
@stop
