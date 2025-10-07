<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function index()
    {
        $books = Book::all();

        if($books->isEmpty()){
            $data = [
                'message' => 'No hay Libros registrados aún',
                'status' => 200
            ];
            return response()->json($data, 200);
        }else{
            return response()->json($books, 200);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'editorial' => 'required|string|max:255',
            'publicacion' => 'required|digits:4',
            'stock' => 'required|integer|min:0',
        ]);

         if ($validator->fails()) {
            $data = [
                'message' => 'Error',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $book = Book::create([
            'titulo' =>    $request->titulo,
            'author_id' => $request->author_id,
            'editorial' => $request->editorial,
            'publicacion' => $request->publicacion,
            'stock' => $request->stock
        ]);

         if (!$book) {
            $data = [
                'message' => 'Error al crear el libro',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'book' => $book,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function show($id)
    {
        $book = Book::find($id);

         if (!$book) {
            $data = [
                'message' => 'Libro no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'book' => $book,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function delete($id)
    {
        $book = Book::find($id);

        if (!$book) {
            $data = [
                'message' => 'Libro no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        
        $book->delete();

        $data = [
            'message' => 'Libro eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            $data = [
                'message' => 'Libro no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'editorial' => 'required|string|max:255',
            'publicacion' => 'required|digits:4',
            'stock' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $book->titulo = $request->titulo;
        $book->author_id = $request->author_id;
        $book->editorial = $request->editorial;
        $book->publicacion = $request->publicacion;
        $book->stock = $request->stock;

        $book->save();

        $data = [
            'message' => 'Libro actualizado',
            'book' => $book,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function patch(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            $data = [
                'message' => 'Libro no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'titulo' => 'string|max:255',
            'author_id' => 'exists:authors,id',
            'editorial' => 'string|max:255',
            'publicacion' => 'digits:4',
            'stock' => 'integer|min:0',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('titulo')) {
            $book->titulo = $request->titulo;
        }

        if ($request->has('author_id')) {
            $book->author_id = $request->author_id;
        }

        if ($request->has('editorial')) {
            $book->editorial = $request->editorial;
        }

        if ($request->has('publicacion')) {
            $book->publicacion = $request->publicacion;
        }

        if ($request->has('stock')) {
            $book->stock = $request->stock;
        }

        $book->save();

        $data = [
            'message' => 'Libro actualizado',
            'book' => $book,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
