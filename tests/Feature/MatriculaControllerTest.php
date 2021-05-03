<?php

namespace Tests\Feature;

use App\Matricula;
use App\Aluno;
use App\Curso;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MatriculaControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp(): void
    {
        parent::setUp();

        $this->route = "/api/matriculas";

        $this->curso = Curso::create([
            'id' => 1,
            'nome' => 'Sistemas de Informação',
            'data_inicio' => '2020-10-10',
            ]);

        $this->aluno = Aluno::create([
            'email' => 'email@email',
            'nome' => 'nome',
            'senha' => 'senha',
            ]);

        $this->matricula = Matricula::create([
            'aluno_id' => '1',
            'curso_id' => '1',
            'data_admissao' => '2020-01-01',
            'ativo' => true,
            ]);
        
        $this->modelClass = Matricula::class;
    }

    public function testIndex()
    {
        $this->get($this->route)
        ->assertStatus(200);
    }

    public function testShow(): void
    {
        $assert = [
            $this->modelClass::FILLABLE["aluno_id"] => '1',
            $this->modelClass::FILLABLE["curso_id"] => '1'
        ];
        
        $find = $this->modelClass::where('ativo', true)->first();
        
        $this->get($this->route . "/" . $find->id)
            ->assertJsonFragment($assert)
            ->assertStatus(200);
    }
}
