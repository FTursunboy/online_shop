<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request) {
      $data = $request->all();



      try {
        $order = new Order();
        $order->name = $data['name'];
        $order->phone = $data['phone'];
        $order->delivery = $data['isDelivery'] ? 'Да' : 'Нет';
        $order->address = $data['address'];
        $order->total_price = $data['totalPrice'];
        $order->products = $data['product'];
        $order->save();
      }
      catch (\Exception $e) {
        return response()->json($e->getMessage());
      }

      return response()->json(['message' => 'Заказ успешно сохранен']);
    }
}
