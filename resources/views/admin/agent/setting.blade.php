@extends('admin.layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="login" class="animate form">
                <form action="{{ route('agents.post.setting') }}" autocomplete="on" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="agent_license">Tên nhà xe</label>
                        <input id="agent_name" class="form-control" name="agent_name"  type="text" value="{{ auth()->user()->agent->agent_name }}" />
                    </div>


                    <div class="form-group">
                        {!! csrf_field() !!}
                        <label style="margin-bottom:0px;" for="agent_address" class="uname">
                            Địa chỉ nhà xe
                        </label>
                        <input id="agent_address"  class="form-control" value="{{ auth()->user()->agent->agent_address }}" name="agent_address"  type="text" placeholder="Địa chỉ nhà xe" />
                    </div>
                    <div class="form-group">
                        <label>Mã số thuế</label>
                        <input id="agent_license"  class="form-control" name="agent_license"  type="text" value="{{ auth()->user()->agent->agent_license }}"
                               placeholder="MST001"/>
                    </div>
                        <div class="form-group">
                            <label>Fax</label>
                        <input id="agent_license" class="form-control" name="agent_fax"  type="text" value="{{ auth()->user()->agent->agent_fax }}"
                               placeholder=""/>
                    </div>

                    <div class="form-group">
                            <label>Email</label>
                        <input id="agent_email" class="form-control"  name="agent_email"  type="text" value="{{ auth()->user()->agent->agent_email }}"
                               placeholder=""/>
                    </div>

                                <div class="form-group">
                        <label style="margin-bottom:0px;" for="agent_website" class="agent_website">
                            Website
                        </label>
                        <input id="agent_website"  class="form-control" name="agent_website"  type="text" value="{{ auth()->user()->agent->agent_website }}"
                               placeholder=""/>
                    </div>

                    <div class="form-group">
                        <label style="margin-bottom:0px;" for="agent_representation" class="agent_representation">
                            Tên người đại diện pháp luật
                        </label>
                        <input id="agent_representation"  class="form-control" name="agent_representation"  type="text" value="{{ auth()->user()->agent->agent_representation }}"
                               placeholder=""/>
                    </div>


                    <div class="form-group">
                        <label style="margin-bottom:0px;" for="agent_representation" class="agent_representation">
                            Logo công ty
                        </label>
                        <input type="file" class="form-control" name="logo_file"/>
                    </div>


                    <p class="login button">
                        <input type="submit" value="Cập nhật" class="btn btn-success"/>
                    </div>

                </form>
            </div>
        </div>
    </div>
@stop

