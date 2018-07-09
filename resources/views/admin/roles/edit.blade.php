@extends('admin.dashboard')

@section('content')
    
    <section class="content-header">
        <!--section starts-->
        <h1>Roles</h1>
        <ol class="breadcrumb">
            <li>
                <a href="/admin/dashboard">
                    <i class="livicon" data-name="home" data-size="14" data-c="#000" data-loop="true"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('roles.index') }}">Roles</a>
            </li>
            <li class="active">Edit</li>
        </ol>
    </section>

    <section class="content">
        @include('includes.alert')
        <div class="row">
            <form action="/admin/roles/{{ $role->id }}" method="post">
                <input name="_method" type="hidden" value="PATCH">
                {{ csrf_field() }}
                <!-- Name input-->
                <div class="row form-group">
                    <label class="col-md-1 control-label" for="name">Name</label>
                    <div class="col-md-5">
                        <input id="name" name="name" type="text" value="{{ $role->name }}" class="form-control">
                    </div>
                </div>
                <!-- Email input-->
                <div class="row form-group">
                    <label class="col-md-1 control-label" for="label">Label</label>
                    <div class="col-md-5">
                        <input id="label" name="label" value="{{ $role->label }}" type="label" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <b>Permission</b>
                    </div>
                    @foreach(Config::get('permissions', []) as $permission => $name)
                        <div class="col-md-2">
                           <label for="{{ $name }}">
                                @if (stristr($role->permissions, $permission))
                                    <input type="checkbox" name="permissions[{{ $permission }}]" id="{{ $name }}" checked>
                                @else
                                    <input type="checkbox" name="permissions[{{ $permission }}]" id="{{ $name }}">
                                @endif
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
    </section>
@stop
@section('js')
    <script type="text/javascript">
    </script>
@stop