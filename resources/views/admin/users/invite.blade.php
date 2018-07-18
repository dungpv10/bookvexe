@extends('admin.layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
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
                            @input_maker_create('roles', ['type' => 'relationship', 'model' => 'App\Models\Role',
                            'label' => 'label', 'value' => 'name'])
                        </div>
                        <br/>
                        <div class="col-md-6">
                            <a class="btn btn-default" href="{{ URL::previous() }}">Cancel</a>
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script type="text/javascript">
    </script>
@stop

