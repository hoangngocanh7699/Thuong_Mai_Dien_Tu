<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use App\OrderDetail;
use App\Payment;
use App\Shipping;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.order.index', compact('orders'));
    }

    public function view($id)
    {
        $order = Order::find($id);
        $customer = Customer::find($order->customer_id);
        $shipping = Shipping::find($order->shipping_id);

        $order_details = OrderDetail::where('order_id', $id)->get();
        return view('admin.order.view', compact('order', 'customer', 'shipping', 'order_details'));
    }

    public function checked_status($id)
    {
        Order::find($id)->update([
            'order_status' => 'Đã xử lý'
        ]);

        $order = Order::find($id);
        Payment::find($order->payment_id)->update([
            'payment_status' => 'Đã xử lý'
        ]);

        return response()->json([
            'code' => 200,
            'status' => 'success'
        ], 200);
    }
}
