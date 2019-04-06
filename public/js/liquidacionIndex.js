$(document).ready(function() {

    $('#datatables').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        responsive: true,
        "columns": [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { "data": "#" },
            { "data": "Fecha" },
            { "data": "No. de factura" },
            { "data": "Vehículo" },
            { "data": "Total en factura" },
            { "data": "Acciones" }
        ],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records",
        },
        destroy: true
    });

    $('.card .material-datatables label').addClass('form-group');

});

function format ( callback, val, newUrl ) {

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