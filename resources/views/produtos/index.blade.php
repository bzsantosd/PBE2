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
            --blue: #2563eb;
            --danger: #dc2626;
        }

        body { font-family: 'DM Sans', sans-serif; background: var(--cream); }

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

        /* Botão Novo Registro */
        .btn-add {
            background: var(--ink);
            color: white;
            padding: 0.75rem 1.25rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .btn-add:hover { background: var(--accent); transform: translateY(-2px); color: white; }

        .table-wrap {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
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

        .prod-name {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            color: var(--ink);
            font-size: 0.95rem;
        }

        .cnpj-mono {
            font-family: 'DM Mono', monospace;
            font-size: 0.78rem;
            color: var(--mid);
            background: #f4f1ee;
            padding: 2px 6px;
            border-radius: 4px;
        }

        .tipo-badge {
            display: inline-block;
            background: var(--purple-bg);
            color: var(--purple);
            font-size: 0.65rem;
            font-weight: 800;
            padding: 3px 10px;
            border-radius: 20px;
            text-transform: uppercase;
        }

        .contact-block { line-height: 1.2; }
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
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Botões de Ação */
        .action-cell { display: flex; gap: 12px; justify-content: flex-end; }
        .btn-edit { color: var(--blue); font-weight: 700; text-decoration: none; font-size: 0.8rem; text-transform: uppercase; }
        .btn-edit:hover { text-decoration: underline; }
        .btn-delete { color: var(--danger); font-weight: 700; background: none; border: none; cursor: pointer; font-size: 0.8rem; text-transform: uppercase; padding: 0; }
        .btn-delete:hover { text-decoration: underline; }

        .empty-state {
            text-align: center;
            padding: 4rem 1rem;
            color: var(--mid);
        }
        .empty-state span { display: block; font-size: 2.5rem; margin-bottom: 0.75rem; opacity: 0.5; }
    </style>

    <div class="py-10 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">

        {{-- Alertas de Feedback --}}
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-800 rounded shadow-sm flex items-center font-medium">
                <span class="mr-2">✓</span> {{ session('success') }}
            </div>
        @endif

        <div class="page-header">
            <div>
                <div class="page-subtitle">Cadastro</div>
                <div class="page-title">Catálogo de Produtos / Fornecedores</div>
            </div>
            <a href="{{ route('produtos.create') }}" class="btn-add">
                + Novo Registro
            </a>
        </div>

        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nome / Empresa</th>
                        <th>Identificação (CNPJ)</th>
                        <th>Tipo</th>
                        <th>Contato</th>
                        <th>Endereço</th>
                        <th>Observações</th>
                        <th style="text-align: right;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produtos as $produto)
                        <tr>
                            <td>
                                <div class="prod-name">{{ $produto->nome_fantasia }}</div>
                                <div style="font-size: 0.7rem; color: var(--mid);">{{ $produto->razao_social }}</div>
                            </td>
                            <td><span class="cnpj-mono">{{ $produto->cnpj }}</span></td>
                            <td><span class="tipo-badge">{{ $produto->tipo_produto }}</span></td>
                            <td class="contact-block">
                                <span class="font-medium">{{ $produto->email }}</span>
                                <small>{{ $produto->telefone }}</small>
                            </td>
                            <td style="color: var(--mid); font-size: 0.82rem;">
                                {{ Str::limit($produto->endereco, 25) }}
                            </td>
                            <td class="obs-text" title="{{ $produto->observacoes }}">
                                {{ $produto->observacoes ?? '-' }}
                            </td>
                            <td>
                                <div class="action-cell">
                                    <a href="{{ route('produtos.edit', $produto->id) }}" class="btn-edit">Editar</a>
                                    
                                    <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" onsubmit="return confirm('Deseja realmente excluir este registro?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <span>🏷️</span>
                                    <p class="font-bold text-lg">Nenhum registro encontrado.</p>
                                    <p class="text-sm">Clique em "Novo Registro" para começar o catálogo.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>