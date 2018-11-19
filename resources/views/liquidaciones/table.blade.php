
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
<?php $cont=0;?>
@foreach($_liquidar as $liquida)
    <tr>
      <td></td>
        <?php $cont++ ?>
      <td>{{ $cont }}</td>
      <td>{{ $liquida->fechaCreacion }}</td>
      <td>{{ $liquida->numeroVale }}</td>
      <td>{{ $liquida->costoUnitarioVale }}</td>

      <td class="text-right">
          <a href="" class="btn btn-xs btn-info btn-round">
              <i title="Mostrar" class="material-icons">visibility</i>
          </a>
      </td>
        <td>
            <label class="switch" title="liquidar">
                <input type="checkbox" name="estadoLiquidacion" id="estadoLiquidacion">
                <span class="slider"></span>
            </label>
        </td>
    </tr>
@endforeach
</tbody>
</table>

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

