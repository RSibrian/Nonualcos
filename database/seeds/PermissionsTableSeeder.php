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



    }
}
