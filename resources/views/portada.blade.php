@extends ('plantilla')
@section('plantilla')
<div class="row">
  <div class="material-datatables">
    <table id="datatables" class="table table-striped table-no-bordered" cellspacing="0" style="background: white;">
      <tr>
        <td class="text-left">
          <img img src="{{ asset('img/logo.png') }}" class="" alt="User Image" width="140px" height="130px">
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
          <img  src="{{ asset('img/logo.jpg') }}" style="width: 60%;
  height: auto; background-size: contain; display:block;
  margin-left: auto;
  margin-right: auto;" alt="User Image">
        </td>
      </tr>
    </table>
  </div>
</div>
@endsection
