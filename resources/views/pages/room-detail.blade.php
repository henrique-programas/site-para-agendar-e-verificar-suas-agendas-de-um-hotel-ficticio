@extends('layouts.app')
@section('title', $room->name . ' — Calm Mind Resort & Spa')

@section('content')

<!-- ===== HERO COM IMAGEM DO QUARTO ===== -->
<section class="relative h-[70vh] min-h-[520px] overflow-hidden">
    @if($room->image_url)
        <div class="absolute inset-0" style="
            background-image: url('{{ $room->image_url }}');
            background-size: cover;
            background-position: center;
            filter: brightness(0.45);
        "></div>
    @else
        <div class="absolute inset-0" style="background: var(--ink-3);"></div>
    @endif

    <div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(10,8,6,0.5) 0%, transparent 40%, var(--ink) 100%);"></div>
    <div class="absolute inset-0" style="background: linear-gradient(to right, rgba(10,8,6,0.4) 0%, transparent 60%);"></div>

    <div class="relative h-full flex items-end pb-16 px-6 lg:px-20 max-w-7xl mx-auto">
        <div>
            <a href="{{ route('rooms') }}"
               class="inline-flex items-center gap-2 text-xs uppercase tracking-widest mb-8"
               style="color: var(--muted-2); text-decoration:none;"
               onmouseover="this.style.color='var(--gold)'" onmouseout="this.style.color='var(--muted-2)'">
                ← Voltar às acomodações
            </a>
            <div class="flex items-center gap-3 mb-3">
                <span class="text-xs uppercase tracking-[0.25em]" style="color: var(--gold);">{{ ucfirst($room->type) }}</span>
                <span style="color: var(--muted-2);">·</span>
                <span class="text-xs" style="color: var(--muted-2);">Nº {{ $room->number }}</span>
                <span style="color: var(--muted-2);">·</span>
                <span class="text-xs" style="color: var(--muted-2);">{{ $room->capacity }} hóspede{{ $room->capacity > 1 ? 's' : '' }}</span>
            </div>
            <h1 class="font-display text-6xl md:text-7xl" style="color: var(--cream); font-style: italic; line-height: 1;">
                {{ $room->name }}
            </h1>
        </div>
    </div>
</section>

