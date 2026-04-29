@extends('layouts.app')
@section('title', 'Calm Mind — Resort & Spa')
@section('content')

<!-- =====================================================
     HERO — Tela cheia com imagem
     ===================================================== -->
<section class="relative h-screen min-h-[700px] overflow-hidden">

    <!-- Imagem de fundo -->
    <div id="hero-bg" class="absolute inset-0" style="
        background-image: url('https://images.unsplash.com/photo-1571896349842-b46d0e36f0bb?w=1600&q=85');
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        filter: brightness(0.52);
    "></div>

    <!-- Gradiente inferior — funde suavemente com a próxima seção -->
    <div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(10,8,6,0.4) 0%, transparent 40%, rgba(10,8,6,0.7) 75%, #0a0806 100%);"></div>
    <!-- Gradiente lateral esquerdo -->
    <div class="absolute inset-0" style="background: linear-gradient(to right, rgba(10,8,6,0.4) 0%, transparent 55%);"></div>

    <div class="relative h-full flex items-end pb-24 px-6 lg:px-20 max-w-7xl mx-auto">
        <div class="max-w-2xl">
            <p class="text-xs uppercase tracking-[0.3em] mb-5" style="color: var(--gold);">Boas-vindas ao</p>
            <h1 class="font-display text-7xl md:text-9xl leading-none mb-5" style="color: var(--cream); font-style: italic;">
                Calm<span style="color: var(--gold);">Mind</span>
            </h1>
            <p class="text-sm uppercase tracking-[0.25em] mb-8" style="color: var(--cream-dim);">Resort & Spa</p>
            <p class="text-lg font-light mb-12 leading-relaxed max-w-md" style="color: rgba(240,232,213,0.65);">
                Um refúgio de silêncio e elegância onde cada detalhe foi pensado para transformar sua estadia.
            </p>
            <div class="flex flex-wrap items-center gap-4">
                <a href="{{ route('rooms') }}" class="btn-gold">Explorar Quartos</a>
                <a href="{{ route('about') }}"  class="btn-outline">Sobre o Resort</a>
            </div>
        </div>
    </div>

    <div class="absolute bottom-8 right-12 flex flex-col items-center gap-2" style="opacity:0.45;">
        <div class="w-px h-14" style="background: linear-gradient(to bottom, var(--gold), transparent);"></div>
        <span style="color: var(--cream-dim); font-size: 0.6rem; letter-spacing: 0.2em; writing-mode: vertical-rl;">SCROLL</span>
    </div>
</section>

<script>
    // Fallback: se o Unsplash não carregar, troca para outra imagem
    (function() {
        const hero = document.getElementById('hero-bg');
        if (!hero) return;
        const urls = [
            'https://images.unsplash.com/photo-1571896349842-b46d0e36f0bb?w=1600&q=85',
            'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=1600&q=80',
            'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=1600&q=80',
            'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=1600&q=80',
        ];
        let idx = 0;
        function tryNext() {
            if (idx >= urls.length) return;
            const img = new Image();
            img.onload = () => { hero.style.backgroundImage = "url('" + urls[idx] + "')"; };
            img.onerror = () => { idx++; tryNext(); };
            img.src = urls[idx];
            idx++;
        }
        tryNext();
    })();
</script>

<!-- =====================================================
     SOBRE — Fundo CLARO (creme), ruptura visual
     ===================================================== -->
<section style="background: var(--cream);" class="py-28">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            <div class="relative order-2 lg:order-1">
                <div class="overflow-hidden rounded-sm shadow-2xl" style="border: 1px solid rgba(10,8,6,0.1);">
                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80"
                         alt="Vista do Resort" class="w-full h-[520px] object-cover"
                         style="filter: brightness(0.9);">
                </div>
                <div class="absolute -bottom-6 -right-6 p-6 rounded-sm shadow-xl hidden lg:block"
                     style="background: var(--ink-3); border: 1px solid rgba(201,168,76,0.2);">
                    <div class="font-display text-3xl mb-1" style="color: var(--gold); font-style: italic;">2018</div>
                    <div class="text-xs uppercase tracking-widest" style="color: var(--muted-2);">Fundação</div>
                </div>
            </div>

            <div class="order-1 lg:order-2 lg:pl-8">
                <span class="block w-12 h-px mb-6" style="background: var(--gold-dim);"></span>
                <p class="text-xs uppercase tracking-[0.25em] mb-4" style="color: var(--gold-dim);">Nossa Essência</p>
                <h2 class="font-display text-5xl md:text-6xl leading-tight mb-8" style="color: var(--ink); font-style: italic;">
                    Uma jornada de<br>bem-estar e luxo
                </h2>
                <p class="text-sm leading-relaxed mb-5" style="color: #4a3f32;">
                    O Calm Mind foi concebido para quem busca mais que uma hospedagem — uma transformação. Cada espaço foi desenhado para criar harmonia entre o corpo, a mente e a natureza.
                </p>
                <p class="text-sm leading-relaxed mb-10" style="color: #4a3f32;">
                    Piscinas de bordas infinitas, tratamentos exclusivos de spa, gastronomia autoral e quartos que parecem suspender o tempo. Aqui, o luxo é sentido, não exibido.
                </p>

                <div class="grid grid-cols-3 gap-6 mb-10 pt-8" style="border-top: 1px solid rgba(10,8,6,0.1);">
                    @foreach([['45','Suítes'],['8.5k+','Hóspedes'],['16','Prêmios']] as $m)
                    <div>
                        <div class="font-display text-3xl mb-1" style="color: var(--gold-dim); font-style: italic;">{{ $m[0] }}</div>
                        <div class="text-xs uppercase tracking-widest" style="color: #7a6a58;">{{ $m[1] }}</div>
                    </div>
                    @endforeach
                </div>

                <a href="{{ route('about') }}" class="btn-outline-dark">Conheça Nossa História</a>
            </div>
        </div>
    </div>
