<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — {{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --ink:      #0a0806;
            --ink-2:    #110e0a;
            --ink-3:    #1c1610;
            --gold:     #c9a84c;
            --gold-dim: #a88a38;
            --cream:    #f0e8d5;
            --cream-dim:#c8bba5;
            --muted:    #8a7560;
            --muted-2:  #5c5040;
            --sidebar-w: 260px;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: #0f0c09;
            color: var(--cream-dim);
            display: flex;
            min-height: 100vh;
        }

        /* ── Sidebar ── */
        .sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            background: var(--ink-2);
            border-right: 1px solid rgba(201,168,76,0.08);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
        }
        .sidebar-brand {
            padding: 2rem 1.75rem 1.5rem;
            border-bottom: 1px solid rgba(201,168,76,0.08);
        }
        .sidebar-brand .label {
            font-size: 0.6rem;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 0.35rem;
        }
        .sidebar-brand .logo {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.9rem;
            color: var(--cream);
            font-style: italic;
            line-height: 1;
        }
        .sidebar-brand .logo span { color: var(--gold); }
        .sidebar-brand .badge {
            display: inline-block;
            margin-top: 0.6rem;
            font-size: 0.6rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            padding: 0.2rem 0.6rem;
            border: 1px solid rgba(201,168,76,0.3);
            color: var(--gold);
            border-radius: 2px;
        }

        /* Nav */
        .sidebar-nav {
            padding: 1.5rem 0;
            flex: 1;
        }
        .nav-section-label {
            font-size: 0.58rem;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: var(--muted-2);
            padding: 0.75rem 1.75rem 0.4rem;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.7rem 1.75rem;
            color: var(--muted);
            text-decoration: none;
            font-size: 0.85rem;
            transition: all 0.2s;
            border-left: 2px solid transparent;
        }
        .nav-item:hover {
            color: var(--cream);
            background: rgba(201,168,76,0.05);
            border-left-color: rgba(201,168,76,0.3);
        }
        .nav-item.active {
            color: var(--gold);
            background: rgba(201,168,76,0.08);
            border-left-color: var(--gold);
        }
        .nav-item svg { width: 16px; height: 16px; flex-shrink: 0; opacity: 0.75; }
        .nav-item.active svg { opacity: 1; }

        /* Footer sidebar */
        .sidebar-footer {
            padding: 1.25rem 1.75rem;
            border-top: 1px solid rgba(201,168,76,0.08);
        }
        .sidebar-footer .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
        }
        .sidebar-footer .avatar {
            width: 34px; height: 34px;
            border-radius: 50%;
            background: rgba(201,168,76,0.12);
            border: 1px solid rgba(201,168,76,0.25);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.75rem;
            color: var(--gold);
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
        }
        .sidebar-footer .name { font-size: 0.82rem; color: var(--cream-dim); line-height: 1.3; }
        .sidebar-footer .role { font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--gold); }
        .logout-btn {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            width: 100%;
            padding: 0.55rem 0.75rem;
            background: transparent;
            border: 1px solid rgba(201,168,76,0.15);
            color: var(--muted);
            border-radius: 2px;
            font-size: 0.78rem;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
            font-family: 'DM Sans', sans-serif;
        }
        .logout-btn:hover {
            border-color: rgba(201,168,76,0.4);
            color: var(--cream-dim);
        }
        .logout-btn svg { width: 14px; height: 14px; }

        /* ── Main ── */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .topbar {
            padding: 1.25rem 2rem;
            border-bottom: 1px solid rgba(201,168,76,0.07);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--ink-2);
        }
        .topbar-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.6rem;
            color: var(--cream);
            font-style: italic;
        }
        .topbar-breadcrumb {
            font-size: 0.72rem;
            color: var(--muted-2);
            text-transform: uppercase;
            letter-spacing: 0.12em;
            margin-top: 0.1rem;
        }
        .topbar-breadcrumb a { color: var(--gold); text-decoration: none; }
        .topbar-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .topbar-link {
            font-size: 0.75rem;
            color: var(--muted);
            text-decoration: none;
            padding: 0.45rem 0.9rem;
            border: 1px solid rgba(201,168,76,0.12);
            border-radius: 2px;
            transition: all 0.2s;
        }
        .topbar-link:hover { color: var(--gold); border-color: rgba(201,168,76,0.3); }

        .main-content {
            padding: 2rem;
            flex: 1;
        }

        /* ── Flash messages ── */
        .flash-error {
            background: rgba(200,70,70,0.1);
            border: 1px solid rgba(200,70,70,0.3);
            color: #e07070;
            padding: 0.75rem 1rem;
            border-radius: 2px;
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
        }
        .flash-success {
            background: rgba(60,160,100,0.1);
            border: 1px solid rgba(60,160,100,0.3);
            color: #5cc890;
            padding: 0.75rem 1rem;
            border-radius: 2px;
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>

{{-- ══ Sidebar ══ --}}
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="label">Painel de Controle</div>
        <div class="logo">Calm<span>Mind</span></div>
        <span class="badge">Administrador</span>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Principal</div>

        <a href="{{ route('admin.dashboard') }}"
           class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Dashboard
        </a>

        <div class="nav-section-label" style="margin-top:0.75rem;">Gestão</div>

        <a href="{{ route('admin.quartos.index') }}"
           class="nav-item {{ request()->routeIs('admin.quartos.*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/>
            </svg>
            Quartos
        </a>

        <a href="{{ route('admin.reservas.index') }}"
           class="nav-item {{ request()->routeIs('admin.reservas.*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
            </svg>
            Reservas
        </a>

        <a href="{{ route('admin.usuarios.index') }}"
           class="nav-item {{ request()->routeIs('admin.usuarios.*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
            </svg>
            Usuários
        </a>

        <div class="nav-section-label" style="margin-top:0.75rem;">Site</div>

        <a href="{{ route('home') }}" target="_blank" class="nav-item">
            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
            </svg>
            Ver Site
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="user-info">
            <div class="avatar">
                {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
            </div>
            <div>
                <div class="name">{{ auth()->user()->name ?? 'Admin' }}</div>
                <div class="role">Administrador</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
                </svg>
                Sair da conta
            </button>
        </form>
    </div>
</aside>

{{-- ══ Conteúdo Principal ══ --}}
<div class="main-wrapper">
    <header class="topbar">
        <div>
            <div class="topbar-title">@yield('page-title', 'Painel Admin')</div>
            <div class="topbar-breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Admin</a>
                @hasSection('breadcrumb')
                    &nbsp;/&nbsp; @yield('breadcrumb')
                @endif
            </div>
        </div>
        <div class="topbar-right">
            <a href="{{ route('home') }}" class="topbar-link">← Voltar ao Site</a>
        </div>
    </header>

    <main class="main-content">
        @php
            $flashSuccess = session('success');
            $flashError = session('error');
        @endphp

        @if($flashSuccess || $flashError)
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

                    const msg = success || error;
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
</div>

<script>
    // SweetAlert confirmations (tema do site)
    (function () {
        if (!window.Swal) return;

        const theme = {
            background: '#110e0a',
            color: '#f0e8d5',
            confirmButtonColor: '#c9a84c',
            cancelButtonColor: '#5c5040',
        };

        window.calmConfirm = function ({ title, text, confirmText, icon }) {
            return Swal.fire({
                ...theme,
                icon: icon || 'warning',
                title: title || 'Confirmar ação',
                text: text || 'Tem certeza?',
                showCancelButton: true,
                confirmButtonText: confirmText || 'Confirmar',
                cancelButtonText: 'Voltar',
                reverseButtons: true,
                focusCancel: true,
            });
        };

        document.addEventListener('submit', function (e) {
            const form = e.target;
            if (!(form instanceof HTMLFormElement)) return;
            if (form.dataset.swalConfirmed === '1') return;

            const title = form.getAttribute('data-swal-title');
            const text = form.getAttribute('data-swal-text');
            const confirmText = form.getAttribute('data-swal-confirm');
            const icon = form.getAttribute('data-swal-icon');
            if (!title && !text && !confirmText && !icon) return;

            e.preventDefault();
            window.calmConfirm({ title, text, confirmText, icon }).then((res) => {
                if (res.isConfirmed) {
                    form.dataset.swalConfirmed = '1';
                    form.submit();
                }
            });
        }, true);
    })();
</script>

</body>
</html>
