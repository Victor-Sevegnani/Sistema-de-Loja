<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('logado');
    }

    public function store(Request $request)
    {
        $data = $request->only(['name', 'email', 'password']);
        if (User::where('email', $data['email'])->exists()) {
            return response()->json([
                'message' => 'Usuário já existente'
            ], 400);
        }

        if (strlen($data['password']) < 6) {
            return response()->json([
                'message' => 'Sua senha deve conter pelo menos 6 caractéres'
            ], 400);
        }

        $data['password'] = bcrypt($data['password']);
        User::create($data);

        return response()->json([
            'message' => 'Usuário criado com sucesso',
        ], 201);
    }


    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Credenciais inválidas'
            ], 400);
        }
        $token = $user->createToken('token')->plainTextToken;
        return response()->json([
            'message' => 'Logado com sucesso',
            'token' => $token
        ], 200);
    }
}