</section>

<!-- =====================================================
     QUOTE — Imagem de fundo com overlay
     ===================================================== -->
<section class="relative h-[320px] overflow-hidden">
    <img src="https://images.unsplash.com/photo-1543898678-b2bfcff5e1cd?w=1600&q=80"
         alt="Piscina" class="absolute inset-0 w-full h-full object-cover"
         style="filter: brightness(0.28);">
    <div class="absolute inset-0" style="background: linear-gradient(to right, var(--ink) 0%, transparent 25%, transparent 75%, var(--ink) 100%);"></div>

    <div class="relative h-full flex items-center justify-center text-center px-6">
        <div>
            <p class="font-display text-3xl md:text-5xl mb-5 leading-tight" style="color: var(--cream); font-style: italic;">
                "Onde o silêncio é um serviço"
            </p>
            <span class="text-xs uppercase tracking-[0.3em]" style="color: var(--gold);">Calm Mind — desde 2018</span>
        </div>
    </div>
</section>

<!-- =====================================================
     QUARTOS — Imagem de fundo escura e sutil
     ===================================================== -->
<section class="relative py-28 overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=1400&q=60"
             alt="" class="w-full h-full object-cover" style="filter: brightness(0.07);">
        <div class="absolute inset-0" style="background: rgba(10,8,6,0.88);"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-6 lg:px-12">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-16">
            <div>
                <span class="block w-12 h-px mb-6" style="background: var(--gold);"></span>
                <p class="text-xs uppercase tracking-[0.25em] mb-3" style="color: var(--gold);">Acomodações</p>
                <h2 class="font-display text-5xl md:text-6xl" style="color: var(--cream); font-style: italic;">Quartos & Suítes</h2>
            </div>
            <a href="{{ route('rooms') }}" class="btn-outline mt-8 md:mt-0 self-start md:self-auto">Ver Todos →</a>
        </div>

        @if($rooms->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($rooms as $room)
            @php
                $typeLabels = [
                    'standard'    => 'Standard',
                    'deluxe'      => 'Deluxe',
                    'suite'       => 'Suíte',
                    'presidential'=> 'Presidencial',
                ];
                $typeLabel = $typeLabels[$room->type] ?? ucfirst($room->type);
                $defaultImgs = [
                    'standard'    => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=600&q=80',
                    'deluxe'      => 'https://images.unsplash.com/photo-1578683078519-94f3b6c49f15?w=600&q=80',
                    'suite'       => 'https://images.unsplash.com/photo-1591088398332-8c716432dd4d?w=600&q=80',
                    'presidential'=> 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?w=600&q=80',
                ];
                $imgUrl = $room->image_url ?: ($defaultImgs[$room->type] ?? 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=600&q=80');
            @endphp
            <div class="card-dark group overflow-hidden">
                <div class="relative h-72 overflow-hidden">
                    <img src="{{ $imgUrl }}" alt="{{ $room->name }}"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                         style="filter: brightness(0.78);">
                    <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(10,8,6,0.9) 0%, transparent 55%);"></div>
                    <div class="absolute top-4 left-4">
                        <span class="text-xs uppercase tracking-widest px-3 py-1 rounded-sm"
                              style="background: rgba(201,168,76,0.15); color: var(--gold); border: 1px solid rgba(201,168,76,0.3); backdrop-filter: blur(4px);">
                            {{ $typeLabel }}
                        </span>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <h3 class="font-display text-2xl mb-1" style="color: var(--cream); font-style: italic;">{{ $room->name }}</h3>
                        <span class="text-xs uppercase tracking-widest" style="color: var(--gold);">
                            R$ {{ number_format($room->price_per_night, 0, ',', '.') }}
                            <span style="color: var(--muted-2);">/ noite</span>
                        </span>
                    </div>
                </div>
                <div class="p-6 flex items-center justify-between" style="border-top: 1px solid rgba(201,168,76,0.08);">
                    <div class="flex gap-4 text-xs" style="color: var(--muted-2);">
                        <span>👥 {{ $room->capacity }} hóspede{{ $room->capacity > 1 ? 's' : '' }}</span>
                        @if($room->amenities && in_array('wifi', $room->amenities))
                            <span>📶 WiFi</span>
                        @endif
                        @if($room->amenities && in_array('spa', $room->amenities))
                            <span>🛁 Spa</span>
                        @endif
                    </div>
                    <a href="{{ route('room.detail', $room) }}"
                       class="text-xs uppercase tracking-widest"
                       style="color: var(--gold);">Ver →</a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        {{-- Fallback com cards estáticos enquanto não há quartos cadastrados --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                ['title'=>'Quarto Deluxe',     'price'=>'450',  'tag'=>'Deluxe',       'cap'=>2, 'img'=>'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=600&q=80'],
                ['title'=>'Suíte Premium',      'price'=>'750',  'tag'=>'Suíte',        'cap'=>2, 'img'=>'https://images.unsplash.com/photo-1578683078519-94f3b6c49f15?w=600&q=80'],
                ['title'=>'Suíte Presidencial', 'price'=>'1200', 'tag'=>'Presidencial', 'cap'=>4, 'img'=>'https://images.unsplash.com/photo-1591088398332-8c716432dd4d?w=600&q=80'],
            ] as $r)
            <div class="card-dark group overflow-hidden">
                <div class="relative h-72 overflow-hidden">
                    <img src="{{ $r['img'] }}" alt="{{ $r['title'] }}"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                         style="filter: brightness(0.78);">
                    <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(10,8,6,0.9) 0%, transparent 55%);"></div>
                    <div class="absolute top-4 left-4">
                        <span class="text-xs uppercase tracking-widest px-3 py-1 rounded-sm"
                              style="background: rgba(201,168,76,0.15); color: var(--gold); border: 1px solid rgba(201,168,76,0.3); backdrop-filter: blur(4px);">
                            {{ $r['tag'] }}
                        </span>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <h3 class="font-display text-2xl mb-1" style="color: var(--cream); font-style: italic;">{{ $r['title'] }}</h3>
                        <span class="text-xs uppercase tracking-widest" style="color: var(--gold);">
                            R$ {{ $r['price'] }} <span style="color: var(--muted-2);">/ noite</span>
                        </span>
                    </div>
                </div>
                <div class="p-6 flex items-center justify-between" style="border-top: 1px solid rgba(201,168,76,0.08);">
                    <div class="flex gap-4 text-xs" style="color: var(--muted-2);">
                        <span>👥 {{ $r['cap'] }} hóspedes</span><span>📶 WiFi</span><span>🛁 Spa</span>
                    </div>
                    <a href="{{ route('rooms') }}" class="text-xs uppercase tracking-widest" style="color: var(--gold);">Ver →</a>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

