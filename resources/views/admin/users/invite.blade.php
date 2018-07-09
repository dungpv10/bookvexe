@extends('admin.dashboard')

@section('content')
    
    <section class="content-header">
        <!--section starts-->
        <h1>Users</h1>
        <ol class="breadcrumb">
            <li>
                <a href="/admin/dashboard">
                    <i class="livicon" data-name="home" data-size="14" data-c="#000" data-loop="true"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('users.index') }}">Users</a>
            </li>
            <li class="active">Invite User</li>
        </ol>
    </section>

    <section class="content">

        @include('includes.alert')

        <div class="row">
            <form method="POST" action="/admin/users/invite">
                {!! csrf_field() !!}

                <div class="row">
                    <div class="col-md-6">
                        @input_maker_label('Email')
                        @input_maker_create('email', ['type' => 'string'])
                    </div>
                    <div class="col-md-6">
                        @input_maker_label('Name')
                        @input_maker_create('name', ['type' => 'string'])
                    </div>
                </div>

                <div class="row tex-center">
                    <div class="col-md-6">
                        @input_maker_label('Role')
                        @input_maker_create('roles', ['type' => 'relationship', 'model' => 'App\Models\Role', 'label' => 'label', 'value' => 'name'])
                    </div>
                    <br />
                    <div class="col-md-6">
                        <a class="btn btn-default" href="{{ URL::previous() }}">Cancel</a>
                        <button class="btn btn-primary" type="submit">Save</button>
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

