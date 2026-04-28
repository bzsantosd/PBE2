<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokedex API - Edição de Colecionador</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            /* Fundo temático com padrão sutil */
            background-color: #f3f4f6;
            background-image: radial-gradient(#cc0000 0.5px, transparent 0.5px), radial-gradient(#cc0000 0.5px, #e5e7eb 0.5px);
            background-size: 20px 20px;
            background-position: 0 0, 10px 10px;
            font-family: 'Roboto', sans-serif;
        }
        .pixel-font { font-family: 'Press+Start+2P', cursive; font-size: 10px; }
        .pokedex-border { border: 4px solid #333; }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen py-10 px-4">
    
    <div class="bg-[#dc0a2d] p-3 rounded-[2rem] shadow-[0_20px_50px_rgba(0,0,0,0.3)] pokedex-border w-96 relative overflow-hidden">
        
        <div class="flex gap-2 mb-4 ml-4">
            <div class="w-10 h-10 bg-blue-400 border-4 border-white rounded-full shadow-inner shadow-blue-600"></div>
            <div class="w-3 h-3 bg-red-600 border border-black rounded-full"></div>
            <div class="w-3 h-3 bg-yellow-400 border border-black rounded-full"></div>
            <div class="w-3 h-3 bg-green-500 border border-black rounded-full"></div>
        </div>

        <div class="bg-[#efefef] rounded-xl p-5 pokedex-border shadow-inner">
            
            <div class="flex justify-between items-center mb-2">
                <h1 class="text-xl font-black text-gray-800 uppercase tracking-tighter">
                    {{ $pokemon['name'] }}
                </h1>
                <span class="text-gray-400 font-bold">#{{ str_pad($pokemon['id'], 3, '0', STR_PAD_LEFT) }}</span>
            </div>

            <div class="bg-white rounded-lg border-2 border-gray-300 shadow-md mb-4 overflow-hidden relative group">
                <div class="absolute inset-0 bg-gradient-to-b from-blue-100/50 to-transparent"></div>
                <img src="{{ $pokemon['sprites']['other']['official-artwork']['front_default'] }}" 
                     alt="{{ $pokemon['name'] }}" 
                     class="w-full h-48 object-contain p-4 relative z-10 drop-shadow-xl transform group-hover:scale-110 transition duration-300">
            </div> 

            <div class="flex justify-center gap-2 mb-4">
                @foreach($pokemon['types'] as $tipo)
                <span class="px-4 py-1 bg-[#333] text-white text-[10px] font-bold rounded-full uppercase tracking-widest border-b-2 border-black">
                    {{ $tipo['type']['name'] }}
                </span>
                @endforeach
            </div>

            <div class="flex justify-around bg-gray-200 rounded-lg py-2 mb-4 text-[11px] font-bold text-gray-600">
                <div class="text-center">
                    <p class="text-gray-400 text-[9px] uppercase">Altura</p>
                    <p>{{ $pokemon['height'] / 10 }} m</p>
                </div>
                <div class="border-l border-gray-300"></div>
                <div class="text-center">
                    <p class="text-gray-400 text-[9px] uppercase">Peso</p>
                    <p>{{ $pokemon['weight'] / 10 }} kg</p>
                </div>
            </div>

            <div class="text-left mb-4">
                <h3 class="text-[10px] font-black text-gray-500 uppercase mb-2 flex items-center gap-2">
                    <span class="w-2 h-2 bg-red-500 rounded-full"></span> Estatísticas Base
                </h3>
                <div class="grid grid-cols-2 gap-2 text-[10px]">
                    @foreach($pokemon['stats'] as $stat)
                    <div class="flex flex-col bg-white border border-gray-200 p-1 px-2 rounded shadow-sm">
                        <span class="text-gray-400 uppercase font-bold text-[8px]">{{ $stat['stat']['name'] }}</span>
                        <span class="font-bold text-gray-700 leading-tight">{{ $stat['base_stat'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="text-left mb-4">
                <h3 class="text-[10px] font-black text-gray-500 uppercase mb-2 flex items-center gap-2">
                    <span class="w-2 h-2 bg-blue-500 rounded-full"></span> Principais Golpes
                </h3>
                <div class="flex flex-wrap gap-1">
                    @foreach(array_slice($pokemon['moves'], 0, 4) as $move)
                    <span class="bg-gray-800 text-green-400 px-2 py-1 rounded border-l-2 border-green-500 text-[9px] font-mono">
                        > {{ strtoupper(str_replace('-', ' ', $move['move']['name'])) }}
                    </span>
                    @endforeach
                </div>
            </div>

            <button onclick="window.location.reload()" 
                    class="w-full bg-[#333] hover:bg-black text-white text-xs font-bold py-3 px-4 rounded-xl transition-all active:scale-95 shadow-lg flex items-center justify-center gap-2">
                <div class="w-3 h-3 bg-white rounded-full border-2 border-gray-500"></div>
                BUSCAR PRÓXIMO
            </button>
        </div>

        <div class="flex justify-between items-center mt-3 px-4">
            <div class="w-12 h-2 bg-black/20 rounded-full"></div>
            <div class="flex gap-1">
                <div class="w-3 h-3 bg-blue-800 rounded-full"></div>
                <div class="w-3 h-3 bg-blue-800 rounded-full"></div>
            </div>
        </div>
    </div>

</body>
</html>