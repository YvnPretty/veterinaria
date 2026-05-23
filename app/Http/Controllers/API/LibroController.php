<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource (GET api/libros).
     */
    public function index()
    {
        $libros = Libro::all();
        return response()->json($libros, 200);
    }

    /**
     * Store a newly created resource in storage (POST api/libros).
     */
    public function store(Request $request)
    {
        // Mass assignment is protected by the Libro model's $fillable array
        $libro = Libro::create($request->all());
        return response()->json($libro, 201);
    }

    /**
     * Display the specified resource (GET api/libros/{id}).
     */
    public function show($id)
    {
        $libro = Libro::findOrFail($id);
        return response()->json($libro, 200);
    }

    /**
     * Update the specified resource in storage (PUT/PATCH api/libros/{id}).
     */
    public function update(Request $request, $id)
    {
        $libro = Libro::findOrFail($id);
        $libro->update($request->all());
        return response()->json($libro, 200);
    }

    /**
     * Remove the specified resource from storage (DELETE api/libros/{id}).
     */
    public function destroy($id)
    {
        $libro = Libro::findOrFail($id);
        $libro->delete();
        return response()->json(['message' => 'libro eliminado'], 200);
    }
}
