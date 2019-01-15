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
                            <th class="disabled-sorting text-right" >Acciones</th>
                            <th class="disabled-sorting text-right"></th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th></th>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Número de vale</th>
                            <th>Valor ($)</th>
                            <th class="text-right" >Acciones</th>
                            <th class="text-right"></th>
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
    $('#vehiculo').change(function(){
        var tabla=$("#cuerpo");
        var vehiculo=$("#vehiculo").find('option:selected');
        var ruta = "/datatable/"+vehiculo.val();

        $.get(ruta,function(res){
            var cont=0;
            if(res!=""){
                tabla.empty();
                $(res).each(function(key,value){
                    cont++;
                    tabla.append(
                        "<tr>"+"<td></td>"+"<td>"+ cont +"</td>"+
                        "<td>"+ value.fechaCreacion +"</td>"+
                        "<td>"+ value.numeroVale +"</td>"+
                        "<td>"+ value.costoUnitarioVale +"</td>"+
                        "<td class='text-right'>"+
                        "<a href='/vales/show/"+value.id+"' class='btn btn-xs btn-info btn-round' >"+
                        "<i title='Mostrar' class='material-icons' rel='tooltip'>visibility</i>"+
                        "</a>"+
                        "</td>"+
                        "<td>"+
                        "<label class='switch  material-icons' title='liquidar' rel='tooltip'>"+
                        "<input type='checkbox' name='name["+value.numeroVale+"]' id='"+value.id+"' class='estado' >"+
                        "<span class='slider'></span>"+
                        "</label>"+
                        "</td>"+
                        "</tr>"
                    );
                });
            }else{
                tabla.empty();
                tabla.append(
                    "<tr>"+"<td colspan='7' align='center'>No hay datos disponibles en la tabla</td>"+
                    "</tr>"
                );
            }

            $(".estado").on("change", function () {
                var a=$(this).attr('id');
                var b=$(this).prop("checked");
                total(a,b);
            })

        });


    });

</script>
<script>
    function total(a,b){
        var monto=0.0;
        var campo=$('#totalFactura');
        var campoCosto=parseFloat($('#totalFactura').val());
        var ruta = "/costo/"+a;

        $.get(ruta, function (res) {

            $(res).each(function (key,value) {
                  if (b===true)
                  {
                      monto=campoCosto+value.costoUnitarioVale;
                      campo.val(monto);
                  }
                  if (b===false)
                  {
                      monto=campoCosto-value.costoUnitarioVale;
                      campo.val(monto);
                  }
            });
        });

    }

</script>

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

