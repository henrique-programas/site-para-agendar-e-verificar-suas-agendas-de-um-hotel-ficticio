@extends('layouts.app')
@section('title', 'Acomodações — Calm Mind Resort & Spa')
@section('content')

<!-- ===== HERO ===== -->
<section class="relative pt-40 pb-28 overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1596928519198-83e0b5c8d900?w=1400&q=80"
             alt="Quartos" class="w-full h-full object-cover" style="filter: brightness(0.22);">
        <div class="absolute inset-0" style="background: linear-gradient(to bottom, var(--ink) 0%, transparent 30%, var(--ink) 100%);"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-6 lg:px-12">
        <span class="line-gold"></span>
        <p class="text-xs uppercase tracking-[0.25em] mb-3" style="color: var(--gold);">Acomodações</p>
        <h1 class="font-display text-6xl md:text-7xl" style="color: var(--cream); font-style: italic;">
            Quartos & Suítes
        </h1>
        <p class="mt-6 max-w-xl text-sm leading-relaxed" style="color: var(--muted-2);">
            Cada acomodação é um mundo próprio — pensada para oferecer conforto excepcional, privacidade e detalhes que surpreendem a cada descoberta.
        </p>
    </div>
</section>

<!-- ===== FILTROS ===== -->
<div style="background: var(--ink-2); border-top: 1px solid rgba(201,168,76,0.08); border-bottom: 1px solid rgba(201,168,76,0.08); position: sticky; top: 80px; z-index: 40;">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 py-5">
        <form class="flex flex-wrap items-end gap-5">
            @foreach([
                ['label' => 'Tipo',       'name' => 'type',     'opts' => ['Todos','Deluxe','Premium','Presidencial','Nupcial','Família','Studio']],
                ['label' => 'Check-in',   'name' => 'checkin',  'type' => 'date'],
                ['label' => 'Check-out',  'name' => 'checkout', 'type' => 'date'],
            ] as $f)
            <div>
                <label class="block text-xs uppercase tracking-widest mb-2" style="color: var(--muted-2);">{{ $f['label'] }}</label>
                @if(isset($f['opts']))
                    <select name="{{ $f['name'] }}" class="px-4 py-2 text-xs rounded-sm focus:outline-none"
                            style="background: var(--ink-3); border: 1px solid rgba(201,168,76,0.12); color: var(--cream); min-width: 130px;">
                        @foreach($f['opts'] as $o)<option>{{ $o }}</option>@endforeach
                    </select>
                @else
                    <input type="{{ $f['type'] }}" name="{{ $f['name'] }}"
                           class="px-4 py-2 text-xs rounded-sm focus:outline-none"
                           style="background: var(--ink-3); border: 1px solid rgba(201,168,76,0.12); color: var(--cream);">
                @endif
            </div>
            @endforeach
            <div>
                <label class="block text-xs uppercase tracking-widest mb-2" style="color: var(--muted-2);">Preço</label>
                <select name="price" class="px-4 py-2 text-xs rounded-sm focus:outline-none"
                        style="background: var(--ink-3); border: 1px solid rgba(201,168,76,0.12); color: var(--cream);">
                    <option>Qualquer</option>
                    <option>Até R$ 500</option>
                    <option>R$ 500 – R$ 1.000</option>
                    <option>Acima R$ 1.000</option>
                </select>
            </div>
            <button type="submit" class="btn-gold py-2">Filtrar</button>
        </form>
    </div>
</div>

