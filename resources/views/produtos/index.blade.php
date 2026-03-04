<x-app-layout>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap');

        :root {
            --ink: #0f0f0f;
            --cream: #faf8f4;
            --accent: #d4562a;
            --accent-muted: #f0cfc4;
            --purple: #6d3a9e;
            --purple-bg: #f0e8fa;
            --mid: #6b6b6b;
            --border: #e2ddd8;
            --card: #ffffff;
        }

        body { font-family: 'DM Sans', sans-serif; background: var(--cream); }

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
            margin-bottom: 1.75rem;
        }

        .table-wrap {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
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
            padding: 1rem 1.25rem;
            font-size: 0.875rem;
            vertical-align: middle;
        }

        .prod-name {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
        }

        .cnpj-mono {
            font-family: 'DM Mono', 'Courier New', monospace;
            font-size: 0.78rem;
            color: var(--mid);
        }

        .tipo-badge {
            display: inline-block;
            background: var(--purple-bg);
            color: var(--purple);
            font-size: 0.7rem;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 20px;
        }

        .contact-block small {
            display: block;
            font-size: 0.78rem;
            color: var(--mid);
            margin-top: 2px;
        }

        .obs-text {
            font-size: 0.78rem;
            color: var(--mid);
            font-style: italic;
        }

        .empty-state {
            text-align: center;
            padding: 3.5rem 1rem;
            color: var(--mid);
        }
        .empty-state span { display: block; font-size: 2rem; margin-bottom: 0.75rem; }
    </style>

    <div class="py-10 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">

        <div class="page-subtitle">Cadastro</div>
        <div class="page-title">Catálogo de Produtos / Fornecedores</div>

        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CNPJ</th>
                        <th>Tipo</th>
                        <th>Contato</th>
                        <th>Endereço</th>
                        <th>Observações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produtos as $produto)
                        <tr>
                            <td class="prod-name">{{ $produto->nome_fantasia }}</td>
                            <td class="cnpj-mono">{{ $produto->cnpj }}</td>
                            <td><span class="tipo-badge">{{ $produto->tipo_produto }}</span></td>
                            <td class="contact-block">
                                {{ $produto->email }}
                                <small>{{ $produto->telefone }}</small>
                            </td>
                            <td style="color: var(--mid); font-size: 0.82rem;">{{ Str::limit($produto->endereco, 30) }}</td>
                            <td class="obs-text">{{ $produto->observacoes }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <span>🏷️</span>
                                    <p>Nenhum produto cadastrado.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>