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

    <script>
        $(document).ready(function() {
            $('#datatables').DataTable({
                pagingType: "full_numbers",
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records",
                },
                destroy: true

            });

            $('#vehiculo').change(function(){

                var vehiculo=$("#vehiculo").find('option:selected').val();
                var newUrl = "{{ route('datatable', ['placa' => ':placa']) }}";
                newUrl = newUrl.replace(':placa', vehiculo);

                cargar(newUrl);
            });

        });

        function calculo(ide, costo) {
            var estado= $("#"+ide).prop("checked");
                console.log(estado);
                console.log(costo);

            var monto=0.00;
            var campo=$('#totalFactura');
            var campoCosto=parseFloat(campo.val());

                    if (estado===true)
                    {
                        monto=campoCosto+costo;
                        campo.val(monto.toFixed(2));
                    }
                    if (estado===false)
                    {
                        monto=campoCosto-costo;
                        campo.val(monto.toFixed(2));
                    }

        }

        function cargar(ruta) {
            var cont=0;
            var table = $('#datatables').DataTable( {
                "ajax": { url: ruta ,dataSrc:""},
                "columns": [
                    {
                        "className":      'details-control',
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": ''

                    },
                    {
                        data: null,
                        render: function (data) {
                            // Combine the first and last names into a single table field
                            cont++;
                            return cont;
                        }
                    },
                    {
                        data:null,
                        render: function (data) {
                            // Combine the first and last names into a single table field
                            return (data.fechaCreacion).split("-").reverse().join("/");
                        }
                    },
                    { "data": "numeroVale" },
                    {
                        data:null,
                        render: function ( data ) {
                            // Combine the first and last names into a single table field

                            return new Intl.NumberFormat("en-IN", { minimumFractionDigits:2 }).format(data.costoUnitarioVale);
                        }
                    },
                    {
                        data: null,
                        render: function ( data ) {
                            // Combine the first and last names into a single table field
                            var costo = new Intl.NumberFormat("en-IN", { minimumFractionDigits:2 }).format(data.costoUnitarioVale);
                            return "<label class='switch  material-icons' title='liquidar' rel='tooltip'>"+
                                "<input type='checkbox' name='name["+data.numeroVale+"]' id='"+data.id+"' onchange='calculo("+data.id+","+costo+")' >"+
                                "<span class='slider'></span>";

                        }
                    },
                    {
                        data: null,
                        render: function ( data ) {
                            // Combine the first and last names into a single table field
                            var r="{{ route('vales.show', ['vale' => ':vale']) }}";
                            r=r.replace(':vale', data.id);
                            return "<a href='"+r+"' class='btn btn-xs btn-info btn-round' >"+
                                "<i title='Mostrar' class='material-icons' rel='tooltip'>visibility</i>"+
                                "</a>";
                        }
                    }
                ],
                "order": [[1, 'asc']],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records",
                },
                destroy: true
            } );

            // Add event listener for opening and closing details
            $('#datatables tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row( tr );

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }

            } );

        }
    </script>

@endsection
