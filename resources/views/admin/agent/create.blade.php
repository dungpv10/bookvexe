@extends('admin.layouts.dashboard')

@section('css')
    <link href="/vendors/jasny-bootstrap/jasny-bootstrap.min.css" rel="stylesheet"/>
@stop
@section('content')
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border margin-bottom-10">
                <h3 class="box-title">Nhập thông tin nhà xe</h3>
            </div>
            <div class="">
                {!! Form::open(['route' => 'agents.store', 'class' => 'form-horizontal', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Tên nhà xe</label>
                    <div class="col-sm-10">
                        <input type="text" name="agent_name" class="form-control" id="agent_name">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Mã số thuế</label>
                    <div class="col-sm-10">
                        <input type="text" name="agent_license" class="form-control" id="agent_license">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Upload Favicon</label>
                    <div class="col-sm-10">
                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                            <div class="form-control" data-trigger="fileinput">
                                <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                <span class="fileinput-filename"></span>
                            </div>
                            <span class="input-group-addon file-btn btn-default btn-file">
                                                        <span class="fileinput-new">Chọn file</span>

                                                        <input name="favicon_img" type="file" name="..."></span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2 col-sm-offset-10 text-right">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
@stop
@section('js')
    <script src="/vendors/jasny-bootstrap/jasny-bootstrap.min.js"></script>
@stop
