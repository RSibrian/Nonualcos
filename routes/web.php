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
	/*$users=DB::select('select * from users');
        $cuenta=0;
        foreach ($users as $us) {
          $cuenta=$cuenta+1;
        }
        if($cuenta==0){
            return view('/auth/register');

        }else{*/
            return view('/auth/login');
       // }

 });


});

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('portada');
    });
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

    //inicio rutas para Vales de combustible

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
        ->middleware('permission:proveedores.create');

    Route::get('unidades','UnidadesController@index')
        ->name('unidades.index')
        ->middleware('permission:proveedores.index');

    Route::get('unidades/create','UnidadesController@create')
        ->name('unidades.create')
        ->middleware('permission:proveedores.create');

    Route::put('unidades/{unidad}','UnidadesController@update')
        ->name('unidades.update')
        ->middleware('permission:proveedores.edit');

    Route::get('unidades/{unidad}','UnidadesController@show')
        ->name('unidades.show')
        ->middleware('permission:proveedores.index');

    Route::get('unidades/{unidad}/edit','UnidadesController@edit')
        ->name('unidades.edit')
        ->middleware('permission:proveedores.edit');

    Route::get('unidades/{unidad}/cargos','UnidadesController@cargosUnidad')
        ->name('unidades.show')
        ->middleware('permission:proveedores.index');
    //fin unidades

    //cargos
    Route::post('cargos/store','CargoController@store')
        ->name('cargos.store')
        ->middleware('permission:proveedores.create');

    Route::get('cargos','CargoController@index')
        ->name('cargos.index')
        ->middleware('permission:proveedores.index');

    Route::get('cargos/create','CargoController@create')
        ->name('cargos.create')
        ->middleware('permission:proveedores.create');

    Route::put('cargos/{cargo}','CargoController@update')
        ->name('cargos.update')
        ->middleware('permission:proveedores.edit');

    Route::get('cargos/{cargo}','CargoController@show')
        ->name('cargos.show')
        ->middleware('permission:proveedores.index');

    Route::get('cargos/{cargo}/edit','CargoController@edit')
        ->name('cargos.edit')
        ->middleware('permission:proveedores.edit');
    //fin cargos

    //persona
    Route::post('empleados/store','EmpleadoController@store')
        ->name('empleados.store')
        ->middleware('permission:proveedores.create');

    Route::get('empleados','EmpleadoController@index')
        ->name('empleados.index')
        ->middleware('permission:proveedores.index');

    Route::get('empleados/create','EmpleadoController@create')
        ->name('empleados.create')
        ->middleware('permission:proveedores.create');

    Route::put('empleados/{empleado}','EmpleadoController@update')
        ->name('empleados.update')
        ->middleware('permission:proveedores.edit');

    Route::get('empleados/{empleado}','EmpleadoController@show')
        ->name('empleados.show')
        ->middleware('permission:proveedores.index');

    Route::get('empleados/{empleado}/edit','EmpleadoController@edit')
        ->name('empleados.edit')
        ->middleware('permission:proveedores.edit');

    Route::get('/empleados/create/{unidad}','EmpleadoController@codigoGenerado')
        ->name('empleados.create.codificacion')
        ->middleware('permission:proveedores.create');
    //fin persona
    //permisos
    Route::get('permisos/{empleado}','PermisoController@show')
        ->name('permisos.show')
        ->middleware('permission:roles.index');

    Route::post('permisos/store','PermisoController@store')
        ->name('permisos.store')
        ->middleware('permission:roles.create');
    //fin permisos
    //planillas
    Route::get('planillas/{empleado}','PlanillaController@show')
        ->name('planillas.show')
        ->middleware('permission:roles.index');

    Route::get('planillas','PlanillaController@index')
        ->name('planillas.index')
        ->middleware('permission:roles.index');

    Route::post('planillas/store','PlanillaController@store')
        ->name('planillas.store')
        ->middleware('permission:roles.create');
    //fin plantillas
    //clasificacion Activos
       Route::post('clasificaciones/store','ClasificacionesActivosController@store')
           ->name('clasificaciones.store')
           ->middleware('permission:proveedores.create');

       Route::get('clasificaciones','ClasificacionesActivosController@index')
           ->name('clasificaciones.index')
           ->middleware('permission:proveedores.index');

       Route::get('clasificaciones/create','ClasificacionesActivosController@create')
           ->name('clasificaciones.create')
           ->middleware('permission:proveedores.create');

           Route::put('clasificaciones/{clasificacionesActivos}','ClasificacionesActivosController@update')
               ->name('clasificaciones.update')
               ->middleware('permission:proveedores.edit');

           Route::get('clasificaciones/{clasificacionesActivos}','ClasificacionesActivosController@show')
               ->name('clasificaciones.show')
               ->middleware('permission:proveedores.index');

           Route::get('clasificaciones/{clasificacionesActivos}/edit','ClasificacionesActivosController@edit')
               ->name('clasificaciones.edit')
               ->middleware('permission:proveedores.edit');


       //fin clasificacion activos
       //activos
           Route::post('activos/store','ActivosController@store')
           ->name('activos.store')
           ->middleware('permission:proveedores.create');

           Route::get('activos/create','ActivosController@create')
           ->name('activos.create')
           ->middleware('permission:proveedores.create');

           Route::get('activos','ActivosController@index')
               ->name('activos.index')
               ->middleware('permission:proveedores.index');

           Route::get('activos/{activo}','ActivosController@show')
                   ->name('activos.show')
                   ->middleware('permission:proveedores.index');

           Route::get('activos/{activo}/edit','ActivosController@edit')
                   ->name('activos.edit')
                   ->middleware('permission:proveedores.edit');

            Route::get('/activos/create/{unidad}','ActivosController@codigoGenerado')
                  ->name('activos.create.codificacion')
                  ->middleware('permission:proveedores.create');

            Route::put('activos/{activos}','ActivosController@update')
                  ->name('activos.update')
                  ->middleware('permission:proveedores.edit');
       //fin activos

       //mantenimiento de activos
    Route::post('mantenimientos/store','MantenimientoController@store')
    ->name('mantenimientos.store')
    ->middleware('permission:proveedores.create');

    Route::get('mantenimientos/create','MantenimientoController@create')
    ->name('mantenimientos.create')
    ->middleware('permission:proveedores.create');

    Route::get('mantenimientos','MantenimientoController@index')
        ->name('mantenimientos.index')
        ->middleware('permission:proveedores.index');

    Route::get('mantenimientos/{mantenimiento}','MantenimientoController@show')
            ->name('mantenimientos.show')
            ->middleware('permission:proveedores.index');

    Route::get('mantenimientos/{mantenimiento}/edit','MantenimientoController@edit')
            ->name('mantenimientos.edit')
            ->middleware('permission:proveedores.edit');

     Route::put('mantenimientos/{mantenimiento}','MantenimientoController@update')
           ->name('mantenimientos.update')
           ->middleware('permission:proveedores.edit');
