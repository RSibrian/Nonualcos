<div id="gridSystemModal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header " >

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="col-md-2  text-center" style="color: white;" >
          <i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
        </span>
          <h4 ><b>Procesar Planilla de Pago Mensual</b>  <span class="violet"></span></h4>

      </div>

      <div class="modal-body">

        <div class="container-fluid bd-example-row">
          <p style='color:#FC8804'><b>IMPORTANTE: </b> </p>
          <p><b>Antes de continuar, asegurese de haber descargado la planilla en formato Excel y la boleta de pago </b></p>

        </div>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        {!! Form::open(['route'=>'planillas.store','method'=>'POST']) !!}
        <input type="hidden" name="concepto" value="Pago de {{\Helper::fecha($fecha_fin_inicio)}} a {{\Helper::fecha($fecha_fin)}} ">
        <div align="center" class="row">
            {!! Form::submit('Procesar',['id'=>"agregar_permiso", "onclick"=>"myFunction()" ,'class'=>'btn btn-verde ']) !!}
            <button type="button" class="btn  btn-ocre " data-dismiss="modal">Cancelar</button>
        </div>
        {!! Form::close() !!}
      </div>

    </div>
  </div>
</div>
