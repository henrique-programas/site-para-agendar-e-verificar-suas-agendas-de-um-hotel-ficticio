@extends('layouts.app')
@section('title', 'Sobre o Resort — Calm Mind')
@section('content')

<!-- ===== HERO ===== -->
<section class="relative pt-44 pb-32 overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=1400&q=80"
             alt="Sobre" class="w-full h-full object-cover" style="filter: brightness(0.2);">
        <div class="absolute inset-0" style="background: linear-gradient(to bottom, var(--ink) 0%, transparent 25%, var(--ink) 100%);"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-6 lg:px-12">
        <span class="line-gold"></span>
        <p class="text-xs uppercase tracking-[0.25em] mb-3" style="color: var(--gold);">Nossa História</p>
        <h1 class="font-display text-6xl md:text-8xl leading-none" style="color: var(--cream); font-style: italic;">
            Sobre o<br><span style="color: var(--gold);">Calm Mind</span>
        </h1>
    </div>
</section>

<!-- ===== HISTÓRIA ===== -->
<section style="background: var(--ink);" class="py-28">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
            <div>
                <span class="line-gold"></span>
                <h2 class="font-display text-5xl mb-8 leading-tight" style="color: var(--cream); font-style: italic;">
                    Uma jornada que<br>começou em 2018
                </h2>
                <p class="text-sm leading-relaxed mb-5" style="color: var(--muted-2);">
                    O Calm Mind nasceu de um sonho simples e ambicioso: criar um lugar onde o tempo desacelerasse. Em 2018, abrimos nossas portas com 12 suítes e uma missão clara — transformar cada estadia em memória.
                </p>
                <p class="text-sm leading-relaxed mb-5" style="color: var(--muted-2);">
                    Hoje, com 45 acomodações, três restaurantes e um spa premiado, continuamos guiados pela mesma obsessão com o detalhe e pelo compromisso com a experiência do hóspede.
                </p>
                <p class="text-sm leading-relaxed mb-10" style="color: var(--muted-2);">
                    Nossa arquitetura integra o natural e o contemporâneo, criando espaços que dialogam com a paisagem sem tentar dominá-la.
                </p>
                <a href="{{ route('rooms') }}" class="btn-outline">Conheça Nossas Suítes</a>
            </div>

            <div class="relative">
                <div class="overflow-hidden rounded-sm" style="border: 1px solid rgba(201,168,76,0.12);">
                    <img src="https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=700&q=80"
                         alt="Resort" class="w-full h-[560px] object-cover" style="filter: brightness(0.82);">
                </div>
                <!-- Cartão flutuante -->
                <div class="absolute -bottom-6 -left-6 p-6 rounded-sm" style="background: var(--ink-3); border: 1px solid rgba(201,168,76,0.15);">
                    <div class="font-display text-4xl mb-1" style="color: var(--gold); font-style: italic;">2018</div>
                    <div class="text-xs uppercase tracking-widest" style="color: var(--muted-2);">Fundação do Resort</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== MÉTRICAS ===== -->
