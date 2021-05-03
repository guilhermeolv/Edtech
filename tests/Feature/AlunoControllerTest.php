<?php

namespace Tests\Feature;

use App\Aluno;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AlunoControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp(): void
    {
        parent::setUp();

        $this->route = "/api/alunos";

        $this->aluno = Aluno::create([
            'email' => 'email@email',
            'nome' => 'nome',
            'senha' => 'senha',
            ]);

        //$this->modelClass = Alunos::class;
    }

    public function testIndex()
    {
        $this->route = "/api/alunos";
        $this->get($this->route)
        ->assertStatus(200);
    }

    public function testShow(): void
    {
        $assert = [
            Aluno::FILLABLE["nome"] => 'nome'
        ];
        
        $findAluno = Aluno::where('email', 'email@email')->first();
        
        $this->get($this->route . "/" . $findAluno->id)
            ->assertJsonFragment($assert)
            ->assertStatus(200);
    }

    public function testCriandoAluno(): void
    {
        $response = $this->post($this->route, [
            'email' => 'emai2l@email',
            'nome' => 'nome11',
            'senha' => 'senha22',
            ]);

        $response->assertStatus(200);
    }

    public function test11Update(): void
    {
        $findAluno = Aluno::where('email', 'email@email')->first();

        $this->assertSame(1, $findAluno->count());

        $newData = [
            'nome' => 'testando',
        ];

        $this->put($this->route . '/' . $findAluno->id, $newData)->assertStatus(302);

        $findTEstAluno = Aluno::where('email', 'email@email')->first();
              
        $this->assertEquals(
            $findAluno->nome,
            $findTEstAluno->nome
        );

    }
}
