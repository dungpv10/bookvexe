@extends('admin.layouts.dashboard')

@section('content')
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::select('bus_type', ['' => 'Lọc theo', 1 => 'Expired'], null, ['class' => 'form-control', 'id' => 'filter_by']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::select('filter_status', ['' => 'Chọn trạng thái', 1 => 'Expired'], null, ['class' => 'form-control', 'id' => 'filter_status']) !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border margin-bottom-10">
                <h3 class="box-title">Bookings</h3>

            </div>
            <div class="table-responsive">

                <table class="table table-bordered " id="bus_table">

                </table>

            </div>
        </div>
    </div>

@stop
@section('js')
    <script type="text/javascript">
        $('#filter_by').add('#filter_status').select2({});
    </script>
@stop
