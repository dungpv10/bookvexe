<div class="row">
    <div class="col-md-12">
        <div class="box box-warning">
            <form method="POST" action="{{ route('users.store') }}" id="frmCreateUser">
                <div class="row">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                    <div class="row form-group">
                        <label for="Email">Họ và tên</label>
                        <input id="email" class="form-control" type="text" name="name" value="" placeholder="ex : Nguyễn Văn A"
                               required>
                    </div>


                    <div class="row form-group">
                        <label for="Email">Tên đăng nhập</label>
                        <input id="username" class="form-control" type="text" name="username" value="" placeholder="ex : customer"
                               required>
                    </div>


                    <div class="row form-group">
                        <label for="Email">Email</label>
                        <input id="email" class="form-control" type="email" name="email" value="" placeholder="abc@gmail.com"
                               required>
                    </div>

                    <div class="row form-group">
                        <label for="Role">Quyền</label>
                        {!! Form::select('roles', $roles, '', ['class' => 'form-control', 'id' => 'roles']) !!}
                    </div>

                    <div class="row text-center">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-check" aria-hidden="true"></i>Tạo
                            mới
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
