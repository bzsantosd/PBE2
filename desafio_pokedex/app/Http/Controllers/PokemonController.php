<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokemon;
use Illuminate\Support\Facades\File;

class PokemonController extends Controller
{
    /**
     * Lista todos os Pokémon na página principal.
     */
    public function index()
    {
        // Busca os 3 lendários (is_fixo = 1)
        $lendarios = Pokemon::where('is_fixo', true)->get();

        // Busca as criações do usuário (is_fixo = 0)
        $cadastrados = Pokemon::where('is_fixo', false)->orderBy('id', 'desc')->get();

        return view('pokedex', compact('lendarios', 'cadastrados'));
    }

    /**
     * Salva um novo Pokémon no banco de dados e a imagem em public/img.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome'      => 'required|string|max:255',
            'tipo'      => 'required|string|max:255',
            'ataque'    => 'required|integer',
            'descricao' => 'required|string',
            'foto'      => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $caminhoFoto = null;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            // Gera um nome único com timestamp para evitar substituição
            $nomeArquivo = time() . '_' . $file->getClientOriginalName();
            
            // Move o arquivo para a pasta public/img
            $file->move(public_path('img'), $nomeArquivo);
            
            // Salva o caminho relativo que será usado pelo helper asset()
            $caminhoFoto = 'img/' . $nomeArquivo;
        }

        Pokemon::create([
            'nome'      => $request->nome,
            'tipo'      => $request->tipo,
            'ataque'    => $request->ataque,
            'descricao' => $request->descricao,
            'foto'      => $caminhoFoto,
            'is_fixo'   => false,
        ]);

        return redirect()->route('pokedex')->with('sucesso', 'Pokémon cadastrado com sucesso!');
    }

    /**
     * Abre a tela de edição.
     */
    public function edit($id)
    {
        $pokemon = Pokemon::findOrFail($id);
        return view('edit', compact('pokemon'));
    }

    /**
     * Atualiza os dados no banco de dados.
     */
    public function update(Request $request, $id)
{
    $pokemon = Pokemon::findOrFail($id);

    $request->validate([
        'nome'      => 'required|string|max:255',
        'tipo'      => 'required|string|max:255',
        'ataque'    => 'required|integer',
        'descricao' => 'required|string',
        'foto'      => 'nullable|image|max:2048',
    ]);

    // Pegamos todos os dados, EXCETO a foto por enquanto
    $dados = $request->except('foto');

    if ($request->hasFile('foto')) {
        // 1. Deleta a foto antiga se ela existir (e não for lendário)
        if ($pokemon->foto && File::exists(public_path($pokemon->foto)) && !$pokemon->is_fixo) {
            File::delete(public_path($pokemon->foto));
        }

        // 2. Sobe a foto nova
        $file = $request->file('foto');
        $nomeArquivo = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('img'), $nomeArquivo);
        
        // 3. Adiciona o novo caminho ao array de dados para salvar
        $dados['foto'] = 'img/' . $nomeArquivo;
    }

    // Atualiza o banco de dados
    $pokemon->update($dados);

    return redirect()->route('pokedex')->with('sucesso', 'Pokémon atualizado com sucesso!');
}

    /**
     * Exclui o Pokémon e remove o arquivo de imagem.
     */
    public function destroy($id)
    {
        $pokemon = Pokemon::findOrFail($id);

        // Deleta o arquivo físico da pasta public/img (apenas se não for fixo)
        if ($pokemon->foto && File::exists(public_path($pokemon->foto)) && !$pokemon->is_fixo) {
            File::delete(public_path($pokemon->foto));
        }

        $pokemon->delete();

        return redirect()->route('pokedex')->with('sucesso', 'Pokémon excluído com sucesso!');
    }
}