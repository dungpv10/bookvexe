<div class="row">
    <div class="col-md-12">
        <div class="box box-warning">
            <form method="POST" action="{{ route('users.store') }}" id="frmCreateUser">
                <div class="row">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                    <div class="row form-group">
                        <label for="Email">Họ và tên</label>
                        <input id="email" class="form-control" type="text" name="name" value="" placeholder="ex : Nguyễn Văn A">
                    </div>


                    <div class="row form-group">
                        <label for="Email">Tên đăng nhập</label>
                        <input id="username" class="form-control" type="text" name="username" value="" placeholder="ex : customer">
                    </div>


                    <div class="row form-group">
                        <label for="Email">Email</label>
                        <input id="email" class="form-control" type="email" name="email" value="" placeholder="abc@gmail.com">
                    </div>
                    @if(Gate::allows('admin'))

                        <div class="row form-group hidden" id="slect_agent">

                            <label for="team_id">Agent</label>
                            <select class="form-control" id="team_id" name="team_id">
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row form-group">
                            <label for="Role">Quyền</label>
                            {!! Form::select('roles', $roles, '', ['class' => 'form-control', 'id' => 'roles']) !!}
                        </div>

                    @endif
                    <div class="row text-center">
                        <button class="btn btn-primary" id="addUser" type="submit"><i class="fa fa-check" aria-hidden="true"></i>Tạo
                            mới
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
