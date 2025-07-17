<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        return response()->json([
            'message' => 'Logado com sucesso',
            'user' => Auth::user(),
        ], 200);
    }

    return response()->json([
        'message' => 'Credenciais inválidas'
    ], 401);
})->name('login');

Route::get('/login', function (Request $request) {
    if ($request->user()) {
        return to_route('logado');
    }
    return view('welcome');
});

Route::get('/logado', function () {
    return view('logado');
})->name('logado')->middleware("auth:sanctum");

Route::get('/perfil', function () {
    return view('perfil');
})->name('perfil');

Route::get('/', function () {
    return to_route('logado');
});

Route::get('/logout', function (Request $request) {
    Auth::logout();;
    return response()->json([
        'message' => 'Sucesso ao sair de sua conta'
    ]);
});