<section class="py-20" style="background: var(--ink-3); border-top: 1px solid rgba(201,168,76,0.1); border-bottom: 1px solid rgba(201,168,76,0.1);">
    <div class="max-w-5xl mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            @foreach([
                ['num' => '45',    'label' => 'Suítes Luxuosas'],
                ['num' => '8.5k+', 'label' => 'Hóspedes Satisfeitos'],
                ['num' => '16',    'label' => 'Prêmios Conquistados'],
                ['num' => '4.9',   'label' => 'Avaliação Média'],
            ] as $m)
            <div>
                <div class="font-display text-5xl mb-2" style="color: var(--gold); font-style: italic;">{{ $m['num'] }}</div>
                <div class="text-xs uppercase tracking-widest" style="color: var(--muted-2);">{{ $m['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===== MISSÃO / VISÃO / VALORES ===== -->
<section style="background: var(--ink-2);" class="py-28">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="text-center mb-16">
            <span class="line-gold mx-auto" style="margin: 0 auto 1.5rem;"></span>
            <h2 class="font-display text-5xl" style="color: var(--cream); font-style: italic;">Nossos Pilares</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                ['icon' => '🎯', 'title' => 'Missão',  'text' => 'Proporcionar experiências transformadoras de bem-estar e hospitalidade excepcional, criando memórias que perdurem muito além da hospedagem.'],
                ['icon' => '🌟', 'title' => 'Visão',   'text' => 'Ser reconhecido globalmente como o destino premium de bem-estar e luxo, onde excelência e inovação convergem para transformar vidas.'],
                ['icon' => '💎', 'title' => 'Valores', 'text' => 'Integridade, excelência, sustentabilidade e humanidade — princípios que guiam cada ação e decisão que tomamos diariamente.'],
            ] as $p)
            <div class="card-dark p-8">
                <div class="text-4xl mb-5">{{ $p['icon'] }}</div>
                <h3 class="font-display text-2xl mb-4" style="color: var(--cream);">{{ $p['title'] }}</h3>
                <p class="text-sm leading-relaxed" style="color: var(--muted-2);">{{ $p['text'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===== FULL WIDTH FOTO ===== -->
<section class="relative h-[450px] overflow-hidden">
    <img src="https://images.unsplash.com/photo-1543898678-b2bfcff5e1cd?w=1600&q=80"
         alt="Spa" class="absolute inset-0 w-full h-full object-cover" style="filter: brightness(0.28);">
    <div class="absolute inset-0" style="background: linear-gradient(135deg, var(--ink) 0%, transparent 50%);"></div>
    <div class="relative h-full flex items-center px-6 lg:px-20 max-w-7xl mx-auto">
        <div class="max-w-xl">
            <span class="line-gold"></span>
            <h2 class="font-display text-4xl md:text-5xl mb-5" style="color: var(--cream); font-style: italic;">
                Sustentabilidade como estilo de vida
            </h2>
            <p class="text-sm leading-relaxed mb-8" style="color: rgba(240,232,213,0.6);">
                60% da nossa energia vem de fontes renováveis. Plantamos 100 árvores por ano e utilizamos sistema de reutilização de água em todo o complexo.
            </p>
            <div class="flex gap-8">
                @foreach(['60% Energia Renovável','Zero Plástico de Uso Único','Produtos Orgânicos no Spa'] as $item)
                <div class="text-xs uppercase tracking-widest" style="color: var(--gold);">✓ {{ $item }}</div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- ===== SERVIÇOS ===== -->
<section style="background: var(--ink);" class="py-28">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="text-center mb-16">
            <span class="line-gold mx-auto" style="margin: 0 auto 1.5rem;"></span>
            <h2 class="font-display text-5xl" style="color: var(--cream); font-style: italic;">
                Serviços Exclusivos
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                ['icon' => '🏊', 'title' => 'Piscinas',           'text' => 'Três piscinas aquecidas, piscina infantil e área de hidromassagem.'],
                ['icon' => '🧖', 'title' => 'Spa Premium',         'text' => 'Massagens, tratamentos faciais, aromaterapia e terapias holísticas.'],
                ['icon' => '🍽️', 'title' => 'Gastronomia',        'text' => 'Três restaurantes com culinária autoral e room service 24h.'],
                ['icon' => '🏋️', 'title' => 'Academia & Fitness', 'text' => 'Equipamentos modernos, yoga, pilates e personal trainers.'],
                ['icon' => '📱', 'title' => 'Conectividade',       'text' => 'WiFi 1Gbps, concierge digital 24h e app exclusivo do resort.'],
                ['icon' => '👶', 'title' => 'Família',             'text' => 'Clube infantil, babysitting e programação especial para crianças.'],
            ] as $s)
            <div class="flex gap-5 p-6 rounded-sm" style="border: 1px solid rgba(201,168,76,0.08);">
                <div class="text-3xl mt-1 flex-shrink-0">{{ $s['icon'] }}</div>
                <div>
                    <h3 class="font-display text-xl mb-2" style="color: var(--cream);">{{ $s['title'] }}</h3>
                    <p class="text-sm leading-relaxed" style="color: var(--muted-2);">{{ $s['text'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===== EQUIPE ===== -->
<section style="background: var(--ink-2);" class="py-28">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="text-center mb-16">
            <span class="line-gold mx-auto" style="margin: 0 auto 1.5rem;"></span>
            <h2 class="font-display text-5xl" style="color: var(--cream); font-style: italic;">Nossa Equipe</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach([
                [
                    'name' => 'Henrique Barroso Andrade',
                    'role' => 'Diretor Geral',
                    'img' => 'images/266340390.png'
                ]
            ] as $s)
            <div class="group">
                <div class="overflow-hidden rounded-sm mb-4" style="border: 1px solid rgba(201,168,76,0.1);">
                    <img src="{{ $s['img'] }}" alt="{{ $s['name'] }}"
                         class="w-full h-64 object-cover transition-all duration-500 group-hover:scale-105"
                         style="filter: brightness(0.75) grayscale(0.3);">
                </div>
                <h3 class="font-display text-xl mb-1" style="color: var(--cream);">{{ $s['name'] }}</h3>
                <p class="text-xs uppercase tracking-widest" style="color: var(--gold);">{{ $s['role'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===== PRÊMIOS ===== -->
<section style="background: var(--ink);" class="py-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="text-center mb-12">
            <h2 class="font-display text-4xl" style="color: var(--cream); font-style: italic;">Reconhecimentos</h2>
        </div>
        <div class="flex flex-wrap justify-center gap-4">
            @foreach([
                'TripAdvisor Traveler\'s Choice','5 Estrelas Michelin','Green Resort Certified',
                'Luxury Spa Award','Best Beach Resort 2023','Excellence in Service'
            ] as $award)
            <div class="px-6 py-3 text-xs uppercase tracking-widest rounded-sm"
                 style="background: var(--ink-3); color: var(--gold); border: 1px solid rgba(201,168,76,0.15);">
                ✦ {{ $award }}
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===== CTA ===== -->
<section class="relative py-32 overflow-hidden">
    <img src="https://images.unsplash.com/photo-1540541338287-41700207dee6?w=1600&q=80"
         alt="Resort" class="absolute inset-0 w-full h-full object-cover" style="filter: brightness(0.2);">
    <div class="absolute inset-0" style="background: linear-gradient(to bottom, var(--ink) 0%, transparent 20%, var(--ink) 100%);"></div>
    <div class="relative max-w-3xl mx-auto px-6 text-center">
        <h2 class="font-display text-5xl mb-5" style="color: var(--cream); font-style: italic;">
            Faça parte da nossa história
        </h2>
        <p class="text-sm mb-10" style="color: var(--muted-2);">
            Reserve sua experiência e descubra o que nos torna únicos.
        </p>
        <a href="{{ route('rooms') }}" class="btn-gold">Reservar Agora</a>
    </div>
</section>

@endsection