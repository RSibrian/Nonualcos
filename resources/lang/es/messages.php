<?php
return[
  //Audit::class
  'attribute'  => 'Atributo',
    'event'      => 'Evento',
    'id'         => 'ID',
    'ip_address' => 'Dirección IP',
    'user_agent' => 'User Agent',
    'new'        => 'Nuevo',
    'old'        => 'Anterior',
    'url'        => 'URL',
    'user'       => 'Usuario',
    'tags'       => 'Tags',

    //Modelos
    'Caffeinated\Shinobi\Models\Role' => 'Rol de Usuario',
    'App\User'  => 'Usuario',
    'App\Unidades'  =>  'Unidad',
    'App\Cargo'  =>  'Cargo',
    'App\Empleado'  =>  'Empleado',
    'App\ClasificacionesActivos'  =>  'Clasificación (Activo)',
    'App\Activos'  =>  'Activo',
    'App\Proveedor'  =>  'Proveedor',
    'App\Mantenimiento'  =>  'Mantenimiento',
    'App\Vale'  =>  'Vale',
    'App\Permiso'  =>  'Permiso',
    'App\Descuento'  =>  'Descuento',
    'App\ActivosUnidades'  =>  'Traslado (Activo)',
    'App\Banco'  =>  'Banco',
    'App\EntradasSalidas'  =>  'Llegada Tarde (Empleado)',
    'App\Liquidacion'  =>  'Liquidación',
    'App\Salidas'  =>  'Salida (Vehículo)',
    'App\Vehiculo'  =>  'Vehiculo',
    'App\Instituciones'  =>  'Institución',
    'App\Prestamo'  =>  'Préstamo',


    //Event
    'created'  =>  'Crear',
    'updated'  =>  'Actualizar',

    //Role::class
    'slug'  =>  'Ficha',
    'description'  =>  'Descripción',
    'special'  =>  'Permisos',

    //User::class
    'name'       => 'Nombre',
    'email'       => 'Correo',
    'password'       => 'Contraseña',
    'idEmpleado'       => 'Empleado',

    //Unidades::class
    'codigoUnidad'  =>  'Código',
    'nombreUnidad'  =>  'Unidad',

    //Cargo::class
    'idUnidad'  =>  'Unidad',
    'nombreCargo'  =>  'Cargo',

    //Empleado::class
    'nombresEmpleado'  =>  'Nombre(s)',
    'apellidosEmpleado'  =>  'Apellido(s)',
    'fechaNacimientoEmpleado'  =>  'Fecha de Nacimiento',
    'generoEmpleado'  =>  'Género',
    'DUIEmpleado'  =>  'DUI',
    'estadoCivilEmpleado'  =>  'Estado Civil',
    'NITEmpleado'  =>  'NIT',
    'dirreccionEmpleado'  =>  'Dirección',
    'idAFP'  =>  'AFP',
    'numeroAFP'  =>  'Número de AFP',
    'idSeguro'  =>  'Seguro Social',
    'numeroSeguro'  =>  'Número de Seguro Social',
    'fechaIngreso'  =>  'Fecha de Contratación',
    'observacionEmpleado'  =>  'Observaciones',
    'idCargo'  =>  'Cargo',
    'salarioBruto'  =>  'Salario',
    'sistemaContratacion'  =>  'Sistema de Contratación',
    'imagenEmpleado'  =>  'Foto de perfil',

    //ClasificacionesActivos::class
    'codigoTipo'  =>  'Código de Clasificación',
    'nombreTipo'  =>  'Nombre de Clasificación',

    //Activo::class
    'codigoInventario' => 'Código en Inventario',
    'nombreActivo' => 'Nombre',
    'numeroFactura' => 'Factura #',
    'precio' => 'Precio',
    'marca' => 'Marca',
    'modelo' => 'Modelo',
    'serie' => 'Serie',
    'color' => 'Color',
    'ObservacionActivo' => 'Observaciones',
    'tipoActivo' => '¿Vehículo?',
    'tipoAdquisicion' => 'Adquisición',
    'fechaAdquisicion' => 'Fecha de Adquisición',
    'estadoActivo' => 'Estado',
    'justificacionActivo' => 'Justificación (baja)',
    'fechaBajaActivo' => 'Fecha de Baja',
    'idProveedor' => 'Proveedor',
    'idClasificacionActivo' => 'Clasificación',
    'estadoUsado' => '¿Es un usado?',
    'aniosUso' => 'Años de Uso',
    'valorResidual' => 'Valor Residual (%)',
    'aniosVida' => 'Años de Vida',

    //Vehiculo::class
    'numeroPlaca' => 'Placa',
    'idActivo' => 'Nombre',

    //ActivosUnidades::class
    'fechaInicioUni' => 'Fecha de Asignación',
    'fechaFinalUni' => 'Fecha de Cambio',
    'estadoUni' => 'Estado',
    'observacionUni' => 'Observación',

    //Proveedor::class
    'nombreEmpresa' => 'Nombre de la empresa',
    'nombreEncargado' => 'Encargado',
    'telefonoProve' => 'Teléfono',
    'tipoProveedor' => 'Tipo',

    //Mantenimiento::class
    'fechaRecepcionTaller' => 'Fecha de Entrega a Taller',
    'reparacionesSolicitadas' => 'Mantenimiento Solicitado',
    'personalSolicitaMantenimiento' => 'Personal que Solicita',
    'reparacionesRealizadas' => 'Mantenimiento Realizado',
    'empresaEncargada' => 'Empresa Encargada de Mantenimiento',
    'nombreEncargado' => 'Nombre de Encargado (Empresa Externa)',
    'fechaRetornoTaller' => 'Fecha de Retorno',
    'costoMantenimiento' => 'Costo',
    'personalRecibeMantenimiento' => 'Personal que Recibe',

    //Vale::class
    'fechaCreacion' => 'Fecha de Registro',
    'numeroVale' => 'Número de Vale',
    'costoUnitarioVale' => 'Costo Unitario',
    'gasolinera' => 'Gasolinera',
    'tipoCombustible' => 'Combustible',
    'galones' => 'Galones',
    'costoGalones' => 'Costo por Galón',
    'aceite' => 'Aceite',
    'costoAceite' => 'Costo de Aceite',
    'grasa' => 'Grasa',
    'costoGrasa' => 'Costo de Grasa',
    'otro' => 'Otro Servicio',
    'costoOtro' => 'Costo de Otro Servicio',
    'empleadoAutorizaVal' => 'Empleado que Autoriza Vale',
    'empleadoRecibeVal' => 'Empleado que Recibe Vale',
    'estadoEntregadoVal' => 'Estado de Entrega',
    'estadoLiquidacionVal' => 'Estado de Liquidación',
    'estadoRecibidoVal' => 'Estado de Devolución',
    'idSalida' => 'Misión',
    'idLiquidacion' => 'Liquidación',

    //Salidas::class
    'fechaSalida' => 'Fecha de Salida',
    'destinoTrasladarse' => 'Destino',
    'mision' => 'Misión',
    'idVehiculo' => 'Vehículo',

    //Liquidacion::class
    'fechaLiquidacion' => 'Fecha de Liquidación',
    'numeroFacturaLiquidacion' => 'Número de Factura',
    'montoFacturaLiquidacion' => 'Monto Facturado',

    //Permiso::class
    'fechaPermisoInicio' => 'Fecha de Inicio',
    'fechaPermisoFinal' => 'Fecha de Finalización',
    'tipoPermiso' => 'Tipo',
    'casoPermiso' => 'Caso',
    'motivoPermiso' => 'Motivo',
    'perm_opcion' => 'perm_opcion',

    //Descuento::class
    'banco_id' => 'Banco',
    'pago' => 'Monto a Descontar',
    'observacionDescuento' => 'Observaciones',
    'estadoDescuento' => 'Estado',
    'numeroCuenta' => 'Número de Cuenta Bancaria',
    'tipoDescuento' => 'Tipo de Descuento',

    //Banco::class
    'ban_nombre' => 'Nombre',

    //Instituciones::class
    'nombreInstitucion' => 'Nombre',
    'direccionInstitucion' => 'Dirección',
    'telefonoInstitucion' => 'Teléfono',

    //Prestamo::class
    'evento' => 'Evento',
    'nombreSolicitante' => 'Personal Solicitante',
    'DUISolicitante' => 'DUI del Solicitante',
    'telefonoSolicitante' => 'Teléfono',
    'observacionPrestamo' => 'Observaciones',
    'fechaEntregaPrestamo' => 'Fecha de Entrega',
    'fechaDevolucionPrestamo' => 'Fecha de Devolución',
    'idInstitucion' => 'Institución Solicitante',

    '' => '',
    '' => '',
    '' => '',
    '' => '',
    '' => '',
    '' => '',
    '' => '',


];

 ?>
