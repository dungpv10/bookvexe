@extends('admin.layouts.dashboard')

@section('content')
<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">View Bus Management Details</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-info btn-sm" title="" data-toggle="tooltip" data-widget="collapse" data-original-title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body" style="display: block;">
            <dl>
                <dt>Tên xe buýt</dt>
                <dd>{{ $busDetail->bus_name }}</dd>
                <dt>Biển đăng ký buýt</dt>
                <dd>{{ $busDetail->bus_reg_number }}</dd>
                <dt>Chỗ ngồi</dt>
                <dd>{{ $busDetail->number_seats }}</dd>
                <dt>Điểm bắt đầu</dt>
                <dd>{{ $busDetail->start_point }}</dd>
                <dt>Thời gian bắt đầu</dt>
                <dd>{{ $busDetail->start_time }}</dd>
                <dt>Điểm kết thúc</dt>
                <dd>{{ $busDetail->end_point }}</dd>
            </dl>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">View Bus Management Details</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-info btn-sm" title="" data-toggle="tooltip" data-widget="collapse" data-original-title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <dl>
                <dt>Kiểu xe buýt</dt>
                <dd>{{ $busTypes[$busDetail->bus_type_id] }}</dd>
                <dt>Status</dt>
                <dd>{{ $busDetail->number_seats }}</dd>
                <dt>Ngày tạo</dt>
                <dd>{{ $busDetail->created_at }}</dd>
                <dt>Tiện nghi</dt>
                <dd>
                    @foreach($amenityInIds as $amenityInId)
                        {{ $amenities[$amenityInId] . "  "}}
                    @endforeach
                </dd>
                <dt>Thời gian kết thúc</dt>
                <dd>{{ $busDetail->end_time }}</dd>
            </dl>
        </div>
    </div>
</div>
@stop
@section('js')
    <script type="text/javascript">
    </script>
@stop