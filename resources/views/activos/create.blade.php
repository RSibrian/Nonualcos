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
            <h6 class="campoObligatorio">los campos con ( * ) son obligatorios</h6>
          </div>
          <div class="wizard-navigation">
            <ul>
              <li>
                <a href="#about" data-toggle="tab">Datos Generales</a>
              </li>
              <li>
                <a href="#account" data-toggle="tab">Detalle de Adquisición</a>
              </li>

            </ul>
          </div>
          <div class="tab-content"  >
            <div class="tab-pane" id="about">
              <div class="row">
                <h4 class="info-text">Comencemos con los Datos Generales</h4>

                <div class="col-sm-10 row col-sm-offset-1">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">apps</i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label"><code>*</code>
                      </label>
                      {!!Form::select('idClasificacionActivo',$clasificaciones,null,['id'=>'idClasificacionActivo','class'=>'form-control','placeholder'=>'*   seleccione una clasificación ','required'])!!}

                    </div>
                  </div>
                </div>

                <div class="col-sm-5 row col-sm-offset-1">

                  <div class="input-group ">
                    <span class="input-group-addon">
                      <h6><code>*</code>¿Es un Vehiculo?</h6>
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
                <div class="col-sm-10 row col-sm-offset-1 " id="placa_div" style="display: none;">
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
                <div class="col-sm-10 row col-sm-offset-1">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">event_seat</i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label"><code>*</code>Ingrese nombre de Activo:
                      </label>
                      {!!Form::text('nombreActivo',null,['id'=>'nombreActivo','class'=>'form-control','required', 'minlength'=>"3" ])!!}
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
                      <select name="tipoAdquisicion" id="tipoAdquisicion" class="form-control" >
                        <option value=1>Compra</option>
                        <option value=0>Donación</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-sm-10 row col-sm-offset-1" id="uso" style="display: none;">

                  <div class="input-group ">
                    <span class="input-group-addon">
                      <h6><code>*</code>¿Es un Usado?</h6>
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



                <div class="col-sm-10 row col-sm-offset-1" id="anios" style="display: none;">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">credit_card</i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label"><code>*</code>Ingrese número de años usado:
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
                      <label class="control-label"><code>*</code>Años de Vida util
                      </label>
                      {!!Form::number('aniosVida',null,['id'=>'aniosVida','class'=>'form-control','required'])!!}
                    </div>
                  </div>
                </div>
                <div class="col-sm-5 row  " >
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">credit_card</i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label"><code>*</code>Ingrese Valor Residual ( % )
                      </label>
                      {!!Form::number('valorResidual',10,['id'=>'valorResidual', 'class'=>'form-control'])!!}

                    </div>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="col-sm-5 row col-sm-offset-1 ">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="material-icons">date_range</i>
                      </span>
                      <div class="form-group label-floating">
                        <label class="control-label"><code>*</code>Fecha de Adquisición
                          <small></small>
                        </label>
                        {!!Form::date('fechaAdquisicion',$date,['id'=>'fechaAdquisicion','max'=>$date,'class'=>'form-control datepicker'])!!}

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
                </div>

                <div class="col-sm-5 row col-sm-offset-1">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">class</i>
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
                      <i class="material-icons">class</i>
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

                <div class="col-sm-10 row col-sm-offset-1">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">note_add</i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label">Observación del Activo:
                      </label>
                      {!!Form::textarea('ObservacionActivo',null,['id'=>'ObservacionActivo','class'=>'form-control' ,'rows'=>'2', 'style'=>'resize: both;'])!!}
                    </div>
                  </div>
                </div>


              </div>

            </div>

            <div class="tab-pane" id="account">
              <h4 class="info-text"> Sigamos con la información Detalle de  Adquisición</h4>
              <div class="row">

                <div class="col-sm-8 row col-sm-offset-1">
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

                <div class="col-sm-2 row">
                  <a title="Agregar Nuevo Proveedor" href="" data-toggle="modal" data-target="#nuevo" class="btn btn-xs btn-info btn-round">
                    <i class="material-icons">add_circle</i>
                  </a>
                </div>

                <div class="col-sm-10 row col-sm-offset-1 "id="factura" style="display: block;">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">tab</i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label">Número de factura:
                      </label>
                      {!!Form::number('numeroFactura',null,['id'=>'numeroFactura','class'=>'form-control',''])!!}
                    </div>
                  </div>
                </div>

                <div class="col-sm-5 row col-sm-offset-1">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">attach_money</i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label">Cantidad articulos:
                      </label>
                      {!!Form::number('cantidad',1,['id'=>'cantidad','class'=>'form-control',''])!!}
                    </div>
                  </div>
                </div>
                <div class="col-sm-5 row">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">attach_money</i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label"><code>*</code>Precio por unidad:
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
  <!-- Modal -->
  <div id="nuevo" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Registrar Proveedor</h4>
        </div>
        <div class="modal-body">
          {!! Form::open() !!}
          <input type="hidden" id='token' name="_token" value="{{ csrf_token() }}">

          <input type="hidden" name="nuevoPro" value="1">
          <fieldset>
            <h6 class="campoObligatorio">los campos con ( * ) son obligatorios</h6>
            <input type="hidden" name="hi2" value="1">

            <div class="col-sm-10 row">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="material-icons">store</i>
                </span>
                <div class="form-group label-floating">
                  <label class="control-label"><code>*</code>Ingrese nombre de la Empresa :
                  </label>
                  {!!Form::text('nombreEmpresa',null,['id'=>'nombreEmpresa','class'=>'form-control','required'])!!}
                </div>
              </div>
            </div>
            <br>
            <div class="col-sm-10 row">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="material-icons">person</i>
                </span>
                <div class="form-group label-floating">
                  <label class="control-label">Ingrese nombre del Encargado :
                  </label>
                  {!!Form::text('nombreEncargado',null,['id'=>'nombreEncargado','class'=>'form-control'])!!}
                </div>
              </div>
            </div>
            <br>
            <div class="col-sm-10 row">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="material-icons">local_phone</i>
                </span>
                <div class="form-group label-floating">
                  <label class="control-label">Ingrese número de Teléfono:
                  </label>
                  {!!Form::text('telefonoProve',null,['id'=>'telefonoProve','class'=>'form-control'])!!}
                </div>
              </div>
            </div>
            <div class="col-sm-10 row">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="material-icons">email</i>
                </span>
                <div class="form-group label-floating">
                  <label class="control-label">Ingrese Correo:
                  </label>
                  {!!Form::text('email',null,['id'=>'email','class'=>'form-control'])!!}
                </div>
              </div>
            </div>
            <div class="col-sm-10 row">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="material-icons">email</i>
                </span>
                <div class="form-group label-floating">
                  <label class="control-label">Tipo de Proveedor:
                  </label>

                  <select name="tipoProveedor" id="tipoProveedor" class="form-control" title="Seleccione el tipo de teléfono" 'required' >
                    <option value="1" @isset($prov)>
                      @if($prov->tipoProveedor==1){{ 'selected' }}@endif
                      @endisset >Solo Proveedor</option>
                      <option value="3" @isset($prov)>
                        @if($prov->tipoProveedor==3){{ 'selected' }}@endif
                        @endisset >Proveedor y Mantenimiento</option>
                      </select>

                    </div>
                  </div>
                </div>



              </fieldset>

            </div>
            <div class="modal-footer">
              <div align="center">
                {!! link_to('#proveedor',$title='Registrar',$attributes=['id'=>'agregar','class'=>'btn  btn-verde '],$secure=null)!!}
                <a href="{{ URL::previous() }}" class='btn btn-ocre '  data-dismiss="modal">Cerrar</a>
              </div>
              {!! Form::close() !!}
            </div>
          </div>

        </div>
      </div>
      @section('scripts')
      {!!Html::script('js/jquery.mask.min.js')!!}


      <script type="text/javascript">
      $(document).ready(function(){
        $("#telefonoProve").mask("0000-0000");
      })
      </script>

      <script type="text/javascript">
      $().ready(function() {
        demo.initMaterialWizard();
      });
    </script>


  <script >
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
    document.getElementById("aniosUso").value = "";
  }
  else
  {

    document.getElementById('anios').style.display='block';
    document.getElementById("aniosUso").value = "";
  }
}

$('#agregar').click(function(){
  var nombreEmpresa=$('#nombreEmpresa').val();
  var nombreEncargado=$('#nombreEncargado').val();
  var telefonoProve=$('#telefonoProve').val();
  var email=$('#email').val();
  var tipoProveedor=$('#tipoProveedor').val();
  var route="{{route('proveedores.storeajax')}}";
  var token=$('#token').val();
  $.ajax({
    url:route,
    headers:{'X-CSRF-TOKEN':token},
    dataType:'json',
    type:'POST',
    data:{nombreEmpresa,nombreEncargado,telefonoProve,email,tipoProveedor},
    success:function(res){
      console.log(res);
      var proveedor=$("#idProveedor");
      proveedor.empty();
      proveedor.append("<option value="+null+">Seleccione un proveedor</option>");
      $(res).each(function(key,value){
        proveedor.append("<option value="+value.id+">"+value.nombreEmpresa+"</option>");
      });
      $('#nuevo').modal('hide');
      $('#nombreEmpresa').val("");
      $('#nombreEncargado').val("");
      $('#telefonoProve').val("");
      $('#email').val("");
      $('#tipoProveedor').val("");
    },
    error:function(res){
      console.log(res);
      alert("art");
    }


  });


});


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
