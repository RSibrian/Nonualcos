@extends ('plantilla')
@section('plantilla')
<div class="content">
  <div class="container-fluid">
    <div class="col-sm-10 col-sm-offset-1">
      <!--      Wizard container        -->
      <div class="wizard-container">
        <div class="card wizard-card" data-color="blue" id="wizardProfile">

          {!! Form::open(['route'=>'empleados.store','method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data']) !!}
          {{ csrf_field() }}

          <div class="wizard-header">
            <h3 class="wizard-title">Registrar Empleado</h3>
            <h5>Completar la informacion sobre el empleado.</h5>
          </div>
          <!-- navegación para formulario multipasos -->
          <div class="wizard-navigation">
            <ul>
              <li>
                <a href="#about" data-toggle="tab">Personal</a>
              </li>
              <li>
                <a href="#account" data-toggle="tab">General</a>
              </li>
              <li>
                <a href="#address" data-toggle="tab">Cargo</a>
              </li>
            </ul>
          </div>
          <!-- contenido -->
          <div class="tab-content">
            <div class="tab-pane" id="about">
              <div class="row">
                <h4 class="info-text">Comencemos con la información básica</h4>
                <div class="col-sm-4 col-sm-offset-1">
                  <div class="picture-container">
                    <div class="picture">
                      <img src="{{ asset('img/default-avatar.png') }}" class="picture-src" id="wizardPicturePreview" title="" />
                      {!!Form::file('per_imagenE',['id'=>'wizard-picture','value'=>"{{ asset('img/default-avatar.png') }}",'accept'=>'image/*'])!!}
                    </div>
                    <h6>Elegir la foto</h6>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">face</i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label"><code>*</code>Nombres
                      </label>
                      {!!Form::text('nombresEmpleado',null,['id'=>'nombresEmpleado','class'=>'form-control','required'])!!}
                    </div>
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">record_voice_over</i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label"><code>*</code>Apellidos
                      </label>
                      {!!Form::text('apellidosEmpleado',null,['id'=>'apellidosEmpleado','class'=>'form-control','required'])!!}
                    </div>
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">date_range</i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label"><code>*</code>Fecha de Nacimiento
                      </label>
                      <!-- <?php echo date('d-m-Y',strtotime('-18 year',strtotime($date))); ?> -->
                      {!!Form::date('fechaNacimientoEmpleado',$date,['id'=>'fechaNacimientoEmpleado','class'=>'form-control datepicker'])!!}
                    </div>
                  </div>

                </div>
                <div class="col-sm-5">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">wc</i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label"><code>*</code>Género
                      </label>
                      <select name="generoEmpleado" id="generoEmpleado" class="form-control" placeholder='Seleccione el tipo de permiso' required>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">featured_play_list</i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label" ><code>*</code>Documento Único de Identidad
                      </label>
                      {!!Form::text('DUIEmpleado',null,['id'=>'dui','class'=>'form-control','required'])!!}
                    </div>
                  </div>
                </div>
                <div class="col-sm-10 col-sm-offset-1 clonedInput" id="input1" >
                  <hr>
                  <div class="row" >
                    <div class="form-group col-sm-5" >
                      <label for="telefono" class="sr-only control-label"></label>
                      <input id="telefono" class="form-control input-group-lg reg_name" type="text" name="telefonoEmpleado[]" placeholder="Número telefónico" maxlength="9"/>
                    </div>
                    <div class="form-group col-sm-5">
                      <label for="tipoTelefono" class="sr-only"></label>
                      <select name="tipoTelefono" id="tipoTelefono" class="form-control" title="Seleccione el tipo de teléfono" >
                        <option value="Trabajo">Trabajo</option>
                        <option value="Personal">Personal</option>
                        <option value="Casa">Casa</option>
                      </select>
                    </div>
                    <div class="form-group col-sm-1">
                      <button type="button" id="btnAdd" title="Agregar Teléfono" class=" btn-info"/>
                      <span class="glyphicon glyphicon-plus"></span>
                    </button>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="tab-pane" id="account">
            <h4 class="info-text"> Sigamos con la información General</h4>
            <div class="row">
              <div  class="col-lg-10">
                <div class="col-lg-7 ">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">supervisor_account</i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label">Estado Civil
                        <small>*</small>
                      </label>
                      <select name="estadoCivilEmpleado" id="estadoCivilEmpleado" class="form-control" placeholder='Seleccione el tipo de permiso' required>
                        <option value="Soltero(a)">Soltero(a)</option>
                        <option value="Casado(a)">Casado(a)</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-sm-5">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">&nbsp;#&nbsp;</i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label">NIT:
                        <small>(requerido)</small>
                      </label>
                      {!!Form::text('NITEmpleado',null,['id'=>'nit','class'=>'form-control','required'])!!}
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">home</i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label">Dirreción
                        <small>requerida</small>
                      </label>
                      {!!Form::text('dirreccionEmpleado',null,['id'=>'dirreccionEmpleado','class'=>'form-control','required'])!!}
                    </div>
                  </div>
                </div>

                <div class="col-lg-6 ">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">&nbsp;$ </i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label">
                        <small></small>
                      </label>
                      {!!Form::select('idAFP', $aportaciones,null,['id'=>'idAFP','class'=>'form-control','placeholder'=>'Seleccione la Afiliación','required'])!!}
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons"> &nbsp;#&nbsp; </i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label"># Afiliación
                      </label>
                      {!!Form::number('numeroAFP',null,['id'=>'numeroAFP','class'=>'form-control'])!!}
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 ">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">&nbsp;$ </i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label">
                        <small></small>
                      </label>
                      {!!Form::select('idSeguro', $seguro,null,['id'=>'idSeguro','class'=>'form-control','placeholder'=>'Seleccione el seguro','required'])!!}
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons"> &nbsp;#&nbsp; </i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label"># Seguro
                      </label>
                      {!!Form::number('numeroSeguro',null,['id'=>'numeroSeguro','class'=>'form-control'])!!}
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 " >
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">date_range</i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label">Fecha de Ingreso
                        <small></small>
                      </label>
                      {!!Form::date('fechaIngreso',$date,['id'=>'fechaIngreso','class'=>'form-control datepicker'])!!}

                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">assignment</i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label">Observaciones:
                      </label>
                      {!! Form::textarea('observacionEmpleado',null,['class'=>'form-control'  ,'rows'=>'2', 'style'=>'resize: both;']) !!}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="address">
            <div class="row">
              <div class="col-sm-12">
                <h4 class="info-text">Sigamos con la informacion del Cargo </h4>
              </div>
              <div class="col-sm-12">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="material-icons">apps</i>
                  </span>
                  <div class="form-group label-floating">
                    <label class="control-label">
                    </label>
                    {!!Form::select('unidad_id', $unidades,null,['id'=>'unidad_id','class'=>'form-control','placeholder'=>'Seleccione la unidad'])!!}
                  </div>
                </div>
              </div>

              <div class="col-sm-12">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="material-icons">assignment_ind</i>
                  </span>
                  <div class="form-group label-floating">
                    <label class="control-label">
                    </label>
                    {!!Form::select('idCargo', $cargos,null,['id'=>'cargo_id','class'=>'form-control','placeholder'=>'Seleccione el cargo','required'])!!}
                  </div>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="material-icons"> &nbsp;$&nbsp; </i>
                  </span>
                  <div class="form-group label-floating">
                    <label class="control-label">Salario
                      <small>(requerido)</small>
                    </label>
                    {!!Form::number('salarioBruto',null,['id'=>'salario','class'=>'form-control','required','step' => '0.01'])!!}
                  </div>
                </div>
              </div>


              <div class="col-lg-7 ">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="material-icons">supervisor_account</i>
                  </span>
                  <div class="form-group label-floating">
                    <label class="control-label">Tipo de Contrato

                    </label>
                    <select name="sistemaContratacion" id="sistemaContratacion" class="form-control" placeholder='Seleccione el tipo de permiso' required>
                      <option value="Contrato">Contrato</option>
                      <option value="Ley de Salario">Ley de Salario</option>
                    </select>
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
    <!-- wizard container -->
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
$('#unidad_id').on('change',function(e){
  var cargos=$("#cargo_id");
  var unidad=$("#unidad_id").find('option:selected');
  var ruta="/Nonualcos/public/empleados/create/"+unidad.val();
  $.get(ruta,function(res){
    cargos.empty();
    cargos.append("<option value="+null+">Seleccione un cargo</option>");
    $(res).each(function(key,value){
      cargos.append("<option value="+value.id+">"+value.nombreCargo+"</option>");
    });
  });
});