//fin mantenimiento de activos

       //Vehiculos
       Route::get('vehiculos','VehiculoController@index')
           ->name('vehiculos.index')
           ->middleware('permission:proveedores.index');

       //fin vehiculos

    //inicio rutas para Vales de combustible

    Route::get('/vales','ValeController@index')
        ->name('vales')
        ->middleware('permission:vales');

    Route::get('/vales/nuevo','ValeController@crear')
        ->name('vales.crear')
        ->middleware('permission:vale.crear');

    Route::post('vales/guardar','ValeController@Guardar')
        ->name('vales.guardar')
        ->middleware('permission:vale.create');

    Route::get('vales/mostrar/{vale}','ValeController@show')
        ->name('vales.show')
        ->middleware('permission:vales.show');

    Route::get('vales/{vale}/editar','ValeController@edit')
        ->name('vales.edit')
        ->middleware('permission:vales.edit');

    Route::get('/vales/liquidar','ValeController@Liquidacion')
        ->name('vales.liquidar')
        ->middleware('permission:vale.crear');

    Route::post('vales/guardarLiquidacion','ValeController@GuardarLiquidacion')
        ->name('vales.guardarLiquidacion')
        ->middleware('permission:vale.create');

    Route::get('/vales/liquidar/nuevo','ValeController@NuevaLiquidacion')
        ->name('vales.lnueva')
        ->middleware('permission:vale.crear');

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


    // fin de vales

    //traslados
    Route::get('activosUnidades/{activo}','ActivosUnidadesController@show')
        ->name('activosUnidades.show')
        ->middleware('permission:roles.index');

    Route::post('activosUnidades/store','ActivosUnidadesController@store')
        ->name('activosUnidades.store')
        ->middleware('permission:roles.create');
    //fin traslados

});
Auth::routes();
