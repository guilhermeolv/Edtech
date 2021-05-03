<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Curso;
use App\Aluno;

class Matricula extends Model
{
    public const TABLE_NAME = 'matriculas';

    public const PRIMARY_KEY = 'id';

    public const FILLABLE = [
        'curso_id' => 'curso_id',
        'aluno_id' => 'aluno_id',
        'ativo' => 'ativo',
        'data_admissao' => 'data_admissao',
    ];

    protected $table = self::TABLE_NAME;

    protected $primaryKey = self::PRIMARY_KEY;

    protected $fillable = self::FILLABLE;

    public function aluno()
    {
        return $this->hasOne(Aluno::class, Aluno::PRIMARY_KEY, 'aluno_id' );
    }

    public function curso()
    {
        return $this->hasOne(Curso::class, Curso::PRIMARY_KEY, 'curso_id' );
    }
}
