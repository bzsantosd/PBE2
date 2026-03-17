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

        .btn-new-order {
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

        .btn-new-order:hover {
            background: var(--accent);
            transform: translateY(-2px);
            color: white;
        }

        .table-wrap {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.02);
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

        .num-pedido {
            font-family: 'DM Mono', monospace;
            font-size: 0.8rem;
            background: #f4f1ee;
            color: var(--ink);
            padding: 4px 10px;
            border-radius: 6px;
            font-weight: 600;
            border: 1px solid var(--border);
        }

        .price-col {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            color: var(--ink);
        }

        /* Status badges dinâmicos */
        .status-badge {
            display: inline-block;
            font-size: 0.65rem;
            font-weight: 800;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 20px;
        }

        .status-pendente { background: #fffbeb; color: #b45309; }
        .status-producao { background: #eff6ff; color: #1d4ed8; }
        .status-retirada { background: #f5f3ff; color: #6d28d9; }
        .status-finalizado { background: #ecfdf5; color: #047857; }
        .status-default { background: #f3f4f6; color: #374151; }

        .action-btns { display: flex; gap: 15px; justify-content: flex-end; }
        .btn-edit { color: var(--blue); font-weight: 700; font-size: 0.75rem; text-transform: uppercase; text-decoration: none; }
        .btn-delete { color: var(--danger); font-weight: 700; font-size: 0.75rem; text-transform: uppercase; background: none; border: none; cursor: pointer; padding: 0; }
        .btn-edit:hover, .btn-delete:hover { text-decoration: underline; }

        .empty-state {
            text-align: center;
            padding: 4rem 1rem;
            color: var(--mid);
        }
    </style>

    <div class="py-10 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">

        {{-- Alerta de Sucesso --}}
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-800 rounded shadow-sm">
                <span class="font-medium">✓ {{ session('success') }}</span>
            </div>
        @endif

        <div class="page-header">
            <div>
                <div class="page-subtitle">Produção</div>
                <div class="page-title">Lista de Pedidos de Confecção</div>
            </div>
            <a href="{{ route('pedidos.create') }}" class="btn-new-order">
                + Gerar Pedido
            </a>
        </div>

        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nº Pedido</th>
                        <th>Cliente</th>
                        <th>Entrega Prevista</th>
                        <th>Valor Total</th>
                        <th>Status</th>
                        <th style="text-align: right;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pedidos as $pedido)
                        <tr>
                            <td><span class="num-pedido">#{{ $pedido->numero_pedido }}</span></td>
                            <td style="font-weight:600; color: var(--ink);">
                                {{ $pedido->cliente->nome ?? 'Cliente não vinculado' }}
                            </td>
                            <td style="color: var(--mid);">
                                {{ \Carbon\Carbon::parse($pedido->data_entrega_prevista)->format('d/m/Y') }}
                            </td>
                            <td class="price-col">
                                R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}
                            </td>
                            <td>
                                @php
                                    $statusClass = match($pedido->status) {
                                        'Pendente' => 'status-pendente',
                                        'Em Produção' => 'status-producao',
                                        'Aguardando Retirada' => 'status-retirada',
                                        'Finalizado' => 'status-finalizado',
                                        default => 'status-default',
                                    };
                                @endphp
                                <span class="status-badge {{ $statusClass }}">
                                    {{ $pedido->status }}
                                </span>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <a href="{{ route('pedidos.edit', $pedido->id) }}" class="btn-edit">Editar</a>
                                    
                                    {{-- Botão configurado para o Modal Genérico --}}
                                    <button type="button" 
                                            class="btn-delete" 
                                            onclick="openDeleteModal('{{ route('pedidos.destroy', $pedido->id) }}', 'Pedido #{{ $pedido->numero_pedido }}')">
                                        Excluir
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <span style="font-size: 2.5rem; display: block; margin-bottom: 1rem; opacity: 0.5;">📋</span>
                                    <p class="font-bold">Nenhum pedido encontrado.</p>
                                    <p class="text-xs">Inicie uma nova produção clicando em "Gerar Pedido".</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Componente Modal --}}
    <x-modal-delete />
</x-app-layout>