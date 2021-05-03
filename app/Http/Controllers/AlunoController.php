<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aluno;
use App\Matricula;
use Exception;

class AlunoController extends Controller
{
    
    public string $modelClass = Aluno::class;

    public const VALIDATORS = [
        Aluno::FILLABLE['nome'] => "required|string|max:191|min:3",
        Aluno::FILLABLE['email'] => "required|email",
        Aluno::FILLABLE['senha'] => "required|string"
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            $aluno = new $this->modelClass([
                $this->modelClass::FILLABLE['nome'] => $request->get('nome'),
                $this->modelClass::FILLABLE['email'] => $request->get('email'),
                $this->modelClass::FILLABLE['senha'] => $request->get('senha'),
            ]);
            $aluno->save();
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
            $aluno = $this->modelClass::find($id);
            $aluno->{ $this->modelClass::FILLABLE['nome'] } = $request->get('nome');
            $aluno->{ $this->modelClass::FILLABLE['email'] } = $request->get('email');
            $aluno->{ $this->modelClass::FILLABLE['senha'] } = $request->get('senha');
            $aluno->save();
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
            $matricula = Matricula::where('aluno_id', $id);
            if ($matricula->count() === 0) {
                $this->modelClass::destroy($id);
                return response(200);
            }
            return response(500, 'Aluno contem matricula ativa!');
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
}