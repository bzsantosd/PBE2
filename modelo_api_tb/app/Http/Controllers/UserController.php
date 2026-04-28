<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    private $apiUrl = "https://dummyjson.com/users";

   public function index(Request $request)
{
    $search = $request->input('search');
    $response = $search 
        ? Http::get("https://dummyjson.com/users/search", ['q' => $search])
        : Http::get("https://dummyjson.com/users");

    $users = $response->json()['users'] ?? [];

    return view('user', compact('users', 'search'));
}

    public function show($id)
    {
        // Busca um usuário individual pelo ID
        $response = Http::get("{$this->apiUrl}/{$id}");
        
        if ($response->failed()) {
            abort(404, 'Usuário não encontrado');
        }

        $user = $response->json();

        return view('user_detail', compact('user'));
    }
}