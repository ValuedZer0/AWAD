<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'book_id',
        'quantity',
        'price',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    /**
     * Get the order this item belongs to.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the book for this order item.
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Calculate subtotal.
     */
    public function getSubtotalAttribute()
    {
        return $this->quantity * $this->price;
    }
}
