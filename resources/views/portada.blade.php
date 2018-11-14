@extends ('plantilla')
@section('plantilla')
    <div class="row">
        <div class="material-datatables">
            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
            <tr>
                <td class="text-left">
                    <img img src="{{ asset('img/logo.jpg') }}" class="" alt="User Image" width="140px" height="130px">
                </td>
                <td class="text-center">
                    <span class=""><h2> Asociación de Municipios Los Nonualcos</h2></span>
                    <p class="title-description"><h3> El Salvador, Departamento de la Paz </h3></p>
                </td>
                <td class="text-right">
                    <img align="right" src="{{ asset('img/sv.png') }}" class="" alt="User Image" width="140px" height="130px">
                </td>
            </tr>
                <tr >
                    <td colspan="3">
                        <img  src="{{ asset('img/bg-pricing.jpg') }}" class="" alt="User Image" width="101%" height="40%">
                    </td>
                </tr>
            </table>
        </div>
    </div>
  @endsection
