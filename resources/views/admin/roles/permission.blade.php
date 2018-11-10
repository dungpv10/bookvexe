@extends('admin.layouts.master_layout')

@section('content')
    <div class="breadcomb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border margin-bottom-10">
                            <h3 class="box-title">Danh sách Quyền</h3>
                            <button type="button" class="btn btn-primary" id="createRoleBtn">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>Thêm mới
                            </button>
                        </div>

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
                            {!! Form::submit('Cập nhật', ['class' => 'btn btn-success']) !!}
                        </div>
                        {!! Form::close() !!}
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
    </script>
@stop
