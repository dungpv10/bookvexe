@extends('admin.layouts.dashboard')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border margin-bottom-10">
                    <h3 class="box-title">Quản lý ngày nghỉ</h3>
                    <button type="button" class="btn btn-primary" id="createHolidayBtn">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>Thêm mới
                    </button>
                </div>


                <div class="table-responsive">

                    <table class="table table-bordered " id="holiday_table">

                    </table>

                </div>

            </div>
        </div>


    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="createHoliday" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="box-title">Tạo mới cài đặt ngày nghỉ</h3>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'holidays.store', 'id' => 'createForm']) !!}

                        <div class="form-group">
                            <label for="date">Ngày nghỉ</label>
                            <input name="date" id="date" class="datepicker form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="increase_price">Giá tiền</label>
                            <input type="number" name="increase_price" id="increase_price" class="form-control"/>
                        </div>


                        <div class="form-group text-right">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-check" aria-hidden="true"></i>
                              <span id="submitBtn">Tạo
                                mới</span>
                            </button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script type="text/javascript">
        $('.datepicker').datetimepicker({
            format: 'MM/DD'
        });
        var holidayTable;
        function deleteHoliday(id) {
            swal({
                title: "Bạn có muốn xóa kỳ nghỉ này?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: 'Bỏ qua',
                confirmButtonText: "Đồng ý",
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: window.location.origin + '/admin/holidays/' + id,
                        method: 'DELETE'
                    }).success(function(data){
                        if(data.code == 200)
                        {
                            swal(
                                'Đã Xoá!',
                                'Bạn đã xoá thành công Role!',
                                'success'
                            ).then(function(){
                                holidayTable.ajax.reload();
                            })
                        }
                        else {
                            swal(
                                'Thất bại',
                                'Thao tác thất bại',
                                'error'
                            ).then(function(){
                                holidayTable.ajax.reload();
                            })
                        }
                    }).error(function(data){
                        swal(
                            'Thất bại',
                            'Thao tác thất bại',
                            'error'
                        ).then(function(){
                            holidayTable.ajax.reload();
                        })
                    });
                    // result.dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
                } else if (result.dismiss === 'cancel') {
                    swal(
                        'Bỏ Qua',
                        'Bạn đã không xoá role nữa',
                        'error'
                    )
                }
            });
        }
        var createHoliday = $('#createHoliday');
        var editHoliday = function(id){
            $.ajax({
                method : 'GET',
                url : window.location.origin + '/admin/holidays/' + id
            }).done(function(response){
                $('#date').val(response.data.date);
                $('#increase_price').val(response.data.increase_price);
                $('#createForm').attr('action', window.location.origin + '/admin/holidays/' + id).append('<input type="hidden" name="_method" value="PATCH"/>');
            
                createHoliday.modal('show');
            }).fail(function(err){
                swal(
                    'Thất bại',
                    'Thao tác thất bại',
                    'error'
                );
            });
        };

        $('#createHolidayBtn').on('click', function(e){
            e.preventDefault();

            createHoliday.modal('show');
        });


        $(function() {
            holidayTable = $('#holiday_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('holidays.datatable') !!}',
                    data: function(d){}
                },
                columns: [
                    { data: 'id', name: 'id', searchable: false, title: 'ID' },
                    { data: 'date', name: 'date', title: 'Ngày nghỉ' },
                    { data: 'increase_price', name: 'increase_price', title: 'Giá' },

                    { data: 'id', name: 'id', title: 'Thao Tác', searchable: false,className: 'text-center', "orderable": false,
                        render: function(data, type, row, meta){
                            let actionLink = '';

                            var agentId = "'" + row['id'] + "'";
                            actionLink = '<a href="javascript:;" data-toggle="tooltip" onclick="deleteHoliday('+ agentId +')"><i class=" fa-2x fa fa-trash" aria-hidden="true"></i></a>';
                            actionLink += '&nbsp;&nbsp;&nbsp;<a target="javascript:;" onclick="editHoliday(' + row['id'] + ')"><i class="fa fa-2x fa-pencil-square-o" aria-hidden="true"></i></a>';

                            return actionLink;
                        }
                    }
                ]
            });


            $('#createForm').bootstrapValidator({
                message:  'Nhập dữ liệu không đúng',
                fields : {
                    date: {
                        validators : {
                            notEmpty: {
                                message : 'Ngày nghỉ lễ không được để trống',
                            },
                            stringLength : {
                                min: 3,
                                max : 255,
                                message: 'Tên dài từ 3 tới 255 ký tự'
                            }
                        }
                    },
                    increase_price: {
                        validators : {
                            notEmpty: {
                                message: 'Giá tiền không được bỏ trống',
                            },
                            stringLength: {
                                min: 3,
                                max: 255,
                                message: 'Địa chỉ dài từ 3 tới 255 ký tự'
                            }
                        }
                    }
                }
            });
        });

    </script>
@stop
