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
                    <h4 class="card-title">Historial de salidas vehículo placa {{ $placa->numeroPlaca }}</h4>
                    <div class="toolbar">
                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
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
                                {!! Form::button('Descargar',[ 'id' => 'descargar', 'class'=>'btn btn-verde glyphicon']) !!}
                                <a class="btn  btn-ocre  glyphicon" href="{{ route('vehiculos.index') }}">Regresar</a>
                            </div>
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th class="text-center">#</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Destino</th>
                                <th class="text-center">Número de vale</th>
                                <th class="text-center">Solicitante</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th class="text-center">#</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Destino</th>
                                <th class="text-center">Número de vale</th>
                                <th class="text-center">Solicitante</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            </tfoot>
                            <tbody class="text-center" id="cuerpo">
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
    <!-- end row -->
    <div class="col-md-1"></div>
    <?php
    $ayuda_title="Ayuda para Salidas";
    $ayuda_body="Cada Salida tiene 1 botón <br>
                  1- Este <i class='material-icons'>visibility</i> Icono es para ver los datos de la salida"
    ?>
    @include('alertas.ayuda')
@stop

@section('scripts')
    <script type="text/javascript" href="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
   <script type="text/javascript">
       $(document).ready(function() {

           $('#datatables').DataTable({
               pagingType: "full_numbers",
               lengthMenu: [
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
               ruta = "{{ route('salidas.datable', [ 'placa' => ':placa', 'fechaI' => ':fechaI', 'fechaF' => ':fechaF']) }}";
           }
           if(x=='2'){
               ruta = "{{ route('Rhistorialsalidas', [ 'placa' => ':placa', 'fechaI' => ':fechaI', 'fechaF' => ':fechaF']) }}";
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
                   {
                       data: null,
                       render: function ( data) {
                           // Combine the first and last names into a single table field
                           return (data.fechaSalida).split('-').reverse().join('/');
                       }
                   },
                   { "data": "destinoTrasladarse" },
                   { "data": "numeroVale" },
                   {
                       data: null,
                       render: function ( data ) {
                           // Combine the first and last names into a single table field
                           return data.nombresEmpleado+' '+data.apellidosEmpleado;
                       }
                   },
                   {
                       data: null,
                       render: function ( data ) {
                           // Combine the first and last names into a single table field
                           var r="{{ route('vales.show', ['vale' => ':vale']) }}";
                           r=r.replace(':vale', data.id);
                           return "<a href='"+r+"' class='btn btn-xs btn-info btn-round' >"+
                               "<i title='Mostrar' class='material-icons' rel='tooltip'>visibility</i>"+
                               "</a>";
                       }
                   }
               ],
               "order": [[1, 'asc']],
               language: {
                   search: "_INPUT_",
                   searchPlaceholder: "Search records",
               },
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

   </script>
@endsection

