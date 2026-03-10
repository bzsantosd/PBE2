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

        .page-header {
            display: flex;
            align-items: flex-end;
            gap: 1rem;
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

        .table-wrap {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table thead tr {
            background: var(--ink);
        }

        .data-table thead th {
            font-family: 'DM Sans', sans-serif;
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.55);
            padding: 1rem 1.25rem;
            text-align: left;
        }

        .data-table thead th:first-child { border-radius: 0; }

        .data-table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.12s ease;
        }

        .data-table tbody tr:last-child { border-bottom: none; }

        .data-table tbody tr:hover { background: #fdf6f3; }

        .data-table tbody td {
            padding: 1rem 1.25rem;
            font-size: 0.875rem;
            color: var(--ink);
            vertical-align: middle;
        }

        .td-name {
            font-weight: 600;
            font-family: 'Syne', sans-serif;
            font-size: 0.9rem;
        }

        .td-mono {
            font-family: 'DM Mono', 'Courier New', monospace;
            font-size: 0.8rem;
            color: var(--mid);
            background: var(--cream);
            padding: 3px 8px;
            border-radius: 5px;
            display: inline-block;
        }

        .empty-state {
            text-align: center;
            padding: 3.5rem 1rem;
            color: var(--mid);
        }

        .empty-state span {
            display: block;
            font-size: 2rem;
            margin-bottom: 0.75rem;
        }

        .empty-state p {
            font-size: 0.9rem;
        }
    </style>

    <div class="py-10 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">

        @if (session('sucess'))
        <div class="mb-6 p-4 bg-green-100 border-1-4 border-green-500 text-green-700 shadow-sm rounded-r">
            {{ session('sucess') }}
</div>
@endif

<div class="bg-white overflow-hidden shadow-sm sm:roundded-lg p-6">
    <div class=" grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="page-header">
            <div>
                <div class="page-subtitle">Cadastro</div>
                <div class="page-title">Clientes Registrados</div>

            </div>
            <a href="{{ route('clientes.create') }}" >
        </a>
        </div>

        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>Endereço</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($clientes)): ?>
                        <?php foreach ($clientes as $cliente): ?>
                            <tr>
                                <td class="td-name"><?= htmlspecialchars($cliente->nome) ?></td>
                                <td><span class="td-mono"><?= htmlspecialchars($cliente->cpf) ?></span></td>
                                <td><?= htmlspecialchars($cliente->email) ?></td>
                                <td><?= htmlspecialchars($cliente->telefone) ?></td>
                                <td style="color: var(--mid);"><?= htmlspecialchars($cliente->endereco) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <span>👤</span>
                                    <p>Nenhum cliente encontrado.</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>