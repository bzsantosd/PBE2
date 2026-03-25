<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500;700&display=swap');
        
        .form-card { background: #ffffff; border: 1px solid #e2ddd8; border-radius: 20px; padding: 2.5rem; }
        .label-custom { font-family: 'DM Sans', sans-serif; font-size: 0.68rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #6b6b6b; margin-bottom: 0.4rem; display: block; }
        .input-custom { width: 100%; border: 1px solid #e2ddd8; border-radius: 10px; padding: 0.75rem; font-family: 'DM Sans', sans-serif; transition: all 0.2s; }
        .input-custom:focus { border-color: #d4562a; outline: none; ring: 0; box-shadow: 0 0 0 2px rgba(212, 86, 42, 0.1); }
        .title-syne { font-family: 'Syne', sans-serif; font-weight: 800; color: #0f0f0f; }
        .price-focus { font-weight: 700; color: #d4562a; }
    </style>

    <div class="py-12 max-w-5xl mx-auto px-6">
        <div class="mb-10 flex justify-between items-end">
            <div>
                <p class="text-[#d4562a] font-bold text-xs uppercase tracking-[0.2em] mb-2">Novo Registro</p>
                <h2 class="title-syne text-4xl">Gerar Pedido</h2>
            </div>
            <div class="text-right">
                <span class="text-gray-400 text-xs uppercase font-bold">Data do Sistema</span>
                <p class="font-bold text-sm">{{ date('d/m/Y') }}</p>
            </div>
        </div>

        <div class="form-card shadow-sm">
            <form action="{{ route('pedidos.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="col-span-1 md:col-span-2">
                        <label class="label-custom">Selecionar Cliente</label>
                        <select name="cliente_id" class="input-custom" required>
                            <option value="">Selecione um cliente cadastrado...</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-1">
                        <label class="label-custom">Nº do Pedido</label>
                        <input type="text" name="numero_pedido" class="input-custom font-bold" value="{{ rand(1000, 9999) }}" required>
                    </div>

                    <div>
                        <label class="label-custom">Valor Total (R$)</label>
                        <input type="number" step="0.01" name="valor_total" class="input-custom price-focus" placeholder="0,00" required>
                    </div>

                    <div>
                        <label class="label-custom">Valor Entrada (R$)</label>
                        <input type="number" step="0.01" name="valor_entrada" class="input-custom text-green-600" placeholder="0,00">
                    </div>

                    <div>
                        <label class="label-custom">Status Inicial</label>
                        <select name="status" class="input-custom font-bold">
                            <option value="Pendente">Pendente</option>
                            <option value="Em Produção">Em Produção</option>
                            <option value="Aguardando Retirada">Aguardando Retirada</option>
                            <option value="Finalizado">Finalizado</option>
                        </select>
                    </div>

                    <div class="col-span-1">
                        <label class="label-custom">Entrega Prevista</label>
                        <input type="date" name="data_entrega_prevista" class="input-custom" required>
                    </div>

                    <div class="col-span-1 md:col-span-2">
                        <label class="label-custom">Observações do Pedido</label>
                        <textarea name="observacoes" rows="1" class="input-custom" placeholder="Detalhes técnicos, cores, urgência..."></textarea>
                    </div>
                </div>

                <div class="mt-12 flex justify-end items-center gap-8 border-t border-gray-100 pt-8">
                    <a href="{{ route('pedidos.index') }}" class="text-xs font-bold text-gray-400 hover:text-black uppercase tracking-widest transition-all">Cancelar</a>
                    <button type="submit" class="bg-[#0f0f0f] text-white px-12 py-4 rounded-xl font-bold text-xs uppercase tracking-[0.2em] hover:bg-[#d4562a] transition-all transform hover:-translate-y-1 shadow-lg shadow-gray-200">
                        Confirmar Pedido
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>