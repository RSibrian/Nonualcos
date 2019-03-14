<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'guest'], function () {
Route::get('/', function () {
            return view('/auth/login');
 });

});

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('portada');
    })->name('index');
//Route::resource('unidadRoute', 'UnidadController')->middleware('permission:');
    //Roles
    Route::post('roles/store','RoleController@store')
    ->name('roles.store')
    ->middleware('permission:roles.create');

    Route::get('roles','RoleController@index')
        ->name('roles.index')
        ->middleware('permission:roles.index');

    Route::get('roles/create','RoleController@create')
        ->name('roles.create')
        ->middleware('permission:roles.create');

    Route::put('roles/{id}','RoleController@update')
        ->name('roles.update')
        ->middleware('permission:roles.edit');

    Route::get('roles/{id}','RoleController@show')
        ->name('roles.show')
        ->middleware('permission:roles.index');

    Route::get('roles/{id}/edit','RoleController@edit')
        ->name('roles.edit')
        ->middleware('permission:roles.edit');
    //fin Roles

//Route::resource('user', 'UsuarioController');

     //users
    Route::get('users/password', 'UsuarioController@password');

    Route::post('users/store','UsuarioController@store')
        ->name('users.store')
        ->middleware('permission:users.create');

    Route::get('users','UsuarioController@index')
        ->name('users.index')
        ->middleware('permission:users.index');

    Route::get('users/create','UsuarioController@create')
        ->name('users.create')
        ->middleware('permission:users.create');

    Route::get('users/reporte','UsuarioController@reporte')
              ->name('users.reporte')
              ->middleware('permission:users.index');

    Route::put('users/{id}','UsuarioController@update')
        ->name('users.update')
        ->middleware('permission:users.edit');

    Route::get('users/{id}','UsuarioController@show')
        ->name('users.show')
        ->middleware('permission:users.index');


    Route::get('users/{id}/edit','UsuarioController@edit')
        ->name('users.edit')
        ->middleware('permission:users.edit');

    Route::post('users/updatepassword', 'UsuarioController@updatePassword');

    Route::get('users/{id}/asignarrole', 'UsuarioController@asignarRole')
        ->name('users.asignarrole')
        ->middleware('permission:users.asignarrole');

    Route::put('users/updaterole/{id}','UsuarioController@updateRole')
        ->name('users.updaterole')
        ->middleware('permission:users.asignarrole');
    //fin users

    //inicio rutas para Vales de combustible (no se usan)

    Route::get('/vales','ValeController@index')
         ->name('vales')
         ->middleware('permission:vales');

    Route::get('/vales/nuevo','ValeController@crear')
          ->name('vales.crear')
          ->middleware('permission:vale.crear');

    Route::get('/vales/liquidar','ValeController@Liquidacion')
          ->name('vales.liquidar')
          ->middleware('permission:vale.liquidar');

    Route::get('/vales/liquidar/nuevo','ValeController@NuevaLiquidacion')
          ->name('vales.lnueva')
          ->middleware('permission:vale.lnueva');

