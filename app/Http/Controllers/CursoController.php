<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curso;
use App\Matricula;

class CursoController extends Controller
{

    public string $modelClass = Curso::class;

    public const VALIDATORS = [
        Curso::FILLABLE['nome'] => "required|string|max:191|min:3",
        Curso::FILLABLE['data_inicio'] => "required|date",
    ];

    public function index()
    {
        try {
            $query = $this->modelClass::All();
            return response($query, 200);
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(self::VALIDATORS);
        try {
            $model = new $this->modelClass([
                $this->modelClass::FILLABLE['nome'] => $request->get('nome'),
                $this->modelClass::FILLABLE['data_inicio'] => $request->get('data_inicio'),
            ]);
            $model->save();
            return response('success', 200);
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $query = $this->modelClass::find($id);
            return response($query, 200);
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(self::VALIDATORS);
        
        try {
            $curso = $this->modelClass::find($id);
            $curso->{ Curso::FILLABLE['nome'] } = $request->get('nome');
            $curso->{ Curso::FILLABLE['data_inicio'] } = $request->get('data_inicio');
            $curso->save();
            return response('success', 200);
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $matricula = Matricula::where('curso_id', $id);
            if ($matricula->count() === 0) {
                $this->modelClass::destroy($id);
                return response(200);
            }
            return response(500, 'Curso contem alunos matriculados!');
        } catch (\Exception $exception) {
            return response($e->getMessage(), 500);
        }
    }
}
