@extends('admin.layouts.master_layout')

@section('content')

    <div class="breadcomb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcomb-list">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="selectpicker" id="bus_id">
                                        <option value="">Chọn xe</option>
                                        @foreach($buses as $bus)
                                            <option value="{{ $bus->id }}">{{ $bus->bus_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <h2>Danh sách đánh giá</h2>
                            <p>
                                Dưới đây là danh sách các đánh giá thuộc quyền quản lý của bạn
                            </p>
                        </div>
                        <div class="table-responsive">

                            <table class="table table-striped" id="rating_table">

                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@stop


@section('js')
    <script type="text/javascript">
        var ratingTable, busId = $('#bus_id');
        // $('.select2').select2();
        $('.select2-container--default').css({width: '100%'});
        $(function(){
            ratingTable = $('#rating_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": '{!! route('ratings.getJsonData') !!}',
                    "data": function (d) {
                        d.bus_id = busId.val();
                    }
                },
                columns: [
                    {data: 'bus.bus_name', name: 'bus.bus_name', title: 'Tên xe'},
                    {data: 'rating_number', name: 'rating_number', title: 'Đánh giá'},
                    {data: 'customerName', name: 'customerName', title: 'Khách hàng'},
                    {data: 'comment', name: 'comment', title: 'Nhận xét'},

                ]
            });
            busId.on('change', function(){
               ratingTable.ajax.reload();
            });
        })

    </script>

@stop
