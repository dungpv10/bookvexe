@extends('admin.dashboard')

@section('content')

    <section class="content-header">
        <!--section starts-->
        <h1>Bus</h1>
        <ol class="breadcrumb">
            <li>
                <a href="/admin/dashboard">
                    <i class="livicon" data-name="home" data-size="14" data-c="#000" data-loop="true"></i>
                    Dashboard
                </a>
            </li>
            <li class="active">List Bus</li>
        </ol>
    </section>

    <section class="content">
        @include('includes.alert')
        <div class="row">
            <div class="col-md-12">

                <div class="table-responsive">

                    <table class="table table-bordered " id="bus_table">

                    </table>

                </div>

            </div>
        </div>
    </section>
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
                    { data: 'bus_name', name: 'bus_name', title: 'Bus Name' },
                    { data: 'bus_reg_number', name: 'bus_reg_number', title: 'Bus RegiNumber' },
                    { data: 'bus_type', name: 'bus_type', title: 'Bus Type' },
                    { data: 'number_seats', name: 'number_seats', title: 'Number Seats' },
                    { data: 'start_point', name: 'start_point', title: 'Start Point' },
                    { data: 'start_time', name: 'start_time', title: 'Start Time'},
                    { data: 'end_point', name: 'end_point', title: 'End Point'},
                    { data: 'end_time', name: 'end_time', title: 'End Time'},
                    { data: 'id', name: 'id', title: 'Action', searchable: false,className: 'text-center', "orderable": false,
                        render: function(data, type, row, meta){
                            var busId = "'" + data + "'";
                            var urlEdit = '{!! route('bus.index') !!}' + '/' + data + '/edit';
                            var switchUrl = '{!! route('bus.create') !!}';
                            var actionLink = '<a href="javascript:;" data-toggle="tooltip" title="Xoá '+ row['name'] +'!" onclick="deleteUserById('+ busId +')"><i class=" fa-2x fa fa-trash" aria-hidden="true"></i></a>';
                            actionLink += '&nbsp;&nbsp;&nbsp;<a href="' + urlEdit + '" data-toggle="tooltip" title="Sửa '+ row['name'] +'!" ><i class="fa fa-2x fa-pencil-square-o" aria-hidden="true"></i></a>';
                            actionLink += '&nbsp;&nbsp;&nbsp;<a href="' + switchUrl + '" data-toggle="tooltip" title="Đăng nhập bằng '+ row['name'] +'!" ><i class="fa fa-2x fa-sign-in" aria-hidden="true"></i></a>';
                            return actionLink;
                        }
                    }
                ]
            });

        });
    </script>
@stop