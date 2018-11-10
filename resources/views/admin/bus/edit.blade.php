<div class="row">
    <div class="col-md-12">
    <div class="box box-warning">
        <form method="post" action="{{ route('bus.update.bus', $busDetail->id) }}" id="frmEditBus"
              enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bus_name">Tên xe</label>
                        <input id="bus_name" class="form-control" type="text" name="bus_name"
                               value="{{ $busDetail->bus_name }}" placeholder="Tên xe buýt" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bus_reg_number">Biển đăng ký</label>
                        <input id="bus_reg_number" class="form-control" type="text" name="bus_reg_number"
                               value="{{ $busDetail->bus_reg_number }}" placeholder="Biển đăng ký buýt" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bus_type">Kiểu xe</label>
                        {!! Form::select('bus_type_id', $busTypes, isset($busDetail->bus_type_id) ? $busDetail->bus_type_id : null, ['class' => 'form-control', 'id' => 'bus_type_id']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="number_seats">Chỗ ngồi</label>
                        <input id="number_seats" class="form-control" type="number" name="number_seats"
                               value="{{ $busDetail->number_seats }}" placeholder="Chỗ ngồi" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="start_point">Điểm bắt đầu</label>
                        <input id="start_point" class="form-control geo_location" type="text" name="start_point"
                               value="{{ $busDetail->start_point }}" placeholder="Điểm bắt đầu" required>
                        <div class="wrap_location_start"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="end_point">Điểm kết thúc</label>
                        <input id="end_point" class="form-control geo_location" type="text" name="end_point"
                               value="{{ $busDetail->end_point }}" placeholder="Điểm kết thúc" required>
                        <div class="wrap_location_end"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="start_time">Thời gian bắt đầu</label>
                        <div class="input-group date datetimepicker">
                            <input id="start_time" class="form-control" type="text" name="start_time"
                                   value="{{ $busDetail->start_time }}" placeholder="Thời gian bắt đầu" required>
                            <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
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
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="amenities">Tiện nghi</label>
                        {!! Form::text('amenities', $busDetail->amenities, ['class' => 'form-control', 'id' => 'amenities', 'required', 'data-role' => "tagsinput"]) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group custom-lable">
                        <label for="">Chọn ảnh</label>
                        <div class="increment control-group input-group">
                            <input type="file" name="image_bus[]" class="form-control input_file">
                            <div class="input-group-btn">
                                <button class="btn btn-success add-image" type="button"><i class="glyphicon glyphicon-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group custom_row">
                        @foreach($busDetail->images as $key => $image)
                            <div class="col-md-6 remove_image_edit">
                                <i class="fa fa-times-circle remove_edit"></i>
                                <img class="image_bus" data-name="{{ $image->image_path }}" src="{{ asset('images/' . $image->image_path) }}" alt="{{ $image->image_path }}">
                                <input type="hidden" name="image_remove_bus[]" value="">
                            </div>
                        @endforeach
                    </div>
                    <div class="clone hide">
                        <div class="control-group input-group" style="margin-top:10px">
                            <input type="file" name="image_bus[]" class="form-control input_file">
                            <div class="input-group-btn">
                                <button class="btn btn-danger remove-image" type="button"><i class="glyphicon glyphicon-remove"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row text-center">
                <button type="submit" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i>Cập nhật
                </button>
            </div>
        </form>
    </div>
</div>
</div>
<script type="text/javascript">
    var busNames = JSON.parse('<?= $busNames; ?>');
    var busRegs = JSON.parse('<?= $busRegs; ?>');
</script>