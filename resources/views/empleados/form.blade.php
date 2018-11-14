<fieldset>
    <h6 class="campoObligatorio">los campos con ( * ) son obligatorios</h6>
    <div class="form-group row">
        <span class="col-md-2  text-center" ><label ><code>*</code> Sección :</label></span>
        <div class="col-md-8">
            {!!Form::select('seccion_id', $secciones,null,['id'=>'seccion_id','class'=>'form-control'])!!}
        </div>
    </div>
    <div class="form-group row">
        <span class="col-md-2  text-center" ><label ><code>*</code> Codigo:</label></span>
        <div class="col-md-6">
            {!!Form::number('sec_codigo',null,['id'=>'sec_codigo','class'=>'form-control', 'placeholder'=>'Codigo de la seccion','required','disabled'])!!}
        </div>
    </div>
    <div class="form-group row">
        <span class="col-md-2  text-center" ><label ><code>*</code> Cargo : </label></span>
        <div class="col-md-8">
            {!!Form::text('car_nombre',null,['id'=>'car_nombre','class'=>'form-control', 'placeholder'=>'Ingrese el nombre del cargo...','required'])!!}
        </div>
    </div>
</fieldset>
@section('scripts')

    <script>
$('#seccion_id').on('change',function(e){
    var sec_codigo=$("#sec_codigo");
    var seccion_id=$("#seccion_id").find('option:selected');
    var ruta="/RecursosHumanos/public/cargos/create/"+seccion_id.val();
    $.get(ruta,function(res){

        sec_codigo.empty();
        $(res).each(function(key,value){
            sec_codigo.val(value.sec_codigo);

        });
    });
});
    </script>
@endsection