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
                    { data: 'id', name: 'id', searchable: false, title: 'ID' },
                    { data: 'bus_name', name: 'bus_name', title: 'Bus Name' },
                    { data: 'number_seats', name: 'number_seats', title: 'Number Seats' },
                    { data: 'start_point', name: 'start_point', title: 'Start Point' },
                    { data: 'end_point', name: 'end_point', title: 'End Point'},
                    { data: 'start_time', name: 'start_time', title: 'Start Time'},
                    { data: 'end_time', name: 'end_time', title: 'End Time'},
                ]
            });

        });
    </script>
@stop