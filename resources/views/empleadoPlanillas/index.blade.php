@extends ('plantilla')
@section('plantilla')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="ocre">
                    <i class="material-icons">work</i>
                </div>
                <div class="card-header card-header-icon" data-background-color="azul" data-toggle="modal" data-target="#myModal">
                    <i class="material-icons">help</i>

                </div>
                <div class="card-content">
                    <h4 class="card-title">Listado de Panillas de Pago</h4>
                    <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <?php
                    $mes=date("m");
                    $dias=date("t");
                    $anno=date("Y");
                    $fecha_fin_inicio = date($anno."-".$mes."-01");
                    $fecha_fin = date($anno."-".$mes."-".$dias);
                    $fecha_fin_mes =date("Y-m-d", strtotime("$fecha_fin_inicio +1 month"));
                    ?>
                    @if(isset($planillas->last()->id))
                    <?php
                    $planilla_last=$planillas->last();
                    ?>
                    @if($planilla_last->mes!=intval($mes))
                      <a  aling='right' href="{{ url("planillas") }}" class="btn  btn-verde btn-round " title="">
                        <i class="material-icons"></i>
                            Planilla
                      </a>
                    @endif
                    @if($planilla_last->mes!=13 && intval($mes)==12 && $planilla_last->mes!=12)
                      <a  title="Agregar Nuevo Proveedor" href="" data-toggle="modal" data-target="#nuevo"  aling='right' href="{{ url("aguinaldos") }}"  class="btn  btn-ocre btn-round " title="">
                        <i class="material-icons"></i>
                        Aguinaldo
                      </a>
                    @endif
                  @else
                    <a  aling='right' href="{{ url("planillas") }}" class="btn  btn-verde btn-round " title="">
                      <i class="material-icons"></i>
                          Planilla
                    </a>

                  @endif




                    <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>

                                    <th>Año</th>
                                    <th>Concepto</th>
                                    <th>Fecha de Pago</th>
                                    <th class="disabled-sorting " >Detalle</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                  <th></th>
                                  <th>#</th>

                                  <th>Año</th>
                                  <th>Concepto</th>
                                  <th>Fecha de Pago</th>
                                  <th class="disabled-sorting " >Detalle</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                 <?php $cont=0;?>
                                @foreach ($planillas as $planilla)

                                    <tr>
                                        <td></td>
                                        <?php $cont++;?>
                                        <td>{{$cont}}</td>

                                        <td>{{$planilla->anno}}</td>
                                        <td>{{$planilla->concepto}}</td>
                                        <td>${{\Helper::fecha($planilla->FechaPago)}}</td>

                                        <td>
                                              <a title="Ver Detalle" href="{{ url("empleadoPlanillas/{$planilla->id}") }}" class="btn btn-xs btn-info btn-round">
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
    <!-- Modal -->
    <div id="nuevo" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Aguinaldos</h4>
          </div>
          <div class="modal-body">
            {!! Form::open(['route'=>'aguinaldos.show','method'=>'POST']) !!}
            <input type="hidden" id='token' name="_token" value="{{ csrf_token() }}">
            <fieldset>
              <h6 class="campoObligatorio">“renta no gravada” y “no sujeta a retención de ISR”</h6>
              <input type="hidden" name="hi2" value="1">
              <div class="col-sm-10 row">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="material-icons">$</i>
                  </span>
                  <div class="form-group label-floating">
                    <label class="control-label">Exoneración de Renta:
                    </label>
                    {!!Form::text('exoneracion',608.34,['id'=>'exoneracion','class'=>'form-control'])!!}
                  </div>
                </div>
              </div>
            </fieldset>
          </div>
          <div class="modal-footer">
            <div align="center">
              {!! Form::submit('Aguinaldos',[ 'class'=>'btn  btn-verde']) !!}
              <a href="{{ URL::previous() }}" class='btn btn-ocre '  data-dismiss="modal">Cerrar</a>
            </div>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
    <!-- end row -->
    <?php
        $ayuda_title="Ayuda para la Tabla de Planillas";
        $ayuda_body="Ver Detalle de Planilla <br>

                     3- Dar clic en el boton <i class='material-icons'>visibility</i> para observar el detalle de planilla"
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
