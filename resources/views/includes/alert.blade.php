<div class="row">
@if (session('success') || session('status'))
	<div class="alert alert-success alert-dismissable">
		@if (session('status'))
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		    <strong></strong> {{ session('status') }}
		@else
		    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		    <strong></strong> {{ session('success') }}
		@endif
	</div>
@endif
@if (session('err') || session('errors'))
	<div class="alert alert-danger  alert-dismissable">
	@if (session('errors'))
		<ul>
		    @foreach ($errors->all() as $error)
		    	<li>{{ $error }}</li>

		    @endforeach
		</ul>
	@else
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Thất bại!</strong> {{ session('err') }}
	@endif
	</div>
@endif
@if (session('info'))
<div class="alert alert-info alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Thông báo!</strong> {{ session('info') }}
</div>
@endif
</div>
