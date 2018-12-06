@extends ('plantilla')
@section('plantilla')
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="green">
                    <i class="material-icons">create</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Vales -
                        <small class="category">Mostrar de liquidación</small>
                    </h4>


                    <fieldset style="border: 1px solid #ccc; padding: 10px">
                        <legend>
                            <small>Datos de Liquidación</small>
                        </legend>

                        <div class="col-sm-6">
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Fecha: <br></h4></td>
                                        <td><h4> <b> {{ $liquidacion->fechaLiquidacion }}</b></h4></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Placa: <br></h4></td>
                                        <?php
                                        $vehiculos = $liquidacion->vale;
                                        foreach ($vehiculos as $vehiculo )
                                        {
                                            $placa = $vehiculo->salida->vehiculo;
                                        }
                                        ?>
                                        <td><h4> <b> {{ $placa->numeroPlaca }}</b></h4></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Número de factura: <br></h4></td>
                                        <td><h4> <b> {{ $liquidacion->numeroFacturaLiquidacion }}</b></h4></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </fieldset>

                    <br>
                    <fieldset style="border: 1px solid #ccc; padding: 10px">
                        <legend>
                            <small>Vales liquidados</small>
                        </legend>

                        <div class="card">
                            <div class="card-content">
                                <div class="material-datatables">
                                    <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                           cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>#</th>
                                            <th>Fecha</th>
                                            <th>Número de vale</th>
                                            <th>Valor ($)</th>
                                            <th class="disabled-sorting text-center">Acciones</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>#</th>
                                            <th>Fecha</th>
                                            <th>Número de vale</th>
                                            <th>Valor ($)</th>
                                            <th class="text-right">Acciones</th>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php $cont=0; ?>
                                        @foreach($vales as $vale)

                                            <tr>
                                                <?php $cont++; ?>
                                                <td></td>
                                                <td> {{ $cont }} </td>
                                                <td> {{ $vale->fechaCreacion }} </td>
                                                <td> {{ $vale->numeroVale }} </td>
                                                <td> {{ "$ ".$vale->costoUnitarioVale }} </td>
                                                <td class='text-right'>
                                                    <a href='{{ route('vales.show', $vale->id) }}' class='btn btn-xs btn-info btn-round' >
                                                        <i title='Mostrar' class='material-icons' rel='tooltip'>visibility</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </fieldset>
                    <br>
                    <fieldset style="border: 1px solid #ccc; padding: 10px">

                        <div class="col-lg-4 col-sm-offset-4">
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Monto de factura: <br></h4></td>
                                        <td><h4> <b> {{ "$ ".$liquidacion->montoFacturaLiquidacion }}</b></h4></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </fieldset>
                    <br>

                    <div align="center">
                        <a href="{{ route('liquidaciones.index') }}" class='btn btn-ocre '>Regresar</a>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>

@stop

@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatables').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records",
                }

            });


            var table = $('#datatables').DataTable();

            // Edit record
            table.on('click', '.edit', function() {
                $tr = $(this).closest('tr');

                var data = table.row($tr).data();
                alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
            });

            // Delete a record
            table.on('click', '.remove', function(e) {
                $tr = $(this).closest('tr');
                table.row($tr).remove().draw();
                e.preventDefault();
            });

            //Like record
            table.on('click', '.like', function() {
                alert('You clicked on Like button');
            });

            $('.card .material-datatables label').addClass('form-group');
        });
    </script>
@endsection

