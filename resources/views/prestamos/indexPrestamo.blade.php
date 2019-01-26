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
                    <h4 class="card-title">Listado de Préstamos</h4>
                    <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <div class="material-datatables">

                            <a href="{{ url("prestamos/create") }}" class="btn  btn-success btn-round ">
                                <i class="material-icons">add</i>
                                Nuevo
                            </a>
                            <a href="{{ url("prestamos") }}"  class="btn btn-xs btn-ocre btn-round" title="Ver Calendario">
                                <i class="material-icons">date_range</i>
                            </a>
                            <a href="{{ url("prestamos/generarReportePrestamo") }}"  class="btn btn-xs btn-ocre btn-round" title="Generar Reporte">
                                <i class="material-icons">assignment</i>
                            </a>



                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%";>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>Institución</th>
                                    <th>Nombre</th>
                                    <th>DUI</th>
                                    <th>Entrega</th>
                                    <th>Devolución</th>
                                    <th>Estado</th>
                                    <th>Solicitud</th>
                                    <th>Comprobante</th>

                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                  <th></th>
                                  <th>#</th>
                                  <th>Institución</th>
                                  <th>Nombre</th>
                                  <th>DUI</th>
                                  <th>Entrega</th>
                                  <th>Devolución</th>
                                  <th>Estado</th>
                                  <th>Solicitud</th>
                                  <th>Comprobante</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $cont=0;?>
                                @foreach ($prestamos as $prestamo)
                                  <?php
                                  $date =  date('Y-m-d H:i',time());


                                 if($prestamo->estadoPrestamo==1){
                                      if($date>$prestamo->fechaDevolucionPrestamo){

                                          $prestamo->estadoPrestamo=3;
                                          $prestamo->save();
                                      }
                                  }
                                  if($prestamo->estadoPrestamo==4){
                                      if($date>$prestamo->fechaDevolucionPrestamo && $prestamo->fechaRegresoPrestamo==null || $prestamo->fechaRegresoPrestamo>$prestamo->fechaDevolucionPrestamo   ){
                                          $prestamo->estadoPrestamo=5;
                                          $prestamo->save();
                                      }
                                  }
                                  ?>
                                    <tr>
                                        <td></td>
                                        <?php $cont++;?>
                                        <td>{{$cont}}</td>
                                        <td>{{$prestamo->institucion->nombreInstitucion}}</td>
                                        <td>{{$prestamo->nombreSolicitante}}</td>
                                        <td>{{$prestamo->DUISolicitante}}</td>
                                        <?php $date = new DateTime($prestamo->fechaEntregaPrestamo); ?>
                                        <td>{{$date->format('d/m/Y')}}</td>

                                        <?php $date1 = new DateTime($prestamo->fechaDevolucionPrestamo); ?>
                                        <td>{{$date1->format('d/m/Y')}}</td>


                                        @if($prestamo->estadoPrestamo==0)
                                            <?php
                                              $color=" style='color:#831517;'";
                                              $estado='Cancelado';
                                            ?>
                                        @elseif($prestamo->estadoPrestamo==1)
                                          <?php
                                            $color=" style='color:#00bcd4;'";
                                            $estado='Pendiente';
                                          ?>
                                        @elseif($prestamo->estadoPrestamo==2)
                                          <?php
                                            $color=" style='color:#17A589;'";
                                            $estado='Completo';
                                          ?>
                                        @elseif($prestamo->estadoPrestamo==3)
                                          <?php
                                            $color=" style='color:#F83324;'";
                                            $estado='No Reclamado';
                                          ?>
                                        @elseif($prestamo->estadoPrestamo==4)
                                          <?php
                                            $color=" style='color:#7D29A0;'";
                                            $estado='Entregado';
                                          ?>
                                        @elseif($prestamo->estadoPrestamo==5)
                                          <?php
                                            $color=" style='color:#6A6968;'";
                                            $estado='No Devuelto';
                                          ?>

                                        @else
                                          <?php
                                            $color=" style='color:#FC8804'";
                                            $estado='Devuelto Tarde';
                                          ?>
                                        @endif
                                        <td <?=$color?>>{{$estado}}</td>
                                        <td>
                                            <a href="{{ asset($prestamo->pdfPrestamo) }} " target="_blank" class="btn btn-xs btn-info btn-round" title="Solicitud de Préstamo">
                                                <i class="material-icons">save_alt</i>
                                            </a>
                                        </td>

                                        <td>
                                          <a href="{{ url("prestamos/reportes/comprobanteEntregaPrestamo/".$prestamo->id) }}" target="_blank" class="btn btn-xs btn-info btn-round" title="Comprobante de Entrega">
                                              <i class="material-icons">save_alt</i>
                                          </a>
                                          <a href="{{ url("prestamos/showPrestamo/".$prestamo->id) }}" class="btn btn-xs btn-info btn-round" title="Ver Detalle de Prestamo">
                                              <i class="material-icons">visibility</i>
                                          </a>
                                        </td>

                                    </tr>
                                @endforeach
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
    <?php
        $ayuda_title="Ayuda para la Tabla de Préstamos";
        $ayuda_body="
                <h4>Botones en la parte superior izquierda:</h4>
                    1-El botón color verde es para crear un nuevo Préstamo.<br><br>
                    2-<i class='material-icons'>date_range</i>&nbsp; Icono para ver la agenda de los Préstamos.
                      En este calendario se podrá:<br>
                      2.1-Entregar Préstamo.<br>
                      2.2-Finalizar Préstamo.<br>
                      2.2-Ver el seguimiento de los Préstamos.<br><br>
                    3-El ícono <i class='material-icons'>assignment</i>&nbsp; es para generar reporte de Préstamos.<br><br>
                <h4>Botones en la tabla:</h4>
                     1- <i class='material-icons'>save_alt</i>&nbsp; Icono es para ver la Solicitud de Préstamos    <br><br>
                     2- <i class='material-icons'>save_alt</i> Icono Generar Comprobante de Entrega de Activos <br><br>
                     3- <i class='material-icons'>visibility</i> Icono es para ver los detalles del Préstamo <br><br>"

    ?>
    @include('alertas.ayuda')
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
