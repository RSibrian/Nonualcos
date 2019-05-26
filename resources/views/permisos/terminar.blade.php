<div id="gridSystemModal2{{$permiso->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header " >

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="col-md-2  text-center" style="color: white;" >
          <i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
        </span>
          <h4 align='left'><b>Agregar Comprobante</b>  <span class="violet"></span></h4>

      </div>

      <div class="modal-body">

        <div class="container-fluid bd-example-row">

            {!!Form::model($permiso,['method'=>'PUT','enctype'=>'multipart/form-data','route'=>['permisos.update',$permiso->id]])!!}
            ¿Desea Agregar el Comprobante?
            <br>
              <input type="hidden" name="hi" value="0">
              <input type="hidden" name="idEmpleado" value="{{$empleado->id}}">
            <div class=" row row" >
                <span class="col-md-2  text-center" ><label > PDF del comprobante:</label></span>
                <div class="col-md-6">
                    {!!Form::file('permisoPdf2',['value'=>'Comprobante del permiso', 'accept'=>'application/pdf','required'])!!}
                </div>
            </div>


              <div class="modal-footer">

              <button type="submit" class="btn btn-sm btn-success ">Aceptar</button>
              <button type="button" class="btn btn-sm btn-ocre " data-dismiss="modal">Cancelar</button>

              </div>

          {!!Form::close()!!}
        </div>
      </div>

    </div>
  </div>
</div>

