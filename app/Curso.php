<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    public const TABLE_NAME = 'cursos';

    public const PRIMARY_KEY = 'id';

    public const FILLABLE = [
        'nome' => 'nome',
        'data_inicio' => 'data_inicio',
    ];

    protected $table = self::TABLE_NAME;

    protected $primaryKey = self::PRIMARY_KEY;

    protected $fillable = self::FILLABLE;
}
