<?php


use Caffeinated\Shinobi\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use App\TipoUsuario;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(User::class,2)->create();

        User::create([
            'name' => 'blanky',
            'email' => 'blanky93@hotmail.com',
            'password' => bcrypt('blanky'),
        ]);

        factory(User::class)->create([
            'name' => 'Estela',
            'email' => 'Estela@hotmail.com',
            'password' => bcrypt('Estela'),
        ]);

        Role::create([
            'name'      => 'Admin',
            'slug'      => 'admin',
            'description'   => 'Usuario con acceso total',
            'special'   => 'all-access'//acceso total al sistemaz
        ]);

        Role::create([
            'name'          => 'Suspendido',
            'slug'          => 'Suspendido',
            'description'   => 'Usuario sin acceso',
            'special'       => 'no-access'//ningun acceso
        ]);

        User::create([
            'name' => 'Gerardo',
            'email' => 'alcides13001@gmail.com',
            'password' => bcrypt('GERARDO12345'),
        ]);

    }
}
