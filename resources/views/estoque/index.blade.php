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

        .material-name {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 0.9rem;
        }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .badge-ok {
            background: var(--success-bg);
            color: var(--success);
        }

        .badge-urgent {
            background: var(--danger-bg);
            color: var(--danger);
            animation: pulse-badge 1.5s ease-in-out infinite;
        }

        @keyframes pulse-badge {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.65; }
        }

        .price-tag {
            font-family: 'DM Mono', 'Courier New', monospace;
            font-size: 0.82rem;
            color: var(--ink);
            font-weight: 500;
        }

        .um-tag {
            font-size: 0.75rem;
            color: var(--mid);
            background: var(--cream);
            padding: 2px 7px;
            border-radius: 4px;
            border: 1px solid var(--border);
        }

        .qty-value {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 1rem;
        }

        .empty-state {
            text-align: center;
            padding: 3.5rem 1rem;
            color: var(--mid);
        }
        .empty-state span { display: block; font-size: 2rem; margin-bottom: 0.75rem; }
    </style>

    <div class="py-10 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">

        <div class="page-subtitle">Armazém</div>
        <div class="page-title">Controle de Materiais (Estoque)</div>

        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Material</th>
                        <th>Categoria</th>
                        <th>Fornecedor</th>
                        <th>Qtd. Atual</th>
                        <th>U.M.</th>
                        <th>Preço Custo</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($estoques as $item)
                        <tr>
                            <td class="material-name">{{ $item->descricao }}</td>
                            <td style="color: var(--mid);">{{ $item->categoria }}</td>
                            <td class="qty-value">{{ $item->quantidade_atual }}</td>
                            <td><span class="um-tag">{{ $item->unidade_medida }}</span></td>
                            <td class="price-tag">R$ {{ number_format($item->preco_custo_unitario, 2, ',', '.') }}</td>
                            <td>
                                @if($item->quantidade_atual <= $item->quantidade_minima)
                                    <span class="badge badge-urgent">⚠ Repor</span>
                                @else
                                    <span class="badge badge-ok">✓ OK</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <span>📦</span>
                                    <p>Nenhum material em estoque.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>