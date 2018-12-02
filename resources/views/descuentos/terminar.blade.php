<div id="gridSystemModal2{{$descuento->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header alert-info" bgcolor="blue">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="col-md-2  text-center" style="color: white;" >
          <i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
        </span>
          <h4 class="modal-title" id="gridModalLabel3" ><b>Finalizar Descuento</b></h4>

      </div>

      <div class="modal-body">

        <div class="container-fluid bd-example-row">

            {!!Form::model($descuento,['method'=>'PUT','enctype'=>'multipart/form-data','route'=>['descuentos.update',$descuento->id]])!!}
            ¿Desea finaliza el Descuento?
            <br>
              <input type="hidden" name="hi" value="{{ $descuento->estadoDescuento }}">
              <input type="hidden" name="idEmpleado" value="{{$empleado->id}}">
            <div class="col-lg-12 row">
                <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="material-icons">place</i>
                                                        </span>
                    <div class="form-group label-floating">
                        <label class="control-label">Detalle:
                        </label>
                        {!! Form::textarea('observacionDescuento',null,['class'=>'form-control'  ,'rows'=>'2', 'style'=>'resize: both;']) !!}
                    </div>
                </div>
            </div>
            <br>
            <div class=" row row" >
                <span class="col-md-2  text-center" ><label ><code>*</code> PDF del comprobante:</label></span>
                <div class="col-md-6">
                    {!!Form::file('pre_imagen2',['value'=>'Comprobante del Descuento', 'accept'=>'application/pdf','required'])!!}
                </div>
            </div>


              <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Aceptar</button>

              </div>

          {!!Form::close()!!}
        </div>
      </div>

    </div>
  </div>
</div>