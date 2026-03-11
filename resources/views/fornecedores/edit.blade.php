<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Editar Fornecedor</h2></x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('fornecedores.update', $fornecedor->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nome Fantasia</label>
                        <input type="text" name="nome_fantasia" value="{{ old('nome_fantasia', $fornecedor->nome_fantasia) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">CNPJ</label>
                        <input type="text" name="cnpj" value="{{ old('cnpj', $fornecedor->cnpj) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">E-mail</label>
                        <input type="email" name="email" value="{{ old('email', $fornecedor->email) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tipo de Produto</label>
                        <input type="text" name="tipo_produto" value="{{ old('tipo_produto', $fornecedor->tipo_produto) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="flex items-center justify-end mt-4 gap-4">
                        <a href="{{ route('fornecedores.index') }}" class="text-gray-500 hover:underline">Cancelar</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md uppercase text-xs font-bold">
                            Atualizar Fornecedor
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>