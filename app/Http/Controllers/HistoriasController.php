<?php

namespace App\Http\Controllers;

use App\Models\historias;
use App\Http\Requests\UpdatehistoriasRequest;
use App\Http\Responses\ApiResponse;
use Exception;
use Illuminate\Http\Request;

class HistoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $historias = historias::all();
            return ApiResponse::success("Listado de historias", 200, $historias);
        } catch (Exception $e) {
            return ApiResponse::error('Error al obtener las historias: ' .$e->getMessage(), 500);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            $request->validate([
                'titulo' => 'required|string|max:45|unique:historias,titulo',
                'subtitulo' => 'string|max:45',
                'descripcion' => 'required|string|max:255',
                'ruta_imagen' => 'required|string|max:255'
            ]);
            $historia = historias::create($request->all());
            return ApiResponse::success("Historia creada", 201, $historia);
        } catch (Exception $e) {
            return ApiResponse::error('Error al crear la historia.' , 422 , $e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $historia = historias::findOrFail($id);
            return ApiResponse::success("Historia encontrada", 200, $historia);
        } catch (Exception $e){
            return ApiResponse::error('Error al obtener la historia.' , 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $historia = historias::findOrFail($id);
            $request->validate([
                'titulo' => 'required|string|max:45|unique:historias,titulo' . $historia->id,
                'subtitulo' => 'string|max:45',
                'descripcion' => 'required|string|max:255',
                'ruta_imagen' => 'required|string|max:255'
            ]);
            $historia->update($request->all());
            return ApiResponse::success("Historia actualizada", 200, $historia);
        } catch (Exception $e) {
            return ApiResponse::error('Error al actualizar la historia.' , 422 , $e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $historia = historias::findOrFail($id);
            $historia->delete();
            return ApiResponse::success("Historia eliminada", 200, $historia);
        } catch (Exception $e) {
            return ApiResponse::error('Error al eliminar la historia.' , 422 , $e);
        }
    }
}
