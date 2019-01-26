<style>
    #texto {
        margin:0;
        padding:0;
        color: #0d3625;
    }
</style>
<div class="card-content">
  <br>
    <h4 class="card-title" ><b>Seleccionar Activos </b></h4>
    <div class="toolbar">
        <!--        Here you can write extra buttons/actions for the toolbar              -->
    </div>
    <div class="material-datatables">
        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
            <thead>
            <tr>

                <th>#</th>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Color</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>#</th>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Color</th>
            </tr>
            </tfoot>
            <tbody>
            <?php $cont=0;?>
            @foreach ($activos as $activo)
                <tr>

                    <?php $cont++;?>
                        <td>
                            <div class="checkbox" style="display: inline">
                                <label id="texto">
                                    {{ Form::checkbox('activos[]',$activo->idActivo,null,[ 'id'=>"check{$activo->idActivo}"]) }}
                                    {{ $cont}}
                                </label>
                            </div>
                        </td>
                        <td>{{$activo->codigoInventario}}</td>
                        <td>{{$activo->nombreActivo}}</td>
                        <td>{{$activo->marca}}</td>
                        <td>{{$activo->modelo}}</td>
                        <td>{{$activo->color}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>


    </div>
</div>
