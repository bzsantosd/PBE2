<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Directory | Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased" x-data="{ openModal: false, activeUser: {} }">

    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900">Diretório de Usuários</h1>
            <p class="text-slate-500">Clique em "Detalhes" para visualizar o perfil completo via Modal.</p>
        </div>

        <div class="mb-6">
            <form action="{{ route('users.index') }}" method="GET" class="flex gap-2">
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Pesquisar..." 
                       class="flex-1 p-3 rounded-xl border border-slate-200 shadow-sm outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="bg-slate-900 text-white px-6 rounded-xl font-medium hover:bg-slate-800 transition">Buscar</button>
            </form>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold uppercase text-slate-500">Usuário</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase text-slate-500">Cargo</th>
                        <th class="px-6 py-4 text-right">Ação</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($users as $user)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 flex items-center gap-3">
                            <img src="{{ $user['image'] }}" class="w-10 h-10 rounded-lg bg-slate-100 shadow-sm">
                            <div>
                                <div class="font-bold text-slate-900">{{ $user['firstName'] }} {{ $user['lastName'] }}</div>
                                <div class="text-xs text-slate-500">{{ $user['email'] }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $user['company']['title'] ?? 'N/D' }}</td>
                        <td class="px-6 py-4 text-right">
                            <button @click='activeUser = @json($user); openModal = true' 
                                    class="bg-blue-50 text-blue-600 px-4 py-2 rounded-lg font-semibold hover:bg-blue-600 hover:text-white transition-all text-sm">
                                Detalhes
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-10 text-center text-slate-400">Nenhum usuário encontrado.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div x-show="openModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-90"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-90"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
         style="display: none;">
        
        <div @click.away="openModal = false" 
             class="bg-white w-full max-w-lg rounded-3xl shadow-2xl overflow-hidden">
            
            <div class="h-32 bg-gradient-to-r from-blue-600 to-indigo-700 relative">
                <button @click="openModal = false" class="absolute top-4 right-4 text-white/80 hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="px-8 pb-8" x-show="activeUser.id">
                <div class="relative flex justify-center">
                    <img :src="activeUser.image" class="w-24 h-24 rounded-2xl border-4 border-white shadow-lg -mt-12 bg-white object-cover">
                </div>

                <div class="text-center mt-4">
                    <h2 class="text-2xl font-bold text-slate-900" x-text="activeUser.firstName + ' ' + activeUser.lastName"></h2>
                    <p class="text-blue-600 font-medium" x-text="activeUser.company?.title || 'Cargo não informado'"></p>
                </div>

                <div class="mt-8 grid grid-cols-2 gap-4 border-t border-slate-100 pt-6">
                    <div>
                        <span class="block text-[10px] uppercase font-bold text-slate-400 tracking-widest">E-mail</span>
                        <span class="text-sm font-medium text-slate-700 break-all" x-text="activeUser.email"></span>
                    </div>
                    <div>
                        <span class="block text-[10px] uppercase font-bold text-slate-400 tracking-widest">Telefone</span>
                        <span class="text-sm font-medium text-slate-700" x-text="activeUser.phone"></span>
                    </div>
                    <div>
                        <span class="block text-[10px] uppercase font-bold text-slate-400 tracking-widest">Idade / Sexo</span>
                        <span class="text-sm font-medium text-slate-700" x-text="activeUser.age + ' anos / ' + activeUser.gender"></span>
                    </div>
                    <div>
                        <span class="block text-[10px] uppercase font-bold text-slate-400 tracking-widest">Cidade</span>
                        <span class="text-sm font-medium text-slate-700" x-text="activeUser.address?.city || 'N/D'"></span>
                    </div>
                </div>

                <button @click="openModal = false" 
                        class="w-full mt-8 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold py-3 rounded-xl transition-colors">
                    Fechar
                </button>
            </div>
        </div>
    </div>

</body>
</html>