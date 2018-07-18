<div class="row">
    <div class="col-md-12">
    <div class="box box-warning">
        <form method="post" action="{{ route('bus.update.bus', $busDetail->id) }}" id="frmEditBus"
              enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="row">
                <div class="col-md-6">
                    <div class="row form-group">
                        <label for="bus_name">Tên xe</label>
                        <input id="bus_name" class="form-control" type="text" name="bus_name"
                               value="{{ $busDetail->bus_name }}" placeholder="Tên xe buýt" required>
                    </div>
                    <div class="row form-group">
                        <label for="bus_type">Kiểu xe</label>
                        {!! Form::select('bus_type_id', $busTypes, isset($busDetail->bus_type_id) ? $busDetail->bus_type_id : null, ['class' => 'form-control', 'id' => 'bus_type_id']) !!}
                    </div>
                    <div class="row form-group">
                        <label for="start_point">Điểm bắt đầu</label>
                        <input id="start_point" class="form-control" type="text" name="start_point"
                               value="{{ $busDetail->start_point }}" placeholder="Điểm bắt đầu" required>
                    </div>
                    <div class="row form-group">
                        <label for="start_time">Thời gian bắt đầu</label>
                        <div class="input-group date datetimepicker">
                            <input id="start_time" class="form-control" type="text" name="start_time"
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
                        <label for="bus_reg_number">Biển đăng ký</label>
                        <input id="bus_reg_number" class="form-control" type="text" name="bus_reg_number"
                               value="{{ $busDetail->bus_reg_number }}" placeholder="Biển đăng ký buýt" required>
                    </div>
                    <div class="row form-group">
                        <label for="number_seats">Chỗ ngồi</label>
                        <input id="number_seats" class="form-control" type="number" name="number_seats"
                               value="{{ $busDetail->number_seats }}" placeholder="Chỗ ngồi" required>
                    </div>
                    <div class="row form-group">
                        <label for="end_point">Điểm kết thúc</label>
                        <input id="end_point" class="form-control" type="text" name="end_point"
                               value="{{ $busDetail->end_point }}" placeholder="Điểm kết thúc" required>
                    </div>
                    <div class="row form-group">
                        <label for="end_time">Thời gian kết thúc</label>
                        <div class="input-group date datetimepicker">
                            <input id="end_time" class="form-control" type="text" name="end_time"
                                   value="{{ $busDetail->end_time }}" placeholder="Thời gian kết thúc" required>
                            <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row text-center">
                {{--<a class="btn btn-default" href="{{ route('bus.index') }}"><i class="fa fa-arrow-left"--}}
                                                                              {{--aria-hidden="true"></i>--}}
                    {{--Quay Lại</a>--}}
                <button type="button" class="btn btn-primary" onclick="saveEditBus('{{$busDetail->id}}')"><i class="fa fa-edit" aria-hidden="true"></i>Cập nhật
                </button>
            </div>
        </form>
    </div>
</div>
</div>