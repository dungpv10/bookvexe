@extends('admin.layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::select('status', $statuses, '', ['class' => 'form-control filter_status', 'id' => 'filter_status']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border margin-bottom-10">
                    <h3 class="box-title">Danh sách nhà xe</h3>
                    <button type="button" class="btn btn-primary" id="createAgentBtn">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>Thêm mới
                    </button>
                </div>


                <div class="table-responsive">

                    <table class="table table-bordered " id="agent_table">

                    </table>

                </div>

            </div>
        </div>


    </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="updateStatusModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="box-title">Cập nhật trạng thái</h3>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'agents.update_status', 'id' => 'agentFormUpdateStatus', 'method' => 'post']) !!}
                        {!! Form::hidden('id', '', ['id' => 'agent_status_id']) !!}
                        <div class="form-group">
                            <label for="status">Trạng thái</label>
                            {!! Form::select('status', $statuses, '', ['class' => 'form-control', 'id' => 'update_agent_status']) !!}
                        </div>

                        <div class="form-group text-right">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-check" aria-hidden="true"></i>Cập nhật
                            </button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="createAgent" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="box-title">Tạo mới nhà xe</h3>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'agents.store', 'id' => 'agentForm']) !!}
                        <div class="form-group">
                            <label for="agent_name">Tên nhà xe</label>
                            <input name="agent_name" id="agent_name" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="agent_address">Địa chỉ nhà xe</label>
                            <input name="agent_address" id="agent_address" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="agent_license">Mã số thuế</label>
                            <input name="agent_license" id="agent_license" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="status">Trạng thái</label>
                            {!! Form::select('status', $statuses, '', ['class' => 'form-control', 'id' => 'agent_status']) !!}
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
        var agentTable;
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
        var createAgent = $('#createAgent');
        var agentForm = $('#agentForm');
        var filterStatus = $('#filter_status');
        filterStatus.on('change', function(){
            agentTable.ajax.reload();
        });
        var editAgent = function(id){
            $.ajax({
                method : 'GET',
                url : window.location.origin + '/admin/agents/' + id
            }).done(function(response){
                $('#agent_name').val(response.data.agent_name);
                $('#agent_address').val(response.data.agent_address);
                $('#agent_license').val(response.data.agent_license);
                $('#agent_status').val(response.data.status);
                $('#agentForm').attr('action', window.location.origin + '/admin/agents/' + id).append('<input type="hidden" name="_method" value="PATCH"/>');
                createAgent.modal('show');
            }).fail(function(err){
                swal(
                    'Thất bại',
                    'Thao tác thất bại',
                    'error'
                );
            });
        };

        $('#createAgentBtn').on('click', function(e){
            e.preventDefault();
            agentForm.attr('action', window.location.origin + '/admin/agents').find('input[name="method"]').remove();
            agentForm.find('.form-control').val('');
            createAgent.modal('show');
        });

        var updateStatus = function(id, status){
            $('#update_agent_status').val(status);
            $('#agent_status_id').val(id);
            $('#updateStatusModal').modal('show');
        };
        $(function() {
             agentTable = $('#agent_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('agents.getJsonData') !!}',
                    data: function(d){
                        d.status = filterStatus.val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id', searchable: false, title: 'ID' },
                    { data: 'agent_name', name: 'agent_name', title: 'Tên nhà xe' },
                    { data: 'agent_address', name: 'agent_address', title: 'Địa chỉ' },
                    { data: 'agent_license', name: 'agent_license', title: 'Mã số thuế' },
                    { data: 'userCreate', name: 'userCreate', title: 'Người tạo' },
                    { data: 'userUpdate', name: 'userUpdate', title: 'Người cập nhật' },
                    { data: 'created_at', name: 'created_at', title: 'Ngày tạo' },
                    { data: 'updated_at', name: 'updated_at', title: 'Ngày cập nhật' },
                    { data: 'status', name: 'status', title: '', visible : false },

                    { data: 'statusName', name: 'statusName', title: 'Trạng thái' ,
                        visible: isRoot,
                        render : function(data, type, row, meta){
                            var classBtn = row['status'] == 1 ? 'btn-success' : 'btn-danger';
                            return '<button onclick="updateStatus(' + row['id'] + ', ' + row['status'] + ')" class="btn ' + classBtn + '">' + row['statusName'] + '</button>';
                        }
                    },
                    { data: 'id', name: 'id', title: 'Thao Tác', searchable: false,className: 'text-center', "orderable": false,
                        render: function(data, type, row, meta){
                            let actionLink = '';
                            if(isRoot){
                                var agentId = "'" + row['id'] + "'";
                                actionLink = '<a href="javascript:;" data-toggle="tooltip" title="Xoá '+ row['name'] +'!" onclick="deleteAgent('+ agentId +')"><i class=" fa-2x fa fa-trash" aria-hidden="true"></i></a>';
                                actionLink += '&nbsp;&nbsp;&nbsp;<a target="javascript:;" onclick="editAgent(' + row['id'] + ')"><i class="fa fa-2x fa-pencil-square-o" aria-hidden="true"></i></a>';
                            }
                            actionLink += '&nbsp;&nbsp;&nbsp;<a href="" title="Liên kết nhà xe"><i class="fa fa-2x fa-stack-overflow" aria-hidden="true"></i></a>';
                            return actionLink;
                        }
                    }
                ]
            });


            $('#agentForm').bootstrapValidator({
                message:  'Nhập dữ liệu không đúng',
                fields : {
                    agent_name: {
                        validators : {
                            notEmpty: {
                                message : 'Tên nhà xe không được bỏ trống',
                            },
                            stringLength : {
                                min: 3,
                                max : 255,
                                message: 'Tên dài từ 3 tới 255 ký tự'
                            }
                        }
                    },
                    agent_address: {
                        validators : {
                            notEmpty: {
                                message: 'Địa chỉ nhà xe không được bỏ trống',
                            },
                            stringLength: {
                                min: 3,
                                max: 255,
                                message: 'Địa chỉ dài từ 3 tới 255 ký tự'
                            }
                        }
                    },
                    agent_license: {
                        validators : {
                            notEmpty: {
                                message: 'Mã số thuế nhà xe không được bỏ trống',
                            },
                            stringLength: {
                                min: 3,
                                max: 255,
                                message: 'Địa chỉ dài từ 3 tới 255 ký tự'
                            }
                        }
                    },
                    status: {
                        validators : {
                            notEmpty: {
                                message: 'Trạng thái không được bỏ trống',
                            }
                        }
                    }
                }
            });
        });

        $('#agentFormUpdateStatus').bootstrapValidator({
            fields : {
                status: {
                    validators : {
                        notEmpty: {
                            message : 'Trạng thái không được bỏ trống'
                        }
                    }
                }
            }
        });
    </script>
@stop
