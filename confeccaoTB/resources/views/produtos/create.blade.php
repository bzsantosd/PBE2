<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500;700&display=swap');
        
        .form-card { background: #ffffff; border: 1px solid #e2ddd8; border-radius: 16px; padding: 2rem; }
        .label-custom { font-family: 'DM Sans', sans-serif; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #6b6b6b; }
        .input-custom { width: 100%; border: 1px solid #e2ddd8; border-radius: 8px; padding: 0.6rem; margin-top: 0.3rem; font-family: 'DM Sans', sans-serif; }
        .input-custom:focus { border-color: #d4562a; ring: none; outline: none; }
        .title-syne { font-family: 'Syne', sans-serif; font-weight: 800; color: #0f0f0f; }
    </style>

    <div class="py-12 max-w-5xl mx-auto px-4">
        <div class="mb-8">
            <h2 class="title-syne text-3xl">Novo Produto / Fornecedor</h2>
            <p class="text-gray-500 text-sm mt-1">Preencha as informações para registrar no sistema.</p>
        </div>

        <div class="form-card shadow-sm">
            <form action="{{ route('produtos.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Nome Fantasia --}}
                    <div class="col-span-1">
                        <label class="label-custom">Nome Fantasia</label>
                        <input type="text" name="nome_fantasia" class="input-custom" placeholder="Ex: Padaria central" required>
                    </div>

                    {{-- Razão Social --}}
                    <div class="col-span-1">
                        <label class="label-custom">Razão Social</label>
                        <input type="text" name="razao_social" class="input-custom" placeholder="Ex: Silva & Cia LTDA" required>
                    </div>

                    {{-- CNPJ --}}
                    <div>
                        <label class="label-custom">CNPJ</label>
                        <input type="text" name="cnpj" class="input-custom" placeholder="00.000.000/0001-00" required>
                    </div>

                    {{-- Tipo de Produto --}}
                    <div>
                        <label class="label-custom">Tipo de Produto/Categoria</label>
                        <select name="tipo_produto" class="input-custom">
                            <option value="Materia-prima">Matéria-prima</option>
                            <option value="Embalagem">Embalagem</option>
                            <option value="Serviço">Serviço</option>
                        </select>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="label-custom">E-mail de Contato</label>
                        <input type="email" name="email" class="input-custom" placeholder="contato@empresa.com" required>
                    </div>

                    {{-- Telefone --}}
                    <div>
                        <label class="label-custom">Telefone</label>
                        <input type="text" name="telefone" class="input-custom" placeholder="(00) 00000-0000" required>
                    </div>

                    {{-- Endereço --}}
                    <div class="col-span-2">
                        <label class="label-custom">Endereço Completo</label>
                        <input type="text" name="endereco" class="input-custom">
                    </div>

                    {{-- Observações --}}
                    <div class="col-span-2">
                        <label class="label-custom">Observações Adicionais</label>
                        <textarea name="observacoes" rows="3" class="input-custom"></textarea>
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-4 items-center">
                    <a href="{{ route('produtos.index') }}" class="text-sm font-bold text-gray-400 hover:text-gray-600 uppercase">Cancelar</a>
                    <button type="submit" class="bg-[#0f0f0f] text-white px-8 py-3 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-[#d4562a] transition-all">
                        Salvar Registro
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>