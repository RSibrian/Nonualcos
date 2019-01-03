@extends ('plantilla')
@section('plantilla')
    <div class="row">
        <div class="col-sm-offset-1 col-md-10">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="blue">
                    <i class="material-icons">work</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Cargo -
                        <small class="category">Mostrando detalle de la bitacora: <b>{{$bitacoraAccion->id}}</b></small>
                    </h4>


                        <input type="hidden" name="hi2" value="1">
                        <div class="form-group ">

                          <table>
                              <tr>
                                  <td ><h4>Empleado: </h4></td>
                                  <td><h4> <b>&nbsp;{{$bitacoraAccion->usuario->empleado?$bitacoraAccion->usuario->empleado->nombresEmpleado." ".$bitacoraAccion->usuario->empleado->apellidosEmpleado:$bitacoraAccion->usuario->name}}</b></h4></td>
                              </tr>
                              <tr>
                                  <td ><h4>Acción: </h4></td>
                                  <td ><h4> <b>&nbsp;{{$bitacoraAccion->accion}}</b></h4></td>
                              </tr>
                            </table>

                            <table  class="col-md-12" border="1px">



                                <tr align="center" style="background-color:#E0F2F7;">
                                  @if(isset($bitacoraAccion->registroAntes))
                                    <td class="col-md-6" ><h4><b>Antes: </b></h4></td>
                                    <td class="col-md-6" ><h4><b>Despues: </b></h4></td>
                                  @else
                                    <td class="col-md-12"colspan="2" ><h4><b>Nuevo Registro: </b></h4></td>
                                  @endif
                                </tr>


                                <tr>
                                  @if(isset($bitacoraAccion->registroAntes))
                                    <td class="col-md-6" ><h4>{!!$bitacoraAccion->registroAntes!!}</h4></td>
                                    <td class="col-md-6"><h4>{!!$bitacoraAccion->registroDespues!!}</h4></td>
                                  @else
                                    <td colspan="2" class="col-md-12"><h4>{!!$bitacoraAccion->registroDespues!!}</h4></td>
                                  @endif

                                </tr>

                          </table>

                            <div align="center">
                                <a href="{{ URL::previous() }}" class='btn btn-ocre '>Regresar</a>
                            </div>
                        </div>



                </div>
            </div>
        </div>


    </div>


    <!-- end row -->
@stop
