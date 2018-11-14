@extends('plantilla')
@section('plantilla')
    <div class="row">
      <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="orange">
                    <i class="material-icons">perm_identity</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Usuario -
                        <small class="category">Modificar Contraseña de {{ Auth::user()->name }}</small>
                    </h4>
                    <form method="post" action="{{url('users/updatepassword')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="mypassword">Introduce tu actual contraseña:</label>
                            <input type="password" name="mypassword" class="form-control">

                        </div>
                        <div class="form-group">
                            <label for="password">Introduce tu nuevo contraseña:</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="mypassword">Confirma tu nuevo contraseña:</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>


                    </form>
                    <div align="center">
                        <button type="submit" class="btn btn-verde">Guardar Cambio</button>
                        <button type="reset" class="btn btn-danger">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
@stop
