<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('site.login');
})->name('login');

Route::post('/auth', function (Request $request) {
    $response = Http::post('http://127.0.0.1:8000/api/login', [
        'email' => $request->email,
        'password' => $request->password,
    ]);

    if ($response->successful()) {
        session(['token' => $response['token']]);
        return redirect()->route('dashboard');
    }

    return redirect()->route('login')->with('error', 'Login inválido');
})->name('auth');

Route::get('/dashboard', function () {
    if (!session('token')) return redirect()->route('login');

    $response = Http::withToken(session('token'))->get('http://127.0.0.1:8000/api/products');

    $produtos = $response->successful() ? $response->json() : [];

    return view('site.dashboard', [
        'produtos' => $produtos,
    ]);
})->name('dashboard');

Route::post('/produtos', function (Request $request) {
    Http::withToken(session('token'))->post('http://127.0.0.1:8000/api/products', $request->all());
    return redirect()->route('dashboard');
})->name('produtos.store');

Route::get('/produtos/{id}/editar', function ($id) {
    $response = Http::withToken(session('token'))->get("http://127.0.0.1:8000/api/products");
    $produtos = $response->json();
    $produto = collect($produtos)->firstWhere('id', $id);

    return view('site.dashboard', [
        'produtoEdicao' => $produto,
        'produtos' => $produtos
    ]);
})->name('produtos.edit');

Route::put('/produtos/{id}', function (Request $request, $id) {
    Http::withToken(session('token'))->put("http://127.0.0.1:8000/api/products/{$id}", $request->all());
    return redirect()->route('dashboard');
})->name('produtos.update');

Route::delete('/produtos/{id}', function ($id) {
    Http::withToken(session('token'))->delete("http://127.0.0.1:8000/api/products/{$id}");
    return redirect()->route('dashboard')->with('success', 'Produto excluído com sucesso.');
})->name('produtos.destroy');

Route::get('/logout', function () {
    session()->flush();
    return redirect()->route('login');
})->name('logout');

Route::view('/register', 'site.register')->name('register');
Route::post('/register', function (Request $request) {
    $response = Http::post('http://127.0.0.1:8000/api/register', $request->all());

    return $response->successful()
        ? redirect()->route('login')->with('success', 'Usuário criado com sucesso!')
        : back()->with('error', 'Erro ao registrar usuário');
})->name('register.submit');
