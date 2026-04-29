@extends('layouts.admin')

@section('page-title', 'Quartos')
@section('breadcrumb', 'Quartos')

@section('content')
<style>
    .page-actions { display:flex; align-items:center; justify-content:space-between; margin-bottom:1.75rem; gap:1rem; flex-wrap:wrap; }
    .page-desc { font-size:0.82rem; color:#5c5040; }
    .btn-gold { display:inline-flex; align-items:center; gap:0.5rem; padding:0.65rem 1.4rem; background:#c9a84c; color:#0a0806; border:none; border-radius:2px; font-size:0.75rem; font-weight:500; letter-spacing:0.1em; text-transform:uppercase; cursor:pointer; text-decoration:none; transition:background 0.2s; font-family:'DM Sans',sans-serif; }
    .btn-gold:hover { background:#e2c47a; }
    .filters { display:flex; gap:0.75rem; margin-bottom:1.5rem; flex-wrap:wrap; }
    .filter-select, .filter-input { padding:0.55rem 0.9rem; background:#1c1610; border:1px solid rgba(201,168,76,0.12); color:#c8bba5; border-radius:2px; font-size:0.8rem; outline:none; font-family:'DM Sans',sans-serif; transition:border-color 0.2s; }
    .filter-select:focus, .filter-input:focus { border-color:rgba(201,168,76,0.35); }
    .filter-input::placeholder { color:#5c5040; }
    .rooms-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:1.25rem; }
    .room-card { background:#1c1610; border:1px solid rgba(201,168,76,0.08); border-radius:3px; overflow:hidden; transition:border-color 0.2s, transform 0.2s; }
    .room-card:hover { border-color:rgba(201,168,76,0.22); transform:translateY(-2px); }
    .room-img { position:relative; height:180px; overflow:hidden; }
    .room-img img { width:100%; height:100%; object-fit:cover; filter:brightness(0.75); transition:transform 0.4s; }
    .room-card:hover .room-img img { transform:scale(1.04); }
    .room-img .room-status { position:absolute; top:0.75rem; right:0.75rem; }
    .room-img .room-type  { position:absolute; top:0.75rem; left:0.75rem; }
    .badge { display:inline-block; padding:0.2rem 0.65rem; border-radius:2px; font-size:0.62rem; letter-spacing:0.1em; text-transform:uppercase; }
    .badge-green  { background:rgba(60,160,100,0.15);  color:#5cc890; border:1px solid rgba(60,160,100,0.3); }
    .badge-yellow { background:rgba(201,168,76,0.15);  color:#c9a84c; border:1px solid rgba(201,168,76,0.3); }
    .badge-red    { background:rgba(200,70,70,0.15);   color:#e07070; border:1px solid rgba(200,70,70,0.3); }
    .badge-gray   { background:rgba(140,130,120,0.12); color:#8a7560; border:1px solid rgba(140,130,120,0.25); }
    .room-body { padding:1.1rem 1.25rem; }
    .room-number { font-size:0.62rem; letter-spacing:0.2em; text-transform:uppercase; color:#5c5040; margin-bottom:0.25rem; }
    .room-name   { font-family:'Cormorant Garamond',serif; font-size:1.25rem; color:#f0e8d5; font-style:italic; margin-bottom:0.15rem; }
    .room-price  { font-size:0.8rem; color:#c9a84c; }
    .room-price span { color:#5c5040; }
    .room-amenities { display:flex; gap:0.5rem; flex-wrap:wrap; margin:0.75rem 0; }
    .amenity-tag { font-size:0.65rem; padding:0.15rem 0.5rem; background:rgba(201,168,76,0.06); border:1px solid rgba(201,168,76,0.1); color:#8a7560; border-radius:2px; }
    .room-actions { display:flex; gap:0.5rem; padding:0.75rem 1.25rem; border-top:1px solid rgba(201,168,76,0.06); }
    .btn-sm { padding:0.4rem 0.85rem; font-size:0.7rem; letter-spacing:0.08em; text-transform:uppercase; border-radius:2px; cursor:pointer; text-decoration:none; transition:all 0.2s; font-family:'DM Sans',sans-serif; }
    .btn-sm-gold    { background:rgba(201,168,76,0.12); border:1px solid rgba(201,168,76,0.25); color:#c9a84c; }
    .btn-sm-gold:hover { background:rgba(201,168,76,0.2); }
    .btn-sm-outline { background:transparent; border:1px solid rgba(201,168,76,0.2); color:#8a7560; }
    .btn-sm-outline:hover { border-color:rgba(201,168,76,0.4); color:#c8bba5; }
    .btn-sm-danger  { background:transparent; border:1px solid rgba(200,70,70,0.2); color:#8a7560; margin-left:auto; }
    .btn-sm-danger:hover { border-color:rgba(200,70,70,0.4); color:#e07070; }
    .empty-state { text-align:center; padding:4rem 2rem; background:#1c1610; border:1px solid rgba(201,168,76,0.08); border-radius:3px; }
    .empty-state p { font-family:'Cormorant Garamond',serif; font-size:1.3rem; color:#5c5040; font-style:italic; margin-bottom:1rem; }
    .pagination-wrap { margin-top:1.5rem; display:flex; justify-content:center; }
    .pagination-wrap nav { display:flex; gap:0.35rem; }
</style>

<div class="page-actions">
    <div>
        <div style="font-family:'Cormorant Garamond',serif; font-size:1.1rem; color:#f0e8d5; font-style:italic; margin-bottom:0.2rem;">
            {{ $rooms->total() }} {{ Str::plural('quarto', $rooms->total()) }} cadastrado{{ $rooms->total() != 1 ? 's' : '' }}
        </div>
        <div class="page-desc">Gerencie a disponibilidade e informações dos quartos</div>
    </div>
    <a href="{{ route('admin.quartos.create') }}" class="btn-gold">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
        Novo Quarto
    </a>
</div>

<form method="GET" class="filters">
    <input type="text" name="search" class="filter-input" placeholder="Buscar quarto..." value="{{ request('search') }}" style="min-width:200px;">
    <select name="type" class="filter-select" onchange="this.form.submit()">
        <option value="">Todos os tipos</option>
        <option value="deluxe"       {{ request('type') === 'deluxe'       ? 'selected' : '' }}>Deluxe</option>
        <option value="premium"      {{ request('type') === 'premium'      ? 'selected' : '' }}>Premium</option>
        <option value="presidencial" {{ request('type') === 'presidencial' ? 'selected' : '' }}>Presidencial</option>
    </select>
    <select name="status" class="filter-select" onchange="this.form.submit()">
        <option value="">Todos os status</option>
        <option value="disponivel" {{ request('status') === 'disponivel' ? 'selected' : '' }}>Disponível</option>
        <option value="ocupado"    {{ request('status') === 'ocupado'    ? 'selected' : '' }}>Ocupado</option>
        <option value="manutencao" {{ request('status') === 'manutencao' ? 'selected' : '' }}>Manutenção</option>
    </select>
    @if(request()->hasAny(['search','type','status']))
        <a href="{{ route('admin.quartos.index') }}" style="font-size:0.75rem; color:#8a7560; text-decoration:none; align-self:center;" onmouseover="this.style.color='#e07070'" onmouseout="this.style.color='#8a7560'">✕ Limpar filtros</a>
    @endif
</form>

@if($rooms->isEmpty())
    <div class="empty-state">
        <p>Nenhum quarto cadastrado ainda</p>
        <a href="{{ route('admin.quartos.create') }}" class="btn-gold">+ Adicionar primeiro quarto</a>
    </div>
@else
    <div class="rooms-grid">
        @foreach($rooms as $room)
        <div class="room-card">
            <div class="room-img">
                @if($room->image_url)
                    <img src="{{ $room->image_url }}" alt="{{ $room->name }}">
                @else
                    <div style="width:100%; height:100%; background:rgba(201,168,76,0.05); display:flex; align-items:center; justify-content:center;">
                        <svg width="40" height="40" fill="none" stroke="rgba(201,168,76,0.3)" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21"/></svg>
                    </div>
                @endif
                <div class="room-type">
                    <span class="badge badge-yellow" style="backdrop-filter:blur(4px);">{{ ucfirst($room->type) }}</span>
                </div>
                <div class="room-status">
                    @if($room->status === 'disponivel')     <span class="badge badge-green" style="backdrop-filter:blur(4px);">Disponível</span>
                    @elseif($room->status === 'ocupado')    <span class="badge badge-red"   style="backdrop-filter:blur(4px);">Ocupado</span>
                    @else                                   <span class="badge badge-gray"  style="backdrop-filter:blur(4px);">Manutenção</span>
                    @endif
                </div>
            </div>
            <div class="room-body">
                <div class="room-number">Nº {{ $room->number }}</div>
                <div class="room-name">{{ $room->name }}</div>
                <div class="room-price">{{ $room->formatted_price }} <span>/ noite</span></div>
                @if($room->amenities)
                <div class="room-amenities">
                    @foreach(array_slice($room->amenities, 0, 4) as $a)
                        <span class="amenity-tag">{{ $a }}</span>
                    @endforeach
                    @if(count($room->amenities) > 4)
                        <span class="amenity-tag">+{{ count($room->amenities) - 4 }}</span>
                    @endif
                </div>
                @endif
            </div>
            <div class="room-actions">
                <a href="{{ route('admin.quartos.edit', $room) }}" class="btn-sm btn-sm-gold">Editar</a>
                <form method="POST" action="{{ route('admin.quartos.destroy', $room) }}"
                      onsubmit="return confirm('Remover o quarto Nº {{ $room->number }}?')" style="margin-left:auto;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-sm btn-sm-danger">Remover</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <div class="pagination-wrap">
        {{ $rooms->links() }}
    </div>
@endif
@endsection
