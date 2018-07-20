<div class="row">
    <div class="col-md-12">
        <div class="box box-warning">
            <form action="/admin/roles" method="post" id="frmCreaterRole">
                {{ csrf_field() }}
                <div class="row">
                    <div class="row form-group">
                        <label for="name">Tên</label>
                        <input id="name" class="form-control" type="text" name="name" value="">
                    </div>


                    <div class="row form-group">
                        <label for="label">Label</label>
                        <input id="label" class="form-control" type="text" name="label" value="">
                    </div>

                    <div class="row form-group">
                        <label>Quyền</label>
                        <div class="row col-md-12">
                            @foreach(Config::get('permissions', []) as $permission => $name)
                                <label class="checkbox-inline" for="{{ $name }}">
                                    <input type="checkbox" name="permissions[{{ $permission }}]" id="{{ $name }}">
                                    {{ $name }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="row text-center">
                        <button class="btn btn-primary" id="addRole" type="submit"><i class="fa fa-check" aria-hidden="true"></i>Tạo
                            mới
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

