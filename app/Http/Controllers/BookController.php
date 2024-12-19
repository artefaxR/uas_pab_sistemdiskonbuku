<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return response()->json(Book::all());
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'discount' => 'nullable|numeric|min:0|max:100', // Tambahkan validasi diskon
    ]);

    $book = Book::create([
        'title' => $validated['title'],
        'price' => $validated['price'],
        'discount' => $validated['discount'] ?? 0, // Default diskon 0 jika tidak diisi
    ]);

    return response()->json($book, 201);
}

}

