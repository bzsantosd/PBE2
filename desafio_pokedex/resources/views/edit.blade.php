<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pokémon - Pokédex</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Roboto', sans-serif; background-color: #f3f4f6; }
    </style>
</head>
<body class="py-10 px-4">

    <div class="max-w-2xl mx-auto">
        <div class="mb-8 flex items-center justify-between">
            <h1 class="text-3xl font-black text-yellow-500 uppercase tracking-tighter">Editar Pokémon</h1>
            <a href="{{ route('pokedex') }}" class="text-gray-500 hover:text-gray-800 font-bold text-sm uppercase">← Voltar</a>
        </div>

        <section class="bg-white p-8 rounded-3xl border-4 border-yellow-500 shadow-2xl">
            
            <form action="{{ route('pokemon.update', $pokemon->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-black uppercase text-gray-400 mb-2">Nome do Pokémon</label>
                    <input type="text" name="nome" value="{{ $pokemon->nome }}" required 
                        class="w-full p-4 border-2 border-gray-100 rounded-2xl focus:border-yellow-500 outline-none transition-all font-bold text-gray-700">
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-black uppercase text-gray-400 mb-2">Tipo</label>
                        <input type="text" name="tipo" value="{{ $pokemon->tipo }}" required 
                            class="w-full p-4 border-2 border-gray-100 rounded-2xl focus:border-yellow-500 outline-none font-bold text-gray-700">
                    </div>
                    <div>
                        <label class="block text-xs font-black uppercase text-gray-400 mb-2">Poder de Ataque</label>
                        <input type="number" name="ataque" value="{{ $pokemon->ataque }}" required 
                            class="w-full p-4 border-2 border-gray-100 rounded-2xl focus:border-yellow-500 outline-none font-bold text-gray-700">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-gray-400 mb-2">Descrição / Habilidades</label>
                    <textarea name="descricao" required rows="3"
                        class="w-full p-4 border-2 border-gray-100 rounded-2xl focus:border-yellow-500 outline-none font-medium text-gray-600">{{ $pokemon->descricao }}</textarea>
                </div>
                
                <div class="p-6 border-2 border-dashed border-gray-200 rounded-3xl bg-gray-50">
                    <label class="block text-xs font-black uppercase text-gray-400 mb-4 text-center">Foto do Pokémon</label>
                    
                    <div class="flex flex-col items-center gap-4">
                        @if($pokemon->foto)
                            <div class="w-32 h-32 bg-white rounded-2xl border-2 border-gray-200 flex items-center justify-center overflow-hidden shadow-inner">
                                <img src="{{ asset($pokemon->foto) }}" class="w-full h-full object-contain p-2">
                            </div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase italic">Foto atual no sistema</p>
                        @endif

                        <div class="w-full">
                            <input type="file" name="foto" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-yellow-50 file:text-yellow-700 hover:file:bg-yellow-100 cursor-pointer">
                            <p class="text-[10px] text-yellow-600 mt-2 font-bold text-center uppercase">Selecione uma imagem apenas se desejar trocar a atual</p>
                        </div>
                    </div>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white font-black py-5 rounded-2xl transition-all shadow-lg transform active:scale-95 uppercase tracking-widest">
                        Salvar Alterações
                    </button>
                    <a href="{{ route('pokedex') }}" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-400 font-black py-5 rounded-2xl transition-all text-center uppercase tracking-widest">
                        Cancelar
                    </a>
                </div>
            </form>
        </section>
    </div>

</body>
</html>