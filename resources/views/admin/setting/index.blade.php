@extends('admin.layouts.master_layout')

@section('css')
    <link href="/vendors/jasny-bootstrap/jasny-bootstrap.min.css" rel="stylesheet"/>
@stop
@section('content')



<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="data-table-list">
                    <div class="basic-tb-hd">
                        <h2>Cài đặt chung</h2>
                        <p>

                        </p>
                    </div>
                    <div class="">

                      <div class="">
                          {!! Form::open(['route' => ['setting.update', $setting->id], 'class' => 'form-horizontal', 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
                          <div class="form-group row">
                              <label for="staticEmail" class="col-sm-2 col-form-label">Tiêu đề</label>
                              <div class="col-sm-10">
                                <div class="nk-int-st">
                                  <input type="text" name="title" class="form-control" id="title" value="{{ $setting->title }}">
                                </div>
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="staticEmail" class="col-sm-2 col-form-label">Mô tả chung</label>
                              <div class="col-sm-10">
                                <div class="nk-int-st">
                                  <textarea type="text" name="description" class="form-control"
                                            id="description">{{ $setting->description }}</textarea>
                                          </div>
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="staticEmail" class="col-sm-2 col-form-label">SMTP Host</label>
                              <div class="col-sm-10">
                                <div class="nk-int-st">
                                  <input type="text" name="smtp_host" class="form-control" value="{{ $setting->smtp_host }}"
                                         id="smtp_host">
                                       </div>
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="staticEmail" class="col-sm-2 col-form-label">SMTP Username</label>
                              <div class="col-sm-10">
                                <div class="nk-int-st">
                                  <input type="text" name="smtp_username" value="{{ $setting->smtp_username }}"
                                         class="form-control" id="smtp_username">
                                       </div>
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="staticEmail" class="col-sm-2 col-form-label">SMTP Password</label>
                              <div class="col-sm-10">
                                <div class="nk-int-st">
                                  <input type="text" name="smtp_password" value="{{ $setting->smtp_password }}"
                                         class="form-control" id="smtp_password">
                                       </div>
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                              <div class="col-sm-10">
                                <div class="nk-int-st">
                                  <input type="text" name="email" class="form-control" value="{{ $setting->email }}" id="email">
                                </div>
                              </div>
                          </div>


                          <div class="form-group row">
                              <div class="col-sm-8 col-sm-offset-2">
                                  <img src="/{{ $setting->logo_path }}" class="img img-thumbnail"/>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="staticEmail" class="col-sm-2 col-form-label">Upload Logo</label>
                              <div class="col-sm-10">
                                  <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                      <div class="form-control" data-trigger="fileinput">
                                          <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                          <span class="fileinput-filename"></span>
                                      </div>
                                      <span class="input-group-addon file-btn btn-default btn-file">
                                                                  <span class="fileinput-new">Chọn file</span>

                                                                  <input name="logo_img" type="file" name="...">
                                                              
                                                                </span>
                                  </div>
                              </div>
                          </div>


                          <div class="form-group row">
                              <div class="col-sm-8 col-sm-offset-2">
                                  <img src="/{{ $setting->favicon_path }}" class="img img-thumbnail"/>
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
            </div>
        </div>

    </div>
</div>


  <!-------------------------->

@stop
@section('js')
    <script src="/vendors/jasny-bootstrap/jasny-bootstrap.min.js"></script>
@stop
