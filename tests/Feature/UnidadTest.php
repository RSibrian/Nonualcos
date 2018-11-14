<?php

namespace Tests\Feature;

use App\Unidad;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UnidadTest extends TestCase
{
    use DatabaseMigrations;
    public function runDatabaseMigrations()
    {
        $this->artisan('migrate:reset');
        $this->artisan('migrate');

    }
    use DatabaseTransactions;

    /** @test */
    function lista_de_unidades_con_datos()
    {
        factory(Unidad::class)->create([
            'uni_nombre'=>'Informatica',
        ]);
        factory(Unidad::class)->create([
            'uni_nombre'=>'Gerencia',
        ]);

        $this->get('/unidadRoute')
            ->assertStatus(200)
            ->assertSee('Informatica')
            ->assertSee('Gerencia')
        ;
    }
    /** @test */
    function lista_de_unidades_sin_datos()
    {
       // Unidad::truncate();
        $this->get('/unidadRoute')
            ->assertStatus(200)
        ;
    }
    /** @test */
    function mostar_una_unidad()
    {
        $unidad=factory(Unidad::class)->create([
            'uni_nombre'=>'Informatica',
        ]);
        $this->get('/unidadRoute/'.$unidad->id)
            ->assertStatus(200)
            ->assertSee('Informatica')
        ;
    }
    /** @test */
    function mostar_error_404_unidad_no_encontrada()
    {

        $this->get('/unidadRoute/1000')
            ->assertStatus(404)
            ->assertSee('Página no econtrada')
        ;
    }
    /** @test */
    function vista_crear_unidad()
    {
        // Unidad::truncate();
        $this->get('/unidadRoute/create')
            ->assertStatus(200)
            ->assertSee('Registro de Unidad')

        ;
    }
    /** @test */
    function crear_unidad()
    {
        // Unidad::truncate();
        $this->post('/unidadRoute/',[
            'uni_codigo'=>1,
            'uni_nombre'=>'Informatica'
        ])
            ->assertRedirect('/unidadRoute');
        $this->assertDatabaseHas('unidads',[
            'uni_codigo' => 1,
            'uni_nombre' => 'Informatica'
        ]);
    }
    /** @test */
    function crear_unidad_sin_nombre()
    {
        // Unidad::truncate();
       /* $this->post('/unidadRoute/',[
            'uni_codigo'=>1,
            'uni_nombre'=>'Informatica'
        ])
            ->assertRedirect('/unidadRoute');
        $this->assertDatabaseHas('unidads',[
            'uni_codigo' => 1,
            'uni_nombre' => 'Informatica'
        ]);*/
    }
    /** @test */
    function editar_unidad()
    {
       $unidad=factory(Unidad::class)->create([
            'uni_nombre'=>'Informatica',
        ]);


        $this->get("/unidadRoute/{$unidad->id}/edit")
            ->assertStatus(200)
            ->assertSee('Informatica')
            ->assertViewIs('unidad.edit')
        ;
    }
    /** @test */
    function update_unidad()
    {
        $unidad=factory(Unidad::class)->create([
            'uni_codigo'=>1,
            'uni_nombre'=>'Ronaldo',
        ]);
        $this->put("/unidadRoute/$unidad->id",([
            'uni_codigo'=>1,
            'uni_nombre'=>'Informatica',
        ]))
            ->assertRedirect("/unidadRoute/{$unidad->id}");
        $this->assertDatabaseHas('unidads',[
            'uni_codigo' => 1,
            'uni_nombre' => 'Informatica'
        ]);
    }

}
