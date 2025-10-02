<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use App\Models;

class BooksController extends Controller
{

    public function index()
    {
      $book=  Book::whereNull('parent_id')->with('childrenRecursive')->get();
      return response()->json($book);
    }


    public function create()
    {
        return view('books.create');
    }


    public function store(Request $request)
    {
        //
       
        $validated=$request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable',
            'parent_id' => 'nullable|exists:books,id',
            'file_path' => 'nullable|string',
        ]);
        $path = null;
        if ($request->hasFile('file_path')) {
           $validated['file_path'] = $request->file('file_path')->store('bookspdf', 'public');
        }
        $updateValidated=Book::create($validated);
           
        return response()->json($updateValidated, 201);
    }


    public function show(string $id)
    {
        $book = Book::with('childrenRecursive')->findOrFail($id);
        return response()->json($book);
    }

    public function edit(string $id)
    {
        $book=Book::findOrFail($id);
      return view('books.edit',compact('book'));
    }


    public function update(Request $request, string $id)
    {
          $findList=Book::findOrFail($id);
         $validated=$request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable',
            'parent_id' => 'nullable|exists:books,id',
            'file_path' => 'nullable|string',
        ]);
        $path = null;
        if ($request->hasFile('file_path')) {
           $validated['file_path'] = $request->file('file_path')->store('bookspdf', 'public');
        }
        $findList->update($validated);
           
        return response()->json($findList, 201);
    }


    public function destroy(string $id)
    {
       $book=Book::findOrFail($id);
       $book->delete();
       return response()->json(null,204);

    }
}
