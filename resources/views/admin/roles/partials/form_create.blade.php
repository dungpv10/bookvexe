<div class="card" style="display: none;" id="createForm">
    <div class="card-header" id="heading">
        <h5 class="mb-0">
            {!! Form::text('insert[name]', '', [
                'class' => 'form-control',

            ]) !!}
        </h5>
    </div>

    <div id="collapse" class="" aria-labelledby="heading"
         data-parent="#accordionExample">
        <div class="card-body">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>
                        Tên module
                    </th>
                    <th>
                        Thao tác
                    </th>
                </tr>
                </thead>
                @foreach($modules as $keyModule => $module)
                    <tr>
                        <td>{{ $module }}</td>
                        <td>
                            <input value="{{$keyModule}}" name="insert[module_ids][]"
                                   type="checkbox"
                            />
                        </td>
                    </tr>
                @endforeach
            </table>

        </div>
    </div>
</div>
