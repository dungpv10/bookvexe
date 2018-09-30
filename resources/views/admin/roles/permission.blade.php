@extends('admin.layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border margin-bottom-10">
                    <h3 class="box-title">Danh sách Quyền</h3>
                    <button type="button" class="btn btn-primary" id="createRoleBtn">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>Thêm mới
                    </button>
                    <button class="btn btn-danger" type="button" onclick="deleteManyRow()">
                        <i class="fa fa-trash" aria-hidden="true"></i> Xóa nhiều
                    </button>
                </div>

                {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}
                    <div class="accordion" id="accordionExample">
                    @foreach($roles as $key => $role)
                        <input type="hidden" value="{{ $role->id }}" name="{{$role->name}}[id]" />
                        <div class="card">
                            <div class="card-header" id="heading{{$key}}">
                                <h5 class="mb-0">
                                    <button class="btn btn-primary" style="width: 100%; text-transform: uppercase;" type="button" data-toggle="collapse"
                                            data-target="#collapse{{$key}}" aria-expanded="false" aria-controls="collapse{{$key}}">
                                        {{ $role->name }}
                                    </button>
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
                                                    <td>{{ $module }}</td>
                                                    <td>
                                                        <input value="1" name="{{$role->name}}[module_ids][]" type="checkbox" @if(in_array($keyModule, $role->module_ids_as_array)) checked @endif />
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
    </script>
@stop
