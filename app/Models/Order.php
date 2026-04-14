<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'total_price',
        'status',
        'shipping_address',
        'phone',
        'ordered_at',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
        'ordered_at' => 'datetime',
    ];

    /**
     * Get the user who made this order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all items in this order.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Generate a unique order number.
     */
    public static function generateOrderNumber()
    {
        $rand = strtoupper(str_random(3));
        $date = date('Ymd');
        $num = Order::count() + 1;
        return 'ORD-' . $date . '-' . str_pad($num, 5, '0', STR_PAD_LEFT) . '-' . $rand;
    }
}
