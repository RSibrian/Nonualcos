@extends ('plantilla')
@section('plantilla')
  <div class="content">
      <div class="container-fluid">
          <div class="col-sm-10 col-sm-offset-1">
              <!--      Wizard container        -->
              <div class="wizard-container">
                  <div class="card wizard-card" data-color="blue" id="wizardProfile">
					{!! Form::open(['route'=>'activos.store','method'=>'POST','autocomplete'=>'off']) !!}
                        <div class="wizard-header">
                            <h3 class="wizard-title">
                                Registrar Activo
                            </h3>
                            <h5>Completar los Datos sobre Activo Fijo.</h5>
                        </div>
                        <div class="wizard-navigation">
                            <ul>
                                <li>
                                    <a href="#about" data-toggle="tab">Datos Generales</a>
                                </li>
                                <li>
                                    <a href="#account" data-toggle="tab">Detalle Compra</a>
                                </li>
                                <li>
                                    <a href="#address" data-toggle="tab">Asignaciones</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane" id="about">
                                <div class="row">
                                    <h4 class="info-text">Comencemos con los Datos Generales</h4>
                                    <div class="col-sm-10 row">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">apps</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">
                                                </label>
                                              {!!Form::select('idClasificacionActivo',$clasificaciones,null,['id'=>'idClasificacionActivo','class'=>'form-control','placeholder'=>'   seleccione una clasificación (requerido)','required'])!!}

                                            </div>
                                        </div>
                                    </div>
                                <div class="col-sm-5 row">

                                  <div class="input-group ">
                                    <span class="input-group-addon">
                                    <h6>¿Es un Vehiculo?</h6>
                                    </span>
                                      <div class="radio">
                                        <label style="color: #0d3625;" for="radio1">
                                            {{ Form::radio('tipoActivo',0,'true',[ 'id'=>"radio1","onClick"=>"mostrarOcultar()"]) }}No
                                            &nbsp;
                                        </label>
                                          <label style="color: #0d3625;" for="radio3">
                                              {{ Form::radio('tipoActivo',1,null,[ 'id'=>"radio3","onClick"=>"mostrarOcultar()"]) }} Si &nbsp;
                                          </label>

                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-sm-5 row " id="placa_div" style="display: none;">
                                      <div class="input-group">
                                          <span class="input-group-addon">
                                              <i class="material-icons">credit_card</i>
                                          </span>
                                          <div class="form-group label-floating">
                                              <label class="control-label"><code>*</code>Ingrese número de placa
                                              </label>
                                              {!!Form::text('numeroPlaca',null,['id'=>'numeroPlaca','class'=>'form-control','required'])!!}
                                          </div>
                                      </div>
                                  </div>
                                    <div class="col-sm-10 row">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">event_seat</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label"><code>*</code>Ingrese nombre de Activo:
                                                </label>
                                                {!!Form::text('nombreActivo',null,['id'=>'nombreActivo','class'=>'form-control','required'])!!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-10 row">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">apps</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Tipo de Adquisición:
                                                </label>
                                                <select name="tipoAdquisicion" id="tipoAdquisicion" class="form-control"  required>
                                                    <option value=1>Compra</option>
                                                    <option value=0>Donación</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-5 row">

                                      <div class="input-group ">
                                        <span class="input-group-addon">
                                        <h6>¿Es un Usado?</h6>
                                        </span>
                                          <div class="radio">
                                            <label style="color: #0d3625;" for="radioNoUsado">
                                                {{ Form::radio('estadoUsado',0,'true',[ 'id'=>"radioNoUsado","onClick"=>"mostrarAniosUsado()"]) }}No
                                                &nbsp;
                                            </label>
                                              <label style="color: #0d3625;" for="radioUsado">
                                                  {{ Form::radio('estadoUsado',1,null,[ 'id'=>"radioUsado","onClick"=>"mostrarAniosUsado()"]) }} Si &nbsp;
                                              </label>

                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-5 row " id="anios" style="display: none;">
                                          <div class="input-group">
                                              <span class="input-group-addon">
                                                  <i class="material-icons">credit_card</i>
                                              </span>
                                              <div class="form-group label-floating">
                                                  <label class="control-label"><code>*</code>Ingrese numero de años usado:
                                                  </label>
                                                  {!!Form::number('aniosUso',null,['id'=>'aniosUso','class'=>'form-control','required'])!!}
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-sm-5 row " >
                                          <div class="input-group">
                                              <span class="input-group-addon">
                                                  <i class="material-icons">credit_card</i>
                                              </span>
                                              <div class="form-group label-floating">
                                                  <label class="control-label"><code>*</code>Ingrese Vida util del activo
                                                  </label>
                                                  {!!Form::number('aniosVida',null,['id'=>'aniosVida','class'=>'form-control','required'])!!}
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-sm-5 row " >
                                          <div class="input-group">
                                              <span class="input-group-addon">
                                                  <i class="material-icons">credit_card</i>
                                              </span>
                                              <div class="form-group label-floating">
                                                  <label class="control-label"><code>*</code>Ingrese Valor Residual
                                                  </label>
                                                  {!!Form::number('valorResidual',null,['id'=>'valorResidual','class'=>'form-control','required'])!!}
                                              </div>
                                          </div>
                                      </div>
                                    <div class="col-sm-5 row">
                                        <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">date_range</i>
                                                    </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Fecha de Adquisición
                                                    <small></small>
                                                </label>
                                                {!!Form::date('fechaAdquisicion',$date,['id'=>'fechaAdquisicion','class'=>'form-control datepicker'])!!}

                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-5 row">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">class</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label"><code>*</code>Ingrese la marca:
                                                </label>
                                                {!!Form::text('marca',null,['id'=>'marca','class'=>'form-control','required'])!!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-5 row">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">bookmarks</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label"><code>*</code>Ingrese el modelo:
                                                </label>
                                                {!!Form::text('modelo',null,['id'=>'modelo','class'=>'form-control','required'])!!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-5 row">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">dns</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label"><code>*</code>Ingrese el color:
                                                </label>
                                                {!!Form::text('color',null,['id'=>'color','class'=>'form-control','required'])!!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-10 row">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">note_add</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Observación del Activo:
                                                </label>
                                                {!!Form::text('ObservacionActivo',null,['id'=>'ObservacionActivo','class'=>'form-control'])!!}
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>

                            <div class="tab-pane" id="account">
                                <h4 class="info-text"> Sigamos con la información Detalle de Compra</h4>
                                <div class="row">

                                      <div class="col-sm-10 row">
                                          <div class="input-group">
                                              <span class="input-group-addon">
                                                  <i class="material-icons">store</i>
                                              </span>
                                              <div class="form-group label-floating">
                                                  <label class="control-label">
                                                  </label>
                                                {!!Form::select('idProveedor',$proveedores,null,['id'=>'idProveedor','class'=>'form-control','placeholder'=>'Selecione un Proveedor'])!!}
                                              </div>
                                          </div>
                                      </div>

                                        <div class="col-sm-5 row">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">tab</i>
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label"><code>*</code>Número de factura:
                                                    </label>
                                                    {!!Form::text('numeroFactura',null,['id'=>'numeroFactura','class'=>'form-control','required'])!!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-5 row">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">attach_money</i>
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label"><code>*</code>Cantidad articulos:
                                                    </label>
                                                    {!!Form::number('cantidad',null,['id'=>'cantidad','class'=>'form-control','required'])!!}
                                                </div>
                                            </div>
                                        </div>
                                      <div class="col-sm-5 row">
                                          <div class="input-group">
                                              <span class="input-group-addon">
                                                  <i class="material-icons">attach_money</i>
                                              </span>
                                              <div class="form-group label-floating">
                                                  <label class="control-label"><code>*</code>Precio del activo por unidad:
                                                  </label>
                                                  {!!Form::number('precio',null,['id'=>'precio','class'=>'form-control','required'])!!}
                                              </div>
                                          </div>
                                      </div>


                                </div>
                            </div>
                            <div class="tab-pane" id="address">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4 class="info-text">Sigamos con la información de Asignaciones </h4>
                                    </div>
                                    <div class="col-sm-10 row">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">apps</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">
                                                </label>
                                              {!!Form::select('idUnidad',$unidades,null,['id'=>'idUnidad','class'=>'form-control','placeholder'=>'Selecione una Unidad (requerido)','required'])!!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-10 row">
                                        <<div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">date_range</i>
                                                    </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label"><code>*</code>Fecha de Asignación
                                                    <small></small>
                                                </label>
                                                {!!Form::date('fechaInicioUni',$date,['id'=>'fechaInicioUni','class'=>'form-control datepicker'])!!}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-10 row">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">apps</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">
                                                </label>
                                              {!!Form::select('idEmpleado',$empleados,null,['id'=>'idEmpleado','class'=>'form-control','placeholder'=>'Selecione un Encargado (requerido)','required'])!!}
                                            </div>
                                        </div>
                                    </div>





                                </div>
                            </div>
                        </div>
                        <div class="wizard-footer">
                            <div class="pull-right">

                                <input type='button' class='btn btn-next btn-fill btn-success' name='next' value='Siguiente' />
                                <div align="center" class="row">
                                    {!! Form::submit('Registrar',['class'=>'btn btn-finish btn-fill btn-verde btn-wd glyphicon glyphicon-floppy-disk']) !!}
                                </div>
                                <!--input type='button' class='btn btn-finish btn-fill btn-rose btn-wd' name='finish' value='Finish' /-->
                            </div>
                            <div class="pull-left">

                                <input type='button' class='btn btn-previous btn-fill btn-ocre btn-wd' name='previous' value='Anterior' />
                            </div>
                            <div class="clearfix"></div>
                        </div>
					{!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
<script type="text/javascript">
    $().ready(function() {
        demo.initMaterialWizard();
    });
</script>

<script>
    $('#idUnidad').on('change',function(e){
        var empleados=$("#idEmpleado");
        var unidad=$("#idUnidad").find('option:selected');
        var ruta="/Nonualcos/public/activos/create/"+unidad.val();
        $.get(ruta,function(res){
            empleados.empty();
            empleados.append("<option value="+null+">Seleccione un Encargado (requerido)</option>");
            $(res).each(function(key,value){
                empleados.append("<option value="+value.id+">"+value.nombresEmpleado+" "+value.apellidosEmpleado+"</option>");
            });
        });
    });

</script>
<script language="JavaScript">
function mostrarOcultar() {
    var resultado="ninguno";

        var porNombre=document.getElementsByName("tipoActivo");
        // Recorremos todos los valores del radio button para encontrar el
        // seleccionado
        for(var i=0;i<porNombre.length;i++)
        {
            if(porNombre[i].checked)
                resultado=porNombre[i].value;
        }
    if (resultado==0)
    {
      document.getElementById('placa_div').style.display='none';
    }
    else
    {
      document.getElementById('placa_div').style.display='block';
    }
}
</script>
<script language="JavaScript">
function mostrarAniosUsado() {
    var resultado="ninguno";

        var porNombre=document.getElementsByName("estadoUsado");
        // Recorremos todos los valores del radio button para encontrar el
        // seleccionado
        for(var i=0;i<porNombre.length;i++)
        {
            if(porNombre[i].checked)
                resultado=porNombre[i].value;
        }
    if (resultado==0)
    {
      document.getElementById('anios').style.display='none';
    }
    else
    {
      document.getElementById('anios').style.display='block';
    }
}
</script>

@endsection

<?php
$time=time();

function dameFecha($fecha,$dia){
    list($year,$mon,$day)=explode('-',$fecha);
    return date('Y-m-d',mktime(0,0,0,$mon,$day+$dia,$year));
}
$total=0;
?>
