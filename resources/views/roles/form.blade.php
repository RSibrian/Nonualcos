<style>
    #texto {
        margin:0;
        padding:0;
        color: #0d3625;
    }
</style>
<fieldset>
    <h6 class="campoObligatorio">los campos con ( * ) son obligatorios</h6>
    <div class="col-sm-10 row">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">assignment_ind</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code> Nombre del Rol :
                </label>
                {!!Form::text('name',null,['id'=>'name','class'=>'form-control', 'required'])!!}

            </div>
        </div>
    </div>
    <div class="col-sm-10 row">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">assignment_ind</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Slug :
                </label>
                {!!Form::text('slug',null,['id'=>'slug','class'=>'form-control','required'])!!}

            </div>
        </div>
    </div>
    <div class="col-sm-10 row">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">assignment</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Descripción  :
                </label>
                {!!Form::text('description',null,['id'=>'description','class'=>'form-control','required'])!!}

            </div>
        </div>
    </div>


    <div class="col-sm-10 row">
        <div class="input-group">
          <h6>Permiso especial</h6>
        <div class="radio">
            <label style="color: #0d3625;" for="radio3">
                {{ Form::radio('special','','true',[ 'id'=>"radio3"]) }}Personalizado &nbsp;
            </label>

            <label style="color: #0d3625;" for="radio1">
                {{ Form::radio('special','all-access',null,[ 'id'=>"radio1"]) }}Acceso total
                &nbsp;
            </label>

            <label style="color: #0d3625;" for="radio2">
                {{ Form::radio('special','no-access',null,[ 'id'=>"radio2"]) }}Sin Acceso &nbsp;
            </label>

        </div>
      </div>
    </div>
    <div class="col-sm-10 row">
    <div class="input-group">
        <h6>Lista de Permisos</h6>
      </div>
    </div>
    <div class="material-datatables">
        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
            <thead>
            <tr>
                <th></th>

                <th>Nombre</th>
                <th>Descripción</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th></th>

                <th>Nombre</th>
                <th>Descripción</th>

            </tr>
            </tfoot>
            <tbody>
            @foreach($permissions as $permission)
                <tr>
                    <td></td>
                    <td>
                        <div class="checkbox" style="display: inline">
                            <label id="texto">
                                {{ Form::checkbox('permissions[]',$permission->id,null,[ 'id'=>"check{$permission->id}"]) }} {{ $permission->name }}
                            </label>
                        </div>
                    </td>

                    <td>
                        <label id="texto">
                            ({{ $permission->description ?: "Sin Descripción" }})
                        </label>
                    </td>

                </tr>
            @endforeach
            <tbody>
        </table>
    </div>

    </div>

    @section('scripts')

        <script type="text/javascript">



            $(document).ready(function() {
                table =  $('#datatables').DataTable({
                    "pagingType": "full_numbers",
                    "lengthMenu": [
                        [10, 25, 50, -1],
                        [10, 25, 50, "Todos"]
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
            function myFunction() {
                table=$('#datatables').DataTable();
                table.destroy();
                table= $('#datatables').DataTable({
                    "pagingType": "full_numbers",
                    "lengthMenu": [
                        [-1],
                        ["Todos"]
                    ],
                    responsive: true,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search records",
                    }

                });
            }
        </script>
    @endsection
</fieldset>
