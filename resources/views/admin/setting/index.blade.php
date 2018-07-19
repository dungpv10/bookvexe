@extends('admin.layouts.dashboard')

@section('css')
    <link href="/vendors/dropzone/dropzone.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border margin-bottom-10">
                <h3 class="box-title">Cài đặt chung</h3>
            </div>
            <div class="">
                <form>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Tiêu đề</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" class="form-control" id="staticEmail" value="email@example.com">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Mô tả chung</label>
                        <div class="col-sm-10">
                            <textarea type="text" name="description" class="form-control" id="staticEmail"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">SMTP Host</label>
                        <div class="col-sm-10">
                            <input type="text" name="smtp_host" class="form-control" id="staticEmail">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">SMTP Username</label>
                        <div class="col-sm-10">
                            <input type="text" name="smtp_username" class="form-control" id="staticEmail">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">SMTP Password</label>
                        <div class="col-sm-10">
                            <input type="text" name="smtp_password" class="form-control" id="staticEmail">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" name="email" class="form-control" id="staticEmail">
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
@stop
@section('js')

@stop
