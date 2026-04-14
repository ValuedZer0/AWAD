<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;

    /**
     * Only admins can create books.
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Only admins can edit books.
     */
    public function update(User $user, Book $book)
    {
        return $user->isAdmin();
    }

    /**
     * Only admins can delete books.
     */
    public function delete(User $user, Book $book)
    {
        return $user->isAdmin();
    }

    /**
     * Anyone can view books.
     */
    public function view(User $user, Book $book)
    {
        return true;
    }
}
