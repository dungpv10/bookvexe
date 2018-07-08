<br />
<br />
<br />
<div class="row">
@if (session('success'))
<div class="alert alert-success alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Thành công!</strong> {{ session('success') }}
</div>
@endif
@if (session('err'))
<div class="alert alert-danger  alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Thất bại!</strong> {{ session('err') }}
</div>
@endif
@if (session('info'))
<div class="alert alert-info alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Thông báo!</strong> {{ session('info') }}
</div>
@endif
</div>