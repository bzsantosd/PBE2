<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap');

        :root {
            --ink: #0f0f0f;
            --cream: #faf8f4;
            --accent: #d4562a;
            --accent-hover: #b54522;
            --accent-muted: #f0cfc4;
            --mid: #6b6b6b;
            --border: #e2ddd8;
            --card: #ffffff;
        }

        body { font-family: 'DM Sans', sans-serif; background: var(--cream); }

        .form-container {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .page-header {
            margin-bottom: 1.75rem;
        }

        .page-title {
            font-family: 'Syne', sans-serif;
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--ink);
            line-height: 1;
        }

        .page-subtitle {
            font-size: 0.82rem;
            color: var(--mid);
            margin-bottom: 0.15rem;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-family: 'Syne', sans-serif;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.02em;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            color: var(--ink);
            transition: all 0.2s ease;
            background-color: #fff;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-muted);
        }

        .btn-submit {
            background: var(--ink);
            color: white;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            padding: 1rem 2rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: transform 0.1s ease, background 0.2s ease;
            width: 100%;
            margin-top: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .btn-submit:hover {
            background: #2a2a2a;
        }

        .btn-submit:active {
            transform: scale(0.98);
        }

        .grid-cols {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
        }

        @media (max-width: 640px) {
            .grid-cols { grid-template-columns: 1fr; }
        }
    </style>

    <div class="py-10 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto">
        
        <div class="page-header">
            <div class="page-subtitle">Formulário</div>
            <div class="page-title">Novo Cliente</div>
        </div>

        <div class="form-container">
            <form action="{{ route('clientes.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nome" class="form-label">Nome Completo</label>
                    <input type="text" name="nome" id="nome" class="form-input" placeholder="Ex: João Silva" required>
                </div>

                <div class="grid-cols">
                    <div class="form-group">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" name="cpf" id="cpf" class="form-input" placeholder="000.000.000-00" required>
                    </div>

                    <div class="form-group">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" name="telefone" id="telefone" class="form-input" placeholder="(00) 00000-0000" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">E-mail Profissional</label>
                    <input type="email" name="email" id="email" class="form-input" placeholder="exemplo@email.com" required>
                </div>

                <div class="form-group">
                    <label for="endereco" class="form-label">Endereço Residencial</label>
                    <input type="text" name="endereco" id="endereco" class="form-input" placeholder="Rua, Número, Bairro, Cidade" required>
                </div>

                <button type="submit" class="btn-submit">
                    Finalizar Cadastro
                </button>

                <a href="{{ route('clientes.index') }}" style="display: block; text-align: center; margin-top: 1.5rem; color: var(--mid); font-size: 0.8rem; text-decoration: none; font-weight: 500;">
                    ← Voltar para a listagem
                </a>
            </form>
        </div>
    </div>
</x-app-layout>