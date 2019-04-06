@extends ('plantilla')
@section('plantilla')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="ocre">
                    <i class="material-icons">assignment</i>
                </div>
                <div class="card-header card-header-icon" data-background-color="azul" data-toggle="modal" data-target="#myModal">
                    <i class="material-icons">help</i>

                </div>
                <div class="card-content">
                    <h4 class="card-title"> Historial mantenimiento vehículo placa {{ $placa->numeroPlaca }}
                    </h4>

                    <div class="material-datatables">
                        <br>
                        <div class="col-sm-6">
                            <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                            </span>
                                <div class="form-group label-floating">
                                    <label class="control-label">Fecha de inicio
                                        <small >(*)</small>
                                    </label>
                                    {!! Form::hidden('placa', $placa->id, ['id' => 'placa']) !!}
                                    {!!Form::date('fechaI',$fechaInicio,['id'=>'fechaI','class'=>'form-control datepicker', 'max' => date('Y-m-d')])!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                            </span>
                                <div class="form-group label-floating">
                                    <label class="control-label">Fecha fin
                                        <small >(*)</small>
                                    </label>
                                    {!!Form::date('fechaF',$fechaFinal,['id'=>'fechaF','class'=>'form-control datepicker', 'max' => date('Y-m-d')])!!}
                                </div>
                            </div>
                        </div>
                        <div id="texto" class="text-danger col-sm-offset-1"></div>
                        <div align="center">
                            {!! Form::button('Mostrar',[ 'id' => 'mostrar','class'=>'btn btn-azul glyphicon']) !!}
                            {!! Form::button('Descargar',['id' => 'descargar','class'=>'btn  btn-verde  glyphicon']) !!}
                            <a class="btn btn-ocre  glyphicon" href="{{ route('vehiculos.index') }}">Regresar</a>
                        </div>
                        <br>
                        <table id="datatables" class="table table-hover display" style="width:100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>Solicitado</th>
                                <th>Realizado</th>
                                <th>Taller</th>
                                <th>Encargado</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>Solicitado</th>
                                <th>Realizado</th>
                                <th>Taller</th>
                                <th>Encargado</th>
                                <th>Acciones</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            </tbody>
                        </table>
                </div>
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
    <!-- end row -->
    </div>
    <div class="col-md-1"></div>
    <?php
    $ayuda_title="Ayuda para Salidas";
    $ayuda_body="Cada Salida tiene 1 botón <br>
                  1- Para ver los registros debe seleccionar un número de placa"
    ?>
    @include('alertas.ayuda')
@stop
<style>
    td.details-control {
        background: url('http://www.datatables.net/examples/resources/details_open.png') no-repeat center center;
        cursor: pointer;
    }
    tr.shown td.details-control {
        background: url('http://www.datatables.net/examples/resources/details_close.png') no-repeat center center;
    }
</style>

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
                },
                destroy: true

            });

            $('#mostrar').click(function(){
                var r=enlace(1);
                cargar(r);
            });

            $('#descargar').click(function(){
                var r=enlace(2);
                window.open(r , '_blank');
            });

        });

        function enlace(x){
            var ruta="";
            var placa=$("#placa").val();
            var fechaI=$("#fechaI").val();
            var fechaF=$("#fechaF").val();

            if (x=='1') {
                 ruta = "{{ route('Historialmanto', [ 'placa' => ':placa', 'fechaI' => ':fechaI', 'fechaF' => ':fechaF']) }}";
            }
            if(x=='2'){
                 ruta = "{{ route('Rhistorialmanto', [ 'placa' => ':placa', 'fechaI' => ':fechaI', 'fechaF' => ':fechaF']) }}";
            }

            ruta=ruta.replace(':placa', placa);
            ruta=ruta.replace(':fechaI', fechaI);
            ruta=ruta.replace(':fechaF', fechaF);

            return ruta;
        }

        function cargar(ruta) {
            var cont=0;
            var table = $('#datatables').DataTable( {
                "ajax": { url: ruta ,dataSrc:""},
                "columns": [
                    {
                        "className":      'details-control',
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": ''
                    },
                    {
                        data: null,
                        render: function ( data) {
                            // Combine the first and last names into a single table field
                            cont++;
                            return cont;
                        }
                    },
                    { "data": "reparacionesSolicitadas" },
                    { "data": "reparacionesRealizadas" },
                    { "data": "nombreEmpresa" },
                    { "data": "nombreEncargado" },
                    {
                        data: null,
                        render: function ( data) {
                            // Combine the first and last names into a single table field
                            var r="{{ route('mantenimientos.show', ['mantenimiento' => ':mantenimiento']) }}";
                            r=r.replace(':mantenimiento', data.id);
                            return "<a href='"+r+"' class='btn btn-xs btn-info btn-round' >"+
                                "<i title='Mostrar' class='material-icons' rel='tooltip'>visibility</i>"+
                                "</a>";
                        }
                    }
                ],
                "order": [[1, 'asc']],
                destroy: true
            } );

            // Add event listener for opening and closing details
            $('#datatables tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row( tr );

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }

            } );

        }

        /* Formatting function for row details - modify as you need */

        function format ( d ) {
            // `d` is the original data object for the row

            return '<table class="table table-hover" style="width:50%" >'+
                '<tr>'+
                '<td>Fecha recepción en taller:</td>'+
                '<td>'+ (d.fechaRecepcionTaller).split("-").reverse().join("/") +'</td>'+
                '</tr>'+
                '<tr>'+
                '<td>Fecha retorno de taller:</td>'+
                '<td>'+ (d.fechaRetornoTaller).split("-").reverse().join("/") +'</td>'+
                '</tr>'+
                '<tr>'+
                '<td>Solicitante:</td>'+
                '<td>'+d.nombresEmpleado+' '+d.apellidosEmpleado+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td>Costo:</td>'+
                '<td>'+'$ '+  new Intl.NumberFormat("en-IN", { minimumFractionDigits:2 }).format(d.costoMantenimiento)+'</td>'+
                '</tr>'+
                '</table>';
        }

    </script>
@endsection

