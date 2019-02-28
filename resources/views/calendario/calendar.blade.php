@extends ('plantilla')
@section('plantilla')
    <style type="text/css">
        button, button:hover{
            background-color: #195BAA;
            color: #FFFFFF;
            background-color: #195BAA;
            box-shadow: none;
        }
        .fc th {
            padding: 10px 0px;
            vertical-align: middle;
            background: #EFFBFB;
        }
        .modal-body{
            height: 450px;
            width: 100%;
            overflow-y: auto;
        }
        #texto {
            margin:0;
            padding:0;
            color: #0d3625;
        }
    </style>
    <div class="card">
    <div class="container-fluid">
        <div class="header text-center">
            <h3 class="title">Salidas de Vehiculos </h3>
        </div>

        <div class="col-md-12">
            <div class="card card-calendar">
                <div class="card-content" class="ps-child">
                    <div id="fullCalendar"></div>
                </div>
            </div>
        </div>
        <div align="center" class="row">
          <a href="{{ URL::previous() }}" class='btn btn-ocre '>Regresar</a>
        </div>
    </div>
    </div>
@stop

@section('scripts')
    {!!Html::script('js/es.js')!!}


    <script>
        $(document).ready(function(){
            $('#fullCalendar').fullCalendar({
                header:{
                    left:'today,prev,next,Miboton',
                    center:'title',
                    right:'month, agendaWeek, agendaDay'
                },


                events:'calendario/1',
                default:true,
                eventClick:function(calEvent,jsEvent,view){

                    $('#tituloEvento').html("Salida de Vehiculo");
                    $('#nombre').val(calEvent.nombre);
                    $('#txtTitulo').val(calEvent.title);
                    $('#mision').val(calEvent.mision);
                    $('#destino').val(calEvent.destino);


                    $("#fecha").val(calEvent.fecha);


                    $('#txtID').val(calEvent.id);

                    $('#txtColor').val(calEvent.beneficiarioEvent);
                    $('#textColor').val(calEvent.lugarEvent);


                    FechaHora = calEvent.start._i.split(" ");
                    $('#txtFecha').val(FechaHora[0]);
                    $('#txtHora').val(FechaHora[1]);

                    $("#ModalEventos").modal();
                },
                editable:true,
                eventDrop:function(calEvent){
                    $('#txtID').val(calEvent.id);
                    $('#txtTitulo').val(calEvent.title);
                    $('#txtColor').val(calEvent.color);
                    $('#txtDescripcion').val(calEvent.descripcion);

                    var FechaHora=calEvent.start.format().split("T");
                    $('#txtFecha').val(FechaHora[0]);
                    $('#txtHora').val(FechaHora[1]);

                    RecolectarDatosGUI();
                    EnviarInformacion('modificar',NuevoEvento, true);
                }


            });
        });

    </script>


@endsection
<!-- Modal (Agregar, Actualizar, Eliminar)-->

<div id="ModalEventos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <span class="col-md-2  text-center" style="color: white;" >
                <i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
            </span>
                <h4 class="modal-title" id="tituloEvento"></h4>
            </div>
            {!! Form::open() !!}
            <div class="modal-body">
                <div class="form">
                    <div class=" col-md-12">
                        <label>Nombre del Motorista:</label>
                        {!!Form::text('nombre',null,['id'=>'nombre','class'=>'form-control','disabled'])!!}
                    </div>
                    <div class=" col-md-8">
                        <label>Número de placa:</label>

                        {!!Form::text('txtTitulo',null,['id'=>'txtTitulo','class'=>'form-control','disabled'])!!}
                    </div>
                    <div class="form-group col-md-4">
                        <label>fecha:</label>
                        {!!Form::text('fecha',null,['id'=>'fecha','class'=>'form-control','disabled'])!!}
                    </div>

                    <div class="form-group col-md-12">
                        <label>Destino:</label>
                        {!!Form::text('destino',null,['id'=>'destino','class'=>'form-control','disabled'])!!}
                    </div>
                    <div class="form-group col-md-12">
                        <label>Misión:</label>
                        {!!Form::text('mision',null,['id'=>'mision','class'=>'form-control','disabled'])!!}
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button"  class="btn btn-ocre" data-dismiss="modal">Cerrar</button>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>
