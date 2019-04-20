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
          <p class="title-description"><h3> El Salvador, Departamento de La Paz </h3></p>
        </td>
        <td class="text-right">
          <img align="right" src="{{ asset('img/sv.png') }}" class="" alt="User Image" width="140px" height="130px">
        </td>
      </tr>
      <tr >
        <td colspan="3">
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
              </ol>

              <!-- Wrapper for slides -->
              <div class="carousel-inner">
                <div class="item active">
                  <img src="{{ asset('img/3.jpg') }}" alt="Chania">
                  <div class="carousel-caption">
                    <h3>Santiago Nonualco</h3>
                    <p>El Salvador</p>
                  </div>
                </div>

                <div class="item">
                  <img src="{{ asset('img/2.jpg') }}" alt="Chicago">
                  <div class="carousel-caption">
                    <h3>Santiago Nonualco</h3>
                    <p>El Salvador</p>
                  </div>
                </div>
  	 <div class="item">
                  <img src="{{ asset('img/1.jpg') }}" alt="New York">
                  <div class="carousel-caption">
                    <h3>Santiago Nonualco</h3>
                    <p>El Salvador</p>
                  </div>
                </div>
              </div>

              <!-- Left and right controls -->
              <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
        </td>
      </tr>
    </table>
  </div>
</div>
@endsection
