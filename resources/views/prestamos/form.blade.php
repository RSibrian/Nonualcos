
                                    <div class="col-sm-4 col-sm-offset-1">
                                        <div class="picture-container">

                                           <!-- <h6>Elegir la foto</h6> -->
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="col-sm-11">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                     <i class="material-icons">picture_as_pdf</i>
                                                </span>
                                                {!!Form::file('pdfPrestamo2',['value'=>'Elija el pdf de la solicitud','required','accept'=>'application/pdf'])!!}
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">assignment</i>
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label"><code>*</code>Título de Evento:
                                                    </label>
                                                    {!! Form::text('evento',null,['class'=>'form-control', 'required','style'=>'resize: both;']) !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                        <div class="col-sm-7">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">face</i>
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label"><code>*</code>Nombre del solicitante
                                                    </label>
                                                    {!!Form::text('nombreSolicitante',null,['id'=>'nombreSolicitante','class'=>'form-control','required'])!!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">credit_card</i>
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label"><code>*</code>DUI
                                                    </label>
                                                    {!!Form::text('DUISolicitante',null,['id'=>'dui','class'=>'form-control','required'])!!}
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-sm-12">
                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">phone</i>
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label"><code>*</code>Teléfono
                                                    </label>
                                                    {!!Form::text('telefonoSolicitante',null,['id'=>'telefono', 'required','class'=>'form-control input-group-lg reg_name'])!!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">home</i>
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">
                                                    </label>
                                                    {!!Form::select('idInstitucion', $instituciones ,null,['id'=>'idInstitucion','required','class'=>'form-control','placeholder'=>'* Seleccione la Institución'])!!}
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-sm-12">
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">date_range</i>
                                                            </span>
                                                <div class="form-group">
                                                    <label class="control-label"><code>*</code>Fecha inicio

                                                    </label>
                                                    {{ Form::input('dateTime-local', 'fechaEntregaPrestamo', $date, ['id' => 'sol_fecha_inicio', 'class' => 'form-control']) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">date_range</i>
                                                            </span>
                                                <div class="form-group">
                                                    <label class="control-label"><code>*</code>Fecha fin

                                                    </label>
                                                    {{ Form::input('datetime-local', 'fechaDevolucionPrestamo', $date, ['id' => 'sol_fecha_fin', 'class' => 'form-control']) }}

                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <!--div class="col-lg-12">
                                            <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="material-icons">place</i>
                                                        </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Observaciones:
                                                    </label>
                                                    {!! Form::textarea('observacionPrestamo',null,['class'=>'form-control'  ,'rows'=>'2', 'style'=>'resize: both;']) !!}
                                                </div>
                                            </div>
                                        </div-->

                                	</div>
