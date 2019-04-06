$(document).ready(function () {

    $("#numeroVale").mask("00000");

});

$(function () {

    var aceite = $('#aceite');
    aceite.on('click', function () {
        if (!(aceite.prop('checked'))) {
            $('#costoAceite').prop('required', false);
            var costo = parseFloat($('#costoAceite').val());
            if (isNaN(costo)) costo = 0.00;
            total((parseFloat($('#costoUnitarioVale').val()) - costo));
            $('#collapseAceite').collapse('hide');
            $('#costoAceite').val('');
        } else {
            $('#costoAceite').prop('required', true);
            $('#collapseAceite').collapse('show');
        }
    });

    var grasa = $('#grasa');
    grasa.on('click', function () {
        if (!(grasa.prop('checked'))) {
            $('#costoGrasa').prop('required', false);
            var costo = parseFloat($('#costoGrasa').val());
            if (isNaN(costo)) costo = 0.00;
            total((parseFloat($('#costoUnitarioVale').val()) - costo));
            $('#collapseGrasa').collapse('hide');
            $('#costoGrasa').val('');
        } else {
            $('#costoGrasa').prop('required', true);
            $('#collapseGrasa').collapse('show');
        }
    });

    var otros = $('#otros');
    otros.on('click', function () {
        if (!(otros.prop('checked'))) {
            $('#nombreOtro').prop('required', false);
            $('#costoOtro').prop('required', false);
            var costo = parseFloat($('#costoOtro').val());
            if (isNaN(costo)) costo = 0.00;
            total((parseFloat($('#costoUnitarioVale').val()) - costo));
            $('#collapseOtros').collapse('hide');
            $('#costoOtro').val('');
            $('#nombreOtro').val('');
        } else {
            $('#nombreOtro').prop('required', true);
            $('#costoOtro').prop('required', true);
            $('#collapseOtros').collapse('show');
        }

    });

    $('#costoGalones').bind('keyup', function (e) {

        if ((e.keyCode > 47 && e.keyCode < 58) || (e.keyCode === 8 || e.keyCode === 46)) {
            multiplica(this.value, $('#galones').val());
        }
    });

    $('#galones').bind('keyup', function (e) {

        if ((e.keyCode > 47 && e.keyCode < 58) || (e.keyCode === 8 || e.keyCode === 46)) {
            multiplica(this.value, $('#costoGalones').val());
            suma($('#costoTotalGalones').val(), $('#costoAceite').val(), $('#costoGrasa').val(), $('#costoOtro').val());
            if (e.keyCode == 8 || e.keyCode == 46) {
                resta($('#costoTotalGalones').val(), $('#costoAceite').val(), $('#costoGrasa').val(), $('#costoOtro').val());
            }
        }
    });

    $('#costoGalones').bind('keyup', function (e) {

        if ((e.keyCode > 47 && e.keyCode < 58) || (e.keyCode === 8 || e.keyCode === 46)) {

            if (e.keyCode === 8 || e.keyCode === 46) {
                //this.value
                resta($('#costoTotalGalones').val(), $('#costoAceite').val(), $('#costoGrasa').val(), $('#costoOtro').val());
                suma($('#costoTotalGalones').val(), $('#costoAceite').val(), $('#costoGrasa').val(), $('#costoOtro').val());
            } else {
                suma($('#costoTotalGalones').val(), $('#costoAceite').val(), $('#costoGrasa').val(), $('#costoOtro').val());
            }
        }
    });


    $('#costoAceite').bind('keyup', function (e) {
        if ((e.keyCode > 47 && e.keyCode < 58) || (e.keyCode === 8 || e.keyCode === 46)) {

            if (e.keyCode === 8 || e.keyCode === 46) {
                resta(this.value, $('#costoTotalGalones').val(), $('#costoGrasa').val(), $('#costoOtro').val());
                suma(this.value, $('#costoTotalGalones').val(), $('#costoGrasa').val(), $('#costoOtro').val());
            } else {
                suma(this.value, $('#costoTotalGalones').val(), $('#costoGrasa').val(), $('#costoOtro').val());
            }
        }
    });


    $('#costoGrasa').bind('keyup', function (e) {
        if ((e.keyCode > 47 && e.keyCode < 58) || (e.keyCode === 8 || e.keyCode === 46)) {

            if (e.keyCode === 8 || e.keyCode === 46) {
                resta(this.value, $('#costoTotalGalones').val(), $('#costoAceite').val(), $('#costoOtro').val());
                suma(this.value, $('#costoTotalGalones').val(), $('#costoAceite').val(), $('#costoOtro').val());
            } else {
                suma(this.value, $('#costoTotalGalones').val(), $('#costoAceite').val(), $('#costoOtro').val());
            }
        }
    });


    $('#costoOtro').bind('keyup', function (e) {
        if ((e.keyCode > 47 && e.keyCode < 58) || (e.keyCode === 8 || e.keyCode === 46)) {

            if (e.keyCode === 8 || e.keyCode === 46) {
                resta(this.value, $('#costoTotalGalones').val(), $('#costoAceite').val(), $('#costoGrasa').val());
                suma(this.value, $('#costoTotalGalones').val(), $('#costoAceite').val(), $('#costoGrasa').val());
            } else {
                suma(this.value, $('#costoTotalGalones').val(), $('#costoAceite').val(), $('#costoGrasa').val());
            }
        }
    });

    function multiplica(valor, valor2) {
        var valInicial1 = parseFloat(valor);
        var valInicial2 = parseFloat(valor2);

        if (isNaN(valInicial1)) {
            valInicial1 = 0.00;
        }

        if (isNaN(valInicial2)) {
            valInicial2 = 0.00;
        }

        var total = valInicial1 * valInicial2;

        $('#costoTotalGalones').val(total.toFixed(2));
    }

    function suma(monto, val1, val2, val3) {

        var valInicial1 = parseFloat(val1);
        var valInicial2 = parseFloat(val2);
        var valInicial3 = parseFloat(val3);
        var monto = parseFloat(monto);

        if (isNaN(monto)) {
            monto = 0.0;
        }

        if (isNaN(valInicial1)) {
            valInicial1 = 0.0;
        }

        if (isNaN(valInicial2)) {
            valInicial2 = 0.0;
        }

        if (isNaN(valInicial3)) {
            valInicial3 = 0.0;
        }

        var t = monto + valInicial1 + valInicial2 + valInicial3;

        total(t);
    }

    function resta(monto, val1, val2, val3) {

        var valInicial1 = parseFloat(val1);
        var valInicial2 = parseFloat(val2);
        var valInicial3 = parseFloat(val3);
        var monto = parseFloat(monto);

        if (isNaN(monto)) {
            monto = 0.0;
        }
        if (isNaN(valInicial1)) {
            valInicial1 = 0.0;
        }

        if (isNaN(valInicial2)) {
            valInicial2 = 0.0;
        }

        if (isNaN(valInicial3)) {
            valInicial3 = 0.0;
        }

        var a = [monto, valInicial1, valInicial2, valInicial3];
        a.sort((a, b) => a - b);

        var b = a[3];

        for (var i = (a.length - 1); i > 0; i--) {
            if (b > a[i - 1]) {
                b = b - a[i - 1];
            } else {
                b = a[i - 1] - b;
            }
        }

        total(b);

    }

    function total(monto) {
        var campo = $('#costoUnitarioVale');
        campo.val(monto.toFixed(2));
    }

});


$( function () {
    var solicitante = $('#solicitante');
    var recibe = $('#empRecibe');

    solicitante.on('change', function () {

        recibe.val(solicitante.find('option:selected').val());

    });
});
