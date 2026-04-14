<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Show checkout page.
     */
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty!');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('orders.checkout', compact('cart', 'total'));
    }

    /**
     * Store order.
     */
    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|min:5',
            'phone' => 'required|string|min:9',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty!');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Create order
        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => 'ORD-' . date('Ymd') . '-' . str_pad(Order::count() + 1, 5, '0', STR_PAD_LEFT) . '-' . strtoupper(Str::random(3)),
            'total_price' => $total,
            'status' => 'pending',
            'shipping_address' => $request->shipping_address,
            'phone' => $request->phone,
        ]);

        // Create order items
        foreach ($cart as $bookId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'book_id' => $bookId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);

            // Update book stock
            \App\Models\Book::find($bookId)->decrement('stock', $item['quantity']);
        }

        session()->forget('cart');

        return redirect()->route('orders.history')->with('success', 'Order placed successfully!');
    }

    /**
     * Show order history.
     */
    public function history()
    {
        $orders = auth()->user()->orders()->orderBy('created_at', 'desc')->paginate(10);
        return view('orders.history', compact('orders'));
    }

    /**
     * Show order details.
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);

        // Check if user owns this order
        if ($order->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            return redirect()->route('home')->with('error', 'Unauthorized access!');
        }

        return view('orders.show', compact('order'));
    }
}