<!-- ===== GRID DE QUARTOS ===== -->
<section style="background: var(--ink);" class="py-24">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach([
                ['title' => 'Quarto Deluxe',     'price' => 'R$ 450', 'tag' => 'Clássico',    'size' => '35m²', 'guests' => '2', 'rating' => '4.5', 'img' => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=600&q=80',     'items' => ['Cama King','Smart TV 55"','Banheiro mármore','Varanda']],
                ['title' => 'Suite Premium',     'price' => 'R$ 750', 'tag' => 'Mais Pedido', 'size' => '65m²', 'guests' => '2', 'rating' => '4.9', 'img' => 'https://images.unsplash.com/photo-1578683078519-94f3b6c49f15?w=600&q=80',     'items' => ['Sala separada','Jacuzzi','Vista resort','Bar privativo']],
                ['title' => 'Suíte Presidencial','price' => 'R$ 1.200','tag' => 'Exclusivo',  'size' => '150m²','guests' => '4', 'rating' => '5.0', 'img' => 'https://images.unsplash.com/photo-1591088398332-8c716432dd4d?w=600&q=80',     'items' => ['2 Quartos','Cozinha equipada','Varanda 80m²','Home theater']],
                ['title' => 'Suite Nupcial',     'price' => 'R$ 950', 'tag' => 'Romântica',   'size' => '90m²', 'guests' => '2', 'rating' => '5.0', 'img' => 'https://images.unsplash.com/photo-1569495285382-649f3061fb6f?w=600&q=80',     'items' => ['Banhão privado','Iluminação especial','Mini adega','Flores diárias']],
                ['title' => 'Suite Família',     'price' => 'R$ 650', 'tag' => 'Familiar',    'size' => '100m²','guests' => '4', 'rating' => '4.6', 'img' => 'https://images.unsplash.com/photo-1596928519198-83e0b5c8d900?w=600&q=80',     'items' => ['2 Quartos','Área de lazer','Kitchenette','Baby-sitting']],
                ['title' => 'Studio Deluxe',     'price' => 'R$ 350', 'tag' => 'Econômico',   'size' => '28m²', 'guests' => '2', 'rating' => '4.4', 'img' => 'https://images.unsplash.com/photo-1512694712202-b4f91e6ca4eb?w=600&q=80',     'items' => ['Cama Queen','WiFi 1Gbps','Toiletries premium','Vista jardim']],
            ] as $room)
            <div class="card-dark group overflow-hidden">
                <!-- Imagem -->
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ $room['img'] }}" alt="{{ $room['title'] }}"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                         style="filter: brightness(0.8);">
                    <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(10,8,6,0.9) 0%, transparent 55%);"></div>

                    <!-- Tag -->
                    <div class="absolute top-4 left-4">
                        <span class="text-xs uppercase tracking-widest px-3 py-1"
                              style="background: rgba(10,8,6,0.7); color: var(--gold); border: 1px solid rgba(201,168,76,0.3); backdrop-filter: blur(6px); border-radius: 2px;">
                            {{ $room['tag'] }}
                        </span>
                    </div>

                    <!-- Tamanho e hóspedes -->
                    <div class="absolute top-4 right-4 flex gap-2 text-xs" style="color: var(--cream-dim);">
                        <span style="background: rgba(10,8,6,0.6); padding: 4px 8px; backdrop-filter: blur(4px); border-radius: 2px;">{{ $room['size'] }}</span>
                    </div>

                    <!-- Rating -->
                    <div class="absolute bottom-4 right-4 flex items-center gap-1 text-xs"
                         style="color: var(--gold);">
                        <span>★</span>
                        <span style="color: var(--cream-dim);">{{ $room['rating'] }}</span>
                    </div>
                </div>

                <!-- Conteúdo -->
                <div class="p-6">
                    <h3 class="font-display text-2xl mb-4" style="color: var(--cream); font-style: italic;">{{ $room['title'] }}</h3>

                    <!-- Amenidades -->
                    <div class="grid grid-cols-2 gap-y-2 mb-6">
                        @foreach($room['items'] as $item)
                        <div class="flex items-center gap-2 text-xs" style="color: var(--muted-2);">
                            <span style="color: var(--gold-dim);">—</span>
                            {{ $item }}
                        </div>
                        @endforeach
                    </div>

                    <!-- Preço + Botão -->
                    <div class="flex items-center justify-between pt-5" style="border-top: 1px solid rgba(201,168,76,0.1);">
                        <div>
                            <span class="font-display text-2xl" style="color: var(--gold); font-style: italic;">{{ $room['price'] }}</span>
                            <span class="text-xs ml-1" style="color: var(--muted);">/ noite</span>
                        </div>
                        <a href="#" class="btn-gold py-2 px-5 text-xs">Ver Detalhes</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Paginação -->
        <div class="flex items-center justify-center gap-2 mt-16">
            <button class="w-10 h-10 flex items-center justify-center text-xs rounded-sm transition-all duration-200"
                    style="background: var(--ink-3); color: var(--muted-2); border: 1px solid rgba(201,168,76,0.1);">←</button>
            @foreach([1,2,3] as $p)
            <button class="w-10 h-10 flex items-center justify-center text-xs rounded-sm transition-all duration-200"
                    style="{{ $p === 1 ? 'background: var(--gold); color: var(--ink);' : 'background: var(--ink-3); color: var(--muted-2); border: 1px solid rgba(201,168,76,0.1);' }}">
                {{ $p }}
            </button>
            @endforeach
            <button class="w-10 h-10 flex items-center justify-center text-xs rounded-sm transition-all duration-200"
                    style="background: var(--ink-3); color: var(--muted-2); border: 1px solid rgba(201,168,76,0.1);">→</button>
        </div>
    </div>
</section>

<!-- ===== CTA ===== -->
<section class="py-20" style="background: var(--ink-2); border-top: 1px solid rgba(201,168,76,0.1);">
    <div class="max-w-3xl mx-auto px-6 text-center">
        <p class="text-xs uppercase tracking-[0.25em] mb-4" style="color: var(--gold);">Atendimento Exclusivo</p>
        <h2 class="font-display text-4xl mb-4" style="color: var(--cream); font-style: italic;">
            Não encontrou o ideal?
        </h2>
        <p class="text-sm mb-8" style="color: var(--muted-2);">
            Nossa equipe cria experiências sob medida para cada hóspede.
        </p>
        <a href="{{ route('contact') }}" class="btn-gold">Falar com Nossa Equipe</a>
    </div>
</section>

@endsection