</script>
{!!Html::script('js/jquery.mask.min.js')!!}
<script type="text/javascript">
$(document).ready(function(){
  $("#cpf").mask("000.000.000-00")
  $("#cnpj").mask("00.000.000/0000-00")
  $("#telefone").mask("(00) 0000-0000")
  //  $("#salario").mask("999.999.990,00", {reverse: true})
  $("#dui").mask("00000000-0")
  $("#cep").mask("00.000-000")
  $("#dataNascimento").mask("00/00/0000")

  $("#rg").mask("999.999.999-W", {
    translation: {
      'W': {
        pattern: /[X0-9]/
      }
    },
    reverse: true
  })

  var options = {
    translation: {
      'A': {pattern: /[A-Z]/},
      'a': {pattern: /[a-zA-Z]/},
      'S': {pattern: /[a-zA-Z0-9]/},
      'L': {pattern: /[a-z]/},
    }
  }

  $("#placa").mask("AAA-0000", options)

  $("#codigo").mask("AA.LLL.0000", options)

  $("#telefono").mask("0000-0000")
  $("#nit").mask("0000-000000-000-0")

})

// $(document).ready(function(){
//     var maxField = 5; //Input fields increment limitation
//     var addButton = $('.add_button'); //Add button selector
//     var wrapper = $('.field_wrapper'); //Input field wrapper
//     var fieldHTML = '<div class="col-sm-5 "><div class="input-group"><span class="input-group-addon"><i class="material-icons"> phone </i></span><div class="form-group label-floating"><label class="control-label">Número telefónico<small></small></label><input id="telefono" name="telefonoEmpleado[]" class="form-control" name="telefonoEmpleado" type="text" maxlength="9"></div></div></div><div class="col-sm-5"><div class="input-group"><span class="input-group-addon"><i class="material-icons"></i></span><div class="form-group label-floating"><label class="control-label">Tipo de teléfono</label><select name="tipoTelefono" id="tipoTelefono" class="form-control"><option value="Trabajo">Trabajo</option><option value="Personal">Personal</option><option value="Casa">Casa</option></select></div></div></div><div class="col-sm-1"><div class="input-group"><span class="input-group-addon"><i class="material-icons"></i></span><div class="form-group label-floating"><label class="control-label"></label><span class="input-group-addon"><a title="Quitar Teléfono" href="javascript:void(0);" class="remove_button" ><i class="material-icons" >remove_circle_outline</i></a></span></div></div></div></div>'; //New input field html
//     var x = 1; //Initial field counter is 1
//     $(addButton).click(function(){ //Once add button is clicked
//         if(x < maxField){ //Check maximum number of input fields
//             x++; //Increment field counter
//             $(wrapper).append(fieldHTML); // Add field html
//         }
//     });
//     $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
//         e.preventDefault();
//         $(this).parent('div').remove(); //Remove field html
//         x--; //Decrement field counter
//     });
// });

