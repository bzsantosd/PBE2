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
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .page-title {
            font-family: 'Syne', sans-serif;
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--ink);
        }

        .page-subtitle {
            font-size: 0.82rem;
            color: var(--mid);
            letter-spacing: 0.04em;
            text-transform: uppercase;
            font-weight: 500;
        }

        .table-wrap {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            width: 100%; /* Garante que a tabela seja larga */
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .data-table thead tr {
            background: var(--ink);
        }

        .data-table thead th {
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.7);
            padding: 1.25rem;
        }

        .data-table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.12s ease;
        }

        .data-table tbody tr:hover { background: #fdf6f3; }

        .data-table tbody td {
            padding: 1.25rem;
            font-size: 0.875rem;
            color: var(--ink);
            vertical-align: middle;
        }

        .td-name {
            font-weight: 600;
            font-family: 'Syne', sans-serif;
            font-size: 1rem;
        }

        .td-mono {
            font-family: 'DM Mono', monospace;
            font-size: 0.8rem;
            color: var(--mid);
            background: var(--cream);
            padding: 4px 10px;
            border-radius: 6px;
        }

        /* Estilo dos Botões */
        .btn-add {
            background: var(--accent);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: opacity 0.2s;
        }
        
        .btn-add:hover { opacity: 0.9; color: white; }

        .action-buttons {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .btn-edit { color: #2563eb; font-weight: 700; text-decoration: none; }
        .btn-delete { color: #dc2626; font-weight: 700; background: none; border: none; cursor: pointer; padding: 0; }

        .empty-state {
            text-align: center;
            padding: 4rem;
            color: var(--mid);
        }
    </style>

    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">

        {{-- Mensagem de Sucesso --}}
        @if (session('success') || session('sucess')) {{-- Tratando o erro de digitação 'sucess' --}}
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-800 rounded shadow-sm">
                {{ session('success') ?? session('sucess') }}
            </div>
        @endif

        <div class="page-header">
            <div>
                <div class="page-subtitle">Gestão</div>
                <div class="page-title">Clientes Registrados</div>
            </div>
            <a href="{{ route('clientes.create') }}" class="btn-add">
                + Novo Cliente
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
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($clientes as $cliente)
                        <tr>
                            <td class="td-name">{{ $cliente->nome }}</td>
                            <td><span class="td-mono">{{ $cliente->cpf }}</span></td>
                            <td>{{ $cliente->email }}</td>
                            <td>{{ $cliente->telefone }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn-edit">
                                        Editar
                                    </a>

                                    {{-- Formulário de Exclusão --}}
                                    <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este cliente?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <span style="font-size: 3rem;">👤</span>
                                    <p class="mt-2">Nenhum cliente encontrado na base de dados.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>