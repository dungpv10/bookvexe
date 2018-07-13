@extends('admin.dashboard')

@section('content')

    <section class="content-header">
        <!--section starts-->
        <h1>Edit Bus Details</h1>
        <ol class="breadcrumb">
            <li>
                <a href="/admin/dashboard">
                    <i class="livicon" data-name="home" data-size="14" data-c="#000" data-loop="true"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('bus.index') }}">Bus Details</a>
            </li>
            <li class="active">Edit Bus</li>
        </ol>
    </section>

    <section class="content">
        @include('includes.alert')
        <div class="row">
            <div class="col-md-12">

                <form method="post" action="{{ route('bus.update.bus', $busDetail->id) }}" id="frmEditBus" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row form-group">
                                <label for="bus_name">Bus Name</label>
                                <input id="bus_name" class="form-control" type="text" name="data[bus_name]" value="{{ $busDetail->bus_name }}" placeholder="bus name" required>
                            </div>
                            <div class="row form-group">
                                <label for="bus_type">Bus Type</label>
                                {!! Form::select('data[bus_type_id]', $busTypes, isset($busDetail->bus_type_id) ? $busDetail->bus_type_id : null, ['class' => 'form-control', 'id' => 'bus_type_id']) !!}
                            </div>
                            <div class="row form-group">
                                <label for="start_point">Start Point</label>
                                <input id="start_point" class="form-control" type="text" name="data[start_point]" value="{{ $busDetail->start_point }}" placeholder="start point" required>
                            </div>
                            <div class="row form-group">
                                <label for="start_time">Start Time</label>
                                <div class="input-group date datetimepicker">
                                    <input id="start_time" class="form-control" type="text" name="data[start_time]" value="{{ $busDetail->start_time }}" placeholder="start time" required>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row form-group">
                                <label for="bus_reg_number">Bus RegiNumber</label>
                                <input id="bus_reg_number" class="form-control" type="text" name="data[bus_reg_number]" value="{{ $busDetail->bus_reg_number }}" placeholder="bus reg number" required>
                            </div>
                            <div class="row form-group">
                                <label for="number_seats">Maximum Seats</label>
                                <input id="number_seats" class="form-control" type="text" name="data[number_seats]" value="{{ $busDetail->number_seats }}" placeholder="number seats" required>
                            </div>
                            <div class="row form-group">
                                <label for="end_point">End Point</label>
                                <input id="end_point" class="form-control" type="text" name="data[end_point]" value="{{ $busDetail->end_point }}" placeholder="end point" required>
                            </div>
                            <div class="row form-group">
                                <label for="end_time">End Time</label>
                                <div class="input-group date datetimepicker">
                                    <input id="end_time" class="form-control" type="text" name="data[end_time]" value="{{ $busDetail->end_time }}" placeholder="end time" required>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="amenities">Amenities</label>
                                {!! Form::select('amenities[]', $amenities, $amenityInIds, ['class' => 'form-control', 'id' => 'amenities', 'multiple' => 'multiple']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row text-center">
                        <a class="btn btn-default" href="{{ route('bus.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                            Quay Lại</a>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-check" aria-hidden="true"></i>Cập nhật</button>
                    </div>
                </form>

            </div>
        </div>
    </section>
@stop
@section('js')
    <script type="text/javascript">
        $('#bus_type_id').select2({
            placeholder: "Chọn Bus Type",
        });
        $('#amenities').select2({
            
        });
        $(".datetimepicker").datetimepicker({
            format: 'LT'
        });
    </script>
@stop