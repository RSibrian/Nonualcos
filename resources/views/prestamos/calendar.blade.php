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
            <h3 class="title">Eventos de Calendario </h3>
            <h5 align="center"><strong>Indicadores de Color:</strong></h5>
        </div>
        <div class="col-sm-12 col-md-offset-1">
                <table>
                    <tr>
                        <td>
                            <button class="btn btn-info btn-round btn-sm">Pendiente</button>
                        </td>
                        <td>
                            <button style="background-color: #7D29A0" class="btn btn-round btn-sm">Entregado</button>
                        </td>
                        <td>
                            <button class="btn btn-verde btn-round btn-sm" >Completo</button>
                        </td>
                        <td>
                            <button style="background-color: #831517" class="btn btn-round btn-sm" >Cancelado</button>
                        </td>
                        <td>
                            <button class="btn  btn-danger btn-round btn-sm" >No Reclamado</button>
                        </td>
                        <td>
                            <button style="background-color: #FC8804" class="btn btn-round btn-sm">Devuelto Tarde</button>
                        </td>
                        <td>
                            <button class="btn  btn-round btn-sm" style=" background-color: #6A6968">No Devuelto</button>
                        </td>
                    </tr>
                </table>
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
                /* customButtons:{
                     Miboton:{
                         text:"Boton 1",
                         click:function(){
                             alert("Accion del Boton");
                         }
                     }
                 }*/
               /* dayClick:function(date,jsEvent,view){

                    $('#btnAgregar').prop("disabled", false);
                    $('#btnModificar').prop("disabled", true);
                    $('#btnCancelar').prop("disabled", true);

                    $('#tituloEvento').html("");
                    $('#txtID').val("");
                    $('#txtTitulo').val("");
                    $('#txtColor').val("");
                    $('#txtDescripcion').val("");
                    $('#txtHora').val("");
                    $('#datatables').val("");
                    $('#txtTelefono').val("");
                    $('#txtDui').val("");
                    $('#textColor').val("");
                    $('#txtFecha').val(date.format());
                    $("#ModalEventos").modal();
                },*/

                events:'prestamos/1',
                default:true,
                eventClick:function(calEvent,jsEvent,view){
                    estado=calEvent.estado;
                    $('#btnEntregar').prop("disabled", true);
                    $('#btnFinalizar').prop("disabled", true);
                    $('#btnCancelar').prop("disabled", true);
                    if(estado==1) {
                        $('#btnEntregar').prop("disabled", false);
                        $('#btnCancelar').prop("disabled", false);
                    }else if(estado==4) {
                        $('#btnFinalizar').prop("disabled", false);
                    } else if(estado==5) {
                        $('#btnFinalizar').prop("disabled", false);
                    }
                    // H2
                    $('#tituloEvento').html("Evento Registrado");


                    //$('#txtDescripcion').html(calEvent.descripcion);

                    $("#tablaActivos").html(calEvent.descripcion);

                    // Mostrar la informacion del evento en los inputs
                    //$('#txtDescripcion').val(calEvent.descripcion);
                    $('#txtID').val(calEvent.id);
                    $('#txtTitulo').val(calEvent.title);
                    $('#txtColor').val(calEvent.beneficiarioEvent);
                    $('#textColor').val(calEvent.lugarEvent);
                    $('#txtTelefono').val(calEvent.telefono);
                    $('#txtDui').val(calEvent.dui);

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
    <script>
        /*para mostrar reloj en el calendario*/
       // $('.clockpicker').clockpicker();
        /*fin de reloj*/

        $(document).ready(function() {


        });


        $("#btnCancelar").click(function(){
            var id = $('#txtID').val();
            var estadoPrestamo = 0;
            var route="{{route('prestamos.storeajaxcancel')}}";
            var token = $("#token").val();
            $.ajax({
                url: route,
                headers: {'X-CSRF-TOKEN':token},
                type: 'POST',
                dataType: 'json',
                data:{id, estadoPrestamo},
                success:function(response){
                    $('#fullCalendar').fullCalendar('refetchEvents');

                    $("#ModalEventos").modal('toggle');
                }
            });
        });

        function finalizar() {
            var id = $('#txtID').val();
            var estadoPrestamo = 2;
            var route="{{route('prestamos.storeajaxfinalizar')}}";
            var token = $("#token").val();
            $.ajax({
                url: route,
                headers: {'X-CSRF-TOKEN':token},
                type: 'POST',
                dataType: 'json',
                data:{id, estadoPrestamo},
                success:function(response){
                    $('#fullCalendar').fullCalendar('refetchEvents');
                    $("#ModalEventos").modal('toggle');
                }
            });
        }
        function entregado() {
            var id = $('#txtID').val();
            var estadoPrestamo = 4;
            var route="{{route('prestamos.storeajaxcancel')}}";
            var token = $("#token").val();
            $.ajax({
                url: route,
                headers: {'X-CSRF-TOKEN':token},
                type: 'POST',
                dataType: 'json',
                data:{id,estadoPrestamo},
                success:function(response){
                    $('#fullCalendar').fullCalendar('refetchEvents');
                    $("#ModalEventos").modal('toggle');
                }
            });
        }

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
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" id="txtID" name="txtID" /><br/>
                <div class="form-row">
                    <div class=" col-md-12">
                        <label>Evento:</label>

                        {!!Form::text('txtTitulo',null,['id'=>'txtTitulo','class'=>'form-control','disabled'])!!}
                    </div>
                    <div class=" col-md-12">
                        <label>Nombre Solicitante:</label>
                        {!!Form::text('txtColor',null,['id'=>'txtColor','class'=>'form-control','disabled'])!!}

                    </div>
                    <div class="form-group col-md-6">
                        <label>Número DUI:</label>
                        {!!Form::text('txtDui',null,['id'=>'txtDui','class'=>'form-control','disabled'])!!}
                    </div>
                    <div class="form-group col-md-6">
                        <label>Número Teléfono:</label>
                        {!!Form::text('txtTelefono',null,['id'=>'txtTelefono','class'=>'form-control','disabled'])!!}
                    </div>
                    <div class="form-group col-md-8">
                        <label>Institución:</label>
                        {!!Form::text('textColor',null,['id'=>'textColor','class'=>'form-control','disabled'])!!}
                    </div>
                    <div class="form-group col-md-4">
                        <label>Hora:</label>
                        <div class="input-group clockpicker" data-autoclose="true">
                            {!!Form::text('txtHora',null,['id'=>'txtHora','class'=>'form-control','disabled'])!!}

                        </div>
                    </div>
                    <div class="form-group col-md-12" align="center">
                        <label>Préstamo Solicitado:</label>
                    </div>
                    <div class="form-group col-sm-12">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%";>
                            <thead>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th >Código</th>
                                <th >Nombre</th>
                                <th >Marca</th>
                                <th>Modelo</th>
                                <th>Color</th>
                            </tr>
                            </thead>
                            <tbody id="tablaActivos">
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type='button' id="btnFinalizar" onClick="finalizar();" class='btn btn-finish btn-fill btn-primary' >Finalizar</button>
                <button type='button' id="btnEntregar" onClick="entregado();" class='btn btn-finish btn-fill btn-azul'>Entregar</button>
                <button type='button'  id="btnCancelar" class='btn btn-fill btn-danger' >Cancelar</button>
                <button type="button"  class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>
