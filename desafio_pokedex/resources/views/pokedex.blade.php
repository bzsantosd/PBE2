<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Pokedex Local</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;900&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Roboto', sans-serif; 
            /* Fundo personalizado: Padrão sutil de "bolinhas" que lembram o design técnico da Pokedex */
            background-color: #e5e7eb;
            background-image: radial-gradient(#f87171 0.5px, transparent 0.5px), radial-gradient(#f87171 0.5px, #e5e7eb 0.5px);
            background-size: 20px 20px;
            background-position: 0 0, 10px 10px;
            background-attachment: fixed;
        }

        /* Efeito de brilho suave no título */
        .pokedex-title {
            text-shadow: 2px 2px 0px #fff, 4px 4px 0px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="py-10 px-4">

    <div class="max-w-6xl mx-auto bg-gray-50/80 backdrop-blur-sm p-6 md:p-10 rounded-[40px] shadow-2xl">
        
        <h1 class="text-6xl font-black text-center text-red-600 mb-12 uppercase tracking-tighter pokedex-title">
            Pokédex <span class="text-gray-800">Edition</span>
        </h1>

        <section class="mb-16">
            <h2 class="text-2xl font-bold mb-6 border-l-8 border-red-600 pl-4 uppercase text-gray-800">
                Pokémon Lendários
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($lendarios as $poke)
                    <div class="bg-red-600 p-1 rounded-3xl shadow-2xl border-4 border-black transform hover:-translate-y-2 transition-all">
                        <div class="bg-gray-100 rounded-2xl p-6 border-2 border-black h-full flex flex-col">
                            
                            <div class="h-40 mb-4 bg-white rounded-xl border-2 border-gray-300 flex items-center justify-center overflow-hidden shadow-inner">
                                <img src="{{ asset($poke->foto) }}" alt="{{ $poke->nome }}" class="w-full h-full object-contain p-2 hover:scale-110 transition-transform">
                            </div>

                            <h3 class="text-xl font-black uppercase text-center mb-4 text-gray-800 border-b-2 border-gray-300 pb-2">
                                {{ $poke->nome }}
                            </h3>
                            <p class="text-sm italic text-gray-600 mb-6 text-center leading-relaxed flex-grow">
                                "{{ $poke->descricao }}"
                            </p>
                            <div class="flex justify-between items-center bg-white p-3 rounded-xl border border-gray-300 shadow-sm mt-auto">
                                <span class="text-xs font-bold uppercase text-red-500">Tipo: {{ $poke->tipo }}</span>
                                <span class="text-xs font-bold uppercase text-gray-700">Atk: {{ $poke->ataque }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="mb-16 bg-white p-8 rounded-3xl border-4 border-blue-500 shadow-2xl max-w-2xl mx-auto relative overflow-hidden">
            <div class="absolute top-0 right-0 w-16 h-16 bg-blue-500 rotate-45 translate-x-8 -translate-y-8"></div>
            
            <h2 class="text-2xl font-black text-center text-blue-500 mb-8 uppercase">Novo Cadastro</h2>
            
            @if(session('sucesso'))
                <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6 font-bold text-center border border-green-200">
                    {{ session('sucesso') }}
                </div>
            @endif

            <form action="{{ route('pokemon.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5 relative z-10">
                @csrf
                <input type="text" name="nome" placeholder="Nome do Pokemon" required class="w-full p-4 border-2 border-gray-200 rounded-2xl focus:border-blue-500 outline-none focus:ring-4 focus:ring-blue-100 transition-all">
                
                <div class="grid grid-cols-2 gap-4">
                    <input type="text" name="tipo" placeholder="Tipo" required class="p-4 border-2 border-gray-200 rounded-2xl focus:border-blue-500 outline-none focus:ring-4 focus:ring-blue-100 transition-all">
                    <input type="number" name="ataque" placeholder="Ataque" required class="p-4 border-2 border-gray-200 rounded-2xl focus:border-blue-500 outline-none focus:ring-4 focus:ring-blue-100 transition-all">
                </div>

                <textarea name="descricao" placeholder="Descrição/Habilidades..." required rows="3" class="w-full p-4 border-2 border-gray-200 rounded-2xl focus:border-blue-500 outline-none focus:ring-4 focus:ring-blue-100 transition-all"></textarea>
                
                <div class="p-4 border-2 border-dashed border-gray-300 rounded-2xl text-center hover:border-blue-400 transition-colors">
                    <input type="file" name="foto" required class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                </div>

                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-black py-5 rounded-2xl shadow-lg uppercase tracking-widest transition-all hover:scale-[1.02] active:scale-95">
                    Salvar Pokémon
                </button>
            </form>
        </section>

        <section>
            <h2 class="text-2xl font-bold mb-8 border-l-8 border-green-500 pl-4 uppercase text-gray-800">
                Minhas Criações
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($cadastrados as $p)
                    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border-2 border-gray-100 hover:shadow-2xl transition-all group">
                        
                        <div class="h-48 overflow-hidden bg-gray-50 flex items-center justify-center border-b border-gray-100">
                            @if($p->foto)
                                <img src="{{ asset($p->foto) }}" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500 p-4">
                            @else
                                <div class="flex flex-col items-center">
                                    <span class="text-gray-300 text-4xl mb-2">?</span>
                                    <span class="text-gray-400 text-[10px] font-bold uppercase">Sem Foto</span>
                                </div>
                            @endif
                        </div>

                        <div class="p-6">
                            <h4 class="font-black text-xl text-gray-800 uppercase mb-1">{{ $p->nome }}</h4>
                            <div class="flex justify-between items-center mb-4">
                                <span class="bg-green-100 text-green-700 text-[10px] font-bold px-2 py-1 rounded-md uppercase">
                                    {{ $p->tipo }}
                                </span>
                                <span class="text-gray-400 text-[10px] font-bold uppercase">ATK: {{ $p->ataque }}</span>
                            </div>
                            <p class="text-xs text-gray-500 italic leading-relaxed line-clamp-2 mb-6 h-8">
                                {{ $p->descricao }}
                            </p>

                            <div class="flex gap-2">
                                <a href="{{ route('pokemon.edit', $p->id) }}" 
                                   class="flex-1 text-center bg-yellow-400 hover:bg-yellow-500 text-yellow-900 text-[10px] font-black py-3 rounded-xl transition-colors uppercase">
                                    Editar
                                </a>

                                <form action="{{ route('pokemon.destroy', $p->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Excluir este Pokémon?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white text-[10px] font-black py-3 rounded-xl transition-colors uppercase">
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20 bg-white/50 rounded-3xl border-2 border-dashed border-gray-300">
                        <p class="text-gray-500 font-bold uppercase tracking-widest text-sm">Nenhum Pokémon criado ainda.</p>
                    </div>
                @endforelse
            </div>
        </section>
    </div>

</body>
</html>