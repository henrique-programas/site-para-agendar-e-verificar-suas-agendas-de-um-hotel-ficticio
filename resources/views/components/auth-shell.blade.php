@props([
    'title' => 'Bem-vindo',
    'subtitle' => null,
    'backUrl' => null,
    'backLabel' => 'Voltar',
    'leftLabel' => 'Resort & Spa',
    'leftTitle' => 'CalmMind',
    'leftTagline' => 'Seu refúgio de tranquilidade e elegância.',
    'imageUrl' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=1200&q=80',
])

<div class="min-h-screen flex">

    <!-- Lado esquerdo — imagem -->
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">
        <div class="absolute inset-0" style="
            background-image: url('{{ $imageUrl }}');
            background-size: cover;
            background-position: center;
            filter: brightness(0.45);
        "></div>
        <div class="absolute inset-0" style="background: linear-gradient(to right, transparent 60%, #0a0806 100%);"></div>

        <div class="relative flex flex-col justify-end p-16">
            <p style="color: #c9a84c; font-size: 0.7rem; letter-spacing: 0.3em; text-transform: uppercase; margin-bottom: 1rem;">
                {{ $leftLabel }}
            </p>

            <h1 style="font-family: 'Cormorant Garamond', serif; font-size: 4rem; color: #f0e8d5; font-style: italic; line-height: 1;">
                {!! str_replace('Mind', '<span style=\"color: #c9a84c;\">Mind</span>', e($leftTitle)) !!}
            </h1>

            <p style="color: #8a7560; font-size: 0.85rem; margin-top: 1rem; max-width: 320px; line-height: 1.6;">
                {{ $leftTagline }}
            </p>
        </div>
    </div>

    <!-- Lado direito — conteúdo -->
    <div class="w-full lg:w-1/2 flex items-center justify-center px-8 py-16" style="background: #0a0806;">
        <div class="w-full max-w-md">

            <!-- Logo mobile -->
            <div class="lg:hidden text-center mb-12">
                <h1 style="font-family: 'Cormorant Garamond', serif; font-size: 3rem; color: #f0e8d5; font-style: italic;">
                    Calm<span style="color: #c9a84c;">Mind</span>
                </h1>
            </div>

            {{-- Ações de navegação --}}
            <div style="display:flex; align-items:center; justify-content:space-between; gap:0.75rem; margin-bottom: 1.25rem;">
                <a href="{{ $backUrl ?? route('home') }}"
                   style="font-size:0.7rem; color:#8a7560; text-decoration:none; letter-spacing:0.08em; text-transform:uppercase;"
                   onmouseover="this.style.color='#c9a84c'" onmouseout="this.style.color='#8a7560'">
                    ← {{ $backLabel }}
                </a>
                <a href="{{ route('home') }}"
                   style="font-size:0.7rem; color:#8a7560; text-decoration:none; letter-spacing:0.08em; text-transform:uppercase;"
                   onmouseover="this.style.color='#c9a84c'" onmouseout="this.style.color='#8a7560'">
                    Página inicial
                </a>
            </div>

            <div style="margin-bottom: 2.5rem;">
                <span style="display:block; width:48px; height:1px; background:#c9a84c; margin-bottom:1.5rem;"></span>
                <h2 style="font-family: 'Cormorant Garamond', serif; font-size: 2.5rem; color: #f0e8d5; font-style: italic;">
                    {{ $title }}
                </h2>
                @if($subtitle)
                    <p style="color: #8a7560; font-size: 0.85rem; margin-top: 0.5rem;">
                        {{ $subtitle }}
                    </p>
                @endif
            </div>

            @if (session('status'))
                <div style="background: rgba(46,125,138,0.15); border: 1px solid rgba(46,125,138,0.3); color: #3fa0b0; padding: 0.75rem 1rem; border-radius: 2px; margin-bottom: 1.5rem; font-size: 0.85rem;">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div style="background: rgba(200,70,70,0.12); border: 1px solid rgba(200,70,70,0.3); color: #e07070; padding: 0.75rem 1rem; border-radius: 2px; margin-bottom: 1.5rem; font-size: 0.85rem;">
                    {{ session('error') }}
                </div>
            @endif

            {{ $slot }}

            @isset($footer)
                <div style="margin-top: 1.5rem;">
                    {{ $footer }}
                </div>
            @endisset

        </div>
    </div>
</div>

