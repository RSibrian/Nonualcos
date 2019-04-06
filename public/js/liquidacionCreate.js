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

function cargar(ruta, r) {
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