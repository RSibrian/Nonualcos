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
        margin-bottom: 23px;
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
                            <th>Número de vale</th>
                            <th>Valor ($)</th>
                            <th class="disabled-sorting" >Liquidar</th>
                            <th class="disabled-sorting">Detalle</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th></th>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Número de vale</th>
                            <th>Valor ($)</th>
                            <th>Liquidar</th>
                            <th>Detalle</th>
                        </tr>
                        </tfoot>
                        <tbody id="cuerpo">
                        </tbody>
                    </table>
                </div>
        </div>
    </div>

</fieldset>

@section('scripts')
    {!!Html::script('js/liquidacionCreate.js')!!}

    <script>
        $('#vehiculo').change(function(){

            var vehiculo=$("#vehiculo").find('option:selected').val();
            var newUrl = "{{ route('datatable', ['placa' => ':placa']) }}";
            newUrl = newUrl.replace(':placa', vehiculo);

            var r="{{ route('vales.show', ['vale' => ':vale']) }}";

            cargar(newUrl, r);
        });

    </script>
@endsection
