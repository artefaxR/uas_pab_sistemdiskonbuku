<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Book;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function store(Request $request)
{
    $validated = $request->validate([
        'book_id' => 'required|exists:books,id',
        'quantity' => 'required|integer|min:1',
    ]);

    $book = Book::findOrFail($validated['book_id']);
    $discount = $book->discount / 100; // Diskon bawaan dari buku
    $totalPrice = ($book->price * $validated['quantity']) * (1 - $discount);

    $transaction = Transaction::create([
        'book_id' => $validated['book_id'],
        'quantity' => $validated['quantity'],
        'discount' => $book->discount, // Simpan diskon bawaan
        'total_price' => $totalPrice,
    ]);

    return response()->json($transaction, 201);
}
    public function index()
{
    $transactions = Transaction::with('book')->get();

    return response()->json($transactions);
}

}
