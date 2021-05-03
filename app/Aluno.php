<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    public const TABLE_NAME = 'alunos';

    public const PRIMARY_KEY = 'id';

    public const FILLABLE = [
        'email' => 'email',
        'nome' => 'nome',
        'senha' => 'senha',
    ];

    protected $table = self::TABLE_NAME;

    protected $primaryKey = self::PRIMARY_KEY;

    protected $fillable = self::FILLABLE;
}
