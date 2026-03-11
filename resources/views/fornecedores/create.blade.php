<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500;700&display=swap');
        
        .form-container { background: #ffffff; border: 1px solid #e2ddd8; border-radius: 20px; padding: 2.5rem; }
        .field-label { font-family: 'DM Sans', sans-serif; font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; color: #6b6b6b; margin-bottom: 0.5rem; display: block; }
        .field-input { width: 100%; border: 1px solid #e2ddd8; border-radius: 10px; padding: 0.75rem; font-family: 'DM Sans', sans-serif; transition: all 0.2s; }
        .field-input:focus { border-color: #d4562a; outline: none; ring: 0; box-shadow: 0 0 0 2px rgba(212, 86, 42, 0.1); }
        .title-brand { font-family: 'Syne', sans-serif; font-weight: 800; color: #0f0f0f; letter-spacing: -0.02em; }
    </style>

    <div class="py-12 max-w-5xl mx-auto px-6">
        <div class="mb-10">
            <div class="text-[#d4562a] font-bold text-xs uppercase tracking-widest mb-2">Novo Registro</div>
            <h2 class="title-brand text-4xl">Cadastrar Fornecedor</h2>
        </div>

        <div class="form-container shadow-sm">
            <form action="{{ route('fornecedores.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="col-span-2 md:col-span-1">
                        <label class="field-label">Nome Fantasia</label>
                        <input type="text" name="nome_fantasia" class="field-input" placeholder="Ex: Tecidos & Arte" required>
                    </div>

                    <div class="col-span-2 md:col-span-1">
                        <label class="field-label">Razão Social</label>
                        <input type="text" name="razao_social" class="field-input" placeholder="Ex: Silva Comercio de Tecidos LTDA">
                    </div>

                    <div>
                        <label class="field-label">CNPJ</label>
                        <input type="text" name="cnpj" class="field-input" placeholder="00.000.000/0001-00" required>
                    </div>

                    <div>
                        <label class="field-label">Tipo de Material / Categoria</label>
                        <select name="tipo_produto" class="field-input">
                            <option value="Materia-prima">Matéria-prima</option>
                            <option value="Embalagem">Embalagem</option>
                            <option value="Acessórios">Acessórios</option>
                            <option value="Serviços">Serviços Externos</option>
                        </select>
                    </div>

                    <div>
                        <label class="field-label">E-mail de Contato</label>
                        <input type="email" name="email" class="field-input" placeholder="contato@fornecedor.com.br" required>
                    </div>

                    <div>
                        <label class="field-label">Telefone / WhatsApp</label>
                        <input type="text" name="telefone" class="field-input" placeholder="(19) 99999-9999">
                    </div>

                    <div class="col-span-2">
                        <label class="field-label">Endereço da Empresa</label>
                        <input type="text" name="endereco" class="field-input" placeholder="Rua, Número, Bairro, Cidade - UF">
                    </div>

                    <div class="col-span-2">
                        <label class="field-label">Observações sobre o fornecedor</label>
                        <textarea name="observacoes" rows="4" class="field-input" placeholder="Ex: Prazo de entrega de 15 dias, pedido mínimo R$ 500..."></textarea>
                    </div>
                </div>

                <div class="mt-12 flex justify-end items-center gap-6 border-t border-gray-100 pt-8">
                    <a href="{{ route('fornecedores.index') }}" class="text-xs font-bold text-gray-400 hover:text-gray-900 uppercase tracking-widest transition-colors">Voltar para lista</a>
                    <button type="submit" class="bg-[#0f0f0f] text-white px-10 py-4 rounded-xl font-bold text-xs uppercase tracking-[0.2em] hover:bg-[#d4562a] transition-all transform hover:-translate-y-1">
                        Finalizar Cadastro
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>