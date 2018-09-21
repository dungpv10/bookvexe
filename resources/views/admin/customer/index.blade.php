@extends('admin.layouts.dashboard')
@section('content')

    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border margin-bottom-10">
                <h3 class="box-title">Danh sách khách hàng</h3>
            </div>
            <div class="table-responsive">

                <table class="table table-bordered " id="customer_table">

                </table>

            </div>
        </div>
    </div>

@stop
@section('js')
    <script type="text/javascript">
        var customerTable;

        $(function() {

            customerTable = $('#customer_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url : '{!! route('customer.getJsonData') !!}',
                },
                columns: [
                    { data: 'id', name: 'id', title: 'ID' },
                    { data: 'customer_name', name: 'customer_name', title: 'Tên' },
                    { data: 'email', name: 'email', title: 'Email' },
                    { data: 'bus.bus_name', name: 'bus.bus_name', title: 'Xe' },
                    { data: 'number_phone', name: 'number_phone', title: 'Số điện thoại' },
                    { data: 'age', name: 'age', title: 'Tuổi' },
                    { data: 'genderValue', name: 'genderValue', title: 'Giới tính' },
                    { data: 'id', name: 'id', title: 'Action', searchable: false,className: 'text-center', "orderable": false,
                        visible : visible,
                        render: function(data, type, row, meta){
                            var customerId = "'" + data + "'";
                            var actionLink = '<a href="javascript:;" data-toggle="tooltip" title="Xoá '+ row['customer_name'] +'!" onclick="deleteCustomer('+ customerId +')"><i class=" fa-2x fa fa-trash" aria-hidden="true"></i></a>';
                            return actionLink;
                        }
                    }
                ]
            });

        });
        function deleteCustomer(id) {
            swal({
                title: "Bạn có muốn xóa khách hàng này?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: 'Bỏ qua',
                confirmButtonText: "Đồng ý",
            }).then((result) => {
                if (result.value) {
                $.ajax({
                    url: '{!! route('customer.index') !!}' + '/' + id,
                    method: 'DELETE'
                }).success(function(data){
                    if(data.code == 200)
                    {
                        swal(
                            'Đã Xoá!',
                            'Bạn đã xoá thành công !',
                            'success'
                        ).then(function(){
                            customerTable.ajax.reload();
                        })
                    }
                    else {
                        swal(
                            'Thất bại',
                            'Thao tác thất bại',
                            'error'
                        ).then(function(){
                            customerTable.ajax.reload();
                        })
                    }
                }).error(function(data){
                    swal(
                        'Thất bại',
                        'Thao tác thất bại',
                        'error'
                    ).then(function(){
                        customerTable.ajax.reload();
                    })
                });
                // result.dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
                } else if (result.dismiss === 'cancel') {
                    swal(
                        'Bỏ Qua',
                        'Bỏ qua xoá khách hàng',
                        'error'
                    )
                }
            });
        }
    </script>
@stop
