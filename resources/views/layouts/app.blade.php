<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Calm Mind') — Resort & Spa</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --ink:        #0a0806;
            --ink-2:      #110e0a;
            --ink-3:      #1c1610;
            --ink-4:      #261f16;
            --gold:       #c9a84c;
            --gold-light: #e2c47a;
            --gold-dim:   #7a6530;
            --teal:       #2e7d8a;
            --cream:      #f0e8d5;
            --cream-dim:  #c8b89a;
            --muted:      #5c5040;
            --muted-2:    #8a7560;
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--ink);
            color: var(--cream);
            line-height: 1.7;
            -webkit-font-smoothing: antialiased;
        }

        /* Textura de grain sutil */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.035'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 9999;
        }

        .font-display { font-family: 'Cormorant Garamond', serif; }

        /* Linha ouro */
        .line-gold {
            display: block;
            width: 48px;
            height: 1px;
            background: var(--gold);
            margin-bottom: 1.5rem;
        }

        /* Botões */
        .btn-gold {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.85rem 2.25rem;
            background: var(--gold);
            color: var(--ink);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            border-radius: 2px;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            cursor: pointer;
        }
        .btn-gold:hover {
            background: var(--gold-light);
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(201, 168, 76, 0.25);
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.85rem 2.25rem;
            background: transparent;
            color: var(--cream);
            border: 1px solid rgba(240, 232, 213, 0.3);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            border-radius: 2px;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            cursor: pointer;
        }
        .btn-outline:hover {
            border-color: var(--gold);
            color: var(--gold);
            transform: translateY(-2px);
        }

        .btn-outline-dark {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.85rem 2.25rem;
            background: transparent;
            color: var(--ink);
            border: 1px solid rgba(10,8,6,0.3);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            border-radius: 2px;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            cursor: pointer;
        }
        .btn-outline-dark:hover {
            background: var(--ink);
            color: var(--gold);
            transform: translateY(-2px);
        }

        /* Cards */
        .card-dark {
            background: var(--ink-3);
            border: 1px solid rgba(201, 168, 76, 0.08);
            border-radius: 4px;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .card-dark:hover {
            border-color: rgba(201, 168, 76, 0.22);
            transform: translateY(-6px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.5);
        }

        /* Nav link */
        .nav-link {
            font-size: 0.75rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--cream-dim);
            transition: color 0.2s;
            position: relative;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 1px;
            background: var(--gold);
            transition: width 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .nav-link:hover { color: var(--gold); }
        .nav-link:hover::after { width: 100%; }

        /* Gradientes de transição */
        .fade-down {
            background: linear-gradient(to bottom, var(--ink) 0%, transparent 100%);
        }
        .fade-up-ink {
            background: linear-gradient(to top, var(--ink) 0%, transparent 100%);
        }

        /* Divider dourado */
        .divider-gold {
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold-dim), transparent);
        }

        /* Scroll suave */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--ink-2); }
        ::-webkit-scrollbar-thumb { background: var(--gold-dim); border-radius: 3px; }
    </style>