<!-- ===== CONTEÚDO PRINCIPAL ===== -->
<section style="background: var(--ink);" class="py-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-20">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">

            <!-- ── Coluna principal ── -->
            <div class="lg:col-span-2">

                {{-- Status --}}
                @if($room->status !== 'disponivel')
                <div style="background: rgba(200,70,70,0.08); border: 1px solid rgba(200,70,70,0.2); color: #e07070; padding: 0.75rem 1rem; border-radius: 2px; font-size: 0.82rem; margin-bottom: 2rem;">
                    Este quarto está {{ $room->status === 'manutencao' ? 'em manutenção' : 'ocupado' }} no momento.
                </div>
                @endif

                {{-- Descrição --}}
                <div class="mb-12">
                    <span class="line-gold"></span>
                    <p class="text-xs uppercase tracking-[0.25em] mb-4" style="color: var(--gold);">Sobre o Quarto</p>
                    @if($room->description)
                        <p class="text-base leading-relaxed" style="color: var(--cream-dim);">
                            {{ $room->description }}
                        </p>
                    @else
                        <p class="text-base leading-relaxed" style="color: var(--muted-2);">
                            Uma acomodação {{ ucfirst($room->type) }} cuidadosamente projetada para proporcionar conforto e elegância excepcionais durante a sua estadia no Calm Mind Resort & Spa.
                        </p>
                    @endif
                </div>

                {{-- Comodidades --}}
                @if($room->amenities && count($room->amenities) > 0)
                <div class="mb-12">
                    <span class="line-gold"></span>
                    <p class="text-xs uppercase tracking-[0.25em] mb-6" style="color: var(--gold);">Comodidades</p>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @foreach($room->amenities as $amenity)
                        <div class="flex items-center gap-3 p-4 rounded-sm"
                             style="background: var(--ink-3); border: 1px solid rgba(201,168,76,0.08);">
                            <span style="color: var(--gold); font-size: 0.7rem;">✦</span>
                            <span class="text-sm" style="color: var(--cream-dim);">{{ $amenity }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Política --}}
                <div>
                    <span class="line-gold"></span>
                    <p class="text-xs uppercase tracking-[0.25em] mb-6" style="color: var(--gold);">Informações</p>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        @foreach([
                            ['Check-in',  '15h00',              'Recepção disponível 24h'],
                            ['Check-out', '12h00',              'Late check-out sob consulta'],
                            ['Café',      'Incluso',            'Servido das 7h às 10h30'],
                        ] as $info)
                        <div style="border-left: 1px solid rgba(201,168,76,0.2); padding-left: 1rem;">
                            <div class="text-xs uppercase tracking-widest mb-1" style="color: var(--muted-2);">{{ $info[0] }}</div>
                            <div class="font-display text-xl mb-1" style="color: var(--cream); font-style: italic;">{{ $info[1] }}</div>
                            <div class="text-xs" style="color: var(--muted-2);">{{ $info[2] }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>

            <!-- ── Sidebar — Reserva ── -->
            <div>
                <div style="background: var(--ink-2); border: 1px solid rgba(201,168,76,0.12); border-radius: 3px; padding: 2rem; position: sticky; top: 100px;">

                    <span class="block w-10 h-px mb-5" style="background: var(--gold);"></span>
                    <p class="text-xs uppercase tracking-[0.2em] mb-1" style="color: var(--muted-2);">Diária a partir de</p>
                    <div class="font-display mb-6" style="font-style: italic;">
                        <span style="font-size: 3rem; color: var(--gold); line-height: 1;">
                            R$ {{ number_format($room->price_per_night, 0, ',', '.') }}
                        </span>
                        <span class="text-sm" style="color: var(--muted);">/ noite</span>
                    </div>

                    @if($room->status === 'disponivel')
                        <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                            <div>
                                <label class="block text-xs uppercase tracking-widest mb-2" style="color: var(--muted-2);">Check-in</label>
                                <input type="date" style="width:100%; padding:0.7rem 0.9rem; background:var(--ink-3); border:1px solid rgba(201,168,76,0.12); color:var(--cream); border-radius:2px; font-size:0.85rem; outline:none;">
                            </div>
                            <div>
                                <label class="block text-xs uppercase tracking-widest mb-2" style="color: var(--muted-2);">Check-out</label>
                                <input type="date" style="width:100%; padding:0.7rem 0.9rem; background:var(--ink-3); border:1px solid rgba(201,168,76,0.12); color:var(--cream); border-radius:2px; font-size:0.85rem; outline:none;">
                            </div>
                            <div>
                                <label class="block text-xs uppercase tracking-widest mb-2" style="color: var(--muted-2);">Hóspedes</label>
                                <select style="width:100%; padding:0.7rem 0.9rem; background:var(--ink-3); border:1px solid rgba(201,168,76,0.12); color:var(--cream); border-radius:2px; font-size:0.85rem; outline:none;">
                                    @for($i = 1; $i <= $room->capacity; $i++)
                                        <option>{{ $i }} hóspede{{ $i > 1 ? 's' : '' }}</option>
                                    @endfor
                                </select>
                            </div>
                            <button class="btn-gold w-full justify-center mt-2" style="width:100%;">
                                Reservar Agora
                            </button>
                        </div>
                        <p class="text-xs text-center mt-4" style="color: var(--muted-2);">
                            Ou fale conosco pelo <a href="{{ route('contact') }}" style="color: var(--gold);">chat</a>
                        </p>
                    @else
                        <div style="text-align:center; padding: 1rem 0;">
                            <p class="text-sm mb-4" style="color: var(--muted-2);">
                                Este quarto não está disponível no momento.
                            </p>
                            <a href="{{ route('rooms') }}" class="btn-outline" style="display:inline-block;">
                                Ver outros quartos
                            </a>
                        </div>
                    @endif

                    {{-- Garantias --}}
                    <div style="border-top: 1px solid rgba(201,168,76,0.08); margin-top: 1.5rem; padding-top: 1.5rem;">
                        @foreach(['Cancelamento gratuito até 48h', 'Café da manhã incluso', 'WiFi de alta velocidade'] as $g)
                        <div class="flex items-center gap-2 text-xs mb-2" style="color: var(--muted-2);">
                            <span style="color: var(--gold);">✓</span> {{ $g }}
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===== QUARTOS RELACIONADOS ===== -->
@if($relacionados->isNotEmpty())
<section style="background: var(--ink-2); border-top: 1px solid rgba(201,168,76,0.08);" class="py-24">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="flex items-end justify-between mb-12">
            <div>
                <span class="line-gold"></span>
                <p class="text-xs uppercase tracking-[0.25em] mb-3" style="color: var(--gold);">Outras Acomodações</p>
                <h2 class="font-display text-4xl" style="color: var(--cream); font-style: italic;">Você também pode gostar</h2>
            </div>
            <a href="{{ route('rooms') }}" class="btn-outline hidden md:inline-flex">Ver todos →</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($relacionados as $rel)
            <div class="card-dark group overflow-hidden">
                <div class="relative h-52 overflow-hidden">
                    @if($rel->image_url)
                        <img src="{{ $rel->image_url }}" alt="{{ $rel->name }}"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                             style="filter: brightness(0.75);">
                    @else
                        <div class="w-full h-full flex items-center justify-center" style="background: var(--ink-3);">
                            <svg width="36" height="36" fill="none" stroke="rgba(201,168,76,0.2)" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18"/></svg>
                        </div>
                    @endif
                    <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(10,8,6,0.85) 0%, transparent 55%);"></div>
                    <div class="absolute bottom-4 left-4">
                        <h3 class="font-display text-xl" style="color: var(--cream); font-style: italic;">{{ $rel->name }}</h3>
                        <span class="text-xs" style="color: var(--gold);">
                            R$ {{ number_format($rel->price_per_night, 0, ',', '.') }} / noite
                        </span>
                    </div>
                </div>
                <div class="p-4 flex items-center justify-between" style="border-top: 1px solid rgba(201,168,76,0.08);">
                    <span class="text-xs uppercase tracking-widest" style="color: var(--muted-2);">{{ ucfirst($rel->type) }}</span>
                    <a href="{{ route('room.detail', $rel) }}" class="text-xs uppercase tracking-widest" style="color: var(--gold);">
                        Saber mais →
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
