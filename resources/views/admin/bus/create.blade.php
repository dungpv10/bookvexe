@extends('admin.dashboard')

@section('content')

    <section class="content-header">
        <!--section starts-->
        <h1>Add Bus Details</h1>
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
            <li class="active">Add Bus</li>
        </ol>
    </section>

    <section class="content">
        @include('includes.alert')
        <div class="row">
            <div class="col-md-12">

                <form method="POST" action="{{ route('bus.store') }}" id="frmCreateNewBus" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row form-group">
                                <label for="bus_name">Tên xe buýt</label>
                                <input id="bus_name" class="form-control" type="text" name="data[bus_name]" value="" placeholder="Tên xe buýt" required>
                            </div>
                            <div class="row form-group">
                                <label for="bus_type">Kiểu xe buýt</label>
                                {!! Form::select('data[bus_type_id]', $busTypes, null, ['class' => 'form-control', 'id' => 'bus_type_id']) !!}
                            </div>
                            <div class="row form-group">
                                <label for="start_point">Điểm bắt đầu</label>
                                <input id="start_point" class="form-control" type="text" name="data[start_point]" value="" placeholder="Điểm bắt đầu" required>
                            </div>
                            <div class="row form-group">
                                <label for="start_time">Thời gian bắt đầu</label>
                                <div class="input-group date datetimepicker">
                                    <input id="start_time" class="form-control" type="text" name="data[start_time]" value="" placeholder="Thời gian bắt đầu" required>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="amenities">Amenities</label>
                                {!! Form::select('amenities[]', $amenities, null, ['class' => 'form-control js-example-basic-multiple', 'id' => 'amenities', 'multiple' => 'multiple', 'required']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row form-group">
                                <label for="bus_reg_number">Biển đăng ký buýt</label>
                                <input id="bus_reg_number" class="form-control" type="text" name="data[bus_reg_number]" value="" placeholder="Biển đăng ký buýt" required>
                            </div>
                            <div class="row form-group">
                                <label for="number_seats">Chỗ ngồi</label>
                                <input id="number_seats" class="form-control" type="text" name="data[number_seats]" value="" placeholder="Chỗ ngồi" required>
                            </div>
                            <div class="row form-group">
                                <label for="end_point">Điểm kết thúc</label>
                                <input id="end_point" class="form-control" type="text" name="data[end_point]" value="" placeholder="Điểm kết thúc" required>
                            </div>
                            <div class="row form-group">
                                <label for="end_time">Thời gian kết thúc</label>
                                <div class="input-group date datetimepicker">
                                    <input id="end_time" class="form-control" type="text" name="data[end_time]" value="" placeholder="Thời gian kết thúc" required>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
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
        $('#frmCreateNewBus').bootstrapValidator({});
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