</head>
<body>

    <!-- ===== NAVEGAÇÃO ===== -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-500"
         style="background: linear-gradient(to bottom, rgba(10,8,6,0.95) 0%, transparent 100%); backdrop-filter: blur(0px);">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="flex items-center justify-between h-20">

                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <span class="font-display text-2xl tracking-wide text-cream" style="font-style: italic;">
                        Calm<span style="color: var(--gold);">Mind</span>
                    </span>
                    <span class="hidden sm:block w-px h-5" style="background: var(--muted);"></span>
                    <span class="hidden sm:block text-muted-2 uppercase tracking-widest" style="font-size: 0.6rem;">Resort & Spa</span>
                </a>

                <!-- Menu Desktop -->
                <div class="hidden md:flex items-center gap-10">
                    <a href="{{ route('home') }}"    class="nav-link">Início</a>
                    <a href="{{ route('about') }}"   class="nav-link">Sobre</a>
                    <a href="{{ route('rooms') }}"   class="nav-link">Quartos</a>
                    <a href="{{ route('contact') }}" class="nav-link">Contato</a>
                </div>

                <!-- Ações -->
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="nav-link">Minha Conta</a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="btn-outline text-sm py-2 px-5">Sair</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn-gold">Login</a>
                    @endauth

                    <!-- Hamburger mobile -->
                    <button id="menu-toggle" class="md:hidden p-2" style="color: var(--cream);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Menu Mobile -->
        <div id="mobile-menu" class="hidden md:hidden border-t" style="background: var(--ink-2); border-color: rgba(201,168,76,0.1);">
            <div class="px-6 py-6 flex flex-col gap-5">
                <a href="{{ route('home') }}"    class="nav-link">Início</a>
                <a href="{{ route('about') }}"   class="nav-link">Sobre</a>
                <a href="{{ route('rooms') }}"   class="nav-link">Quartos</a>
                <a href="{{ route('contact') }}" class="nav-link">Contato</a>
            </div>
        </div>
    </nav>

    <!-- ===== CONTEÚDO ===== -->
    <main>
        @php
            $flashSuccess = session('success');
            $flashError = session('error');
            $firstValidationError = $errors?->first();
        @endphp

        @if($flashSuccess || $flashError || $firstValidationError)
            <script>
                (function () {
                    if (!window.Swal) return;

                    const theme = {
                        background: '#110e0a',
                        color: '#f0e8d5',
                        confirmButtonColor: '#c9a84c',
                    };

                    const success = @json($flashSuccess);
                    const error = @json($flashError);
                    const validation = @json($firstValidationError);

                    const msg = success || error || validation;
                    const icon = success ? 'success' : 'error';
                    const title = success ? 'Sucesso' : 'Atenção';

                    Swal.fire({
                        ...theme,
                        icon,
                        title,
                        text: msg,
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                    });
                })();
            </script>
        @endif

        @yield('content')
    </main>

    <!-- ===== FOOTER ===== -->
    <footer style="background: var(--ink-2); border-top: 1px solid rgba(201,168,76,0.1);">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 py-20">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">

                <!-- Brand -->
                <div class="md:col-span-2">
                    <div class="font-display text-3xl text-cream mb-1" style="font-style: italic;">
                        Calm<span style="color: var(--gold);">Mind</span>
                    </div>
                    <div class="text-xs tracking-widest uppercase mb-6" style="color: var(--muted-2);">Resort & Spa</div>
                    <p class="text-sm leading-relaxed max-w-xs" style="color: var(--muted-2);">
                        Um refúgio de tranquilidade e sofisticação onde cada detalhe foi pensado para transformar sua estadia em uma experiência inesquecível.
                    </p>
                    <div class="flex gap-4 mt-8">
                        <a href="#" class="w-9 h-9 flex items-center justify-center rounded-full border transition-all duration-300"
                           style="border-color: rgba(201,168,76,0.2); color: var(--muted-2);"
                           onmouseover="this.style.borderColor='var(--gold)'; this.style.color='var(--gold)';"
                           onmouseout="this.style.borderColor='rgba(201,168,76,0.2)'; this.style.color='var(--muted-2)';">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 flex items-center justify-center rounded-full border transition-all duration-300"
                           style="border-color: rgba(201,168,76,0.2); color: var(--muted-2);"
                           onmouseover="this.style.borderColor='var(--gold)'; this.style.color='var(--gold)';"
                           onmouseout="this.style.borderColor='rgba(201,168,76,0.2)'; this.style.color='var(--muted-2)';">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Links -->
                <div>
                    <h4 class="text-xs uppercase tracking-widest mb-6" style="color: var(--gold);">Navegação</h4>
                    <ul class="space-y-3 text-sm" style="color: var(--muted-2);">
                        <li><a href="{{ route('home') }}"    class="hover:text-gold transition-colors duration-200">Início</a></li>
                        <li><a href="{{ route('about') }}"   class="hover:text-gold transition-colors duration-200">Sobre o Resort</a></li>
                        <li><a href="{{ route('rooms') }}"   class="hover:text-gold transition-colors duration-200">Nossas Acomodações</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-gold transition-colors duration-200">Contato</a></li>
                    </ul>
                </div>

                <!-- Contato -->
                <div>
                    <h4 class="text-xs uppercase tracking-widest mb-6" style="color: var(--gold);">Contato</h4>
                    <ul class="space-y-3 text-sm" style="color: var(--muted-2);">
                        <li>+55 (11) 9999-9999</li>
                        <li>contato@calmmind.com</li>
                        <li class="leading-relaxed">Av. Brasil, 1000<br>São Paulo — SP</li>
                    </ul>
                </div>
            </div>

            <div class="divider-gold mb-8"></div>

            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-xs" style="color: var(--muted);">
                <p>&copy; {{ date('Y') }} Calm Mind Resort & Spa. Todos os direitos reservados.</p>
                <p>Designed with precision</p>
            </div>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 60) {
                navbar.style.background = 'rgba(10,8,6,0.97)';
                navbar.style.backdropFilter = 'blur(12px)';
                navbar.style.borderBottom = '1px solid rgba(201,168,76,0.1)';
            } else {
                navbar.style.background = 'linear-gradient(to bottom, rgba(10,8,6,0.95) 0%, transparent 100%)';
                navbar.style.backdropFilter = 'blur(0px)';
                navbar.style.borderBottom = 'none';
            }
        });

        // Mobile menu
        document.getElementById('menu-toggle').addEventListener('click', () => {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>

    @vite('resources/js/app.js')
</body>
</html>