<!-- =====================================================
     DIFERENCIAIS — Fundo CLARO (alternância)
     ===================================================== -->
<section style="background: #e8dfc8;" class="py-28">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">

        <div class="text-center mb-16">
            <span class="block w-12 h-px mx-auto mb-6" style="background: var(--gold-dim);"></span>
            <p class="text-xs uppercase tracking-[0.25em] mb-3" style="color: var(--gold-dim);">Por que escolher o Calm Mind</p>
            <h2 class="font-display text-5xl" style="color: var(--ink); font-style: italic;">Uma experiência completa</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['icon'=>'🏊','title'=>'Piscinas Infinitas', 'text'=>'Três piscinas aquecidas com bordas infinitas e bar à beira d\'água.'],
                ['icon'=>'🧖','title'=>'Spa Exclusivo',      'text'=>'Tratamentos corporais e faciais com produtos naturais premium.'],
                ['icon'=>'🍽️','title'=>'Gastronomia Autoral','text'=>'Chefs renomados com menu sazonal e ingredientes selecionados.'],
                ['icon'=>'🌿','title'=>'Natureza Integrada', 'text'=>'Arquitetura que dissolve os limites entre interior e exterior.'],
            ] as $item)
            <div class="p-8 rounded-sm shadow-md transition-all duration-300 hover:-translate-y-1"
                 style="background: rgba(255,255,255,0.65); border: 1px solid rgba(10,8,6,0.08);">
                <div class="text-4xl mb-5">{{ $item['icon'] }}</div>
                <h3 class="font-display text-xl mb-3" style="color: var(--ink);">{{ $item['title'] }}</h3>
                <p class="text-sm leading-relaxed" style="color: #5a4a38;">{{ $item['text'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- =====================================================
     DISPONIBILIDADE — Imagem de fundo com overlay
     ===================================================== -->
<section class="relative py-20 overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1540541338287-41700207dee6?w=1400&q=75"
             alt="" class="w-full h-full object-cover" style="filter: brightness(0.22);">
        <div class="absolute inset-0" style="background: rgba(10,8,6,0.8);"></div>
    </div>

    <div class="relative max-w-5xl mx-auto px-6 lg:px-12">
        <p class="text-center text-xs uppercase tracking-[0.3em] mb-3" style="color: var(--gold);">Verificar Disponibilidade</p>
        <h3 class="font-display text-3xl text-center mb-10" style="color: var(--cream); font-style: italic;">
            Quando você chega?
        </h3>
        <form class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach([['Check-in','date','checkin'],['Check-out','date','checkout']] as $f)
            <div>
                <label class="block text-xs uppercase tracking-widest mb-2" style="color: var(--muted-2);">{{ $f[0] }}</label>
                <input type="{{ $f[1] }}" name="{{ $f[2] }}"
                       class="w-full px-4 py-3 text-sm rounded-sm focus:outline-none"
                       style="background: rgba(28,22,16,0.8); border: 1px solid rgba(201,168,76,0.2); color: var(--cream);">
            </div>
            @endforeach
            <div>
                <label class="block text-xs uppercase tracking-widest mb-2" style="color: var(--muted-2);">Hóspedes</label>
                <select class="w-full px-4 py-3 text-sm rounded-sm focus:outline-none"
                        style="background: rgba(28,22,16,0.8); border: 1px solid rgba(201,168,76,0.2); color: var(--cream);">
                    <option>1 Hóspede</option><option>2 Hóspedes</option><option>3 Hóspedes</option><option>4+</option>
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="btn-gold w-full justify-center">Buscar</button>
            </div>
        </form>
    </div>
</section>

<!-- =====================================================
     DEPOIMENTOS — Fundo escuro sólido
     ===================================================== -->
<section style="background: var(--ink-2);" class="py-24">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="text-center mb-14">
            <span class="block w-12 h-px mx-auto mb-6" style="background: var(--gold);"></span>
            <h2 class="font-display text-4xl" style="color: var(--cream); font-style: italic;">O que dizem nossos hóspedes</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                ['text'=>'Uma das experiências mais marcantes que já tive. O spa é simplesmente excepcional e o atendimento supera qualquer expectativa.','author'=>'Fernanda L.','city'=>'São Paulo'],
                ['text'=>'O quarto presidencial tem uma vista de tirar o fôlego. A gastronomia é autoral e cada prato é uma obra de arte.','author'=>'Ricardo M.','city'=>'Rio de Janeiro'],
                ['text'=>'Voltamos pela terceira vez e o resort continua surpreendendo. A atenção ao detalhe é incomparável no Brasil.','author'=>'Carla S.','city'=>'Curitiba'],
            ] as $dep)
            <div class="card-dark p-8">
                <div class="text-3xl mb-6" style="color: var(--gold); font-family: serif; line-height: 1;">"</div>
                <p class="text-sm leading-relaxed mb-8 italic" style="color: var(--cream-dim);">{{ $dep['text'] }}</p>
                <div style="border-top: 1px solid rgba(201,168,76,0.12);" class="pt-5">
                    <div class="text-sm font-medium" style="color: var(--cream);">{{ $dep['author'] }}</div>
                    <div class="text-xs uppercase tracking-widest mt-1" style="color: var(--muted-2);">{{ $dep['city'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- =====================================================
     CTA FINAL — Imagem de fundo intensa
     ===================================================== -->
<section class="relative py-40 overflow-hidden">
    <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?w=1600&q=80"
         alt="Resort" class="absolute inset-0 w-full h-full object-cover"
         style="filter: brightness(0.22);">
    <div class="absolute inset-0" style="background: linear-gradient(to bottom, var(--ink) 0%, transparent 20%, transparent 80%, var(--ink) 100%);"></div>
    <div class="absolute inset-0" style="background: linear-gradient(135deg, rgba(10,8,6,0.6) 0%, transparent 60%);"></div>

    <div class="relative max-w-3xl mx-auto px-6 text-center">
        <span class="block w-12 h-px mx-auto mb-8" style="background: var(--gold);"></span>
        <h2 class="font-display text-5xl md:text-6xl mb-6" style="color: var(--cream); font-style: italic;">
            Pronto para sua experiência?
        </h2>
        <p class="text-base mb-12 max-w-xl mx-auto" style="color: rgba(240,232,213,0.55);">
            Reserve agora e descubra por que somos referência em hospitalidade de luxo.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('rooms') }}"   class="btn-gold">Reservar Agora</a>
            <a href="{{ route('contact') }}" class="btn-outline">Falar com Especialista</a>
        </div>
    </div>
</section>

@endsection