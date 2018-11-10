@extends('admin.layouts.master_layout')

@section('content')

<div class="breadcomb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcomb-list">
                    <div class="row">
                        <div class="col-md-3">
                          <h3 class="box-title">Danh sách Quyền</h3>
                          <button type="button" class="btn btn-primary" id="createRoleBtn">
                              <i class="fa fa-plus-circle" aria-hidden="true"></i>Thêm mới
                          </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <h2>Danh sách quyền</h2>
                            <p>
                                Dưới đây là danh sách các xe thuộc quyền quản lý của bạn
                            </p>
                        </div>
                        <div class="table-responsive">

                          {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}
                          @include('admin.roles.partials.form_create')
                          <div class="accordion" id="accordionExample">

                              @foreach($roles as $key => $role)
                                  <input type="hidden" value="{{ $role->id }}" name="{{$role->name}}[id]"/>
                                  <div class="card">
                                      <div class="card-header" id="heading{{$key}}">
                                          <h5 class="mb-0">
                                              {!! Form::text($role->name . '[name]', $role->name, [
                                                  'class' => 'form-control',
                                                  'data-target' => '#collapse' . $key,
                                                  'data-toggle' => "collapse",
                                                  'aria-expanded' => 'false',
                                                  'aria-controls' => 'collapse' . $key
                                              ]) !!}
                                          </h5>
                                      </div>

                                      <div id="collapse{{$key}}" class="collapse" aria-labelledby="heading{{$key}}"
                                           data-parent="#accordionExample">
                                          <div class="card-body">

                                              <table class="table table-striped">
                                                  <thead>
                                                  <tr>
                                                      <th>
                                                          Tên module
                                                      </th>
                                                      <th>
                                                          Thao tác
                                                      </th>
                                                  </tr>
                                                  </thead>
                                                  @foreach($modules as $keyModule => $module)
                                                      <tr>
                                                          <td><label for="{{$role->name}}_{{$keyModule}}">{{ $module }}</label>
                                                          </td>
                                                          <td>
                                                              <input value="{{$keyModule}}" name="{{$role->name}}[module_ids][]"
                                                                     id="{{$role->name}}_{{$keyModule}}"
                                                                     type="checkbox"
                                                                     @if(in_array($keyModule, $role->module_ids_as_array)) checked @endif />
                                                          </td>
                                                      </tr>
                                                  @endforeach
                                              </table>

                                          </div>
                                      </div>
                                  </div>
                              @endforeach

                          </div>
                          <div>
                              {!! Form::button('Cập nhật', ['class' => 'btn btn-primary', 'id' => 'submitBtn']) !!}
                          </div>
                          {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>





    <div class="modal fade bd-example-modal-lg" id="registerRole" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="box-title">Tạo mới Quyền</h3>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script type="text/javascript">
        $('#createRoleBtn').on('click', function (e) {
            e.preventDefault();
            $('#createForm').toggle('normal');
        });

        $('#submitBtn').on('click', function(){
            $(this).parents('form').submit();
        });
    </script>
@stop
