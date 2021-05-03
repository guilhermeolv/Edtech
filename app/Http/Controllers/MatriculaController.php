<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Matricula;

class MatriculaController extends Controller
{
    public string $modelClass = Matricula::class;

    public array $relationships = [];

    public const VALIDATORS = [
        Matricula::FILLABLE['data_admissao'] => "required|date",
    ];

    public function __construct()
    {
        $this->relationships = [
            'curso', 
            'aluno'
        ];
    }

    public function index()
    {
        try {
            $query = $this->modelClass::with($this->relationships)->get();
            
            
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
            $data = new $this->modelClass([
                $this->modelClass::FILLABLE['data_admissao'] => $request->get('data_admissao'),
                $this->modelClass::FILLABLE['ativo'] => $request->get('ativo'),
                $this->modelClass::FILLABLE['aluno_id'] => $request->get('aluno'),
                $this->modelClass::FILLABLE['curso_id'] => $request->get('curso'),
            ]);
            $data->save();
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
            $data = $this->modelClass::find($id);
            $data->{ $this->modelClass::FILLABLE['curso_id'] } = $request->get('curso');
            $data->{ $this->modelClass::FILLABLE['aluno_id'] } = $request->get('aluno');
            $data->{ $this->modelClass::FILLABLE['data_admissao'] } = $request->get('data_admissao');
            $data->{ $this->modelClass::FILLABLE['ativo'] } = $request->get('ativo');
            $data->save();
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
            $this->modelClass::destroy($id);
            return response(200);
        } catch (\Exception $exception) {
            return response(500, $this->getErrorString($exception));
        }
    }
}
