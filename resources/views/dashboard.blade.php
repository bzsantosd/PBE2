<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

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
            --warning: #c97b1a;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--cream);
            color: var(--ink);
        }

        .dash-header {
            font-family: 'Syne', sans-serif;
        }

        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.25rem;
        }

        .kpi-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .kpi-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.07);
        }

        .kpi-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: var(--accent);
        }

        .kpi-label {
            font-family: 'DM Sans', sans-serif;
            font-size: 0.72rem;
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--mid);
            margin-bottom: 0.75rem;
        }

        .kpi-value {
            font-family: 'Syne', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--ink);
            line-height: 1;
        }

        .kpi-icon {
            position: absolute;
            top: 1.25rem;
            right: 1.25rem;
            width: 38px;
            height: 38px;
            background: var(--accent-muted);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .section-title {
            font-family: 'Syne', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--border);
        }

        .dash-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.75rem;
        }

        .status-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 6px;
        }

        .status-ok { background: var(--success); }
        .status-alert { background: var(--accent); }
        .status-warn { background: var(--warning); }

        .welcome-banner {
            background: var(--ink);
            color: white;
            border-radius: 20px;
            padding: 2rem 2.5rem;
            position: relative;
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .welcome-banner::after {
            content: '';
            position: absolute;
            right: -40px;
            top: -40px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: var(--accent);
            opacity: 0.15;
        }

        .welcome-banner h1 {
            font-family: 'Syne', sans-serif;
            font-size: 1.6rem;
            font-weight: 800;
            margin-bottom: 0.25rem;
        }

        .welcome-banner p {
            font-size: 0.88rem;
            opacity: 0.6;
        }

        .nav-shortcut {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.85rem 1rem;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: var(--cream);
            text-decoration: none;
            color: var(--ink);
            font-size: 0.88rem;
            font-weight: 500;
            transition: all 0.15s ease;
        }

        .nav-shortcut:hover {
            background: var(--accent);
            color: white;
            border-color: var(--accent);
        }

        .nav-shortcut:hover .shortcut-icon {
            background: rgba(255,255,255,0.2);
        }

        .shortcut-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: var(--accent-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
            transition: background 0.15s ease;
        }
    </style>

    <div class="py-10 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">

        {{-- Welcome Banner --}}
        <div class="welcome-banner">
            <h1>Bem-vindo ao Sistema de Confecção</h1>
            <p>Gerencie clientes, pedidos, estoque e fornecedores em um só lugar.</p>
        </div>

        {{-- KPI Cards --}}
        <div class="kpi-grid mb-8">
            <div class="kpi-card">
                <div class="kpi-icon">👥</div>
                <div class="kpi-label">Clientes</div>
                <div class="kpi-value">—</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-icon">📦</div>
                <div class="kpi-label">Pedidos Ativos</div>
                <div class="kpi-value">—</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-icon">🏷️</div>
                <div class="kpi-label">Itens em Estoque</div>
                <div class="kpi-value">—</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-icon">🤝</div>
                <div class="kpi-label">Fornecedores</div>
                <div class="kpi-value">—</div>
            </div>
        </div>

        {{-- Acesso Rápido --}}
        <div class="dash-card mb-8">
            <div class="section-title">Acesso Rápido</div>
            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(180px,1fr)); gap: 0.75rem;">
                <a href="#" class="nav-shortcut"><span class="shortcut-icon">👤</span> Clientes</a>
                <a href="#" class="nav-shortcut"><span class="shortcut-icon">📋</span> Pedidos</a>
                <a href="#" class="nav-shortcut"><span class="shortcut-icon">📦</span> Estoque</a>
                <a href="#" class="nav-shortcut"><span class="shortcut-icon">🏭</span> Fornecedores</a>
                <a href="#" class="nav-shortcut"><span class="shortcut-icon">📊</span> Relatórios</a>
            </div>
        </div>

        {{-- Status do Sistema --}}
        <div class="dash-card">
            <div class="section-title">Status do Sistema</div>
            <p style="font-size:0.88rem; color:var(--mid);">
                <span class="status-dot status-ok"></span> Sistema operando normalmente
                &nbsp;&nbsp;
                <span class="status-dot status-alert"></span> Itens com estoque baixo — verifique o módulo de estoque
            </p>
        </div>

    </div>
</x-app-layout>