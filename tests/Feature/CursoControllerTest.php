<?php

namespace Tests\Feature;

use App\Curso;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CursoControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp(): void
    {
        parent::setUp();

        $this->route = "/api/cursos";

        $this->curso = Curso::create([
            'nome' => 'Sistemas de Informação',
            'data_inicio' => '2020-10-10',
            ]);
        
        $this->modelClass = Curso::class;
    }

    public function testIndex()
    {
        $this->get($this->route)
        ->assertStatus(200);
    }

    public function testShow(): void
    {
        $assert = [
            $this->modelClass::FILLABLE["nome"] => 'Sistemas de Informação'
        ];
        
        $find = $this->modelClass::where('nome', 'Sistemas de Informação')->first();
        
        $this->get($this->route . "/" . $find->id)
            ->assertJsonFragment($assert)
            ->assertStatus(200);
    }

    public function testCreate(): void
    {
        $response = $this->post($this->route, [
            'nome' => 'Geografia',
            'data_inicio' => '2021-09-10',
            ]);

        $response->assertStatus(200);
    }

    public function test11Update(): void
    {
        $find = $this->modelClass::where('nome', 'Sistemas de Informação')->first();

        $this->assertSame(1, $find->count());

        $newData = [
            'nome' => 'Ciencia da Computação',
        ];

        $this->put($this->route . '/' . $find->id, $newData)->assertStatus(302);

        $findTest = $this->modelClass::where('nome', 'Sistemas de Informação')->first();
              
        $this->assertEquals(
            $find->nome,
            $findTest->nome
        );

    }

}
