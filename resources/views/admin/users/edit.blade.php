<div class="box box-warning">
<form method="POST" action="{{ route('users.update', $user->id) }}" id="frmEditUser">
    <input name="_method" type="hidden" value="PATCH">
    <input type="hidden" name="_token" value="{{csrf_token()}}">

    <div class="row form-group">
        <label for="Email">Email</label>
        <input id="email" class="form-control" type="email" name="email" value="{{ $user->email }}">
    </div>

    <div class="row form-group">
        <label for="name">Họ tên</label>
        <input id="name" class="form-control" type="text" name="name" value="{{ $user->name }}">
    </div>
    <div class="row form-group">
        <label for="username">Tên đăng nhập</label>
        <input id="username" class="form-control" type="text" name="username" value="{{ $user->username }}">
    </div>
    <div class="row">
        <label for="dob">Ngày sinh</label>
        <div class="form-group">
            <div class='input-group date datetimepicker'>
                <input type='text' value="{{ $user->dob }}" name="dob" id="dob" class="form-control" />
                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                </span>
            </div>
        </div>
    </div>
    <div class="row form-group">
        <label for="mobile">Số điện thoại</label>
        <input id="mobile" class="form-control" type="text" name="mobile" value="{{ $user->mobile }}">
    </div>
    <div class="row form-group">
        <label for="gender">Giới tính</label>
        <select id="gender" class="form-control" name="gender">
            <option value="0" {{ $user->gender == 0 ? 'selected' :'' }}>Nam</option>
            <option value="1" {{ $user->gender == 1 ? 'selected' :'' }}>Nữ</option>
        </select>
    </div>
    <div class="row form-group">
        <label for="address">Địa chỉ</label>
        <input id="address" class="form-control" type="text" name="address" value="{{ $user->address }}">
    </div>

    @if(Gate::allows('root'))
        <div class="row form-group" id="slect_agent">
            <label for="team_id">Agent</label>
            {!! Form::select('agent_id', $teams, '', ['id' => 'team_id', 'class' => 'form-control']) !!}
        </div>
    @else
        {!! Form::hidden('agent_id', auth()->user()->agent->id) !!}
    @endif
    <div class="row  form-group">
        <label for="Role">Quyền</label>
        {!! Form::select('role_id', $roles, $user->role->id, ['class' => 'form-control', 'id' => 'roles']) !!}
    </div>
    <div class="row text-center">
        <button class="btn btn-primary" type="submit"><i class="fa fa-check" aria-hidden="true"></i>Cập nhật</button>
    </div>
</form>
</div>

