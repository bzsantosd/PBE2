<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Editar Item do Estoque</h2></x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('estoque.update', $item->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Descrição</label>
                        <input type="text" name="descricao" value="{{ old('descricao', $item->descricao) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ID Fornecedor</label>
                            <input type="number" name="fornecedor_id" value="{{ old('fornecedor_id', $item->fornecedor_id) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Unidade de Medida</label>
                            <input type="text" name="unidade_medida" value="{{ old('unidade_medida', $item->unidade_medida) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Quantidade Atual</label>
                            <input type="number" step="0.01" name="quantidade_atual" value="{{ old('quantidade_atual', $item->quantidade_atual) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Quantidade Mínima</label>
                            <input type="number" step="0.01" name="quantidade_minima" value="{{ old('quantidade_minima', $item->quantidade_minima) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Preço Custo Unitário</label>
                            <input type="number" step="0.01" name="preco_custo_unitario" value="{{ old('preco_custo_unitario', $item->preco_custo_unitario) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Categoria</label>
                        <input type="text" name="categoria" value="{{ old('categoria', $item->categoria) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="flex items-center justify-end mt-4 gap-4">
                        <a href="{{ route('estoque.index') }}" class="text-gray-500 hover:underline">Cancelar</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md uppercase text-xs font-bold">
                            Atualizar Estoque
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>