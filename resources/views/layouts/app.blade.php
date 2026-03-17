<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <x-modal-delete />

        <script>
            document.addEventListener('input', function (e) {
                const target = e.target;
                
                // Máscara de CPF
                if (target.id === 'cpf' || target.name === 'cpf') {
                    let v = target.value.replace(/\D/g, '');
                    v = v.replace(/(\d{3})(\d)/, '$1.$2');
                    v = v.replace(/(\d{3})(\d)/, '$1.$2');
                    v = v.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                    target.value = v.substring(0, 14);
                }

                // Máscara de CNPJ
                if (target.id === 'cnpj' || target.name === 'cnpj') {
                    let v = target.value.replace(/\D/g, '');
                    v = v.replace(/^(\d{2})(\d)/, '$1.$2');
                    v = v.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
                    v = v.replace(/\.(\d{3})(\d)/, '.$1/$2');
                    v = v.replace(/(\d{4})(\d)/, '$1-$2');
                    target.value = v.substring(0, 18);
                }

                // Máscara de Telefone (Celular e Fixo)
                if (target.id === 'telefone' || target.name === 'telefone') {
                    let v = target.value.replace(/\D/g, '');
                    v = v.replace(/^(\d{2})(\d)/g, "($1) $2");
                    if (v.length > 13) {
                        v = v.replace(/(\d{5})(\d)/, "$1-$2"); // Celular
                    } else {
                        v = v.replace(/(\d{4})(\d)/, "$1-$2"); // Fixo
                    }
                    target.value = v.substring(0, 15);
                }
            });
        </script>
    </body>

</html>