$(document).ready(function() {
  $('#btnAdd').click(function() {
    var num     = $('.clonedInput').length; // how many "duplicatable" input fields we currently have
    var newNum  = new Number(num + 1);      // the numeric ID of the new input field being added

    // create the new element via clone(), and manipulate it's ID using newNum value
    var newElem = $('#input' + num).clone().attr('id', 'input' + newNum);

    // manipulate the name/id values of the input inside the new element
    newElem.children(':first').attr('id', 'name' + newNum).attr('name', 'name' + newNum).attr('class', 'form-control');

    // insert the new element after the last "duplicatable" input field
    $('#input' + num).after(newElem);

    // enable the "remove" button
    $('#btnDel').removeAttr('disabled');

    // business rule: you can only add 5 names
    if (newNum == 5)
    $('#btnAdd').attr('disabled','disabled');
  });

  $('#btnDel').click(function() {
    var num = $('.clonedInput').length; // how many "duplicatable" input fields we currently have
    $('#input' + num).remove();     // remove the last element

    // enable the "add" button
    $('#btnAdd').removeAttr('disabled');

    // if only one element remains, disable the "remove" button
    if (num-1 == 1)
    $('#btnDel').attr('disabled','disabled');
  });

  $('#btnDel').attr('disabled','disabled');
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
