<style>
    .switch input {
        display:none;
    }
    .switch {
        display:inline-block;
        width:40px;
        height:20px;
        margin:8px;
        transform:translateY(50%);
        position:relative;
        margin-bottom: 22px;

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
        width:100%;
        height:100%;
        background:#777;
        border-radius:20px;
        transform:translateX(-20px);
        transition:.4s;
    }

    input:checked + .slider:before {
        transform:translateX(20px);
        background:dodgerblue;
    }
    input:checked + .slider {
        box-shadow:0 0 0 2px dodgerblue,0 0 2px dodgerblue;
    }

</style>

<fieldset style="border: 1px solid #ccc; padding: 10px">
    <legend>
        <small>Vales a liquidar</small>
    </legend>

        <div class="card">
            <div class="card-content">
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                        <tr>
                            <th></th>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Código de vale</th>
                            <th>Valor ($)</th>
                            <th class="disabled-sorting text-center" colspan="2">Acciones</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th></th>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Código de vale</th>
                            <th>Valor ($)</th>
                            <th class="text-center" colspan="2">Acciones</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php
                        $cont=0;
                        //echo dd($_liquidar);
                        ?>
                        @foreach($_liquidar as $liquida)
                            <tr>
                                <td></td>
                                <?php $cont++ ?>
                                <td>{{ $cont }}</td>
                                <td>{{ $liquida->fechaCreacion }}</td>
                                <td>{{ $liquida->numeroVale }}</td>
                                <td>{{ $liquida->costoUnitarioVale }}</td>

                                <td class="text-right">
                                    <a href="{{route('vales.show', $liquida->id)}}" class="btn btn-xs btn-info btn-round">
                                        <i title="Mostrar" class="material-icons">visibility</i>
                                    </a>
                                </td>
                                <td>
                                    <label class="switch" title="liquidar">
                                        <input type="checkbox" name="name[{{$liquida->numeroVale}}]" id="{{ $liquida->numeroVale }}" onchange="estado({{$liquida->numeroVale}},{{ $liquida->costoUnitarioVale}})">
                                        <span class="slider"></span>
                                    </label>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </div>

</fieldset>

@section('scripts')

<script type="text/javascript">

    function estado(name, valor){
         var monto;
        if ($('#' + name).prop("checked") == true) {
            //suma
             monto=parseFloat($('#totalFactura').val())+valor;
             $('#totalFactura').val(monto);

        } else {
            //resta
            monto=parseFloat($('#totalFactura').val())-valor;
            $('#totalFactura').val(monto);
        }

    }
</script>
@endsection

