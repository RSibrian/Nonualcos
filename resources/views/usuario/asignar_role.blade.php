@extends ('plantilla')
@section('plantilla')
    <style>
        /* Hidding the radiobuttons &amp; checkboxes */
        input[type="radio"], input[type="checkbox"] {
            display: none;
        }
        /* Styling background */
        label i:first-child {
            color: gray;
        }
        /* Hidding the "check" status of inputs */
        input[type="radio"] + label .fa-circle,
        input[type="checkbox"] + label .fa-check  {
            display: none;
        }
        /* Styling the "check" status */
        input[type="radio"]:checked + label .fa-circle,
        input[type="checkbox"]:checked + label .fa-check {
            display: block;
            color: DarkTurquoise;
        }
        /* Styling checkboxes */
        input[type="checkbox"]:checked + label .fa-check {
            position: relative;
            left: .125em;
            bottom: .125em;
        }
        /* Styling radiobuttons */
        input[type="radio"]:checked + label .fa-circle-o {
            display: none;
        }
    </style>
	<div class="row">
    <div class="col-md-1"></div>
	    <div class="col-md-10">
	        <div class="card">
	            <div class="card-header card-header-icon" data-background-color="green">
	                <i class="material-icons">perm_identity</i>
	            </div>
	            <div class="card-content">
	                <h4 class="card-title">Usuario -
	                    <small class="category">Asignar Roles a <b>{{ $user->name }}</b></small>
	                </h4>
                    {!!Form::model($user,['method'=>'PUT','route'=>['users.updaterole',$user->id]])!!}
                    <h3>Lista de Roles</h3>
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>

                                </tr>
                                </tfoot>
                                <tbody>
                            @foreach($roles as $role)
                                    <tr>
                                        <td>
                                            {{ Form::checkbox('roles[]',$role->id,null,[ 'id'=>"check{$role->id}"]) }}
                                            <label for="check{{$role->id}}">
                                                <h3><span class="fa-stack">
                                                    <i class="fa fa-square-o fa-stack-1x"></i>
                                                    <i class="fa fa-check fa-stack-1x"></i>
                                                </span></h3>
                                            </label>
                                        </td>
                                        <td>
                                            <h4>{{ $role->name }}
                                                &nbsp;
                                            </h4>
                                        </td>
                                        <td>
                                            ({{ $role->description ?: "Sin Descripción" }})
                                        </td>
                                    </tr>
                            @endforeach
                                <tbody>
                        </table>
                        </div>

                    <div align="center">
                      {!! Form::submit('Registrar',['class'=>'btn  btn-verde glyphicon glyphicon-floppy-disk']) !!}
                      {!! Form::reset('Limpiar',['class'=>'btn btn-azul']) !!}
                      <a href="{{ URL::previous() }}" class='btn btn-ocre '>Regresar</a>
                    </div>
					{!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>


@stop



@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatables').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records",
                }

            });


            var table = $('#datatables').DataTable();

            // Edit record
            table.on('click', '.edit', function() {
                $tr = $(this).closest('tr');

                var data = table.row($tr).data();
                alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
            });

            // Delete a record
            table.on('click', '.remove', function(e) {
                $tr = $(this).closest('tr');
                table.row($tr).remove().draw();
                e.preventDefault();
            });

            //Like record
            table.on('click', '.like', function() {
                alert('You clicked on Like button');
            });

            $('.card .material-datatables label').addClass('form-group');
        });
    </script>
@endsection
