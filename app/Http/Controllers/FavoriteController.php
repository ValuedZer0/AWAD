<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Toggle favorite status.
     */
    public function toggle($bookId)
    {
        $book = Book::findOrFail($bookId);
        $user = auth()->user();

        if ($user->favorites()->where('book_id', $bookId)->exists()) {
            $user->favorites()->detach($bookId);
            return redirect()->back()->with('success', 'Removed from favorites!');
        } else {
            $user->favorites()->attach($bookId);
            return redirect()->back()->with('success', 'Added to favorites!');
        }
    }

    /**
     * View user favorites.
     */
    public function view()
    {
        $favorites = auth()->user()->favorites()->paginate(12);
        return view('favorites.index', compact('favorites'));
    }

    /**
     * Remove favorite.
     */
    public function remove($bookId)
    {
        auth()->user()->favorites()->detach($bookId);
        return redirect()->back()->with('success', 'Removed from favorites!');
    }
}
