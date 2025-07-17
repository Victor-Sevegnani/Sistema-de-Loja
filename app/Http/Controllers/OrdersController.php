<?php

namespace App\Http\Controllers;

use App\Models\OrdersModel;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = OrdersModel::all();
        $filteredOrders = [];

        if ($orders->count() === 0) {
            return response()->json([
                'error' => 'Não foram encontrados produtos cadastrados'
            ], 200);
        }
        foreach ($orders as $order) {
            $filteredOrders[] = $order;
        }

        return response()->json([
            'message' => $filteredOrders
        ], 200);
    }


    public function store(Request $request): JsonResponse
    {
        $items = $request->only(['product', 'type', 'price', 'quantity']);

        if (OrdersModel::query()->where('product', $items['product'])->exists()) {
            return response()->json([
                'message' => 'Itens já registrados'
            ], 400);
        }

        $items['user_id'] = Auth::id();
        OrdersModel::query()->create($items);
        return response()->json([
            'message' => 'Itens criados com sucesso'
        ], 201);
    }

    public function update(Request $request): JsonResponse
    {
        $items = $request->only(['product', 'type', 'price', 'quantity']);
        $query = OrdersModel::query();

        if (!$query->update($items)) {
            return response()->json([
                'message' => 'Falha ao editar o produto'
            ], 400);
        };

        return response()->json([
            'message' => 'Sucesso ao atualizar o produto'
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        if (!OrdersModel::destroy($id)) {
            return response()->json([
                'message' => 'Falha ao apagar o produto'
            ], 400);
        };
        return response()->json([
            'message' => 'Sucesso ao apagar o produto'
        ], 200);
    }

    public function find(int $id): JsonResponse
    {
        return response()->json(OrdersModel::find($id), 200);
    }

}
