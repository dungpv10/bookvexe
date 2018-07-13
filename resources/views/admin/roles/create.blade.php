@extends('admin.layouts.dashboard')

@section('content')

    <div class="col-md-12">
        <form action="/admin/roles" method="post">
            {{ csrf_field() }}
            <!-- Name input-->
            <div class="row form-group">
                <label class="col-md-1 control-label" for="name">Name</label>
                <div class="col-md-5">
                    <input id="name" name="name" value="{{ old('name') }}" type="text" class="form-control">
                </div>
            </div>
            <!-- Email input-->
            <div class="row form-group">
                <label class="col-md-1 control-label" for="label">Label</label>
                <div class="col-md-5">
                    <input id="label" value="{{ old('label') }}" name="label" type="label" class="form-control">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-12">
                    <b>Permission</b>
                </div>
                @foreach(Config::get('permissions', []) as $permission => $name)
                    <div class="col-md-2">
                        <label for="{{ $name }}">
                            <input type="checkbox" name="permissions[{{ $permission }}]" id="{{ $name }}">
                            {{ $name }}
                        </label>
                    </div>
                @endforeach
            </div>
            <!-- Form actions -->
            <div class="form-group">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-responsive btn-info btn-sm">Save</button>
                </div>
            </div>
        </form>
    </div>

@stop
@section('js')
    <script type="text/javascript">
    </script>
@stop
