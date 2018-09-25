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
                            <button class="btn btn-primary" type="submit"><i class="fa fa-check" aria-hidden="true"></i>Tạo
                                mới
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
        function deleteAgent(id) {
            swal({
                title: "Bạn có muốn xóa nhà xe này?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: 'Bỏ qua',
                confirmButtonText: "Đồng ý",
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: window.location.origin + '/admin/agents/' + id,
                        method: 'DELETE'
                    }).success(function(data){
                        if(data.code == 200)
                        {
                            swal(
                                'Đã Xoá!',
                                'Bạn đã xoá thành công Role!',
                                'success'
                            ).then(function(){
                                agentTable.ajax.reload();
                            })
                        }
                        else {
                            swal(
                                'Thất bại',
                                'Thao tác thất bại',
                                'error'
                            ).then(function(){
                                agentTable.ajax.reload();
                            })
                        }
                    }).error(function(data){
                        swal(
                            'Thất bại',
                            'Thao tác thất bại',
                            'error'
                        ).then(function(){
                            agentTable.ajax.reload();
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

        var filterStatus = $('#filter_status');
        filterStatus.on('change', function(){
            agentTable.ajax.reload();
        });
        var editAgent = function(id){
            // $.ajax({
            //     method : 'GET',
            //     url : window.location.origin + '/admin/agents/' + id
            // }).done(function(response){
            //     $('#agent_name').val(response.data.agent_name);
            //     $('#agent_address').val(response.data.agent_address);
            //     $('#agent_license').val(response.data.agent_license);
            //     $('#agent_status').val(response.data.status);
            //     $('#agent_mobile').val(response.data.agent_mobile);
            //     $('#agent_email').val(response.data.agent_email);
            //     $('#agent_representation').val(response.data.agent_representation);
            //     $('#agent_representation_mobile').val(response.data.agent_representation_mobile);
            //     $('#agent_website').val(response.data.agent_website);
            //     $('#agentForm').attr('action', window.location.origin + '/admin/agents/' + id).append('<input type="hidden" name="_method" value="PATCH"/>');
            //     createAgent.modal('show');
            // }).fail(function(err){
            //     swal(
            //         'Thất bại',
            //         'Thao tác thất bại',
            //         'error'
            //     );
            // });
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
                    data: function(d){
                        d.status = filterStatus.val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id', searchable: false, title: 'ID' },
                    { data: 'date', name: 'date', title: 'Ngày nghỉ' },
                    { data: 'increase_price', name: 'increase_price', title: 'Giá' },

                    { data: 'id', name: 'id', title: 'Thao Tác', searchable: false,className: 'text-center', "orderable": false,
                        render: function(data, type, row, meta){
                            let actionLink = '';
                            if(isRoot){
                                var agentId = "'" + row['id'] + "'";
                                actionLink = '<a href="javascript:;" data-toggle="tooltip" title="Xoá '+ row['name'] +'!" onclick="deleteAgent('+ agentId +')"><i class=" fa-2x fa fa-trash" aria-hidden="true"></i></a>';
                                actionLink += '&nbsp;&nbsp;&nbsp;<a target="javascript:;" onclick="editAgent(' + row['id'] + ')"><i class="fa fa-2x fa-pencil-square-o" aria-hidden="true"></i></a>';
                            }
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
