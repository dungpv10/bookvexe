<div class="row">
    <div class="col-md-12">
        <div class="box box-warning">
        <form method="POST" action="{{ route('routes.store') }}" id="frmCreateRoute">
            <input type="hidden" name="_token" value="{{csrf_token()}}">

            <div class="form-group">
                <label for="route_name">Tuyến</label>
                <input id="route_name" class="form-control" type="text" name="route_name" 
                value="">
            </div>
            <div class="form-group">
                <label for="Role">Xe</label>
                <select class="form-control" name="bus_id" id="bus_id">
                    <option value="">Chọn Xe</option>
                    @foreach($buses as $bus)
                    <option value="{{ $bus->id }}" >{{ $bus->bus_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="price">Giá</label>
                <input id="price" class="form-control" type="number" name="price" value="">
            </div>
            <div class="form-group">
                <label for="from_place">Điểm đi</label>
                <input id="from_place" class="form-control geo_location" type="text" name="from_place" value="">
                <div class="wrap_location_from_place"></div>
            </div>
            <div class="form-group">
                <label for="arrived_place">Điểm đến</label>
                <input id="arrived_place" class="form-control geo_location" type="text" name="arrived_place" value="">
                <div class="wrap_location_arrived_place"></div>
            </div>
            <div class="form-group">
                <label for="start_time">Giờ đi</label>
                <div class="input-group date datetimepicker">
                    <input id="start_time" class="form-control" type="text" name="start_time"
                           value="" placeholder="Thời gian bắt đầu" required>
                    <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-time"></span>
                                            </span>
                </div>
            </div>
            <div class="form-group">
                <label for="arrived_time">Giờ đến</label>
                <div class="input-group date datetimepicker">
                    <input id="arrived_time" class="form-control" type="text" name="arrived_time"
                           value="" placeholder="Thời gian kết thúc" required>
                    <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-time"></span>
                                            </span>
                </div>
            </div>
            
            <div class="row text-center">
                <button class="btn btn-primary" type="submit"><i class="fa fa-check" aria-hidden="true"></i>Thêm mới</button>
            </div>
        </form>
        </div>
    </div>
</div>

