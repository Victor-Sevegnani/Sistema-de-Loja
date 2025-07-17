<?php

namespace App\Http\Controllers;

use App\Models\OrdersModel;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function purchase(Request $request): JsonResponse
    {
        $product = $request->input('product');
        $inputQuantity = (int)$request->input('quantity');

        $order = OrdersModel::where('product', $product)->first();

        if (!$order) {
            return response()->json(['error' => 'Produto não encontrado'], 404);
        }

        if ($order->quantity < 1) {
            $order->delete();
            return response()->json(['error' => 'Produto sem estoque e removido'], 200);
        }

        if ($order->quantity < $inputQuantity) {
            return response()->json(['error' => 'Quantidade maior que o estoque'], 400);
        }

        $user = $request->user();
        $totalPrice = $order->price * $inputQuantity;

        if ($user->money < $totalPrice) {
            return response()->json(['error' => 'Dinheiro insuficiente'], 400);
        }

        $order->quantity -= $inputQuantity;
        $order->save();

        $user->money -= $totalPrice;

        $orders = $user->orders ? json_decode($user->orders, true) : [];
        $orders[] = [
            'product' => $product,
            'quantity' => $inputQuantity,
            'total' => $totalPrice
        ];
        $user->orders = json_encode($orders);
        $user->save();

        return response()->json([
            'message' => 'Compra realizada com sucesso!',
            'orders' => $orders,
        ], 200);
    }
}
