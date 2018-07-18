<div class="row">
    <div class="col-md-12">
        <div class="box box-warning">
            <form action="{{ route('bus-type.store') }}" method="POST" enctype="multipart/form-data"
                  id="frmCreateNewBusType">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="box-body">
                    <div class="form-group">
                        <label for="bus_type_name">Kiểu xe bus</label>
                        <input type="text" class="form-control" name="bus_type_name"
                               data-parsley-pattern="^[a-zA-Z\ . ! @ # $ % ^ &amp; * () + = , \/]+$"
                               id="bus_type_name" placeholder="Nhập kiểu xe bus" required>
                    </div>
                    <button type="button" onclick="createBusType()" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i>Thêm mới</button>
                </div>
            </form>
        </div>
    </div>
</div>