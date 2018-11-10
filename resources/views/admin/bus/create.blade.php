<div class="row">
    <div class="col-md-12">
        <div class="box box-warning">
            <form method="POST" action="{{ route('bus.store') }}" id="frmCreateNewBus" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="bus_name">Tên xe</label>
                            <div class="nk-int-st">
                            <input id="bus_name" class="form-control" type="text" name="bus_name" value=""
                                   placeholder="Tên xe buýt" required>
                                 </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" form-group">
                            <label for="bus_reg_number">Biển đăng ký</label>
                            <div class="nk-int-st">
                            <input id="bus_reg_number" class="form-control" type="text" name="bus_reg_number" value=""
                                   placeholder="Biển đăng ký" required>
                                 </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class=" form-group">
                            <label for="bus_type">Kiểu xe</label>
                            {!! Form::select('bus_type_id', $busTypes, null, ['class' => 'selectpicker', 'id' => 'bus_type_id']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" form-group">
                            <label for="number_seats">Chỗ ngồi</label>
                            <div class="nk-int-st">
                            <input id="number_seats" class="form-control" type="number" name="number_seats" value=""
                                   placeholder="Chỗ ngồi" required>
                                 </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class=" form-group">
                            <label for="start_point">Điểm bắt đầu</label>
                            <div class="nk-int-st">
                            <input id="start_point" class="form-control geo_location" type="text" name="start_point" value=""
                                   placeholder="Điểm bắt đầu" required>
                                 </div>
                            <div class="wrap_location_start"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" form-group">
                            <label for="end_point">Điểm kết thúc</label>
                            <div class="nk-int-st">
                            <input id="end_point" class="form-control geo_location" type="text" name="end_point" value=""
                                   placeholder="Điểm kết thúc" required>
                                 </div>
                            <div class="wrap_location_end"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class=" form-group">
                            <label for="start_time">Thời gian bắt đầu</label>
                            <div class="input-group date datetimepicker" style="width: 100%;">
                              <div class="nk-int-st">
                                <input id="start_time" class="form-control" type="text" name="start_time" value=""
                                       placeholder="Thời gian bắt đầu" required>
                                     </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" form-group">
                            <label for="end_time">Thời gian kết thúc</label>
                            <div class="input-group date datetimepicker" style="width: 100%;">
                              <div class="nk-int-st">
                                <input id="end_time" class="form-control" type="text" name="end_time" value=""
                                       placeholder="Thời gian kết thúc" required>
                                     </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class=" form-group">
                            <label for="amenities">Tiện nghi</label>
                            <div class="nk-int-st">
                            {!! Form::text('amenities', null, ['class' => 'form-control', 'id' => 'amenities', 'required', "data-role" => "tagsinput"]) !!}
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" form-group custom-lable">
                            <label for="">Chọn ảnh</label>
                            <div class=" increment control-group input-group">
                              <div class="nk-int-st">
                                <input type="file" name="image_bus[]" class="form-control input_file">
                              </div>
                                <div class="input-group-btn">
                                    <button class="btn btn-success add-image" type="button"><i class="glyphicon glyphicon-plus"></i></button>
                                </div>
                            </div>
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
                    <button class="btn btn-primary" type="submit"><i class="fa fa-plus-circle" aria-hidden="true"></i>Thêm mới
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
