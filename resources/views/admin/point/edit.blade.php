<div class="row">
    <div class="col-md-12">
        <div class="box box-warning">
            <form method="POST" action="{{ route('points.update', $point->id) }}" id="frmEditPoint" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row form-group">
                            <label for="point_type_id">Kiểu điểm dừng</label>
                            {!! Form::select('point_type_id', $pointTypes, $point->point_type_id, ['class' => 'form-control select2', 'id' => 'point_type_id']) !!}
                        </div>
                        <div class="row form-group">
                            <label for="route_id">Tuyến đường</label>
                            {!! Form::select('route_id', $routes, $point->route->id, ['class' => 'form-control select2', 'id' => 'route_id']) !!}
                        </div>
                        <div class="row form-group">
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
                        <div class="row form-group">
                            <label for="landmark">Dấu đất</label>
                            <input id="landmark" class="form-control" type="text" name="landmark" value="{{ $point->landmark }}" placeholder="Dấu đất" required >
                        </div>
                        <div class="row form-group">
                            <label for="address">Địa chỉ</label>
                            <input id="address" class="form-control" type="text" name="address" value="{{ $point->address }}" placeholder="Địa chỉ" required >
                        </div>
                    </div>
                </div>

                <div class="row text-center">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-plus-circle" aria-hidden="true"></i>Thêm mới
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>