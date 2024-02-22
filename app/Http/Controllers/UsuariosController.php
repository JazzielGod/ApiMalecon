<?php

namespace App\Http\Controllers;

use App\Models\usuarios;
use App\Http\Responses\ApiResponse; 
use Exception;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $usuarios = usuarios::all();
            return ApiResponse::success("Listado de usuarios", 200, $usuarios);
        } catch (Exception $e) {
            return ApiResponse::error('Error al obtener los usuarios: ' .$e->getMessage(), 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|string|max:50|min:3',
                'email' => 'required|string|max:100|email|unique:usuarios,email',
                'password' => 'required|string',
                'rol' => 'required|in:admin,user'
            ]);
            $usuario = usuarios::create($request->all());
            return ApiResponse::success("Usuario creado", 201, $usuario);
        } catch (Exception $e) {
            return ApiResponse::error('Error al crear el usuario.' , 422 , $e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $usuario = usuarios::findOrFail($id);
            return ApiResponse::success("Usuario encontrado", 200, $usuario);
        } catch (Exception $e) {
            return ApiResponse::error('Error al obtener el usuario.' , 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $usuario = usuarios::findOrFail($id);
            $request->validate([
                'nombre' => 'required|string|max:50|min:3',
                'email' => 'required|string|max:100|email|unique:usuarios,email,'. $usuario->id,
                'password' => 'required|string',
                'rol' => 'required|in:admin,user'
            ]);
            $usuario->update($request->all());
            return ApiResponse::success("Usuario actualizado", 200, $usuario);
        } catch (Exception $e) {
            return ApiResponse::error('Error al actualizar el usuario.' , 422 , $e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $usuario = usuarios::findOrFail($id);
            $usuario->delete();
            return ApiResponse::success("Usuario eliminado", 200);
        } catch (Exception $e) {
            return ApiResponse::error('Error al eliminar el usuario.' , 404);
        }
    }
}
