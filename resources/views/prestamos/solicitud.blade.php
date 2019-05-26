<div id="gridSystemModal2{{$prestamo->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header " >

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="col-md-2  text-center" style="color: white;" >
          <i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
        </span>
          <h4 align='left'><b>Agregar Solicitud de Préstamo</b>  <span class="violet"></span></h4>

      </div>

      <div class="modal-body">

        <div class="container-fluid bd-example-row">

            {!!Form::model($prestamo,['method'=>'PUT','enctype'=>'multipart/form-data','route'=>['prestamos.update',$prestamo->id]])!!}

            <div class=" row row" >
                <span class="col-md-2  text-center" ><label ><code>*</code> PDF de la Solicitud:</label></span>
                <div class="col-md-6">
                    {!!Form::file('pdfPrestamo2',['value'=>'Solicitud de Préstamo', 'accept'=>'application/pdf','required'])!!}
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