//Proveedores
    Route::post('proveedores/store','ProveedorController@store')
        ->name('proveedores.store')
        ->middleware('permission:proveedores.create');

    Route::get('proveedores','ProveedorController@index')
        ->name('proveedores.index')
        ->middleware('permission:proveedores.index');

    Route::get('proveedores/create','ProveedorController@create')
        ->name('proveedores.create')
        ->middleware('permission:proveedores.create');
    Route::post('proveedores/storeajax','ProveedorController@storeAjax')
        ->name('proveedores.storeajax');


    Route::put('proveedores/{id}','ProveedorController@update')
        ->name('proveedores.update')
        ->middleware('permission:proveedores.edit');

        Route::get('proveedores/{id}','ProveedorController@show')
            ->name('proveedores.show')
            ->middleware('permission:proveedores.index');


        Route::get('proveedores/{id}/edit','ProveedorController@edit')
            ->name('proveedores.edit')
            ->middleware('permission:proveedores.edit');
    //fin proveedores

    //unidades
    Route::post('unidades/store','UnidadesController@store')
        ->name('unidades.store')
        ->middleware('permission:unidades.create');

    Route::get('unidades','UnidadesController@index')
        ->name('unidades.index')
        ->middleware('permission:unidades.index');

    Route::get('unidades/create','UnidadesController@create')
        ->name('unidades.create')
        ->middleware('permission:unidades.create');

    Route::put('unidades/{unidad}','UnidadesController@update')
        ->name('unidades.update')
        ->middleware('permission:unidades.edit');

    Route::get('unidades/{unidad}','UnidadesController@show')
        ->name('unidades.show')
        ->middleware('permission:unidades.index');

    Route::get('unidades/{unidad}/edit','UnidadesController@edit')
        ->name('unidades.edit')
        ->middleware('permission:unidades.edit');

    Route::get('unidades/{unidad}/cargos','UnidadesController@cargosUnidad')
        ->name('unidades.show')
        ->middleware('permission:unidades.index');
    //fin unidades

    //cargos
    Route::post('cargos/store','CargoController@store')
        ->name('cargos.store')
        ->middleware('permission:cargos.create');

    Route::get('cargos','CargoController@index')
        ->name('cargos.index')
        ->middleware('permission:cargos.index');

    Route::get('cargos/create','CargoController@create')
        ->name('cargos.create')
        ->middleware('permission:cargos.create');

    Route::put('cargos/{cargo}','CargoController@update')
        ->name('cargos.update')
        ->middleware('permission:cargos.edit');

    Route::get('cargos/{cargo}','CargoController@show')
        ->name('cargos.show')
        ->middleware('permission:cargos.index');

    Route::get('cargos/{cargo}/edit','CargoController@edit')
        ->name('cargos.edit')
        ->middleware('permission:cargos.edit');
    //fin cargos

    //persona
    Route::get('empleados/reporteExpediente/{idEmpleado}','EmpleadoController@reporteExpediente')
        ->name('empleados.reporteExpediente')
        ->middleware('permission:empleados.index');

    Route::post('empleados/store','EmpleadoController@store')
        ->name('empleados.store')
        ->middleware('permission:empleados.create');

    Route::get('empleados','EmpleadoController@index')
        ->name('empleados.index')
        ->middleware('permission:empleados.index');



    Route::get('empleados/reporteEmpleado','EmpleadoController@reporteEmpleado')
        ->name('empleados.reporteEmpleado')
        ->middleware('permission:empleados.index');



    Route::get('empleados/create','EmpleadoController@create')
        ->name('empleados.create')
        ->middleware('permission:empleados.create');

    Route::put('empleados/{empleado}','EmpleadoController@update')
        ->name('empleados.update')
        ->middleware('permission:empleados.edit');

    Route::get('empleados/{empleado}','EmpleadoController@show')
        ->name('empleados.show')
        ->middleware('permission:empleados.index');

    Route::get('empleados/{empleado}/edit','EmpleadoController@edit')
        ->name('empleados.edit')
        ->middleware('permission:empleados.edit');

    Route::get('/empleados/create/{unidad}','EmpleadoController@codigoGenerado')
        ->name('empleados.create.codificacion');

    //fin persona
    //permisos
    Route::get('permisos/{empleado}','PermisoController@show')
        ->name('permisos.show')
        ->middleware('permission:permisos.show');

    Route::post('permisos/store','PermisoController@store')
        ->name('permisos.store')
        ->middleware('permission:permisos.create');
    //fin permisos
    //planillas

    Route::get('planillas','PlanillaController@index')
        ->name('planillas.index')
        ->middleware('permission:empleadoPlanillas.index');

    Route::post('planillas/store','PlanillaController@store')
        ->name('planillas.store')
        ->middleware('permission:empleadoPlanillas.store');

        Route::get('planillas/create/reporte','PlanillaController@reporte')
            ->name('planillas.reporte')
            ->middleware('permission:empleadoPlanillas.store');
    //fin plantillas
    //clasificacion Activos
       Route::post('clasificaciones/store','ClasificacionesActivosController@store')
           ->name('clasificaciones.store')
           ->middleware('permission:clasificaciones.create');

       Route::get('clasificaciones','ClasificacionesActivosController@index')
           ->name('clasificaciones.index')
           ->middleware('permission:clasificaciones.index');

       Route::get('clasificaciones/create','ClasificacionesActivosController@create')
           ->name('clasificaciones.create')
           ->middleware('permission:clasificaciones.create');

           Route::put('clasificaciones/{clasificacionesActivos}','ClasificacionesActivosController@update')
               ->name('clasificaciones.update')
               ->middleware('permission:clasificaciones.edit');

           Route::get('clasificaciones/{clasificacionesActivos}','ClasificacionesActivosController@show')
               ->name('clasificaciones.show')
               ->middleware('permission:clasificaciones.index');

           Route::get('clasificaciones/{clasificacionesActivos}/edit','ClasificacionesActivosController@edit')
               ->name('clasificaciones.edit')
               ->middleware('permission:clasificaciones.edit');


       //fin clasificacion activos
       //activos
       Route::get('activos/generarReporte','ActivosController@generarReporte')
           ->name('activos.generarReporte')
           ->middleware('permission:activos.index');

         Route::get('activos/reporteDepreAnual/{activo}','ActivosController@reporteDepreAnual')
              ->name('activos.reporteDepreAnual')
              ->middleware('permission:activos.index');

          Route::get('activos/reporteDepreMensual/{activo}','ActivosController@reporteDepreMensual')
             ->name('activos.reporteDepreMensual')
             ->middleware('permission:activos.index');

           Route::get('activos/reporteDatosActivos/{activo}','ActivosController@reporteDatosActivos')
              ->name('activos.reporteDatosActivos')
              ->middleware('permission:activos.index');

           Route::post('activos/reportexUnidad','ActivosController@reportexUnidad')
            ->name('activos.reportexUnidad')
            ->middleware('permission:activos.create');

           Route::post('activos/store','ActivosController@store')
           ->name('activos.store')
           ->middleware('permission:activos.create');

           Route::get('activos/create','ActivosController@create')
           ->name('activos.create')
           ->middleware('permission:activos.create');

           Route::get('activos','ActivosController@index')
               ->name('activos.index')
               ->middleware('permission:activos.index');

           Route::get('activos/baja','ActivosController@indexDaniados')
                          ->name('activos.baja')
                          ->middleware('permission:activos.index');

           Route::get('activos/reporteGeneral','ActivosController@reporteGeneral')
                ->name('activos.reporteGeneral')
               ->middleware('permission:activos.index');

           Route::get('activos/mantenimientosUnidades/{activo}','ActivosController@mantenimientosUnidades')
                   ->name('activos.mantenimientosUnidades')
                   ->middleware('permission:mantenimientos.index');

           Route::get('activos/{activo}','ActivosController@show')
                   ->name('activos.show')
                   ->middleware('permission:activos.index');

           Route::get('activos/{activo}/edit','ActivosController@edit')
                   ->name('activos.edit')
                   ->middleware('permission:activos.edit');

           Route::get('/activos/create/{unidad}','ActivosController@codigoGenerado')
                 ->name('activos.create.codificacion');


       Route::put('activos/{activos}','ActivosController@update')
                         ->name('activos.update')
                         ->middleware('permission:activos.edit');

        Route::put('activos/daniado/{activos}','ActivosController@updateDaniado')
                         ->name('activos.daniado');


       Route::put('activos/baja/{activos}','ActivosController@updateBaja')
                         ->name('activos.baja');

       //fin activos

       //mantenimiento de activos
    Route::post('mantenimientos/store','MantenimientoController@store')
    ->name('mantenimientos.store')
    ->middleware('permission:mantenimientos.create');

    Route::get('mantenimientos/create','MantenimientoController@create')
    ->name('mantenimientos.create')
    ->middleware('permission:mantenimientos.create');

    Route::get('mantenimientos/create/{activo}','MantenimientoController@create1')
    ->name('mantenimientos.create1')
    ->middleware('permission:mantenimientos.create');

         Route::get('mantenimientos/generarReporte','MantenimientoController@generarReporte')->name('mantenimientos.generarReporte');

        Route::post('mantenimientos/reporteTiempo','MantenimientoController@reporteTiempo')
               ->name('mantenimientos.reporteTiempo');

    Route::get('mantenimientos','MantenimientoController@index')
        ->name('mantenimientos.index')
        ->middleware('permission:mantenimientos.index');

    Route::get('mantenimientos/{mantenimiento}','MantenimientoController@show')
            ->name('mantenimientos.show')
            ->middleware('permission:mantenimientos.index');

    Route::get('mantenimientos/{mantenimiento}/edit','MantenimientoController@edit')
            ->name('mantenimientos.edit')
            ->middleware('permission:mantenimientos.edit');

     Route::put('mantenimientos/{mantenimiento}','MantenimientoController@update')
           ->name('mantenimientos.update')
           ->middleware('permission:mantenimientos.edit');

           // devuelve datos de activos para autocompletar
    Route::get('autocompletarActivos', 'MantenimientoController@autocompletarActivos')
           ->name('autocompletarActivos');

    Route::get('mantenimientos/generarSolicitud/{mantenimiento}','MantenimientoController@generarSolicitud')
          ->name('mantenimientos.solicitud')
          ->middleware('permission:mantenimientos.edit');

