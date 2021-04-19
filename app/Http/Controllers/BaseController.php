<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class BaseController
{
    protected string $classe;

    public function index(Request $request)
    {
        return $this->classe::paginate($request->per_page);
    }

    public function store(Request $request)
    {
        return response()->json($this->classe::create($request->all()), 201);
    }

    public function show(int $id)
    {
        $objeto = $this->classe::find($id);
        if (!$objeto) return response()->json('', 204);

        return response()->json($objeto, 200);
    }

    public function update(int $id, Request $request)
    {
        $objeto = $this->classe::find($id);
        if (!$objeto) return response()->json('Recurso não encontrado', 404);

        $objeto->fill($request->all());
        $objeto->save();

        return $objeto;
    }

    public function destroy(int $id)
    {
        $qtd_removidos = $this->classe::destroy($id);
        if ($qtd_removidos === 0 ){
            return response()->json("Recurso não encontrado", 404);
        }   
        return response()->json("", 200);
        
    }
}
