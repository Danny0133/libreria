<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::all();

        if($authors->isEmpty()){
            $data = [
                'message' => 'No hay autores registrados aún',
                'status' => 200
            ];
            return response()->json($data, 200);
        }else{
            return response()->json($authors, 200);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'apellidos' => 'required|max:255',
        ]);

         if ($validator->fails()) {
            $data = [
                'message' => 'Error',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $author = Author::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos
        ]);

         if (!$author) {
            $data = [
                'message' => 'Error al crear el autor',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'author' => $author,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $author = Author::find($id);

         if (!$author) {
            $data = [
                'message' => 'Autor no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'autor' => $author,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function delete($id)
    {
        $author = Author::find($id);

        if (!$author) {
            $data = [
                'message' => 'Autor no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        
        $author->delete();

        $data = [
            'message' => 'Autor eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $author = Author::find($id);

        if (!$author) {
            $data = [
                'message' => 'Autor no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'apellidos' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $author->nombre = $request->nombre;
        $author->apellidos = $request->apellidos;

        $author->save();

        $data = [
            'message' => 'Autor actualizado',
            'autor' => $author,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function patch(Request $request, $id)
    {
        $author = Author::find($id);

        if (!$author) {
            $data = [
                'message' => 'Autor no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'max:255',
            'apellidos' => 'max:255',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('nombre')) {
            $author->nombre = $request->nombre;
        }

        if ($request->has('apellidos')) {
            $author->apellidos = $request->apellidos;
        }

        $author->save();

        $data = [
            'message' => 'Autor actualizado',
            'autor' => $author,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
