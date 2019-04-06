$( function () {
    var aceite= $('#Maceite').val();
    var grasa= $('#Mgrasa').val();
    var otro= $('#Motros').val();

    if (aceite==1){
        $('#aceite').click();
    }

    if (grasa==1){
        $('#grasa').click();
    }

    if (otro!=''){
        $('#otros').click();
    }
});