@extends ('plantilla')
@section('plantilla')
    <style>

        .switch input {
            display:none;
            background: white;
        }
        .switch {
            display:inline-block;
            width:40px;
            height:20px;
            margin: 5px;
            transform:translateY(-20%);
            position:relative;
            background: white;
        }

        .slider {
            position:absolute;
            top:0;
            bottom:0;
            left:0;
            right:0;
            border-radius:20px;
            box-shadow:0 0 0 2px #777, 0 0 4px #777;
            cursor:pointer;
            border:4px solid transparent;
            overflow:hidden;
            transition:.4s;
            background: white;
        }
        .slider:before {
            position:absolute;
            content:"";
            width:50%;
            height:100%;
            background:#777;
            border-radius:10px;
            transform:translateX(-20px);
            transition:.4s;
        }

        input:checked + .slider:before {
            transform:translateX(3px);
            background:dodgerblue;
        }
        input:checked + .slider {
            box-shadow:0 0 0 2px dodgerblue,0 0 2px dodgerblue;
        }

    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="ocre">
                    <i class="material-icons">assignment</i>
                </div>
                <div class="card-header card-header-icon" data-background-color="azul" data-toggle="modal" data-target="#myModal">
                    <i class="material-icons">help</i>

                </div>
                <div class="card-content">
                    <h4 class="card-title">Gestión de Vales</h4>
                    <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <div class="material-datatables">
                        @can('vales.create')
                            <a href="{{ route('vales.create') }}" class="btn  btn-verde btn-round ">
                                <i class="material-icons">add</i>
                                Nuevo
                            </a>
                        @endcan

                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th class="text-center">Fecha</th>
                                    <th class="text-center">Unidad</th>
                                    <th>Solicitante</th>
                                    <th>Galones</th>
                                    <th>Costo</th>
                                    <th>Entregado</th>
                                    <th>Devuelto</th>
                                    <th class="disabled-sorting text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th class="text-center">Fecha</th>
                                    <th class="text-center">Unidad</th>
                                    <th>Solicitante</th>
                                    <th>Galones</th>
                                    <th>Costo</th>
                                    <th>Entregado</th>
                                    <th>Devuelto</th>
                                    <th class="text-right">Acciones</th>
                                </tr>
                            </tfoot>
                            <tbody class="text-center">
                            <?php $cont=0;
                                  $estado='';
                            ?>
                             @foreach($_vales as $vale)
                              <tr>
                                  <td></td>
                                  <?php $cont++;?>
                                <td>{{ $cont }}</td>
                                <td>
                                  <p>{{ \Helper::fecha($vale->fechaCreacion) }}</p>
                                </td>
                                  <td>
                                      <?php $unidad=$vale->salida->empleados->cargo->unidad; ?>
                                      <p>
                                          {{ $unidad->nombreUnidad }}
                                      </p>
                                  </td>
                                <td>
                                    <?php $nombre=$vale->salida->empleados; ?>
                                  <p>
                                       {{ $nombre->getFullNameAttribute() }}
                                  </p>
                                </td>
                                  <td>
                                      <p>
                                          @if ( $vale->galones==null)
                                              {{ 'No especificado' }}
                                          @else
                                              {{ \Helper::dinero($vale->galones) }}
                                          @endif
                                      </p>
                                  </td>
                                  <td>
                                      <p>
                                          @if ( $vale->costoUnitarioVale==null)
                                              {{ 'No especificado' }}
                                          @else
                                              {{ '$ '.\Helper::dinero($vale->costoUnitarioVale) }}
                                          @endif

                                      </p>
                                  </td>
                                <td>
                                    @if ($vale->estadoEntregadoVal===1)
                                        {{ 'Si' }}
                                    @else
                                        <label class='switch  material-icons' title='Entregar' rel='tooltip'>
                                            <input type='checkbox' id='{{ $vale->id }}' class='entregado' >
                                            <span class='slider'></span>
                                        </label>
                                        @php
                                            $estado='disabled';
                                        @endphp
                                    @endif
                                </td>
                                <td>
                                    @if ($vale->estadoRecibidoVal===1)
                                        {{ 'Si' }}
                                    @else
                                        <label class='switch  material-icons' title='Devolver' rel='tooltip'>
                                            <input type='checkbox' id='{{ $vale->id }}' class='devuelto'
                                            @if($estado==='disabled')
                                                {{ $estado }}
                                            @endif
                                            >
                                            <span class='slider'></span>
                                        </label>
                                    @endif
                                </td>
                                <td class="text-right">
                                  @can('users.edit')
                                      <a href="{{ route('vales.edit', $vale->id) }}"  class="btn btn-xs btn-info btn-round ">
                                          <i title="Editar vale" class="material-icons" rel="tooltip">create</i>
                                      </a>
                                  @endcan
                                  <a href="{{ route('vales.show', $vale->id) }}" class="btn btn-xs btn-info btn-round " >
                                      <i title="Mostrar Vale" class="material-icons"  rel="tooltip">visibility</i>
                                  </a>
                                </td>
                              </tr>
                                 @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
    <!-- end row -->
    <div class="col-md-1"></div>
    <?php
    $ayuda_title="Ayuda para la Tabla de Vale";
    $ayuda_body="Cada Vale tiene 3 botones <br>
                   1- Este <i class='material-icons'>create</i>&nbsp; Icono es para editar el vale     <br><br>
                   2- Este <i class='material-icons'>visibility</i> Icono es para ver los datos del vale"
    ?>
    @include('alertas.ayuda')
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

        $('#table-filter').on('change', function(){
            table.search(this.value).draw();
        });

        var table = $('#datatables').DataTable();

        $('.card .material-datatables label').addClass('form-group');
    });
</script>

<script>
    var entregado=$('.entregado');
    entregado.on('click', function(){
        var vale= $(this).attr('id');
        var estado= $(this).prop('checked');

        if(estado===true){
            var newUrl = "{{ route('vales.entregar', ['vale' => ':vale']) }}";
            newUrl = newUrl.replace(':vale', vale);
            entregar(newUrl);
        }

        function entregar(newUrl){
            $.ajax({
                type:'GET',
                url:newUrl,
                dataType:'json',
                success: function (data) {
                    location.reload();
                    console.log(data);
                },
                error: function() {
                    location.reload();
                    console.log(data);
                }
            });
        }
    });

</script>

<script>
    var devuelto=$('.devuelto');
    devuelto.on('click', function(){
        var vale= $(this).attr('id');
        var estado= $(this).prop('checked');

        if(estado===true){
            var newUrl = "{{ route('vales.devolver', ['vale' => ':vale']) }}";
            newUrl = newUrl.replace(':vale', vale);
            devolver(newUrl);
        }

        function devolver(newUrl){
            $.ajax({
                type:'GET',
                url:newUrl,
                dataType:'json',
                success: function (data) {
                    location.reload();
                    console.log(data);
                },
                error: function() {
                    console.log(data);
                    location.reload();
                }
            });
        }
    });
</script>

@endsection
