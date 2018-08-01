@extends('auth.layouts')

@section('content')
    <div id="login" class="animate form">
        <form action="{{ route('teams.post.confirm', auth()->user()->id) }}" autocomplete="on" method="post">
            <h3 class="black_bg">
                <img src="/img/logo.png" alt="josh logo">
            </h3>
            <p>
                @include('includes.alert')
            </p>
            {{ csrf_field() }}
            <div class="form-group">
                <label style="margin-bottom:0px;" for="name" class="uname">
                    Tên nhà xe
                </label>
                {!! Form::text('name', '', ['class' => 'form-control', 'style' => 'padding: 0px 5px 0px 26px;']) !!}
            </div>

            <div class="form-group">
                <label style="margin-bottom:0px;" for="address" class="uname">
                    Địa chỉ nhà xe
                </label>
                {!! Form::text('address', '', ['class' => 'form-control', 'style' => 'padding: 0px 5px 0px 26px;']) !!}
            </div>

            <div class="form-group">
                <label style="margin-bottom:0px;" for="address" class="uname">
                    Mã số thuế
                </label>
                {!! Form::text('agent_license', '', ['class' => 'form-control', 'style' => 'padding: 0px 5px 0px 26px;']) !!}
            </div>

            <p class="login button">
                <input type="submit" value="Xác nhận" class="btn btn-success"/>
            </p>

        </form>
    </div>
@stop