//fin mantenimiento de activos

       //Vehiculos
       Route::get('vehiculos','VehiculoController@index')
           ->name('vehiculos.index')
           ->middleware('permission:vales.index');

    Route::get('/HistorialVehiculos/{placa}/mantenimientos','VehiculoController@indexHistory')
        ->name('HiVe.index')
        ->middleware('permission:vales.index');

    Route::get('/Mantenimientos/{fechaInicio}/{fechaFin}/{placa}','VehiculoController@datatable3')
        ->name('Historialmanto');

    Route::get('/ReporteGeneralManto/{fechaInicio}/{fechaFin}/{placa}','VehiculoController@RGMantenimientos')
        ->name('Rhistorialmanto');

       //fin vehiculos

    //inicio rutas para Vales de combustible

    Route::get('/vales/index','ValeController@index')
        ->name('vales.index')
        ->middleware('permission:vales.index');

    Route::get('/vales/create','ValeController@create')
        ->name('vales.create')
        ->middleware('permission:vales.create');

    Route::post('vales/store','ValeController@store')
        ->name('vales.store')
        ->middleware('permission:vales.create');

    Route::get('vales/{vale}','ValeController@show')
        ->name('vales.show')
        ->middleware('permission:vales.index');

    Route::get('vales/{vale}/edit','ValeController@edit')
        ->name('vales.edit')
        ->middleware('permission:vales.edit');

    Route::put('vales/update/{vale}','ValeController@update')
        ->name('vales.update')
        ->middleware('permission:vales.edit');

    Route::get('vales/reporte/{vale}','ValeController@ValeVistaReporte')
        ->name('vales.reporte')
        ->middleware('permission:vales.index');

    Route::get('entregar/{vale}','ValeController@entregar')
        ->name('vales.entregar')
        ->middleware('permission:vales.edit');

    Route::get('devolver/{vale}','ValeController@devolver')
        ->name('vales.devolver')
        ->middleware('permission:vales.edit');

    Route::get('/liquidaciones/vales/index','LiquidacionController@index')
        ->name('liquidaciones.index')
        ->middleware('permission:liquidaciones.index');

    Route::post('/liquidaciones/vales/store','LiquidacionController@store')
        ->name('liquidaciones.store')
        ->middleware('permission:liquidaciones.create');

    Route::get('/liquidaciones/vales/create','LiquidacionController@create')
        ->name('liquidaciones.create')
        ->middleware('permission:liquidaciones.create');

    Route::get('/liquidaciones/{liquidacion}','LiquidacionController@show')
        ->name('liquidaciones.show')
        ->middleware('permission:liquidaciones.index');

    Route::get('/liquidaciones/vales/{liquidacion}/edit','LiquidacionController@edit')
        ->name('liquidaciones.edit')
        ->middleware('permission:liquidaciones.edit');

    Route::put('/liquidaciones/vales/{liquidaciones}','LiquidacionController@update')
        ->name('liquidaciones.update')
        ->middleware('permission:liquidaciones.edit');

    Route::get('/datatable/{placa}','LiquidacionController@datatable')
        ->name('datatable');

    Route::get('/costo/{id}','LiquidacionController@coste')
        ->name('costo');

    Route::get('/liquidaciones/{liquidacion}/vales','LiquidacionController@LiquidacionVales')
        ->name('liquidaciones.vales')
        ->middleware('permission:liquidaciones.index');

    Route::get('/liquidaciones/reporte/{liquidacion}','LiquidacionController@LiquidacionVistaReporte')
        ->name('liquidacion.reporte')
        ->middleware('permission:liquidaciones.index');

    Route::get('/liquidaciones/reporte_general/{fechaI}/{fechaF}','LiquidacionController@LiquidacionReporteGeneral')
        ->name('liquidacion.reporteG')
        ->middleware('permission:liquidaciones.index');

    Route::get('autocompletePlacas','ValeController@autocompletePlacas')
        ->name('autocompletePlacas');

    Route::get('autocompleteDestinos','ValeController@autocompleteDestinos')
        ->name('autocompleteDestinos');

    Route::get('autocompleteEmpleado','ValeController@autocompleteEmpleado')
        ->name('autocompleteEmpleado');

    Route::get('autocompleteGasolinera','ValeController@autocompleteGasolinera')
        ->name('autocompleteGasolinera');

    Route::get('autocompletetipoCombustible','ValeController@autocompletetipoCombustible')
        ->name('autocompletetipoCombustible');

    Route::get('/HistorialVehiculos/{placa}/salidas','SalidasController@index')
        ->name('salidas')
        ->middleware('permission:vales.index');

    Route::get('/salidas/{fechaInicio}/{fechaFin}/{placa}','SalidasController@datatable2')
        ->name('salidas.datable')
        ->middleware('permission:vales.index');

    // fin de vales

    //traslados
    Route::get('reporteTraslado/{idTraslado}','ActivosUnidadesController@reporteTraslado')
        ->name('activosUnidades.reporteTraslado')
        ->middleware('permission:activosUnidades.show');

    Route::get('activosUnidades/{activo}','ActivosUnidadesController@show')
        ->name('activosUnidades.show')
        ->middleware('permission:activosUnidades.show');

    Route::post('activosUnidades/store','ActivosUnidadesController@store')
        ->name('activosUnidades.store')
        ->middleware('permission:activosUnidades.store');
    //fin traslados

    //incapacidades
    Route::get('incapacidades/{empleado}','IncapacidadController@show')
        ->name('incapacidades.show')
        ->middleware('permission:incapacidades.show');
    Route::post('incapacidades/store','IncapacidadController@store')
        ->name('incapacidades.store')
        ->middleware('permission:incapacidades.store');
    //fin incapacidades
    //bancos

    Route::post('bancos/store','BancoController@store')
        ->name('bancos.store')
        ->middleware('permission:bancos.create');

    Route::get('bancos','BancoController@index')
        ->name('bancos.index')
        ->middleware('permission:bancos.index');

    Route::get('bancos/create','BancoController@create')
        ->name('bancos.create')
        ->middleware('permission:bancos.create');

    Route::put('bancos/{banco}','BancoController@update')
        ->name('bancos.update')
        ->middleware('permission:bancos.edit');

    Route::get('bancos/{banco}','BancoController@show')
        ->name('bancos.show')
        ->middleware('permission:bancos.index');

    Route::get('bancos/{banco}/edit','BancoController@edit')
        ->name('bancos.edit')
        ->middleware('permission:bancos.edit');
    //fin bancos

    //descuentos
    Route::get('descuentos/{empleado}','DescuentoController@show')
        ->name('descuentos.show')
        ->middleware('permission:descuentos.show');

    Route::post('descuentos/store','DescuentoController@store')
        ->name('descuentos.store')
        ->middleware('permission:descuentos.store');

    Route::put('descuentos/{descuento}','DescuentoController@update')
        ->name('descuentos.update')
        ->middleware('permission:descuentos.store');
    //fin prestamos


    Route::get('planillas/create/excel','PlanillaController@create')
        ->name('planillas.create')
        ->middleware('permission:empleadoPlanillas.store');

    //depreciaciones
    Route::get('depreciaciones/{activo}','DepreciacionController@show')
        ->name('depreciaciones.show')
        ->middleware('permission:activos.index');

    //fin depreciaciones
    //bitacora
    Route::get('auditoria','AuditoriaController@index')
        ->name('auditoria.index')
        ->middleware('permission:auditoria.index');

    Route::get('auditoria/{auditoria}','AuditoriaController@show')
        ->name('auditoria.show')
        ->middleware('permission:auditoria.index');

    Route::get('auditoria/details/{audit}','AuditoriaController@details')
        ->name('auditoria.details');
    //fin bitacora

    Route::get('entradasSalidas/{empleado}','EntradasSalidasController@show')
        ->name('entradasSalidas.show')
        ->middleware('permission:entradasSalidas.show');

    Route::post('entradasSalidas/store','EntradasSalidasController@store')
        ->name('entradasSalidas.store')
        ->middleware('permission:entradasSalidas.store');


        //instituciones
           Route::post('instituciones/store','InstitucionesController@store')
               ->name('instituciones.store')
               ->middleware('permission:proveedores.create');

           Route::get('instituciones','InstitucionesController@index')
               ->name('instituciones.index')
               ->middleware('permission:instituciones.index');

           Route::get('instituciones/create','InstitucionesController@create')
               ->name('instituciones.create')
               ->middleware('permission:instituciones.create');

           Route::put('instituciones/{institucion}','InstitucionesController@update')
               ->name('instituciones.update')
               ->middleware('permission:instituciones.edit');

           Route::get('instituciones/{institucion}','InstitucionesController@show')
               ->name('instituciones.show')
               ->middleware('permission:instituciones.index');

           Route::get('instituciones/{institucion}/edit','InstitucionesController@edit')
               ->name('instituciones.edit')
               ->middleware('permission:instituciones.edit');


           //fin instituciones

           //prestamos
         Route::post('prestamos/store','PrestamoController@store')
             ->name('prestamos.store')
             ->middleware('permission:prestamos.create');

         Route::get('prestamos/generarReportePrestamo','PrestamoController@generarReportePrestamo')
                 ->name('prestamos.generarReportePrestamo')
                 ->middleware('permission:prestamos.create');

         Route::post('prestamos/reportePrestamo','PrestamoController@reportePrestamo')
                   ->name('prestamos.reportePrestamo')
                   ->middleware('permission:prestamos.create');

         Route::get('prestamos/indexPrestamo','PrestamoController@indexPrestamo')
                   ->name('prestamos.indexPrestamo')
                   ->middleware('permission:prestamos.indexPrestamo');

       Route::get('prestamos/reportes/comprobanteEntregaPrestamo/{prestamo}','PrestamoController@comprobanteEntregaPrestamo')
                   ->name('prestamos.comprobanteEntregaPrestamo')
                   ->middleware('permission:prestamos.indexPrestamo');

       Route::get('prestamos/showPrestamo/{prestamo}','PrestamoController@showPrestamo')
                   ->name('prestamos.showPrestamo')
                   ->middleware('permission:prestamos.index');

       Route::get('prestamos','PrestamoController@index')
               ->name('prestamos.index')
               ->middleware('permission:prestamos.index');

           Route::get('prestamos/solicitud','PrestamoController@reporteSolicitud')
               ->name('prestamos.solicitud')
               ->middleware('permission:prestamos.index');

           Route::get('prestamos/create','PrestamoController@create')
               ->name('prestamos.create')
               ->middleware('permission:prestamos.create');

           Route::get('prestamos/{id}','PrestamoController@show')
               ->name('prestamos.show')
               ->middleware('permission:prestamos.index');

           Route::post('prestamos/storeajaxaux','PrestamoController@storeAjaxAux')
               ->name('prestamos.storeajaxaux');

           Route::DELETE('prestamos/delete/{prestamoTemporal}','PrestamoController@destroy')
               ->name('prestamos.delete');

           Route::post('prestamos/storeajaxcancel/','PrestamoController@storeAjaxCancel')
               ->name('prestamos.storeajaxcancel');

           Route::post('prestamos/storeajaxfinalizar','PrestamoController@storeAjaxFinalizar')
               ->name('prestamos.storeajaxfinalizar');
           //fin prestamos

           //indemnizaciones
                   Route::post('indemnizaciones/store','IndemnizacionController@store')
                   ->name('indemnizaciones.store')
                   ->middleware('permission:empleadoPlanillas.store');

                   Route::get('indemnizaciones','IndemnizacionController@index')
                   ->name('indemnizaciones.index')
                   ->middleware('permission:empleadoPlanillas.index');

                   Route::get('indemnizaciones/create','IndemnizacionController@create')
                   ->name('indemnizaciones.create')
                   ->middleware('permission:empleadoPlanillas.store');

                   Route::put('indemnizaciones/{Indemnizacion}','IndemnizacionController@update')
                   ->name('indemnizaciones.update')
                   ->middleware('permission:empleadoPlanillas.store');

                   Route::get('indemnizaciones/{Indemnizacion}','IndemnizacionController@show')
                   ->name('indemnizaciones.show')
                   ->middleware('permission:empleadoPlanillas.index');

                   Route::get('indemnizaciones/{Indemnizacion}/edit','IndemnizacionController@edit')
                   ->name('indemnizaciones.edit')
                   ->middleware('permission:empleadoPlanillas.store');

                   Route::post('indemnizaciones/make','IndemnizacionController@make')
                   ->name('indemnizaciones.make')
                   ->middleware('permission:empleadoPlanillas.store');

                   Route::get('indemnizaciones/bajaEmpleado/{empleado}','IndemnizacionController@bajaEmpleado')
                   ->name('indemnizaciones.baja');
                  
                   Route::post('indemnizaciones/desactivarEmpleado','IndemnizacionController@desactivarEmpleado')
                   ->name('indemnizaciones.darDeBaja');
                   
           //indemnizaciones

    //aguinaldo
    Route::post('aguinaldos/show','AguinaldoController@show')
        ->name('aguinaldos.show')
        ->middleware('permission:empleadoPlanillas.index');

    Route::get('aguinaldos','AguinaldoController@index')
        ->name('aguinaldos.index')
        ->middleware('permission:empleadoPlanillas.index');

    Route::post('aguinaldos/store','AguinaldoController@store')
        ->name('aguinaldos.store')
        ->middleware('permission:empleadoPlanillas.store');

    Route::get('aguinaldos/create/reporte/{exento}','AguinaldoController@reporte')
        ->name('aguinaldos.reporte')
        ->middleware('permission:empleadoPlanillas.index');
    Route::get('aguinaldos/create/excel/{exento}','AguinaldoController@create')
        ->name('aguinaldos.create')
        ->middleware('permission:empleadoPlanillas.index');
    //fin aguinaldo

    //empleadoPlanillas
           Route::get('empleadoPlanillas','EmpleadoPlanillaController@index')
           ->name('empleadoPlanillas.index')
           ->middleware('permission:empleadoPlanillas.index');

           Route::get('empleadoPlanillas/{planilla}','EmpleadoPlanillaController@show')
           ->name('empleadoPlanillas.show')
           ->middleware('permission:empleadoPlanillas.index');

           //fin empleadoPlanillas
    //calendar vehiculo
    Route::get('calendario/{id}','PlanillaController@show')
        ->name('calendario.show')
        ->middleware('permission:roles.index');

    Route::get('calendario','PlanillaController@calendario')
        ->name('calendario.index');
    //calendar
    //bitacora Usuarios
    Route::get('bitacoraUsuario','BitacoraUsuarioController@index')
            ->name('bitacoraUsuario.index')
            ->middleware('permission:auditoria.index');

    Route::get('backups','BackupController@index')
            ->name('backups.index')
            ->middleware('permission:auditoria.index');

    Route::get('backups/create','BackupController@create')
            ->name('backups.create')
            ->middleware('permission:auditoria.index');




        Route::get('/clear', function() {

           Artisan::call('cache:clear');
           Artisan::call('config:clear');
           Artisan::call('config:cache');
           Artisan::call('view:clear');

           return "Cleared!";

        });



});
Auth::routes();
