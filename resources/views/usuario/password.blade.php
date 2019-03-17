@extends('plantilla')
@section('plantilla')
  <div class="row">

    <div class="col-sm-offset-1 col-md-10">
        <div class="card">
                <div class="card-header card-header-icon" data-background-color="orange">
                    <i class="material-icons">perm_identity</i>
                </div>
                 <div class="card-content">
                    <h4 class="card-title">Usuario -
                        <small class="category">Modificar Contraseña de {{ Auth::user()->name }}</small>
                    </h4>
                    {!! Form::open(['route'=>'users.updatepassword','method'=>'POST','autocomplete'=>'off']) !!}
                                  {{ csrf_field() }}
                            <h6 class="campoObligatorio">los campos con ( * ) son obligatorios</h6>


                            <div class="col-sm-10 row">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">lock</i>
                                    </span>
                                    <div class="form-group label-floating">
                                        <label class="control-label"><code>*</code>Contraseña :
                                        </label>
                                      {!!Form::password('mypassword',['class'=>'form-control'])!!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-10 row">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">lock</i>
                                    </span>
                                    <div class="form-group label-floating">
                                        <label class="control-label"><code>*</code>Nueva Contraseña :
                                        </label>
                                      {!!Form::password('password',['class'=>'form-control'])!!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-10 row">
                                <div class="input-group">
                                    <span for="password-confirm" class="input-group-addon">
                                        <i class="material-icons">lock</i>
                                    </span>
                                    <div class="form-group label-floating">
                                        <label class="control-label"><code>*</code>Confirmar Contraseña Nueva :
                                        </label>
                                      {!!Form::password('password_confirmation',['id'=>'password-confirm','class'=>'form-control'])!!}
                                    </div>
                                </div>
                            </div>

          	  					 <div class="col-sm-10 row" align="center" class="row">
          							{!! Form::submit('Guardar',['class'=>'btn btn-verde glyphicon glyphicon-floppy-disk']) !!}
          							{!! Form::reset('Cancelar',['class'=>'btn btn-danger']) !!}
          	  					</div>
          					{!! Form::close() !!}

                </div>
            </div>
        </div>

    </div>
@stop
