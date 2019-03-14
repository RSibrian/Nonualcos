<?php

use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //permisos
        Permission::create(
            [
                'name' => 'Navegar Usuarios',
                'slug' => 'users.index',
                'description' => 'Lista y navega todos los usuarios del sistema',
            ]
        );

        Permission::create(
            [
                'name' => 'Editar Usuarios',
                'slug' => 'users.edit',
                'description' => 'Editar cualquier dato de un usuario del sistema',
            ]
        );
        Permission::create(
            [
                'name' => 'Crear Usuarios',
                'slug' => 'users.create',
                'description' => 'crear usuarios del sistema',
            ]
        );
        Permission::create(
            [
                'name' => 'Asignar Roles',
                'slug' => 'users.asignarrole',
                'description' => 'Asignar cualquier role a un usuario del sistema',
            ]
        );
        //fin
        //Roles
        Permission::create(
            [
                'name' => 'Navegar roles',
                'slug' => 'roles.index',
                'description' => 'Lista y navega todos los roles del sistema',
            ]
        );

        Permission::create(
            [
                'name' => 'Crear Roles',
                'slug' => 'roles.create',
                'description' => 'crear un roles en el sistema',
            ]
        );
        Permission::create(
            [
                'name' => 'Editar Roles',
                'slug' => 'roles.edit',
                'description' => 'Editar cualquier dato de un rol del sistema',
            ]
        );

        //Proveedores
        Permission::create(
            [
                'name' => 'Ver Proveedores',
                'slug' => 'proveedores.index',
                'description' => 'crear un roles en el sistema',
            ]
        );
        Permission::create(
            [
                'name' => 'Crear Proveedor',
                'slug' => 'proveedores.create',
                'description' => 'crear un roles en el sistema',
            ]
        );
        Permission::create(
            [
                'name' => 'Editar Proveedor',
                'slug' => 'proveedores.edit',
                'description' => 'Editar cualquier dato de un rol del sistema',
            ]
        );
        //fin
        //unidades
        Permission::create(
            [
                'name' => 'Ver unidades',
                'slug' => 'unidades.index',
                'description' => 'Lista y navega todos los roles del sistema',
            ]
        );
        Permission::create(
            [
                'name' => 'Crear unidades',
                'slug' => 'unidades.create',
                'description' => 'crear unidades en el sistema',
            ]
        );
        Permission::create(
            [
                'name' => 'Editar unidades',
                'slug' => 'unidades.edit',
                'description' => 'Editar cualquier dato de una unidad del sistema',
            ]
        );
        //fin

        //cargos
        Permission::create(
            [
                'name' => 'Ver cargos',
                'slug' => 'cargos.index',
                'description' => 'Lista y navega todos los cargos del sistema',
            ]
        );
        Permission::create(
            [
                'name' => 'Crear cargos',
                'slug' => 'cargos.create',
                'description' => 'crear cargos en el sistema',
            ]
        );
        Permission::create(
            [
                'name' => 'Editar cargos',
                'slug' => 'cargos.edit',
                'description' => 'Editar cualquier dato de un cargo del sistema',
            ]
        );
        //fin

       //empleados
        Permission::create(
            [
                'name' => 'Ver empleados',
                'slug' => 'empleados.index',
                'description' => 'Lista y navega todos los empleados del sistema',
            ]
        );
        Permission::create(
            [
                'name' => 'Crear empleados',
                'slug' => 'empleados.create',
                'description' => 'crear empleados en el sistema',
            ]
        );
        Permission::create(
            [
                'name' => 'Editar empleados',
                'slug' => 'empleados.edit',
                'description' => 'Editar cualquier dato de un empleado del sistema',
            ]
        );
        //fin
        //Planillas
        Permission::create(
            [
                'name' => 'Ver Planilla',
                'slug' => 'empleadoPlanillas.index',
                'description' => 'Ver planillas generadas',
            ]
        );
        Permission::create(
            [
                'name' => 'Procesar Planilla',
                'slug' => 'empleadoPlanillas.store',
                'description' => 'Crear Planilla de pago, Indemnizaciones y Aguinaldos',
            ]
        );
        //fin planillas
        //permisos de empleado
        Permission::create(
            [
                'name' => 'Ver Permisos',
                'slug' => 'permisos.show',
                'description' => 'Ver Permisos de empleados',
            ]
        );
        Permission::create(
            [
                'name' => 'Crear Permisos',
                'slug' => 'permisos.store',
                'description' => 'Crear Permisos de empleados',
            ]
        );
        //final
        //llegadas tardias
        Permission::create(
            [
                'name' => 'Ver LLegadas Tardias',
                'slug' => 'entradasSalidas.show',
                'description' => 'Ver LLegadas Tardias de empleados',
            ]
        );
        Permission::create(
            [
                'name' => 'Crear LLegadas Tardias',
                'slug' => 'entradasSalidas.store',
                'description' => 'Crear LLegadas Tardias de empleados',
            ]
        );
        //final
        //incapacidades
        Permission::create(
            [
                'name' => 'Ver Incapacidades',
                'slug' => 'incapacidades.show',
                'description' => 'Ver incapacidades de empleados',
            ]
        );
        Permission::create(
            [
                'name' => 'Crear Incapacidades',
                'slug' => 'incapacidades.store',
                'description' => 'Crear Incapacidades de empleados',
            ]
        );
        //fin
        //descuentos
        Permission::create(
            [
                'name' => 'Ver Descuentos',
                'slug' => 'descuentos.show',
                'description' => 'Ver descuentos de empleados',
            ]
        );
        Permission::create(
            [
                'name' => 'Crear Descuentos',
                'slug' => 'descuentos.store',
                'description' => 'Crear descuentos de empleados',
            ]
        );
        //final

        //bamcos
        Permission::create(
            [
                'name' => 'Ver Bancos',
                'slug' => 'bancos.index',
                'description' => 'Lista, detalle  de Bancos. ',
            ]
        );
        Permission::create(
            [
                'name' => 'Crear Bancos',
                'slug' => 'bancos.create',
                'description' => 'crear Bancos',
            ]
        );
        Permission::create(
            [
                'name' => 'Editar Bancos',
                'slug' => 'bancos.edit',
                'description' => 'Editar cualquier tipo de Banco',
            ]
        );
        //fin
        //clasificaciones de activos
        Permission::create(
            [
                'name' => 'Ver clasificaciones de activos',
                'slug' => 'clasificaciones.index',
                'description' => 'Lista y navega todos las clasificaciones de activo',
            ]
        );
        Permission::create(
            [
                'name' => 'Crear clasificaciones de activos',
                'slug' => 'clasificaciones.create',
                'description' => 'crear clasificaciones de activos',
            ]
        );
        Permission::create(
            [
                'name' => 'Editar clasificaciones de activos',
                'slug' => 'clasificaciones.edit',
                'description' => 'Editar cualquier clasificacion de activos',
            ]
        );
        //fin
        //activos
        Permission::create(
            [
                'name' => 'Ver activos',
                'slug' => 'activos.index',
                'description' => 'Lista, detalle y reportes de activo fijo. ',
            ]
        );
        Permission::create(
            [
                'name' => 'Crear activo fijo',
                'slug' => 'activos.create',
                'description' => 'crear activo fijo',
            ]
        );
        Permission::create(
            [
                'name' => 'Editar activo fijo',
                'slug' => 'activos.edit',
                'description' => 'Editar cualquier activo fijo',
            ]
        );
        //final
        //traslado de activos

        Permission::create(
            [
                'name' => 'Ver traslados por activo',
                'slug' => 'activosUnidades.show',
                'description' => 'Ver traslados por activo fijo. ',
            ]
        );
        Permission::create(
            [
                'name' => 'Crear traslados activo fijo',
                'slug' => 'activosUnidades.store',
                'description' => 'crear traslados respectivos al activo fijo',
            ]
        );
        //fin
        //mantenimientos

        Permission::create(
            [
                'name' => 'Ver Mantenimiento por activo',
                'slug' => 'mantenimientos.index',
                'description' => 'Ver mantenimientos por activo fijo. ',
            ]
        );
        Permission::create(
            [
                'name' => 'Crear mantenimientos activo fijo',
                'slug' => 'mantenimientos.create',
                'description' => 'crear mantenimientos respectivos al activo fijo',
            ]
        );
        Permission::create(
            [
                'name' => 'Editar activo fijo',
                'slug' => 'mantenimientos.edit',
                'description' => 'Editar cualquier activo fijo',
            ]
        );
        //final
        //prestamos

        Permission::create(
            [
                'name' => 'Ver Préstamos',
                'slug' => 'prestamos.indexPrestamo',
                'description' => 'Lista, detalle de Préstamos. ',
            ]
        );
        Permission::create(
            [
                'name' => 'Crear Préstamos',
                'slug' => 'prestamos.create',
                'description' => 'crear Préstamos',
            ]
        );


        //final

        //instituciones
        Permission::create(
            [
                'name' => 'Ver Instituciones',
                'slug' => 'instituciones.index',
                'description' => 'Lista, detalle de Instituciones. ',
            ]
        );
        Permission::create(
            [
                'name' => 'Crear Instituciones',
                'slug' => 'instituciones.create',
                'description' => 'crear Institucion',
            ]
        );
        Permission::create(
            [
                'name' => 'Editar Instituciones',
                'slug' => 'instituciones.edit',
                'description' => 'Editar cualquier Institucion',
            ]
        );
        //fin


        //bitacora,auditoria y backup
        Permission::create(
            [
                'name' => 'Seguridad del Sistema',
                'slug' => 'auditoria.index',
                'description' => 'Ver Bítacora Usuario, Auditoria y Backup',
            ]
        );

         //Vales

         Permission::create(
             [
                 'name' => 'Ver Vales',
                 'slug' => 'vales.index',
                 'description' => 'Lista, detalle de Vales de Combustible. ',
             ]
         );
         Permission::create(
             [
                 'name' => 'Crear Vales',
                 'slug' => 'vales.create',
                 'description' => 'crear Vales de Combustible',
             ]
         );
         Permission::create(
             [
                 'name' => 'Editar Vales',
                 'slug' => 'vales.edit',
                 'description' => 'Editar cualquier Vale de Combustible',
             ]
         );
         //salidas
         //liquidaciones
         Permission::create(
             [
                 'name' => 'Ver Liquidaciones',
                 'slug' => 'liquidaciones.index',
                 'description' => 'Lista, detalle de Liquidaciones de Vales. ',
             ]
         );
         Permission::create(
             [
                 'name' => 'Crear Liquidaciones',
                 'slug' => 'liquidaciones.create',
                 'description' => 'crear Liquidaciones de Vales ',
             ]
         );
         Permission::create(
             [
                 'name' => 'Editar Liquidaciones',
                 'slug' => 'liquidaciones.edit',
                 'description' => 'Editar cualquier Liquidaciones ',
             ]
         );








    }
}
