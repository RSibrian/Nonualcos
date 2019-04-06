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
                    <h4 class="card-title">Reporte general de liquidaciones </h4>
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
                            <a class="btn  btn-ocre  glyphicon" href="{{ route('liquidaciones.index') }}">Regresar</a>
                        </div>
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th class="text-center">#</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">No. de factura</th>
                                <th class="text-center">Vehículo</th>
                                <th class="text-center">Total en factura</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th class="text-center">#</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">No. de factura</th>
                                <th class="text-center">Vehículo</th>
                                <th class="text-center">Total en factura</th>
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

    <style>
        td.details-control {
            background: url('http://www.datatables.net/examples/resources/details_open.png') no-repeat center center;
            cursor: pointer;
        }
        tr.shown td.details-control {
            background: url('http://www.datatables.net/examples/resources/details_close.png') no-repeat center center;
        }
    </style>
@stop

@section('scripts')
    <script type="text/javascript" href="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script type="text/javascript">
        $('#mostrar').click(function(){
            var fechaI=$("#fechaI").val();
            var fechaF=$("#fechaF").val();

            if ( valida(fechaI,fechaF)) {
                var url=enlace(fechaI,fechaF,1);
                var r="{{ route('liquidaciones.show', ['liquidacion' => ':liquidacion']) }}";
                var newUrl = "{{ route('liquidaciones.vales', ['liquidacion' => ':liquidacion']) }}";
                cargar(url,r,newUrl);
            }

        });

        $('#descargar').click(function(){
            var fechaI=$("#fechaI").val();
            var fechaF=$("#fechaF").val();

            if (valida(fechaI,fechaF)){
                var r=enlace(fechaI,fechaF,2);
                window.open(r , '_blank');
            }
        });

        function enlace(fechaI,fechaF,x){
            var ruta="";

            if (x=='1') {
                ruta = "{{ route('liquidaciones.mostrar', [ 'fechaI' => ':fechaI', 'fechaF' => ':fechaF']) }}";
            }
            if(x=='2'){
                ruta = "{{ route('liquidacion.reporteG', [ 'fechaI' => ':fechaI', 'fechaF' => ':fechaF']) }}";
            }

            ruta=ruta.replace(':fechaI', fechaI);
            ruta=ruta.replace(':fechaF', fechaF);

            return ruta;
        }
    </script>
    {!!Html::script('js/liquidacionesReporte.js')!!}
    {!!Html::script('js/fecha.js')!!}
@endsection

