<x-app-layout>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap');

        :root {
            --ink: #0f0f0f;
            --cream: #faf8f4;
            --accent: #d4562a;
            --accent-muted: #f0cfc4;
            --mid: #6b6b6b;
            --border: #e2ddd8;
            --card: #ffffff;
            --blue: #2563eb;
            --danger: #dc2626;
        }

        body { font-family: 'DM Sans', sans-serif; background: var(--cream); }

        /* Cabeçalho com Botão */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 1.75rem;
        }

        .page-subtitle {
            font-size: 0.72rem;
            color: var(--mid);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-weight: 500;
            margin-bottom: 0.2rem;
        }

        .page-title {
            font-family: 'Syne', sans-serif;
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--ink);
            line-height: 1;
        }

        .btn-new {
            background: var(--ink);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-new:hover {
            background: var(--accent);
            transform: translateY(-2px);
            color: white;
        }

        /* Tabela */
        .table-wrap {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        }

        .data-table { width: 100%; border-collapse: collapse; }
        .data-table thead tr { background: var(--ink); }

        .data-table thead th {
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.5);
            padding: 1rem 1.25rem;
            text-align: left;
        }

        .data-table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.12s;
        }

        .data-table tbody tr:last-child { border-bottom: none; }
        .data-table tbody tr:hover { background: #fdf6f3; }

        .data-table tbody td {
            padding: 1.1rem 1.25rem;
            font-size: 0.875rem;
            vertical-align: middle;
        }

        .supplier-name {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            color: var(--ink);
        }

        .tipo-badge {
            display: inline-block;
            background: var(--accent-muted);
            color: var(--accent);
            font-size: 0.65rem;
            font-weight: 800;
            padding: 3px 10px;
            border-radius: 20px;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }

        .cnpj-mono {
            font-family: 'DM Mono', monospace;
            font-size: 0.78rem;
            color: var(--mid);
            background: #f4f1ee;
            padding: 2px 6px;
            border-radius: 4px;
        }

        /* Ações */
        .action-btns {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        .btn-edit { 
            color: var(--blue); 
            font-weight: 700; 
            font-size: 0.75rem; 
            text-transform: uppercase; 
            text-decoration: none; 
        }

        .btn-delete { 
            color: var(--danger); 
            font-weight: 700; 
            font-size: 0.75rem; 
            text-transform: uppercase; 
            background: none; 
            border: none; 
            cursor: pointer; 
            padding: 0;
        }

        .btn-edit:hover, .btn-delete:hover { text-decoration: underline; }

        .empty-state {
            text-align: center;
            padding: 3.5rem 1rem;
            color: var(--mid);
        }
        .empty-state span { display: block; font-size: 2rem; margin-bottom: 0.75rem; }
    </style>

    <div class="py-10 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">

        {{-- Alerta de Sucesso --}}
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-800 rounded shadow-sm flex justify-between items-center">
                <span class="font-medium">✓ {{ session('success') }}</span>
            </div>
        @endif

        <div class="page-header">
            <div>
                <div class="page-subtitle">Cadastro</div>
                <div class="page-title">Fornecedores de Insumos e Serviços</div>
            </div>
            <a href="{{ route('fornecedores.create') }}" class="btn-new">
                + Novo Fornecedor
            </a>
        </div>

        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nome Fantasia</th>
                        <th>Tipo de Material</th>
                        <th>CNPJ</th>
                        <th>Contato</th>
                        <th>E-mail</th>
                        <th style="text-align: right;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($fornecedores as $fornecedor)
                        <tr>
                            <td>
                                <div class="supplier-name">{{ $fornecedor->nome_fantasia }}</div>
                                <div style="font-size: 0.7rem; color: var(--mid);">{{ $fornecedor->razao_social }}</div>
                            </td>
                            <td><span class="tipo-badge">{{ $fornecedor->tipo_produto }}</span></td>
                            <td><span class="cnpj-mono">{{ $fornecedor->cnpj ?? 'N/D' }}</span></td>
                            <td>{{ $fornecedor->telefone }}</td>
                            <td style="color: var(--mid);">{{ $fornecedor->email }}</td>
                            <td>
                                <div class="action-btns">
                                    <a href="{{ route('fornecedores.edit', $fornecedor->id) }}" class="btn-edit">
                                        Editar
                                    </a>

                                    <form action="{{ route('fornecedores.destroy', $fornecedor->id) }}" method="POST" onsubmit="return confirm('Excluir este fornecedor permanentemente?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <span>🏭</span>
                                    <p class="font-bold">Nenhum fornecedor cadastrado.</p>
                                    <p class="text-xs">Clique no botão acima para adicionar o primeiro.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>