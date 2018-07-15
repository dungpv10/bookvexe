@extends('admin.layouts.dashboard')
@section('content')
    <div class="col-md-12">
        {{--edit bus type--}}
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Thêm kiểu xe bus</h3>
            </div>
            <form action="{{ route('bus-type.update',['id' => $busTypeDetail->id]) }}" method="POST" enctype="multipart/form-data" id="frmCreateNewBusType">
                <input name="_method" type="hidden" value="PATCH">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="bus_type_name">Kiểu xe bus</label>
                            <input type="text" class="form-control" value="{{ $busTypeDetail->bus_type_name }}" name="bus_type_name" data-parsley-pattern="^[a-zA-Z\ . ! @ # $ % ^ &amp; * () + = , \/]+$" id="bus_type_name" placeholder="Nhập kiểu xe bus" required>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Đăng ký</button>
                </div>
            </form>
        </div>
    </div>
@stop
@section('js')
@stop