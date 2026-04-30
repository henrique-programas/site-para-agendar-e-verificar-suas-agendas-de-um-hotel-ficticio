@extends('layouts.app')

@section('title', 'Check-in — Disponibilidade')

@section('content')
<div style="min-height: 100vh; padding-top: 110px; padding-bottom: 4rem; background: var(--ink);">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">

        <div style="margin-bottom: 2rem; display:flex; align-items:flex-start; justify-content:space-between; gap:1rem; flex-wrap:wrap;">
            <div style="flex:1; min-width:16rem;">
                <span class="line-gold"></span>
                <p class="text-xs uppercase tracking-[0.25em] mb-3" style="color: var(--gold);">Disponibilidade</p>
                <h1 class="font-display text-5xl" style="color: var(--cream); font-style: italic; line-height: 1.1;">
                    Escolha as datas e encontre seu quarto
                </h1>
                <p class="mt-4 text-sm" style="color: var(--muted-2); max-width: 46rem;">
                    O sistema verifica automaticamente se existe alguma reserva que conflita com o período selecionado.
                </p>
            </div>
            <a href="{{ route('dashboard') }}" class="btn-outline" style="padding:0.55rem 1rem; align-self:flex-start;">← Voltar para Minha conta</a>
        </div>

        {{-- Alerts via SweetAlert (layout) --}}

        <div class="card-dark" style="padding: 1.5rem; margin-bottom: 2rem;">
            <form method="GET" action="{{ route('checkin') }}" class="flex flex-wrap items-end gap-4">
                @php
                    $ci = request('check_in');
                    $co = request('check_out');
                    $ciValue = (is_string($ci) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $ci)) ? $ci : '';
                    $coValue = (is_string($co) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $co)) ? $co : '';
                @endphp
                <div>
                    <label class="block text-xs uppercase tracking-widest mb-2" style="color: var(--muted-2);">Check-in</label>
                    <input type="date" name="check_in" value="{{ $ciValue }}"
                           style="padding:0.7rem 0.9rem; background:var(--ink-3); border:1px solid rgba(201,168,76,0.12); color:var(--cream); border-radius:2px; font-size:0.85rem; outline:none;">
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-widest mb-2" style="color: var(--muted-2);">Check-out</label>
                    <input type="date" name="check_out" value="{{ $coValue }}"
                           style="padding:0.7rem 0.9rem; background:var(--ink-3); border:1px solid rgba(201,168,76,0.12); color:var(--cream); border-radius:2px; font-size:0.85rem; outline:none;">
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-widest mb-2" style="color: var(--muted-2);">Hóspedes</label>
                    <select name="guests"
                            style="padding:0.7rem 0.9rem; background:var(--ink-3); border:1px solid rgba(201,168,76,0.12); color:var(--cream); border-radius:2px; font-size:0.85rem; outline:none;">
                        <option value="">Qualquer</option>
                        @for($i=1; $i<=10; $i++)
                            <option value="{{ $i }}" {{ request('guests') == (string)$i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-widest mb-2" style="color: var(--muted-2);">Tipo</label>
                    <select name="type"
                            style="padding:0.7rem 0.9rem; background:var(--ink-3); border:1px solid rgba(201,168,76,0.12); color:var(--cream); border-radius:2px; font-size:0.85rem; outline:none;">
                        <option value="todos" {{ request('type','todos') === 'todos' ? 'selected' : '' }}>Todos</option>
                        <option value="standard"     {{ request('type') === 'standard' ? 'selected' : '' }}>Standard</option>
                        <option value="deluxe"       {{ request('type') === 'deluxe' ? 'selected' : '' }}>Deluxe</option>
                        <option value="suite"        {{ request('type') === 'suite' ? 'selected' : '' }}>Suíte</option>
                        <option value="presidential" {{ request('type') === 'presidential' ? 'selected' : '' }}>Presidencial</option>
                    </select>
                </div>

                <button class="btn-gold" type="submit" style="padding:0.85rem 1.6rem;">
                    Ver disponibilidade
                </button>
            </form>
        </div>

        @if(request('check_in') && request('check_out'))
            @if($rooms->isEmpty())
                <div style="text-align:center; padding:3.5rem 0; color: var(--muted-2);">
                    <div class="font-display" style="font-size:2rem; font-style:italic; color: var(--cream-dim); margin-bottom:0.4rem;">
                        Nenhum quarto disponível
                    </div>
                    <div style="font-size:0.9rem;">
                        Tente outras datas ou reduza a quantidade de hóspedes.
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($rooms as $room)
                        <div class="card-dark overflow-hidden">
                            <div class="p-6">
                                <div class="text-xs uppercase tracking-widest mb-1" style="color: var(--muted-2);">Nº {{ $room->number }}</div>
                                <h3 class="font-display text-2xl mb-3" style="color: var(--cream); font-style: italic;">{{ $room->name }}</h3>
                                <div class="text-xs mb-5" style="color: var(--muted-2);">
                                    {{ ucfirst($room->type) }} · Até {{ $room->capacity }} hósp.
                                </div>

                                <div class="flex items-center justify-between mb-5">
                                    <div>
                                        <span class="font-display text-2xl" style="color: var(--gold); font-style: italic;">
                                            R$ {{ number_format($room->price_per_night, 0, ',', '.') }}
                                        </span>
                                        <span class="text-xs ml-1" style="color: var(--muted);">/ noite</span>
                                    </div>
                                    <a href="{{ route('room.detail', $room) }}" class="btn-outline" style="padding:0.55rem 1rem;">
                                        Ver
                                    </a>
                                </div>

                                <form method="POST" action="{{ route('reservation.store', $room) }}">
                                    @csrf
                                    <input type="hidden" name="check_in" value="{{ request('check_in') }}">
                                    <input type="hidden" name="check_out" value="{{ request('check_out') }}">
                                    <input type="hidden" name="guests" value="{{ request('guests', 1) }}">
                                    <button type="submit" class="btn-gold w-full justify-center" style="width:100%;">
                                        Reservar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @else
            <div style="text-align:center; padding:3.5rem 0; color: var(--muted-2);">
                Escolha as datas acima para ver os quartos disponíveis.
            </div>
        @endif

    </div>
</div>
@endsection

