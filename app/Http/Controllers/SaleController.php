<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with(['user', 'book'])->get();
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $books = Book::all();
        return view('sales.create', compact('books'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $book = Book::find($validated['book_id']);

        if ($book->stock < $validated['quantity']) {
            return redirect()->back()->with('error', 'Not enough stock available');
        }

        $totalPrice = $book->price * $validated['quantity'];

        $sale = Sale::create([
            'user_id' => $validated['user_id'],
            'book_id' => $validated['book_id'],
            'quantity' => $validated['quantity'],
            'total_price' => $totalPrice,
        ]);

        // Handle stock reduction after successful sale
        $sale->handleStockReduction();

        return redirect()->route('sales.index');
    }
}

