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

});

function cargar(ruta,r,newUrl) {
    var cont=0;
     var table=$('#datatables').DataTable( {
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
                render: function ( data) {
                    // Combine the first and last names into a single table field
                    cont++;
                    return cont;
                }
            },
            {
                data: null,
                render: function ( data) {
                    // Combine the first and last names into a single table field
                    return (data.fechaLiquidacion).split('-').reverse().join('/');
                }
            },
            { "data": "numeroFacturaLiquidacion" },
            { "data": "numeroPlaca" },
            {
                data:null,
                render: function ( data ) {
                    // Combine the first and last names into a single table field

                    return '$ '+ new Intl.NumberFormat("en-IN", { minimumFractionDigits:2 }).format(data.montoFacturaLiquidacion);
                }
            },
            {
                data: null,
                render: function ( data ) {
                    // Combine the first and last names into a single table field
                    r=r.replace(':liquidacion', data.id);
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
        var rowData=row.data();

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this ro
            format(row.child,rowData, newUrl);
            tr.addClass('shown');
        }

    } );

}


    function format ( callback, val, newUrl ) {

        newUrl = newUrl.replace(':liquidacion', val.id);
        $.ajax({
            url:newUrl,
            dataType: "json",
            complete: function (response) {
                var data = JSON.parse(response.responseText);
                var cont=0;
                var thead = '',  tbody = '';
                thead = '<tr>'+
                    '<th>' +" # "+ '</th>'+
                    '<th>' +" Fecha "+ '</th>'+
                    '<th>' +" Número de vale "+ '</th>'+
                    '<th>' +" Unidad "+ '</th>'+
                    '<th>' +" Costo total de vale "+ '</th>'+
                    '</tr>';

                $.each(data, function (i, d) {
                    cont++;
                    tbody += '<tr>'+
                        '<td>' + cont + '</td>'+
                        '<td>' + (d.fechaCreacion).split("-").reverse().join("/")+ '</td>'+
                        '<td>' + d.numeroVale + '</td>'+
                        '<td>' + d.nombreUnidad + '</td>'+
                        '<td> $ ' + new Intl.NumberFormat("en-IN", { minimumFractionDigits:2 }).format( d.costoUnitarioVale)+ '</td>'+
                        '</tr>';
                });
                callback($("<table class='table' style='width:90%;'>" + thead + tbody + '</table>')).show();
            },
            error: function () {
                $('#output').html('Bummer: there was an error!');
            }
        });
    }
