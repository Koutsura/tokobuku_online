<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
{
    // Get all books, categories, sales, and users
    $books = Book::all();
    $categories = Category::all();
    $sales = Sale::with('user')->get(); // Get sales with associated user
    $users = user::all(); // Get all users

    return view('dashboard', compact('books', 'categories', 'sales', 'users'));
}


    public function addBook(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|integer',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $book = new Book();
        $book->title = $request->title;
        $book->description = $request->description;
        $book->category_id = $request->category_id;
        $book->stock = $request->stock;
        $book->price = $request->price;
        $book->save();

        return redirect()->route('dashboard')->with('success', 'Book added successfully!');
    }

    public function addSale(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'book_id' => 'required|integer',
            'quantity' => 'required|integer',
        ]);

        $sale = new Sale();
        $sale->user_id = $request->user_id;
        $sale->book_id = $request->book_id;
        $sale->quantity = $request->quantity;
        $sale->total_price = Book::find($request->book_id)->price * $request->quantity;
        $sale->save();

        // Decrease stock of the book after sale
        $book = Book::find($request->book_id);
        $book->stock -= $request->quantity;
        $book->save();

        return redirect()->route('dashboard')->with('success', 'Sale added successfully!');
    }

    public function addCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return redirect()->route('dashboard')->with('success', 'Category added successfully!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
