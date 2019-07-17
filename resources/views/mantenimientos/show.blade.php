
@extends ('plantilla')
@section('plantilla')
<div class="row">
  <div class=" col-sm-offset-1  col-md-10">
    <div class="card">
      <div class="card-header card-header-icon" data-background-color="blue">
        <i class="material-icons">perm_identity</i>
      </div>
      <div class="card-content">
        <h4 class="card-title">Mantenimientos -
          <small class="category">Mostrando detalles de mantenimiento </small>
        </h4>

        <br>
        <fieldset style="border: 1px solid #ccc; padding: 10px">
          <legend><small>Artículo</small></legend>

          <div class="container">
            <div class="row">
              <div class="col col-md-1">
                <h4>Código:</h4>
              </div>
              <div class="col col-md-2">
                <h4><strong>
                  {{ $mantenimiento->activos->codigoInventario }}
                </strong></h4>
              </div>
              <div class="col col-md-1">
                <h4>Nombre:</h4>
              </div>
              <div class="col col-md-6">
                <h4><strong>
                  {{ $mantenimiento->activos->nombreActivo }}
                </strong></h4>
              </div>
            </div>

            <div class="row">
              <div class="col col-md-2">
                <h4>Clasificación:</h4>
              </div>
              <div class="col col-md-8">
                <h4><strong>
                  {{ $mantenimiento->activos->clasificacionActivo->nombreTipo }}
                </strong></h4>
              </div>
            </div>
            <div class="row">
              <div class="col col-md-2">
                <h4>Proveedor:</h4>
              </div>
              <div class="col col-md-8">
                <h4><strong>
                  <?php if (isset($mantenimiento->activos->proveedor->nombreEmpresa)): ?>
                    {{ $mantenimiento->activos->proveedor->nombreEmpresa }}
                    <?php else: ?>
                      {{"No asignado"}}
                  <?php endif; ?>
                </strong></h4>
              </div>
            </div>
          </div>
        </fieldset>
        <br>
        <fieldset style="border: 1px solid #ccc; padding: 10px">
          <legend><small>Datos de Solicitud</small></legend>

          <div class="container">
            <div class="row">
              <div class="col col-md-3">
                <h4>Fecha de inicio de solicitud :</h4>
              </div>
              <div class="col col-md-3">
                <h4><strong>
                  {{ \Helper::fecha($mantenimiento->fechaRecepcionTaller) }}
                </strong></h4>
              </div>
            </div>
            <div class="row">
              <div class="col col-md-3">
                <h4>Personal de ALN que solicita:</h4>
              </div>
              <div class="col col-md-7">
                <h4><strong>
                  {{ $mantenimiento->empleado1->fullName }}
                </strong></h4>
              </div>
            </div>
            <div class="row">
              <div class="col col-md-3">
                <h4>Empresa encargada:</h4>
              </div>
              <div class="col col-md-7">
                <h4><strong>
                  {{ $mantenimiento->proveedores->nombreEmpresa }}
                </strong></h4>
              </div>
            </div>
            <div class="row">
              <div class="col col-md-3">
                <h4>Persona encargada de mantenimiento:</h4>
              </div>
              <div class="col col-md-7">
                <h4><strong>
                  {{ $mantenimiento->nombreEncargado }}
                </strong></h4>
              </div>
            </div>
            <div class="row">
              <div class="col col-md-3">
                <h4>Mantenimiento Solicitado:</h4>
              </div>
              <div class="col col-md-7">
                <h4>
                  {{ $mantenimiento->reparacionesSolicitadas }}
                </h4>
              </div>
            </div>
          </div>

        </fieldset>
        <br>

        <fieldset style="border: 1px solid #ccc; padding: 10px">
          <legend><small></small></legend>
          <div class="container">
            <div class="row">
              <div class="col col-md-3">
                <h4>Estado de mantenimiento:</h4>
              </div>
              <div class="col col-md-7">
                <h4><strong>
                  <?php if ($mantenimiento->personalRecibeMantenimiento==null): ?>
                    <p class="text-warning"> En Curso </p>
                  <?php else: ?>
                    <p class="text-success"> Finalizado </p>
                  <?php endif; ?>
                </strong></h4>
              </div>
            </div>
          </div>
        </fieldset>
        <br>

        <?php if ($mantenimiento->personalRecibeMantenimiento!=null): ?>
          <fieldset style="border: 1px solid #ccc; padding: 10px">
            <legend><small>Datos de Mantenimiento</small></legend>

            <div class="container">

              <div class="row">
                <div class="col col-md-3">
                  <h4>Fecha de Retorno:</h4>
                </div>
                <div class="col col-md-3">
                  <h4><strong>
                    {{ \Helper::fecha($mantenimiento->fechaRetornoTaller) }}
                  </strong></h4>
                </div>
              </div>
              <div class="row">
                <div class="col col-md-3">
                  <h4>Personal de ALN que recibe:</h4>
                </div>
                <div class="col col-md-7">
                  <h4><strong>
                    {{ $mantenimiento->empleado2->fullName }}
                  </strong></h4>
                </div>
              </div>
              <div class="row">
                <div class="col col-md-3">
                  <h4>Costo de mantenimiento:</h4>
                </div>
                <div class="col col-md-7">
                  <h4><strong>$
                    {{ \Helper::dinero($mantenimiento->costoMantenimiento)
                  }}
                </strong></h4>
              </div>
            </div>
            <div class="row">
              <div class="col col-md-3">
                <h4>Mantenimiento Realizado:</h4>
              </div>
              <div class="col col-md-7">
                <h4>
                  {{ $mantenimiento->reparacionesRealizadas }}
                </h4>
              </div>
            </div>

          </div>

        </fieldset>
      <?php endif; ?>
      <br>

      <div align="center">
        <a href="{{ url()->previous() }}" class='btn btn-ocre '>Regresar</a>
      </div>

    </div>
  </div>
</div>
</div>


<!-- end row -->
@stop
