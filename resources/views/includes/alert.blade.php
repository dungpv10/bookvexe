<div class="row">
@if (session('success') || session('status'))
	<div class="alert alert-success alert-dismissable">
		@if (session('status'))
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		    <strong>Thành công!</strong> {{ session('status') }}
		@else
		    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		    <strong>Thành công!</strong> {{ session('success') }}
		@endif
	</div>
@endif
@if (session('err') || session('errors'))
	@if (session('errors'))
		<ul>
		    @foreach ($errors->all() as $error)
		        <li style="color:red">{{ $error }}</li>
		    @endforeach
		</ul>
	@else
	<div class="alert alert-danger  alert-dismissable">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Thất bại!</strong> {{ session('err') }}
	</div>
	@endif
@endif
@if (session('info'))
<div class="alert alert-info alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Thông báo!</strong> {{ session('info') }}
</div>
@endif
</div>