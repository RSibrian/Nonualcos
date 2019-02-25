@extends ('plantilla')
@section('plantilla')
<div class="content">
  <div class="container-fluid">
    <div class="col-sm-10 col-sm-offset-1">
      <!--      Wizard container        -->
      <div class="wizard-container">
        <div class="card wizard-card" data-color="blue" id="wizardProfile">
          {!!Form::model($activo,['method'=>'PUT','route'=>['activos.update',$activo->id]])!!}
          <div class="wizard-header">
            <h3 class="wizard-title">
              Editar Activo
            </h3>
            <h5>Editar los Datos de Activo Fijo.</h5>
            <h6 class="campoObligatorio">los campos con ( * ) son obligatorios</h6>
          </div>
          <div class="wizard-navigation">
            <ul>
              <li>
                <a href="#about" data-toggle="tab">Datos Generales</a>
              </li>
              <li>
                <a href="#account" data-toggle="tab">Detalle Compra</a>
              </li>
            </ul>
          </div>
          <div class="tab-content">
            <div class="tab-pane" id="about">
              <div class="row">
                <h4 class="info-text">Comencemos con los Datos Generales</h4>

                @if($activo->tipoActivo==1)
                <div class="col-sm-10 row col-sm-offset-1" id="placa_div">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">credit_card</i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label"><code>*</code>Ingrese número de placa:
                      </label>
                      {!!Form::text('numeroPlaca',$activo->vehiculo->numeroPlaca,['id'=>'numeroPlaca','class'=>'form-control','required'])!!}
                    </div>
                  </div>
                </div>
                @endif
                <div class="col-sm-3 row col-sm-offset-1">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">event_seat</i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label">código:
                      </label>
                      {!!Form::text('codigoInventario',null,['id'=>'codigoInventario','class'=>'form-control','disabled'])!!}
                    </div>
                  </div>
                </div>
                <div class="col-sm-7 row">
                  <div class="input-group">
                    <span class="input-group-addon">
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label"><code>*</code>Ingrese nombre de Activo:
                      </label>
                      {!!Form::text('nombreActivo',null,['id'=>'nombreActivo','class'=>'form-control','required'])!!}
                    </div>
                  </div>
                </div>
                <div class="col-sm-10 row col-sm-offset-1">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">apps</i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label"><code>*</code>Tipo de Adquisición:
                      </label>
                      <select name="tipoAdquisicion" id="tipoAdquisicion" class="form-control"  required>
                        @if($activo->tipoAdquisicion==1)
                        <option selected value=1>Compra</option>
                        <option value=0>Donación</option>
                        @else
                        <option value=1>Compra</option>
                        <option selected value=0>Donación</option>
                        @endif
                      </select>
                    </div>
                  </div>
                </div>

                @if($activo->tipoAdquisicion==0)  <?php $x="block";?>@else  <?php $x="none";?>@endif
                @if($activo->estadoUsado==1)  <?php $y="block";?>@else  <?php $y="none";?>@endif

                <div class="col-sm-10 row col-sm-offset-1" id="uso" style="display:{{$x}};">

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

                <div class="col-sm-10 row col-sm-offset-1 " id="anios" style="display: {{$y}};">
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


                <div class="col-sm-5 row col-sm-offset-1" >
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
                <div class="col-sm-5 row col-sm-offset-1">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">date_range</i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label"><code>*</code>Fecha de Adquisición
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
                      <label class="control-label">Ingrese la marca:
                      </label>
                      {!!Form::text('marca',null,['id'=>'marca','class'=>'form-control'])!!}
                    </div>
                  </div>
                </div>

                <div class="col-sm-5 row col-sm-offset-1">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">bookmarks</i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label">Ingrese el modelo:
                      </label>
                      {!!Form::text('modelo',null,['id'=>'modelo','class'=>'form-control'])!!}
                    </div>
                  </div>
                </div>
                <div class="col-sm-5 row">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">bookmarks</i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label">Ingrese serie:
                      </label>
                      {!!Form::text('serie',null,['id'=>'serie','class'=>'form-control'])!!}
                    </div>
                  </div>
                </div>

                <div class="col-sm-5 row col-sm-offset-1">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">dns</i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label">Ingrese el color:
                      </label>
                      {!!Form::text('color',null,['id'=>'color','class'=>'form-control'])!!}
                    </div>
                  </div>
                </div>
                @if($activo->estadoActivo!=0)
                <div class="col-sm-10 row col-sm-offset-1">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">apps</i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label">Cambiar estado de Activo:
                      </label>
                      <select name="estadoActivo" id="estadoActivo" class="form-control"  required>
                        @if($activo->estadoActivo==1)
                        <option selected value=1>En Uso</option>
                        <option value=0>De Baja</option>
                        <option value=2>Dañado</option>
                        <!--  <option value=3>Mantenimiento</option>
                        <option value=4>Préstado</option> -->
                        @elseif($activo->estadoActivo==0)
                        <option value=1>En Uso</option>
                        <option selected value=0>De Baja</option>
                        <option value=2>Dañado</option>
                        <!--  <option value=3>Mantenimiento</option>
                        <option value=4>Préstado</option>-->
                        @elseif($activo->estadoActivo==2)
                        <option value=1>En Uso</option>
                        <option value=0>De Baja</option>
                        <option selected value=2>Dañado</option>
                        <!-- <option value=3>Mantenimiento</option>
                        <option value=4>Préstado</option>-->
                        @elseif($activo->estadoActivo==2)
                        <option value=1>En Uso</option>
                        <option value=0>De Baja</option>
                        <option value=2>Dañado</option>
                        <!--<option selected value=3>Mantenimiento</option>
                        <option value=4>Préstado</option>-->
                        @else
                        <option value=1>En Uso</option>
                        <option value=0>De Baja</option>
                        <option value=2>Dañado</option>
                        <!--<option value=3>Mantenimiento</option>
                        <option selected value=4>Préstado</option>-->
                        @endif
                      </select>
                    </div>
                  </div>
                </div>
                @endif

                <div class="col-sm-10 row col-sm-offset-1" id="baja" style="display: none;">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">note_add</i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label"><code>*</code>Justificación:
                      </label>
                      {!!Form::text('justificacionActivo',null,['id'=>'justificacionActivo','class'=>'form-control','required'])!!}
                    </div>
                  </div>
                </div>

                <div class="col-sm-10 row col-sm-offset-1">
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

                <div class="col-sm-10 row col-sm-offset-1">
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

                <div class="col-sm-10 row col-sm-offset-1"id="factura" style="display: block;">

                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">tab</i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label"><code>*</code>Número de factura:
                      </label>
                      {!!Form::number('numeroFactura',null,['id'=>'numeroFactura','class'=>'form-control','required'])!!}
                    </div>
                  </div>
                </div>
                <div class="col-sm-10 row col-sm-offset-1">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">attach_money</i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label"><code>*</code>Precio del activo:
                      </label>
                      {!!Form::number('precio',null,['id'=>'precio','class'=>'form-control','required','step'=>"any"])!!}
                    </div>
                  </div>
                </div>


              </div>
            </div>

          </div>

          <div class="wizard-footer">
            <div class="pull-right">

              <input type='button' class='btn btn-next btn-fill btn-success' name='next' value='Siguiente' />
              <div  class="row">
                {!! Form::submit('Actualizar',['class'=>'btn btn-finish btn-fill btn-verde btn-wd glyphicon glyphicon-floppy-disk']) !!}
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
    document.getElementById("aniosUso").value = "";

  }
  else
  {
    document.getElementById('anios').style.display='block';
    document.getElementById("aniosUso").value = "";
  }
}

$('#tipoAdquisicion').on('change',function(e){
  var tipo=$("#tipoAdquisicion").find('option:selected');
  if (tipo.val()==0)
  {

    document.getElementById('uso').style.display='block';
    document.getElementById('factura').style.display='none';
  }
  else
  {
    document.getElementById("aniosUso").value = "";
    document.getElementById("radioNoUsado").checked = "true";
    document.getElementById('uso').style.display='none';
    document.getElementById('anios').style.display='none';
    document.getElementById('factura').style.display='block';
  }
});

$('#estadoActivo').on('change',function(e){
  var estado=$("#estadoActivo").find('option:selected');
  if (estado.val()==0)
  {
    document.getElementById('baja').style.display='block';

  }
  else
  {
    document.getElementById('baja').style.display='none';

  }
});
</script>
@endsection
