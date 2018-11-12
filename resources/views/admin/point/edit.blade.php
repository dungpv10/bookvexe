<div class="row">
    <div class="col-md-12">
        <div class="box box-warning">
            <form method="POST" action="{{ route('points.update', $point->id) }}" id="frmEditPoint" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PATCH">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="point_type_id">Kiểu điểm dừng</label>
                            {!! Form::select('point_type_id', $pointTypes, $point->point_type_id, ['class' => 'form-control select2', 'id' => 'point_type_id']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="landmark">Dấu đất</label>
                            <input id="landmark" class="form-control geo_location" type="text" name="landmark" value="{{ $point->landmark }}" placeholder="Dấu đất" required >
                            <div class="wrap_location_landmark"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="route_id">Tuyến đường</label>
                            {!! Form::select('route_id', $routes, $point->route->id, ['class' => 'form-control select2', 'id' => 'route_id']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">Địa chỉ</label>
                            <input id="address" class="form-control geo_location" type="text" name="address" value="{{ $point->address }}" placeholder="Địa chỉ" required >
                            <div class="wrap_location_address"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="drop_time">Thời gian giảm</label>
                            <div class="input-group date datetimepicker">
                                <input id="drop_time" class="form-control" type="text" name="drop_time" value="{{ $point->drop_time }}"
                                       placeholder="Thời gian giảm" required>
                                <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">

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