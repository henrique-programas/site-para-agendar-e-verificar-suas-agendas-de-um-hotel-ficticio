@if($rooms->isEmpty())
    <div style="text-align:center; padding:5rem 0;">
        <p class="font-display text-3xl mb-4" style="color: var(--muted); font-style: italic;">
            Nenhum quarto encontrado
        </p>
        <a href="{{ route('rooms') }}" class="btn-outline">Ver todos os quartos</a>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($rooms as $room)
        <div class="card-dark group overflow-hidden">
            <!-- Imagem -->
            <div class="relative h-64 overflow-hidden">
                @if($room->image_url)
                    <img src="{{ $room->image_url }}" alt="{{ $room->name }}"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                         style="filter: brightness(0.8);">
                @else
                    <div class="w-full h-full flex items-center justify-center"
                         style="background: var(--ink-3);">
                        <svg width="48" height="48" fill="none" stroke="rgba(201,168,76,0.2)" stroke-width="1" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21"/>
                        </svg>
                    </div>
                @endif
                <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(10,8,6,0.9) 0%, transparent 55%);"></div>

                {{-- Tag tipo --}}
                <div class="absolute top-4 left-4">
                    <span class="text-xs uppercase tracking-widest px-3 py-1"
                          style="background: rgba(10,8,6,0.7); color: var(--gold); border: 1px solid rgba(201,168,76,0.3); backdrop-filter: blur(6px); border-radius: 2px;">
                        {{ ucfirst($room->type) }}
                    </span>
                </div>

                {{-- Capacidade --}}
                <div class="absolute top-4 right-4 text-xs"
                     style="background: rgba(10,8,6,0.6); padding: 4px 8px; backdrop-filter: blur(4px); border-radius: 2px; color: var(--cream-dim);">
                    {{ $room->capacity }} hósp.
                </div>

                {{-- Status --}}
                @if($room->status !== 'disponivel')
                <div class="absolute bottom-4 left-4">
                    <span class="text-xs px-3 py-1"
                          style="background: rgba(200,70,70,0.15); color: #e07070; border: 1px solid rgba(200,70,70,0.3); border-radius: 2px; backdrop-filter: blur(4px);">
                        {{ $room->status === 'manutencao' ? 'Em manutenção' : 'Ocupado' }}
                    </span>
                </div>
                @endif
            </div>

            <!-- Conteúdo -->
            <div class="p-6">
                <div class="text-xs uppercase tracking-widest mb-1" style="color: var(--muted-2);">Nº {{ $room->number }}</div>
                <h3 class="font-display text-2xl mb-4" style="color: var(--cream); font-style: italic;">{{ $room->name }}</h3>

                {{-- Comodidades --}}
                @if($room->amenities)
                <div class="grid grid-cols-2 gap-y-2 mb-6">
                    @foreach(array_slice($room->amenities, 0, 4) as $item)
                    <div class="flex items-center gap-2 text-xs" style="color: var(--muted-2);">
                        <span style="color: var(--gold-dim);">—</span>{{ $item }}
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- Descrição curta --}}
                @if($room->description)
                <p class="text-xs leading-relaxed mb-5" style="color: var(--muted-2);">
                    {{ Str::limit($room->description, 80) }}
                </p>
                @endif

                <!-- Preço + Botão -->
                <div class="flex items-center justify-between pt-5" style="border-top: 1px solid rgba(201,168,76,0.1);">
                    <div>
                        <span class="font-display text-2xl" style="color: var(--gold); font-style: italic;">
                            R$ {{ number_format($room->price_per_night, 0, ',', '.') }}
                        </span>
                        <span class="text-xs ml-1" style="color: var(--muted);">/ noite</span>
                    </div>
                    <a href="{{ route('room.detail', $room) }}" class="btn-gold py-2 px-5 text-xs">
                        Saber Mais
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Paginação --}}
    @if($rooms->hasPages())
    <div class="flex items-center justify-center gap-2 mt-16">
        {{ $rooms->onEachSide(1)->links('pagination::simple-tailwind') }}
    </div>
    @endif
@endif
