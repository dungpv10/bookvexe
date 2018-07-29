<div class="box box-warning">
<form method="POST" action="{{ route('routes.store') }}" id="frmCreateRoute">
    <input type="hidden" name="_token" value="{{csrf_token()}}">

    <div class="row form-group">
        <label for="route_name">Tuyến</label>
        <input id="route_name" class="form-control" type="text" name="route_name" 
        value="">
    </div>
    <div class="row  form-group">
        <label for="Role">Xe</label>
        <select class="form-control" name="bus_id" id="bus_id">
            <option value="">Chọn Xe</option>
            @foreach($buses as $bus)
            <option value="{{ $bus->id }}" >{{ $bus->bus_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="row form-group">
        <label for="price">Giá</label>
        <input id="price" class="form-control" type="number" name="price" value="">
    </div>
    <div class="row form-group">
        <label for="from_place">Điểm đi</label>
        <input id="from_place" class="form-control" type="text" name="from_place" value="">
    </div>
    <div class="row form-group">
        <label for="arrived_place">Điểm đến</label>
        <input id="arrived_place" class="form-control" type="text" name="arrived_place" value="">
    </div>
    <div class="row form-group">
        <label for="start_time">Giờ đi</label>
        <input id="start_time" class="form-control" type="number" name="start_time" value="">
    </div>
    <div class="row form-group">
        <label for="arrived_time">Giờ đến</label>
        <input id="arrived_time" class="form-control" type="number" name="arrived_time" value="">
    </div>
    
    <div class="row text-center">
        <button class="btn btn-primary" type="submit"><i class="fa fa-check" aria-hidden="true"></i>Thêm mới</button>
    </div>
</form>
</div>

