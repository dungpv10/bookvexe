@extends('admin.layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <select class="form-control select2" id="bus_id">
                    <option value="">Chọn xe</option>
                    @foreach($buses as $bus)
                        <option value="{{ $bus->id }}">{{ $bus->bus_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border margin-bottom-10">
                    <h3 class="box-title">Danh sách mã giảm giá</h3>
                    <button class="btn btn-primary" type="button" id="addPromotionBtn">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm mới
                    </button>
                </div>
                <div class="table-responsive">

                    <table class="table table-bordered " id="rating_table">

                    </table>

                </div>
            </div>
        </div>


    </div>

@stop


@section('js')
    <script type="text/javascript">
        var ratingTable;
        $('.select2').select2();
        $('.select2-container--default').css({width: '100%'});
        $(function(){
            ratingTable = $('#rating_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": '{!! route('ratings.getJsonData') !!}',
                    "data": function (d) {
                        d.bus_id = $('#bus_id').val();
                        // d.promotion_type = filterPromotionType.val()
                        // d.agent_id = filterAgentId.val()
                    }
                },
                columns: [
                    {data: 'bus.bus_name', name: 'bus.bus_name', title: 'Tên xe'},
                    {data: 'rating_number', name: 'rating_number', title: 'Đánh giá'},

                ]
            });
        })

    </script>

@stop
