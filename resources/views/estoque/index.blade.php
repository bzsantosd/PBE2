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
            --success: #2a7d4f;
            --success-bg: #e8f5ee;
            --danger: #c0392b;
            --danger-bg: #fdecea;
            --blue: #2563eb;
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

        /* Botão de Adicionar */
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

        .material-name {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 0.95rem;
            color: var(--ink);
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.65rem;
            font-weight: 800;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .badge-ok { background: var(--success-bg); color: var(--success); }
        .badge-urgent { 
            background: var(--danger-bg); 
            color: var(--danger);
            animation: pulse-badge 1.5s ease-in-out infinite;
        }

        @keyframes pulse-badge {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.8; }
        }

        .price-tag {
            font-family: 'DM Mono', monospace;
            font-size: 0.85rem;
            color: var(--ink);
            font-weight: 600;
        }

        .qty-value {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
        }

        /* Botões de Ação */
        .action-cell { display: flex; gap: 12px; align-items: center; }
        .btn-edit { color: var(--blue); font-weight: 700; text-decoration: none; font-size: 0.8rem; text-transform: uppercase; }
        .btn-edit:hover { text-decoration: underline; }
        .btn-delete { color: var(--danger); font-weight: 700; background: none; border: none; cursor: pointer; font-size: 0.8rem; text-transform: uppercase; padding: 0; }
        .btn-delete:hover { text-decoration: underline; }

        .empty-state {
            text-align: center;
            padding: 5rem 1rem;
            color: var(--mid);
        }
        .empty-state span { display: block; font-size: 3rem; margin-bottom: 1rem; filter: grayscale(1); }
    </style>

    <div class="py-10 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        
        {{-- Alertas de Feedback --}}
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-800 rounded shadow-sm flex items-center">
                <span class="mr-2">✓</span> {{ session('success') }}
            </div>
        @endif

        <div class="page-header">
            <div>
                <div class="page-subtitle">Armazém</div>
                <div class="page-title">Controle de Materiais</div>
            </div>
            <a href="{{ route('estoque.create') }}" class="btn-add">
                <span>+</span> ADICIONAR MATERIAL
            </a>
        </div>

        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Material</th>
                        <th>Categoria / Fornecedor</th>
                        <th>Qtd. Atual</th>
                        <th>Preço Custo</th>
                        <th>Status</th>
                        <th style="text-align: right;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($estoques as $item)
                        <tr>
                            <td>
                                <div class="material-name">{{ $item->descricao }}</div>
                                <div style="font-size: 0.7rem; color: var(--mid);">ID: #{{ $item->id }}</div>
                            </td>
                            <td>
                                <div style="color: var(--ink); font-weight: 500;">{{ $item->categoria }}</div>
                                <div style="font-size: 0.75rem; color: var(--mid);">Fornecedor ID: {{ $item->fornecedor_id }}</div>
                            </td>
                            <td>
                                <span class="qty-value">{{ $item->quantidade_atual }}</span>
                                <span style="font-size: 0.7rem; color: var(--mid); margin-left: 2px;">{{ $item->unidade_medida }}</span>
                            </td>
                            <td class="price-tag">R$ {{ number_format($item->preco_custo_unitario, 2, ',', '.') }}</td>
                            <td>
                                @if($item->quantidade_atual <= $item->quantidade_minima)
                                    <span class="badge badge-urgent">⚠ Repor</span>
                                @else
                                    <span class="badge badge-ok">✓ OK</span>
                                @endif
                            </td>
                            <td style="text-align: right;">
                                <div class="action-cell" style="justify-content: flex-end;">
                                    <a href="{{ route('estoque.edit', $item->id) }}" class="btn-edit">Editar</a>
                                    
                                    <form action="{{ route('estoque.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Excluir este item permanentemente?')">
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
                                    <span>📦</span>
                                    <p class="font-bold">Nenhum material em estoque.</p>
                                    <p class="text-sm">Comece adicionando seu primeiro item de matéria-prima.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>