@extends('admin.layouts.dashboard')

@section('content')

    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-header with-border margin-bottom-10">
                <h3 class="box-title">Sửa thông tin xe bus</h3>
            </div>
            <form method="post" action="{{ route('bus.update.bus', $busDetail->id) }}" id="frmEditBus"
              enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="row">
                <div class="col-md-6">
                    <div class="row form-group">
                        <label for="bus_name">Tên xe buýt</label>
                        <input id="bus_name" class="form-control" type="text" name="data[bus_name]"
                               value="{{ $busDetail->bus_name }}" placeholder="Tên xe buýt" required>
                    </div>
                    <div class="row form-group">
                        <label for="bus_type">Kiểu xe buýt</label>
                        {!! Form::select('data[bus_type_id]', $busTypes, isset($busDetail->bus_type_id) ? $busDetail->bus_type_id : null, ['class' => 'form-control', 'id' => 'bus_type_id']) !!}
                    </div>
                    <div class="row form-group">
                        <label for="start_point">Điểm bắt đầu</label>
                        <input id="start_point" class="form-control" type="text" name="data[start_point]"
                               value="{{ $busDetail->start_point }}" placeholder="Điểm bắt đầu" required>
                    </div>
                    <div class="row form-group">
                        <label for="start_time">Thời gian bắt đầu</label>
                        <div class="input-group date datetimepicker">
                            <input id="start_time" class="form-control" type="text" name="data[start_time]"
                                   value="{{ $busDetail->start_time }}" placeholder="Thời gian bắt đầu" required>
                            <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="amenities">Tiện nghi</label>
                        {!! Form::text('amenities', $busDetail->amenities, ['class' => 'form-control', 'id' => 'amenities', 'required', 'data-role' => "tagsinput"]) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row form-group">
                        <label for="bus_reg_number">Biển đăng ký buýt</label>
                        <input id="bus_reg_number" class="form-control" type="text" name="data[bus_reg_number]"
                               value="{{ $busDetail->bus_reg_number }}" placeholder="Biển đăng ký buýt" required>
                    </div>
                    <div class="row form-group">
                        <label for="number_seats">Chỗ ngồi</label>
                        <input id="number_seats" class="form-control" type="text" name="data[number_seats]"
                               value="{{ $busDetail->number_seats }}" placeholder="Chỗ ngồi" required>
                    </div>
                    <div class="row form-group">
                        <label for="end_point">Điểm kết thúc</label>
                        <input id="end_point" class="form-control" type="text" name="data[end_point]"
                               value="{{ $busDetail->end_point }}" placeholder="Điểm kết thúc" required>
                    </div>
                    <div class="row form-group">
                        <label for="end_time">Thời gian kết thúc</label>
                        <div class="input-group date datetimepicker">
                            <input id="end_time" class="form-control" type="text" name="data[end_time]"
                                   value="{{ $busDetail->end_time }}" placeholder="Thời gian kết thúc" required>
                            <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row text-center">
                <a class="btn btn-default" href="{{ route('bus.index') }}"><i class="fa fa-arrow-left"
                                                                              aria-hidden="true"></i>
                    Quay Lại</a>
                <button class="btn btn-primary" type="submit"><i class="fa fa-check" aria-hidden="true"></i>Cập nhật
                </button>
            </div>
        </form>
        </div>
    </div>
@stop
@section('js')
    <script type="text/javascript">
        $('#frmEditBus').bootstrapValidator({});
        $('#bus_type_id').select2({
            placeholder: "Chọn Bus Type",
        });
        $(".datetimepicker").datetimepicker({
            format: 'LT'
        });
        $('#amenities').tagsinput({
            tagClass: 'label label-warning'
        });
    </script>
@stop
