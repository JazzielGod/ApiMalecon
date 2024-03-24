<?php

namespace App\Http\Controllers;

use App\Models\reportes;
use App\Http\Responses\ApiResponse;
use Exception;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $reportes = reportes::all();
            return ApiResponse::success("Listado de reportes", 200, $reportes);
        } catch (Exception $e) {
            return ApiResponse::error('Error al obtener los reportes: ' .$e->getMessage(), 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'num_reporte' => 'required|string|max:255|unique:reportes,num_reporte',
                'nombre' => 'required|string|max:45',
                'area' => 'required|string|max:100',
                'problema' => 'required|string|max:255'
            ]);
            $reporte = reportes::create($request->all());
            return ApiResponse::success("Reporte creado", 201, $reporte);
        } catch (Exception $e) {
            return ApiResponse::error('Error al crear el reporte.' , 422 , $e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $reporte = reportes::findOrFail($id);
            return ApiResponse::success("Reporte encontrado", 200, $reporte);
        } catch (Exception $e){
            return ApiResponse::error('Error al obtener el reporte.' , 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {  
        try {
            $reporte = reportes::findOrFail($id);
            $request->validate([
                'num_reporte' => 'required|string|max:255|unique:reportes,num_reporte' . $reporte->id,
                'nombre' => 'required|string|max:45',
                'area' => 'required|string|max:100',
                'problema' => 'required|string|max:255'
            ]);
            $reporte->update($request->all());
            return ApiResponse::success("Reporte actualizado", 200, $reporte);
        } catch (Exception $e) {
            return ApiResponse::error('Error al actualizar el reporte.' , 422 , $e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $reporte = reportes::findOrFail($id);
            $reporte->delete();
            return ApiResponse::success("Reporte eliminado", 200, $reporte);
        } catch (Exception $e) {
            return ApiResponse::error('Error al eliminar el reporte.' , 404);
        }
    }
}
