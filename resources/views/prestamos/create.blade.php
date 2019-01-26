@extends ('plantilla')
@section('plantilla')
    <div class="row">
	    <div class="col-sm-offset-1 col-md-10">
	        <div class="card">

	            <div class="card-header card-header-icon" data-background-color="green">
	                <i class="material-icons">perm_identity</i>
	            </div>
	            <div class="card-content">
	                <h4 class="card-title">Préstamo -
	                    <small class="category">Registrar Solicitud Préstamo</small>
	                </h4>
                  <h6 class="campoObligatorio">los campos con ( * ) son obligatorios</h6>

					{!! Form::open(['route'=>'prestamos.store','name'=>'form1','autocomplete'=>'off','enctype'=>'multipart/form-data']) !!}
                        {{ csrf_field() }}
                        @include('prestamos.form')

                        <div  class="col-lg-12">
                          @include('prestamos.activos_prestamos.form')
                        </div>
	  					<div align="center" class="row">
                            {!! Form::submit('Registrar',['class'=>'btn  btn-verde glyphicon glyphicon-floppy-disk']) !!}

                            <a href="{{ URL::previous() }}" class='btn btn-ocre '>Regresar</a>
	  					</div>
					{!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop


@section('scripts')

{!!Html::script('js/jquery.mask.min.js')!!}
<script type="text/javascript">
    $(document).ready(function(){
        $("#dui").mask("00000000-0")
        $("#telefono").mask("0000-0000");
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        table =  $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "Todos"]
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
    function myFunction() {
        table=$('#datatables').DataTable();
        table.destroy();
        table= $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [-1],
                ["Todos"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }

        });
    }
</script>
<!-- Fin guardad sin actualizar aux -->
<script type="text/javascript">
    $().ready(function() {
        demo.initMaterialWizard();
    });
</script>

@endsection
