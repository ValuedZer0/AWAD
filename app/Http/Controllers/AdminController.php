<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Admin dashboard.
     */
    public function dashboard()
    {
        $totalBooks = Book::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_price');
        $recentOrders = Order::latest()->limit(5)->get();

        return view('admin.dashboard', compact('totalBooks', 'totalOrders', 'totalRevenue', 'recentOrders'));
    }

    /**
     * List all books (admin).
     */
    public function listBooks()
    {
        $books = Book::with('category')->paginate(20);
        return view('admin.books.index', compact('books'));
    }

    /**
     * Show create book form.
     */
    public function createBook()
    {
        $categories = Category::all();
        return view('admin.books.create', compact('categories'));
    }

    /**
     * Store new book.
     */
    public function storeBook(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:books',
            'author' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'isbn' => 'nullable|unique:books',
            'image_url' => 'nullable|url',
            'pages' => 'nullable|integer',
            'published_date' => 'nullable|date',
        ]);

        Book::create([
            'title' => $request->title,
            'slug' => str_slug($request->title),
            'author' => $request->author,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'isbn' => $request->isbn,
            'image_url' => $request->image_url,
            'pages' => $request->pages,
            'published_date' => $request->published_date,
        ]);

        return redirect()->route('admin.books.list')->with('success', 'Book added successfully!');
    }

    /**
     * Edit book form.
     */
    public function editBook($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    /**
     * Update book.
     */
    public function updateBook(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'title' => 'required|string|unique:books,title,' . $id,
            'author' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'isbn' => 'nullable|unique:books,isbn,' . $id,
            'image_url' => 'nullable|url',
            'pages' => 'nullable|integer',
            'published_date' => 'nullable|date',
        ]);

        $book->update($request->only([
            'title', 'author', 'category_id', 'price', 'stock',
            'description', 'isbn', 'image_url', 'pages', 'published_date'
        ]));

        return redirect()->route('admin.books.list')->with('success', 'Book updated successfully!');
    }

    /**
     * Delete book.
     */
    public function deleteBook($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->back()->with('success', 'Book deleted successfully!');
    }

    /**
     * List all orders (admin).
     */
    public function listOrders()
    {
        $orders = Order::with('user')->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Update order status.
     */
    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,shipped,delivered,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Order status updated!');
    }
}
