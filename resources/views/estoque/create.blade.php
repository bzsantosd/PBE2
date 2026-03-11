<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cadastrar Item no Estoque</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                    <p class="font-bold">Verifique os erros abaixo:</p>
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 border border-gray-200">
                <form action="{{ route('estoque.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div class="col-span-2">
                            <label class="block text-sm font-bold text-gray-700 uppercase">Descrição do Produto</label>
                            <input type="text" name="descricao" value="{{ old('descricao') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase">ID Fornecedor</label>
                            <input type="number" name="fornecedor_id" value="{{ old('fornecedor_id') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase">Categoria</label>
                            <input type="text" name="categoria" value="{{ old('categoria') }}" placeholder="Ex: Matéria-prima" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase">Unidade de Medida</label>
                            <select name="unidade_medida" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="UN">Unidade (UN)</option>
                                <option value="KG">Quilograma (KG)</option>
                                <option value="LT">Litro (LT)</option>
                                <option value="MT">Metro (MT)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase">Preço de Custo Unitário</label>
                            <div class="relative mt-1">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">R$</span>
                                <input type="number" step="0.01" name="preco_custo_unitario" value="{{ old('preco_custo_unitario') }}" class="pl-10 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase">Quantidade Atual</label>
                            <input type="number" step="0.01" name="quantidade_atual" value="{{ old('quantidade_atual') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase">Alerta de Qtd. Mínima</label>
                            <input type="number" step="0.01" name="quantidade_minima" value="{{ old('quantidade_minima') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                    </div>

                    <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t">
                        <a href="{{ route('estoque.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">Cancelar</a>
                        <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-2 rounded-md font-bold uppercase text-xs tracking-widest transition-all">
                            Salvar no Estoque
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>