<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Show home page.
     */
    public function index()
    {
        $featuredBooks = Book::orderBy('rating', 'desc')->limit(8)->get();
        $newBooks = Book::latest()->limit(8)->get();
        $categories = Category::all();

        return view('home', compact('featuredBooks', 'newBooks', 'categories'));
    }

    /**
     * Show about page.
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Show contact page.
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * Handle contact form submission.
     */
    public function contactSubmit(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string|min:10',
        ]);

        // In a real app, you'd save this or send an email
        // For now, just redirect with success
        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}
