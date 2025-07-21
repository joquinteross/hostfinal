<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    //

    public function index()
    {

        $books = Book::all();
        return response()->json($books);
    }

    public function show($id)
    {
        $books = Book::findOrFail($id);
        $books->save();
        return response()->json($books);

    }

    public function store (Request $request)
    {

        $book = new Book();
        $book->name = $request->name;
        $book->price = $request->price;
        $book->save();
        return response()->json($book,201);
    }


    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->name = $request->name;
        $book->price = $request->price;
        $book->save();

        return response()->json($book,200);
    }

    public function destroy($id)
    {

        $book = Book::findOrFail($id);
        $book->delete();
        return response()->json(null,204);
    }
}
