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

        .num-pedido {
            font-family: 'DM Mono', 'Courier New', monospace;
            font-size: 0.8rem;
            background: var(--ink);
            color: white;
            padding: 3px 8px;
            border-radius: 5px;
            display: inline-block;
        }

        .price-col {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 0.95rem;
        }

        /* Status badges */
        .status-badge {
            display: inline-block;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 20px;
        }

        .status-pendente {
            background: #fef3cd;
            color: #856404;
        }

        .status-em-producao {
            background: #cfe2ff;
            color: #084298;
        }

        .status-concluido {
            background: #d1e7dd;
            color: #0a3622;
        }

        .status-cancelado {
            background: #f8d7da;
            color: #842029;
        }

        .status-default {
            background: var(--cream);
            color: var(--mid);
            border: 1px solid var(--border);
        }

        .obs-text {
            font-size: 0.8rem;
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

        <div class="page-subtitle">Produção</div>
        <div class="page-title">Lista de Pedidos de Confecção</div>

        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nº Pedido</th>
                        <th>Cliente</th>
                        <th>Entrega Prevista</th>
                        <th>Valor Total</th>
                        <th>Status</th>
                        <th>Observações</th>
                    </tr>
                </thead>
                <tbody>
                    @if($pedidos->isNotEmpty())
                        @foreach($pedidos as $pedido)
                            <tr>
                                <td><span class="num-pedido">#{{ $pedido->numero_pedido }}</span></td>
                                <td style="font-weight:600;">{{ $pedido->cliente->nome ?? 'Cliente não vinculado' }}</td>
                                <td>{{ \Carbon\Carbon::parse($pedido->data_entrega_prevista)->format('d/m/Y') }}</td>
                                <td class="price-col">R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</td>
                                <td>
                                    @php
                                        $statusMap = [
                                            'pendente'     => 'status-pendente',
                                            'em_producao'  => 'status-em-producao',
                                            'concluido'    => 'status-concluido',
                                            'cancelado'    => 'status-cancelado',
                                        ];
                                        $cls = $statusMap[$pedido->status] ?? 'status-default';
                                    @endphp
                                    <span class="status-badge {{ $cls }}">{{ ucfirst(str_replace('_', ' ', $pedido->status)) }}</span>
                                </td>
                                <td class="obs-text">{{ Str::limit($pedido->observacoes, 40) }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <span>📋</span>
                                    <p>Nenhum pedido encontrado.</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>