<div class="box box-warning">
<form method="POST" action="{{ route('routes.update', $route->id) }}" id="frmEditRoute">
    <input name="_method" type="hidden" value="PATCH">
    <input type="hidden" name="_token" value="{{csrf_token()}}">

    <div class="row form-group">
        <label for="route_name">Tuyến</label>
        <input id="route_name" class="form-control" type="text" name="route_name" 
        value="{{ $route->route_name }}">
    </div>
    <div class="row  form-group">
        <label for="Role">Xe</label>
        <select class="form-control" name="bus_id" id="bus_id">
            <option value="">Chọn Xe</option>
            @foreach($buses as $bus)
            <option value="{{ $bus->id }}" {{ ($route->bus_id == $bus->id) ? 'selected' : '' }}>{{ $bus->bus_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="row form-group">
        <label for="price">Giá</label>
        <input id="price" class="form-control" type="number" name="price" value="{{ $route->price }}">
    </div>
    <div class="row form-group">
        <label for="from_place">Điểm đi</label>
        <input id="from_place" class="form-control" type="text" name="from_place" value="{{ $route->from_place }}">
    </div>
    <div class="row form-group">
        <label for="arrived_place">Điểm đến</label>
        <input id="arrived_place" class="form-control" type="text" name="arrived_place" value="{{ $route->arrived_place }}">
    </div>
    <div class="row form-group">
        <label for="start_time">Giờ đi</label>
        <div class="input-group date datetimepicker">
            <input id="start_time" class="form-control" type="text" name="start_time"
                   value="{{ $route->start_time }}" placeholder="Thời gian bắt đầu" required>
            <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
        </div>
    </div>
    <div class="row form-group">
        <label for="arrived_time">Giờ đến</label>
        <div class="input-group date datetimepicker">
            <input id="arrived_time" class="form-control" type="text" name="arrived_time"
                   value="{{ $route->arrived_time }}" placeholder="Thời gian kết thúc" required>
            <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
        </div>
    </div>
    
    <div class="row text-center">
        <button class="btn btn-primary" type="submit"><i class="fa fa-check" aria-hidden="true"></i>Cập nhật</button>
    </div>
</form>
</div>

