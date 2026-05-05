<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokemon;


class PokemonController extends Controller
{
    /**
     * Esta é a função que carrega a página principal.
     * É aqui que passamos as duas variáveis para a View.
     */
    public function index()
    {
        // 1. Buscamos no banco apenas os que marcamos como fixos (no Seeder)
        $lendarios = Pokemon::where('is_fixo', true)->get();

        // 2. Buscamos os que o usuário cadastrou (onde is_fixo é falso)
        // Usamos o orderBy para o mais novo aparecer primeiro
        $cadastrados = Pokemon::where('is_fixo', false)->orderBy('id', 'desc')->get();

        // 3. Enviamos essas duas variáveis para o arquivo 'pokedex.blade.php'
        return view('pokedex', compact('lendarios', 'cadastrados'));
    }

    /**
     * Esta função salva o novo Pokémon que você cadastrar via formulário
     */
    public function store(Request $request) {
    $pokemon = new Pokemon();
    $pokemon->nome = $request->nome;
    $pokemon->tipo = $request->tipo;
    $pokemon->ataque = $request->ataque;
    $pokemon->descricao = $request->descricao;

    if($request->hasFile('foto')) {
        $imgName = time() . '.' . $request->foto->extension();
        // Isso move o arquivo para public/img
        $request->foto->move(public_path('img'), $imgName);
        $pokemon->foto = $imgName;
    }

    $pokemon->save();
    return back()->with('sucesso', 'Pokémon cadastrado!');
}


    public function edit($id)
{
    $pokemon = Pokemon::findOrFail($id);
    return view('edit', compact('pokemon'));
}

    public function update(Request $request, $id)
{
    $pokemon = Pokemon::findOrFail($id);

    $request->validate([
        'nome' => 'required',
        'tipo' => 'required',
        'ataque' => 'required|integer',
        'descricao' => 'required',
        'foto' => 'image|nullable|max:2048'
    ]);

    $data = $request->all();

    if ($request->hasFile('foto')) {
        $data['foto'] = $request->file('foto')->store('pokemons', 'public');
    }

    $pokemon->update($data);

    return redirect('/')->with('sucesso', 'Pokémon atualizado com sucesso!');
}


public function destroy($id)
{
    $pokemon = Pokemon::findOrFail($id);
    
    // Opcional: Deletar a foto do storage para não ocupar espaço
    if ($pokemon->foto && !str_starts_with($pokemon->foto, 'img/')) {
        \Illuminate\Support\Facades\Storage::disk('public')->delete($pokemon->foto);
    }

    $pokemon->delete();

    return redirect('/')->with('sucesso', 'Pokémon excluído com sucesso!');
}
}