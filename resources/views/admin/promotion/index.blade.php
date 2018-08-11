@extends('admin.layouts.dashboard')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.css" rel="stylesheet"/>
@stop
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::select('promotion_type', $promotionTypes, '', ['class' => 'form-control select2', 'id' => 'filter_promotion_type']) !!}
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::select('status', $statuses, '', ['class' => 'form-control select2', 'id' => 'filter_status']) !!}
            </div>
        </div>
    </div>
    <div class="row">
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
                            <input type="number" class="form-control" name="amount"/>
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
    </div>
@stop
@section('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $('.datepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
        $('.select2').css({width: '100%'}).select2();
        var promotionTable;

        $(function () {
            var filterPromotionType = $('#filter_promotion_type'), filterStatus = $('#filter_status');

            promotionTable = $('#bus_type_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": '{!! route('promotions.json_data') !!}',
                    "data": function(d){
                        d.status = filterStatus.val();
                        d.promotion_type = filterPromotionType.val()

                    }
                },
                order: [1, 'asc'],
                columns: [
                    {data: 'code', name: 'code', title: 'Mã giảm giá'},
                    {data: 'amount', name: 'amount', title: 'Số lượng'},
                    {data: 'agent.agent_name', name: 'amount', title: 'Thuộc nhà xe'},
                    {data: 'expiry_date', name: 'expiry_date', title: 'Ngày hết hạn'},
                    {
                        data: 'promotion_type_name',
                        name: 'promotion_type_name',
                        title: 'Loại giảm giá',
                        orderable: false
                    },
                    {
                        data: 'status_name', name: 'status_name', title: 'Trạng thái', orderable: false,
                        render: function (data, type, row, meta) {
                            $active = '';
                            if (row['status'] == "1") {
                                $active = 'active';
                            }
                            return '<button onclick="activePromotion(' + row['id'] + ')" type="button" class="btn btn-lg btn-toggle ' + $active + '" data-toggle="button" aria-pressed="true" autocomplete="off"><div class="handle"></div></button>';
                        }
                    },
                    {data: 'id', name: 'id', 'title': '', visible: false},
                    {data: 'status', name: 'status', 'title': '', visible: false},
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

            filterPromotionType.add(filterStatus).on('change', function(e){
                promotionTable.ajax.reload();
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
                    }).success(function (data) {
                        if (data.code == 200) {
                            swal(
                                'Đã Xoá!',
                                'Bạn đã xoá thành công!',
                                'success'
                            ).then(function () {
                                promotionTable.ajax.reload();
                            })
                        }
                        else {
                            swal(
                                'Thất bại',
                                'Thao tác thất bại',
                                'error'
                            ).then(function () {
                                promotionTable.ajax.reload();
                            })
                        }
                    }).error(function (data) {
                        swal(
                            'Thất bại',
                            'Thao tác thất bại',
                            'error'
                        ).then(function () {
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
            }).success(function (data) {

            }).error(function (data) {

            });

        }

        // show create bus type
        function showViewCreateBusType() {

            $("#createPromotionModal").modal('show');
        }
        var activePromotion = function(id){
            $.ajax({
                method: 'POST',
                url : "{{ route('promotions.active') }}",
                data : {id: id}
            }).done(function(response){
                if(response.code === 200){
                    toastr.success('Update Thành công trạng thái người dùng', 'Thành Công', {timeOut: 3000});
                } else{
                    swal(
                        'Thất bại',
                        'Thao tác thất bại',
                        'error'
                    );
                }
            }).fail(function(error){
                swal(
                    'Thất bại',
                    'Thao tác thất bại',
                    'error'
                );
            });
        }
    </script>
@stop
