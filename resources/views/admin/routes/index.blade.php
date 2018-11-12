@extends('admin.layouts.master_layout')

@section('content')
    
    <div class="breadcomb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcomb-list">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="selectpicker" id="bus_id">
                                        <option value="">Chọn xe</option>
                                        @foreach($buses as $bus)
                                            <option value="{{ $bus->id }}">{{ $bus->bus_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="selectpicker" id="route_id">
                                        <option value="">Chọn Tuyến</option>
                                        @foreach($routes as $route)
                                            <option value="{{ $route->id }}">{{ $route->route_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @if(Gate::allows('admin'))
                                <button type="button" class="btn btn-primary" id="createRouteBtn">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>Thêm mới
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <h2>Danh sách tuyến</h2>
                            <p>
                                Dưới đây là danh sách các tuyến thuộc quyền quản lý của bạn
                            </p>
                        </div>
                        <div class="table-responsive">

                            <table class="table table-striped" id="route_table">

                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="modal fade bd-example-modal-lg" id="registerRouteModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="box-title">Tạo mới tuyến</h3>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('routes.store') }}" id="frmCreateRoute">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label for="route_name">Tuyến</label>
                            <div class="nk-int-st">
                                <input id="route_name" class="form-control" type="text" name="route_name" 
                                value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bus_id">Xe</label>
                            <select class="selectpicker" name="bus_id" id="bus_id">
                                <option value="">Chọn Xe</option>
                                @foreach($buses as $bus)
                                <option value="{{ $bus->id }}" >{{ $bus->bus_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="price">Giá</label>
                            <div class="nk-int-st">
                                <input id="price" class="form-control" type="number" name="price" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="from_place">Điểm đi</label>
                            <div class="nk-int-st">
                                <input id="from_place" class="form-control geo_location" type="text" name="from_place" value="">
                                <div class="wrap_location_from_place"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="arrived_place">Điểm đến</label>
                            <div class="nk-int-st">
                                <input id="arrived_place" class="form-control geo_location" type="text" name="arrived_place" value="">
                                <div class="wrap_location_arrived_place"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="start_time">Giờ đi</label>
                            <div class="input-group date datetimepicker" style="width: 100%">
                                <div class="nk-int-st">
                                    <input id="start_time" class="form-control" type="text" name="start_time"
                                       value="" placeholder="Thời gian bắt đầu" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="arrived_time">Giờ đến</label>
                            <div class="input-group date datetimepicker" style="width: 100%">
                                <div class="nk-int-st">
                                    <input id="arrived_time" class="form-control" type="text" name="arrived_time"
                                       value="" placeholder="Thời gian kết thúc" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                            <button class="btn btn-primary waves-effect" type="submit"><i class="fa fa-check" aria-hidden="true"></i>Thêm mới</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade bd-example-modal-lg" id="editRouteModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="box-title">Sửa thông tin tuyến </h3>
                </div>
                <div class="modal-body">
                    <form method="POST" action="" id="frmEditRoute">
                        <input name="_method" type="hidden" value="PATCH">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <div class="form-group">
                            <label for="route_name_edit">Tuyến</label>
                            <div class="nk-int-st">
                                <input id="route_name_edit" class="form-control" type="text" name="route_name" 
                                value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Role">Xe</label>
                            <select class="selectpicker" name="bus_id" id="bus_id_edit">
                                <option value="">Chọn Xe</option>
                                @foreach($buses as $bus)
                                <option value="{{ $bus->id }}" >{{ $bus->bus_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="price">Giá</label>
                            <div class="nk-int-st">
                                <input id="price_edit" class="form-control" type="number" name="price" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="from_place">Điểm đi</label>
                            <div class="nk-int-st">
                                <input id="from_place_edit" class="form-control geo_location" type="text" name="from_place" value="">
                                <div class="wrap_location_from_place_edit"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="arrived_place">Điểm đến</label>
                            <div class="nk-int-st">
                                <input id="arrived_place_edit" class="form-control geo_location" type="text" name="arrived_place" value="">
                                <div class="wrap_location_arrived_place_edit"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="start_time">Giờ đi</label>
                            <div class="input-group date datetimepicker" style="width: 100%">
                                <div class="nk-int-st">
                                    <input id="start_time_edit" class="form-control" type="text" name="start_time"
                                       value="" placeholder="Thời gian bắt đầu" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="arrived_time">Giờ đến</label>
                            <div class="input-group date datetimepicker" style="width: 100%;">
                                <div class="nk-int-st">
                                    <input id="arrived_time_edit" class="form-control" type="text" name="arrived_time"
                                       value="" placeholder="Thời gian kết thúc" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                            <button class="btn btn-primary waves-effect" type="submit"><i class="fa fa-check" aria-hidden="true"></i>Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop
@section('js')
    <script type="text/javascript">
    var routeTable;
    var dataLocation = function( request, response ) {
        $.ajax({
            url: "http://ws.geonames.org/searchJSON",
            dataType: "jsonp",
            data: {
                style: "MEDIUM",
                maxRows: 10,
                featureClass: "P",
                country: "VN,KH",
                name: request.term,
                username: "vuvanky"
            },
            success: function( data ) {
                response( $.map( data.geonames, function( item ) {
                    return {
                        label: item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryCode,
                        value: item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryCode,
                        lat: item.lat,
                        lng: item.lng
                    }
                }));
            }
        });
    };
    $(function() {
        $(".datetimepicker input").timepicker();

        $( "#from_place" ).autocomplete({
            source: dataLocation,
            minLength: 0,
            delay: 0,
            appendTo: ".wrap_location_from_place",
            close: function() {
                //UI plugin not removing loading gif, lets force it
                $( '#from_place' ).removeClass( "ui-autocomplete-loading" );
            }
        });

        $( "#arrived_place" ).autocomplete({
            source: dataLocation,
            minLength: 0,
            delay: 0,
            appendTo: ".wrap_location_arrived_place",
            close: function() {
                //UI plugin not removing loading gif, lets force it
                $( '#arrived_place' ).removeClass( "ui-autocomplete-loading" );
            }
        });

        $( "#from_place_edit" ).autocomplete({
            source: dataLocation,
            minLength: 0,
            delay: 0,
            appendTo: ".wrap_location_from_place_edit",
            close: function() {
                //UI plugin not removing loading gif, lets force it
                $( '#from_place_edit' ).removeClass( "ui-autocomplete-loading" );
            }
        });

        $( "#arrived_place_edit" ).autocomplete({
            source: dataLocation,
            minLength: 0,
            delay: 0,
            appendTo: ".wrap_location_arrived_place_edit",
            close: function() {
                //UI plugin not removing loading gif, lets force it
                $( '#from_place_edit' ).removeClass( "ui-autocomplete-loading" );
            }
        });

        $('#bus_id').on('change', function(){
            if ($(this).val() !="") {
                routeTable.ajax.reload();
                $('#route_id').val("").change();
            }
        });
        $('#route_id').on('change', function(){
            if ($(this).val() !="") {
                routeTable.ajax.reload();
                $('#bus_id').val("").change();
            }
        });

        routeTable = $('#route_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                "url": '{!! route('routes.datatable') !!}',
                "method": "POST",
                "data": function ( d ) {
                    d.bus_id = $('#bus_id').val();
                    d.route_id = $('#route_id').val();
                }
            },
            columns: [
                { data: 'id', name: 'id', searchable: false, title: 'ID' },
                { data: 'route_name', name: 'route_name', title: 'Tên' },
                { data: 'price', name: 'price', title: 'Giá' },
                { data: 'from_place', name: 'from_place', title: 'Bắt đầu' },
                { data: 'arrived_place', name: 'arrived_place', title: 'Kết thúc'},
                { data: 'userCreate', name: 'userCreate', title: 'Người tạo'},
                { data: 'updateUser', name: 'updateUser', title: 'Người cập nhật'},

                { data: 'start_time', name: 'start_time', title: 'Giờ đi',
                    render: function(data, type, row, meta){
                        var element = data.split(":");
                        if (element.length > 2){
                            return element[0] + ':' + element[1];
                        }
                        return data;
                    }
                },
                { data: 'arrived_time', name: 'arrived_time', title: 'Giờ đến',
                    render: function(data, type, row, meta){
                        var element = data.split(":");
                        if (element.length > 2){
                            return element[0] + ':' + element[1];
                        }
                        return data;
                    }
                },
                { data: 'busName', name: 'buses.bus_name', title: 'Bus'},
                { data: 'created_at', name: 'created_at', title: 'Ngày tạo'},
                { data: 'updated_at', name: 'updated_at', title: 'Ngày cập nhật'},
                { data: 'id', name: 'id', title: 'Thao Tác', searchable: false,className: 'text-center', "orderable": false,
                    visible: visible,
                    render: function(data, type, row, meta){
                        var routeId = "'" + row['id'] + "'";
                        let actionLink = '<a href="javascript:;" data-toggle="tooltip" title="Xoá '+ row['route_name'] +'!" onclick="deleteRouteById('+ routeId +')"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                        actionLink += '&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="editRoute('+ routeId +')" data-toggle="tooltip" title="Sửa '+ row['route_name'] +'!" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                        return actionLink;
                    }
                }
            ]
        });

        validateSetup('frmEditRoute');

        validateSetup('frmCreateRoute');

    });
    function deleteRouteById(id) {
        swal({
            title: "Bạn có muốn xóa tuyến  này?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: 'Bỏ qua',
            confirmButtonText: "Đồng ý",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: window.location.origin + '/admin/routes/' + id,
                    method: 'DELETE'
                }).success(function(data){
                    console.log(data);
                    if(data.code == 200)
                    {
                        swal(
                          'Đã Xoá!',
                          'Bạn đã xoá thành công tuyến !',
                          'success'
                        ).then(function(){
                            routeTable.ajax.reload();
                        })
                    }
                    else {
                        swal(
                            'Thất bại',
                            'Thao tác thất bại',
                            'error'
                        ).then(function(){
                            routeTable.ajax.reload();
                        })
                    }
                }).error(function(data){
                    swal(
                        'Thất bại',
                        'Thao tác thất bại',
                        'error'
                    ).then(function(){
                        routeTable.ajax.reload();
                    })
                });
            // result.dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
            } else if (result.dismiss === 'cancel') {
              swal(
                'Bỏ Qua',
                'Bạn đã không xoá tuyến  nữa',
                'error'
              )
            }
          });
    }


    var createRouter = "{{ route('routes.create') }}";

    $('#createRouteBtn').on('click', function () {
        $('#registerRouteModal').modal('show');
    });

    function validateSetup(formId) {
        $('#' + formId).bootstrapValidator({
            message: 'Dữ liệu nhập không đúng',
            fields: {
                route_name: {
                    message: 'Tên không đúng định dạng',
                    validators: {
                        notEmpty: {
                            message: 'Tên không được trống'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'Tên dài từ 6 tớ 30 ký tự'
                        }
                    }
                },
                from_place: {
                    message: 'Điểm đi không đúng định dạng',
                    validators: {
                        notEmpty: {
                            message: 'Điểm đi không được trống'
                        },
                        // stringLength: {
                        //     min: 6,
                        //     max: 30,
                        //     message: 'Điểm đi dài từ 6 tớ 30 ký tự'
                        // }
                    },
                    callback: {
                        message: 'Điểm đi và điểm đến phải khác nhau',
                        callback: function() {
                            const start = $('#from_place').val().trim();
                            const end = $('#arrived_place').val().trim();
                            if (end != "" && end != "") {
                                return start != end;
                            }
                            return true;
                        }
                    }
                },
                arrived_place: {
                    message: 'Điểm đến không đúng định dạng',
                    validators: {
                        notEmpty: {
                            message: 'Điểm đến không được trống'
                        },
                        // stringLength: {
                        //     min: 6,
                        //     max: 30,
                        //     message: 'Điểm đến dài từ 6 tớ 30 ký tự'
                        // },
                        callback: {
                            message: 'Điểm đi và điểm đến phải khác nhau',
                            callback: function() {
                                const start = $('#from_place').val().trim();
                                const end = $('#arrived_place').val().trim();
                                if (end != "" && end != "") {
                                    return start != end;
                                }
                                return true;
                            }
                        }
                    }
                },
                start_time: {
                    message: 'Giờ đi không đúng định dạng',
                    validators: {
                        notEmpty: {
                            message: 'Điểm đi không được trống'
                        },
                        // callback: {
                        //     message: 'Giờ đi phải nhỏ hơn giờ đến',
                        //     callback: function() {
                        //         const start = $('#start_time').val();
                        //         const end = $('#arrived_time').val();
                        //         if (end > 0 && end != "") {
                        //             return parseFloat(end) > parseFloat(start);
                        //         }
                        //         return true;
                        //     }
                        // }
                    }
                },
                arrived_time: {
                    message: 'Giờ đến không đúng định dạng',
                    validators: {
                        notEmpty: {
                            message: 'Điểm đến không được trống'
                        },
                        // callback: {
                        //     message: 'Giờ đến phải lớn hơn giờ đi',
                        //     callback: function() {
                        //         const start = $('#start_time').val();
                        //         const end = $('#arrived_time').val();
                        //         return parseFloat(end) > parseFloat(start);
                        //     }
                        // }
                    }
                },
                price: {
                    message: 'Giá không đúng định dạng',
                    validators: {
                        notEmpty: {
                            message: 'Giá không được trống'
                        },
                        numeric: {
                            message: 'Giá phải là số'
                        },
                        callback: {
                            message: 'Giá phải lớn hơn 0',
                            callback: function() {
                                const p = $('#price').val();
                                return p > 0;
                            }
                        }
                    }
                },
                bus: {
                    validators: {
                        notEmpty: {
                            message: 'Xe không được rỗng'
                        },
                    }
                }
            }
        });
    }

    function editRoute(rId) {
        $.ajax({
                url: '{!! route("routes.index") !!}' +'/'+ rId + '/edit',
                method: 'GET'
            }).success(function(response){
                if (response.code == 200) {
                    $('#editRouteModal').find('form').attr('action', window.location.origin + '/admin/routes/' + rId );
                    $('#route_name_edit').val(response.data.route_name);
                    $('#bus_id_edit').val(response.data.bus_id).selectpicker('refresh');
                    $('#price_edit').val(response.data.price);
                    $('#from_place_edit').val(response.data.from_place);
                    $('#arrived_place_edit').val(response.data.arrived_place);
                    $('#start_time_edit').val(response.data.start_time);
                    $('#arrived_time_edit').val(response.data.arrived_time);
                    $("#editRouteModal").modal();
                } else {
                    swal(
                        'Thất bại',
                        'Thao tác thất bại',
                        'error'
                    );
                }
            }).error(function(data){

            });
    }

    </script>
@stop
