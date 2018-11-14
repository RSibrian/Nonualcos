<?php

namespace Tests\Feature;



use App\TipoUsuario;
use App\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserModuleTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @test
     */
     function lista_de_usuarios_con_datos()
    {
        factory(User::class)->create([
            'name'=>'Willian',
        ]);
        factory(User::class)->create([
            'name'=>'Ronaldo',
        ]);

        $this->get('/tipoUsuarioRoute')
            ->assertStatus(200)
            ->assertSee('Willian')
            ->assertSee('Ronaldo')
            ;
    }
    /**
     * A basic test example.
     *
     * @test
     */
    /*function lista_de_usuarios_sin_datos()
    {
        $this->get('/tipoUsuarioRoute')
            ->assertStatus(200)
            ->assertSee('No hay datos disponibles en la tabla2')
        ;
    }*/

}
