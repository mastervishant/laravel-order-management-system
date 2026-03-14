<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{
    // Create order
    public function create(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'items' => 'required|array',
            'items.*.product_name' => 'required',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        $order = Order::create(['customer_name' => $request->customer_name,'user_id'=>Auth::id()]);

        foreach ($request->items as $item) {
            $order->items()->create($item);
        }

        return redirect()->route('orders.index')->with('success', 'Order created successfully!');
    }
// Update order status manually
public function updateStatus(Request $request, $id)
{
   $request->validate([
          'status'=>'required|in:PENDING,PROCESSING,SHIPPED,DELIVERED'
      ]);

      $order = Order::where('user_id',auth()->id())->findOrFail($id);

      $order->status = $request->status;
      $order->save();

      return back()->with('success','Status updated');
}

    // List all orders
    public function index(Request $request)
    {
       $status = $request->query('status');

          $query = Order::where('user_id', auth()->id());

          if ($status) {
              $query->where('status',$status);
          }

          $orders = $query->get();

          return view('orders.index', compact('orders'));
  }

    // Show order details
    public function show($id)
    {
     $order = Order::where('user_id',auth()->id())
                      ->with('items')
                      ->findOrFail($id);

        return view('orders.show',compact('order'));
    }

    // Cancel order
    public function cancel($id)
    {
    $order = Order::where('user_id',auth()->id())->findOrFail($id);

        if ($order->status !== 'PENDING') {
            return back()->with('error','Only pending orders can be cancelled');
        }

        $order->status = 'CANCELED';
        $order->save();

        return back()->with('success','Order cancelled');
  }
}
