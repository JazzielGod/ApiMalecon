<?php

namespace App\Http\Controllers;

use App\Models\encuestas;
use Illuminate\Http\Request;
use App\Http\Responses\ApiResponse; 
use Exception;

class EncuestasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $encuestas = encuestas::all();
            return ApiResponse::success("Listado de encuestas", 200, $encuestas);
        } catch (Exception $e) {
            return ApiResponse::error('Error al obtener las encuestas: ' .$e->getMessage(), 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'num_pregunta' => 'required|integer',
                'pregunta' => 'required|string|max:255',
                'respuesta' => 'required|string|max:255|in:MALO,REGULAR,BUENO'
            ]);
            $encuesta = encuestas::create($request->all());
            return ApiResponse::success("Encuesta creada", 201, $encuesta);
        } catch (Exception $e) {
            return ApiResponse::error('Error al crear la encuesta.' , 422 , $e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $encuesta = encuestas::findOrFail($id);
            return ApiResponse::success("Encuesta encontrada", 200, $encuesta);
        } catch (Exception $e) {
            return ApiResponse::error('Error al obtener la encuesta.' , 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $encuesta = encuestas::findOrFail($id);
            $request->validate([
                'num_pregunta' => 'required|integer',
                'pregunta' => 'required|string|max:255',
                'respuesta' => 'required|string|max:255|in:MALO,REGULAR,BUENO'
            ]);
            $encuesta->update($request->all());
            return ApiResponse::success("Encuesta actualizada", 200, $encuesta);
        } catch (Exception $e) {
            return ApiResponse::error('Error al actualizar la encuesta.' , 422 , $e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $encuesta = encuestas::findOrFail($id);
            $encuesta->delete();
            return ApiResponse::success("Encuesta eliminada", 200, $encuesta);
        } catch (Exception $e) {
            return ApiResponse::error('Error al eliminar la encuesta.' , 404);
        }
    }
}
