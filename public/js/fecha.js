
    function valida(fechaI,fechaF) {

        if (fechaI!=""){
            if (fechaF!=""){
                document.getElementById("texto").innerHTML="";
                if (compare_dates(fechaF, fechaI)) {
                    return true;
                }else{
                    document.getElementById("texto").innerHTML="Fecha fin debe ser mayor que fecha inicio";
                }
            } else{
                document.getElementById("texto").innerHTML="Seleccione una fecha fin";
            }
        } else{
            document.getElementById("texto").innerHTML="Seleccione una fecha inicial";
        }

        return false;

    }

    function compare_dates(fechaF, fechaI)
    {
        fechaF= (fechaF).split("-").reverse().join("-");
        fechaI= (fechaI).split("-").reverse().join("-");

        var xMonth=fechaF.substring(3, 5);
        var xDay=fechaF.substring(0, 2);
        var xYear=fechaF.substring(6,10);
        var yMonth=fechaI.substring(3, 5);
        var yDay=fechaI.substring(0, 2);
        var yYear=fechaI.substring(6,10);
        if (xYear> yYear)
        {
            return(true)
        }
        else
        {
            if (xYear == yYear)
            {
                if (xMonth> yMonth)
                {
                    return(true)
                }
                else
                {
                    if (xMonth == yMonth)
                    {
                        if (xDay> yDay)
                            return(true);
                        else
                        if (xDay == yDay)
                            return(true);
                        else
                            return(false);
                    }
                    else
                        return(false);
                }
            }
            else
                return(false);
        }
    }

