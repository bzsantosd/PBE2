<nav x-data="{ open: false }" style="background: #0f0f0f; border-bottom: 1px solid #1e1e1e; font-family: 'DM Sans', sans-serif;">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@300;400;500&display=swap');

        .nav-root {
            background: #0f0f0f;
        }

        .nav-logo-text {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.1rem;
            color: #ffffff;
            letter-spacing: -0.01em;
        }

        .nav-logo-dot {
            display: inline-block;
            width: 7px;
            height: 7px;
            background: #d4562a;
            border-radius: 50%;
            margin-left: 3px;
            vertical-align: middle;
            margin-bottom: 3px;
        }

        .nav-link {
            display: inline-flex;
            align-items: center;
            padding: 0 4px;
            height: 100%;
            font-size: 0.82rem;
            font-weight: 500;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.45);
            border-bottom: 2px solid transparent;
            text-decoration: none;
            transition: color 0.15s ease, border-color 0.15s ease;
        }

        .nav-link:hover {
            color: rgba(255,255,255,0.85);
            border-bottom-color: rgba(255,255,255,0.2);
        }

        .nav-link.active {
            color: #ffffff;
            border-bottom-color: #d4562a;
        }

        .nav-user-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            background: #1a1a1a;
            border: 1px solid #2e2e2e;
            border-radius: 8px;
            color: rgba(255,255,255,0.65);
            font-size: 0.82rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.15s ease;
            font-family: 'DM Sans', sans-serif;
        }

        .nav-user-btn:hover {
            background: #242424;
            border-color: #3e3e3e;
            color: #fff;
        }

        .nav-avatar {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: #d4562a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.68rem;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
            font-family: 'Syne', sans-serif;
        }

        /* Dropdown */
        .nav-dropdown {
            position: absolute;
            right: 0;
            top: calc(100% + 8px);
            background: #161616;
            border: 1px solid #2e2e2e;
            border-radius: 10px;
            min-width: 180px;
            overflow: hidden;
            z-index: 50;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        .nav-dropdown a,
        .nav-dropdown button {
            display: block;
            width: 100%;
            text-align: left;
            padding: 10px 16px;
            font-size: 0.83rem;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            background: none;
            border: none;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            transition: background 0.12s, color 0.12s;
        }

        .nav-dropdown a:hover,
        .nav-dropdown button:hover {
            background: #222;
            color: #fff;
        }

        .nav-dropdown-divider {
            border: none;
            border-top: 1px solid #2e2e2e;
            margin: 0;
        }

        /* Hamburger button */
        .nav-hamburger {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 8px;
            border-radius: 8px;
            background: transparent;
            border: 1px solid #2e2e2e;
            color: rgba(255,255,255,0.5);
            cursor: pointer;
            transition: all 0.15s;
        }

        .nav-hamburger:hover {
            background: #1a1a1a;
            color: #fff;
        }

        /* Mobile menu */
        .mobile-menu {
            border-top: 1px solid #1e1e1e;
        }

        .mobile-nav-link {
            display: block;
            padding: 12px 20px;
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.5);
            text-decoration: none;
            border-left: 3px solid transparent;
            transition: all 0.15s;
        }

        .mobile-nav-link:hover {
            color: #fff;
            background: #1a1a1a;
            border-left-color: rgba(212,86,42,0.5);
        }

        .mobile-nav-link.active {
            color: #fff;
            border-left-color: #d4562a;
            background: #1a1a1a;
        }

        .mobile-user-section {
            border-top: 1px solid #1e1e1e;
            padding: 16px 20px;
        }

        .mobile-user-name {
            font-family: 'Syne', sans-serif;
            font-size: 0.9rem;
            font-weight: 700;
            color: #fff;
        }

        .mobile-user-email {
            font-size: 0.78rem;
            color: rgba(255,255,255,0.4);
            margin-top: 2px;
        }
    </style>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center" style="height: 60px;">

            {{-- Logo + Links --}}
            <div class="flex items-center gap-10">
                <a href="{{ route('dashboard') }}" style="text-decoration:none;">
                    <span class="nav-logo-text">Studio Confecção<span class="nav-logo-dot"></span></span>
                </a>

                <div class="hidden sm:flex items-center gap-6" style="height: 60px;">
                    <a href="{{ route('dashboard') }}"
                       class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a>
                    {{-- Adicione mais links de nav aqui --}}
                    <a href="{{ route('clientes.index') }}"
                       class="nav-link {{ request()->routeIs('clientes.*') ? 'active' : '' }}">
                        Clientes
                        <a href="{{ route('estoque.index') }}"
                       class="nav-link {{ request()->routeIs('estoque.*') ? 'active' : '' }}">
                        Estoque
                        <a href="{{ route('produtos.index') }}"
                       class="nav-link {{ request()->routeIs('produtos.*') ? 'active' : '' }}">
                        Produtos
                        <a href="{{ route('fornecedores.index') }}"
                       class="nav-link {{ request()->routeIs('fornecedores.*') ? 'active' : '' }}">
                        Fornecedores
                        <a href="{{ route('pedido.index') }}"
                       class="nav-link {{ request()->routeIs('pedido.*') ? 'active' : '' }}">
                        Pedidos
                    </a>
                </div>
            </div>

            {{-- User Dropdown --}}
            <div class="hidden sm:flex sm:items-center" style="position: relative;" x-data="{ dropOpen: false }">
                <button @click="dropOpen = !dropOpen" @click.outside="dropOpen = false" class="nav-user-btn">
                    <span class="nav-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </span>
                    {{ Auth::user()->name }}
                    <svg style="width:14px;height:14px;opacity:0.5;transition:transform 0.2s" :style="dropOpen ? 'transform:rotate(180deg)' : ''" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>

                <div x-show="dropOpen" x-transition class="nav-dropdown">
                    <a href="{{ route('profile.edit') }}">Perfil</a>
                    <hr class="nav-dropdown-divider">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button onclick="event.preventDefault(); this.closest('form').submit();">
                            Sair
                        </button>
                    </form>
                </div>
            </div>

            {{-- Hamburger --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open" class="nav-hamburger">
                    <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    {{-- Mobile Menu --}}
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden mobile-menu">
        <div class="py-2">
            <a href="{{ route('dashboard') }}"
               class="mobile-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Dashboard
            </a>
        </div>

        <div class="mobile-user-section">
            <div class="mobile-user-name">{{ Auth::user()->name }}</div>
            <div class="mobile-user-email">{{ Auth::user()->email }}</div>

            <div style="margin-top: 12px; display: flex; flex-direction: column; gap: 4px;">
                <a href="{{ route('profile.edit') }}" class="mobile-nav-link" style="padding: 10px 0; border-left: none; text-transform: none; letter-spacing: 0;">
                    Perfil
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button onclick="event.preventDefault(); this.closest('form').submit();"
                        class="mobile-nav-link" style="padding: 10px 0; border-left: none; text-transform: none; letter-spacing: 0; width: 100%; text-align: left; background: none; border-top: none; border-right: none; border-bottom: none; cursor: pointer; color: #d4562a;">
                        Sair
                    </button>
                </form>
            </div>
        </div>
    </div>

</nav>