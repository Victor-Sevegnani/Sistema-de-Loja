<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index(Request $request)
    {
        return response()->json($request->user());
    }

    public function allUsers()
    {
        return response()->json(User::all());
    }

    public function update(Request $request)
    {
        $userId = Auth::id();
        $data = $request->all();

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
            if (!User::query()->where('id', $userId)->update($data)) {
                response()->json([
                    'message' => 'Falha ao atualizar o perfil'
                ], 400);
            };
        }

        if (!empty($data['money'])) {
            $user = User::query()->find($userId);
            $user->money += $data['money'];
            $user->save();
        }
        return response()->json([
            'message' => 'Sucesso ao atualizar o perfil',
        ], 200);
    }

    public function destroy(Request $request)
    {
        if (!User::destroy($request->id)) {
            return response()->json([
                'message' => 'Falha ao apagar seu perfil'
            ]);
        }
        return response()->json([
            'message' => 'Sucesso ao apagar o perfil'
        ], 200);
    }
}
