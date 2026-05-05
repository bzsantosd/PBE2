<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Pokémon</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-3xl shadow-xl border-4 border-yellow-500">
        <h2 class="text-2xl font-black text-center text-yellow-600 mb-8 uppercase">Editar: {{ $pokemon->nome }}</h2>
        
        <form action="{{ route('pokemon.update', $pokemon->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')
            
            <input type="text" name="nome" value="{{ $pokemon->nome }}" class="w-full p-4 border-2 rounded-2xl outline-none focus:border-yellow-500">
            
            <div class="grid grid-cols-2 gap-4">
                <input type="text" name="tipo" value="{{ $pokemon->tipo }}" class="p-4 border-2 rounded-2xl outline-none focus:border-yellow-500">
                <input type="number" name="ataque" value="{{ $pokemon->ataque }}" class="p-4 border-2 rounded-2xl outline-none focus:border-yellow-500">
            </div>

            <textarea name="descricao" rows="3" class="w-full p-4 border-2 rounded-2xl outline-none focus:border-yellow-500">{{ $pokemon->descricao }}</textarea>
            
            <div class="p-4 border-2 border-dashed rounded-2xl">
                <p class="text-xs font-bold text-gray-400 mb-2">NOVA FOTO (DEIXE VAZIO PARA MANTER A ATUAL):</p>
                <input type="file" name="foto" class="w-full text-sm">
            </div>

            <div class="flex gap-4">
                <a href="/" class="w-1/2 bg-gray-500 text-white text-center font-black py-4 rounded-2xl">CANCELAR</a>
                <button type="submit" class="w-1/2 bg-yellow-500 hover:bg-yellow-600 text-white font-black py-4 rounded-2xl shadow-lg">SALVAR ALTERAÇÕES</button>
            </div>
        </form>
    </div>
</body>
</html>