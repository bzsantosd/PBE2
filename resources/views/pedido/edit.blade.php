<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Editar Pedido</h2></x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('pedidos.update', $pedido->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Cliente</label>
                        <select name="cliente_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}" {{ $pedido->cliente_id == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nº do Pedido</label>
                            <input type="text" name="numero_pedido" value="{{ old('numero_pedido', $pedido->numero_pedido) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Data Entrega Prevista</label>
                            <input type="date" name="data_entrega_prevista" value="{{ old('data_entrega_prevista', $pedido->data_entrega_prevista) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Valor Total</label>
                            <input type="number" step="0.01" name="valor_total" value="{{ old('valor_total', $pedido->valor_total) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Valor Entrada</label>
                            <input type="number" step="0.01" name="valor_entrada" value="{{ old('valor_entrada', $pedido->valor_entrada) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="Pendente" {{ $pedido->status == 'Pendente' ? 'selected' : '' }}>Pendente</option>
                                <option value="Em Produção" {{ $pedido->status == 'Em Produção' ? 'selected' : '' }}>Em Produção</option>
                                <option value="Finalizado" {{ $pedido->status == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Observações</label>
                        <textarea name="observacoes" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('observacoes', $pedido->observacoes) }}</textarea>
                    </div>

                    <div class="flex items-center justify-end mt-4 gap-4">
                        <a href="{{ route('pedidos.index') }}" class="text-gray-500 hover:underline">Cancelar</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md uppercase text-xs font-bold">
                            Atualizar Pedido
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>