@extends('auth.layouts')

@section('content')
    <div id="login" class="animate form">
        <form action="{{ route('agents.post.setting') }}" autocomplete="on" method="post">
            <h3 class="black_bg">
                <img src="/img/logo.png" alt="josh logo">
            </h3>
            <p>
                @include('includes.alert')
            </p>

            <p>
                <label style="margin-bottom:0px;" for="agent_address" class="agent_address"> <i class="livicon"
                                                                                                data-name="key"
                                                                                                data-size="16"
                                                                                                data-loop="true"
                                                                                                data-c="#3c8dbc"
                                                                                                data-hc="#3c8dbc"></i>
                    Tên nhà xe
                </label>
                <input id="agent_license" name="agent_name" required type="text" value="{{ auth()->user()->agent->agent_name }}" />
            </p>


            <p>
                {!! csrf_field() !!}
                <label style="margin-bottom:0px;" for="username" class="uname"> <i class="livicon"
                                                                                   data-name="user"
                                                                                   data-size="16"
                                                                                   data-loop="true"
                                                                                   data-c="#3c8dbc"
                                                                                   data-hc="#3c8dbc"></i>
                    Địa chỉ nhà xe
                </label>
                <input id="agent_address" value="{{ auth()->user()->agent->agent_address }}" name="agent_address" required type="text" placeholder="Địa chỉ nhà xe" />
            </p>
            <p>
                <label style="margin-bottom:0px;" for="agent_address" class="agent_address"> <i class="livicon"
                                                                                       data-name="key"
                                                                                       data-size="16"
                                                                                       data-loop="true"
                                                                                       data-c="#3c8dbc"
                                                                                       data-hc="#3c8dbc"></i>
                    Mã số thuế
                </label>
                <input id="agent_license" name="agent_license" required type="text" value="{{ auth()->user()->agent->agent_license }}"
                       placeholder="MST001"/>
            </p>

            <p class="login button">
                <input type="submit" value="Cập nhật" class="btn btn-success"/>
            </p>

        </form>
    </div>
@stop

