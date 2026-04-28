<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Calm Mind Resort & Spa') - Seu Refúgio de Tranquilidade</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Lato:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    @vite('resources/css/app.css')
    
    <style>
        :root {
            --primary: #2d7a8a;
            --primary-light: #4a9fb5;
            --secondary: #3d2817;
            --secondary-dark: #2a1810;
            --accent: #c4a47a;
            --bg-light: #f5f1e8;
            --bg-white: #fefbf7;
            --text-dark: #2a2a2a;
            --text-light: #6b6b6b;
        }

        body {
            font-family: 'Lato', sans-serif;
            color: var(--text-dark);
            background-color: var(--bg-white);
            line-height: 1.6;
        }

        .font-display {
            font-family: 'Playfair Display', serif;
            letter-spacing: 0.02em;
        }

        /* Animações elegantes */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out;
        }

        .animate-fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        /* Efeito hover elegante */
        .transition-elegant {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Botões com estilo */
        .btn-primary {
            background-color: var(--secondary);
            color: white;
            padding: 0.875rem 2rem;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            transition-elegant;
        }

        .btn-primary:hover {
            background-color: var(--secondary-dark);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(61, 40, 23, 0.15);
        }

        .btn-secondary {
            background-color: transparent;
            border: 1.5px solid var(--secondary);
            color: var(--secondary);
            padding: 0.75rem 1.75rem;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            transition-elegant;
        }

        .btn-secondary:hover {
            background-color: var(--secondary);
            color: white;
        }

        /* Cards com sombra sutil */
        .card-elegant {
            background-color: var(--bg-white);
            border-radius: 12px;
            overflow: hidden;
            transition-elegant;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .card-elegant:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
        }

        /* Linha elegante */
        .line-accent {
            height: 2px;
            background: linear-gradient(90deg, var(--accent) 0%, var(--accent) 100%);
            width: 60px;
        }
    </style>
</head>
<body class="bg-white">
    <!-- Navigation -->
    <nav class="fixed w-full top-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center group">
                    <div class="font-display text-2xl text-secondary-dark font-bold tracking-wide">
                        Calm<span class="text-accent">Mind</span>
                    </div>
                </a>

                <!-- Menu Central -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-text-dark hover:text-primary transition-elegant">
                        Início
                    </a>
                    <a href="{{ route('about') }}" class="text-sm font-medium text-text-dark hover:text-primary transition-elegant">
                        Sobre
                    </a>
                    <a href="{{ route('rooms') }}" class="text-sm font-medium text-text-dark hover:text-primary transition-elegant">
                        Quartos
                    </a>
                    <a href="{{ route('contact') }}" class="text-sm font-medium text-text-dark hover:text-primary transition-elegant">
                        Contato
                    </a>
                </div>

                <!-- Login/Menu -->
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-sm font-medium text-text-dark hover:text-primary">
                            Dashboard
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="btn-primary">Sair</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn-secondary">
                            Login
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button class="md:hidden p-2 rounded-lg hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-secondary-dark text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <!-- Sobre -->
                <div>
                    <h3 class="font-display text-xl mb-4">Calm<span class="text-accent">Mind</span></h3>
                    <p class="text-gray-300 text-sm leading-relaxed">
                        Seu refúgio de tranquilidade e bem-estar. Uma experiência única de conforto e luxo em harmonia com a natureza.
                    </p>
                </div>

                <!-- Links Rápidos -->
                <div>
                    <h4 class="font-semibold mb-4 text-accent">Navegação</h4>
                    <ul class="space-y-2 text-sm text-gray-300">
                        <li><a href="{{ route('home') }}" class="hover:text-accent transition-elegant">Início</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-accent transition-elegant">Sobre</a></li>
                        <li><a href="{{ route('rooms') }}" class="hover:text-accent transition-elegant">Quartos</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-accent transition-elegant">Contato</a></li>
                    </ul>
                </div>

                <!-- Contato -->
                <div>
                    <h4 class="font-semibold mb-4 text-accent">Contato</h4>
                    <ul class="space-y-2 text-sm text-gray-300">
                        <li>📞 +55 (11) 9999-9999</li>
                        <li>✉️ contato@calmmind.com</li>
                        <li>📍 São Paulo, SP - Brasil</li>
                    </ul>
                </div>

                <!-- Redes Sociais -->
                <div>
                    <h4 class="font-semibold mb-4 text-accent">Siga-nos</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-accent/20 flex items-center justify-center hover:bg-accent/40 transition-elegant">
                            📘
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-accent/20 flex items-center justify-center hover:bg-accent/40 transition-elegant">
                            📷
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-accent/20 flex items-center justify-center hover:bg-accent/40 transition-elegant">
                            🐦
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-700 pt-8 text-center text-gray-400 text-sm">
                <p>&copy; 2024 Calm Mind Resort & Spa. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    @vite('resources/js/app.js')
</body>
</html>
