<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'author',
        'description',
        'price',
        'stock',
        'isbn',
        'image_url',
        'pages',
        'published_date',
        'review',
        'rating',
    ];

    protected $casts = [
        'published_date' => 'date',
        'price' => 'decimal:2',
        'rating' => 'decimal:2',
    ];

    /**
     * Get the category that owns this book.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the order items for this book.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get users who favorited this book.
     */
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    /**
     * Check if book is in user's favorites.
     */
    public function isFavoritedBy(User $user)
    {
        return $this->favoritedBy()->where('user_id', $user->id)->exists();
    }
}
