@extends('layouts.admin')

@section('page-title', 'Reservas')
@section('breadcrumb', 'Reservas')

@section('content')
<style>
    .page-actions { display:flex; align-items:center; justify-content:space-between; margin-bottom:1.75rem; gap:1rem; flex-wrap:wrap; }
    .page-desc { font-size:0.82rem; color:#5c5040; }
    .summary-row { display:flex; gap:1rem; margin-bottom:1.75rem; flex-wrap:wrap; }
    .summary-pill { display:flex; align-items:center; gap:0.6rem; padding:0.6rem 1.1rem; background:#1c1610; border:1px solid rgba(201,168,76,0.1); border-radius:2px; font-size:0.78rem; color:#8a7560; }
    .summary-pill strong { color:#f0e8d5; font-size:1rem; font-family:'Cormorant Garamond',serif; font-style:italic; }
    .filters { display:flex; gap:0.75rem; margin-bottom:1.25rem; flex-wrap:wrap; align-items:center; }
    .filter-select, .filter-input { padding:0.55rem 0.9rem; background:#1c1610; border:1px solid rgba(201,168,76,0.12); color:#c8bba5; border-radius:2px; font-size:0.8rem; outline:none; font-family:'DM Sans',sans-serif; transition:border-color 0.2s; }
    .filter-select:focus, .filter-input:focus { border-color:rgba(201,168,76,0.35); }
    .filter-input::placeholder { color:#5c5040; }
    .table-wrap { background:#1c1610; border:1px solid rgba(201,168,76,0.08); border-radius:3px; overflow:hidden; }
    table { width:100%; border-collapse:collapse; }
    thead th { font-size:0.62rem; text-transform:uppercase; letter-spacing:0.18em; color:#5c5040; padding:0.9rem 1.25rem; border-bottom:1px solid rgba(201,168,76,0.07); text-align:left; font-weight:400; white-space:nowrap; }
    tbody td { font-size:0.83rem; color:#c8bba5; padding:0.9rem 1.25rem; border-bottom:1px solid rgba(201,168,76,0.05); vertical-align:middle; }
    tbody tr:last-child td { border-bottom:none; }
    tbody tr:hover td { background:rgba(201,168,76,0.03); }
    .guest-cell { display:flex; align-items:center; gap:0.65rem; }
    .guest-avatar { width:30px; height:30px; border-radius:50%; background:rgba(201,168,76,0.1); border:1px solid rgba(201,168,76,0.2); display:flex; align-items:center; justify-content:center; font-size:0.7rem; color:#c9a84c; font-family:'Cormorant Garamond',serif; font-style:italic; flex-shrink:0; }
    .guest-name  { font-size:0.85rem; color:#f0e8d5; }
    .guest-email { font-size:0.7rem; color:#5c5040; }
    .badge { display:inline-block; padding:0.2rem 0.65rem; border-radius:2px; font-size:0.62rem; letter-spacing:0.1em; text-transform:uppercase; white-space:nowrap; }
    .badge-green  { background:rgba(60,160,100,0.12);  color:#5cc890; border:1px solid rgba(60,160,100,0.25); }
    .badge-yellow { background:rgba(201,168,76,0.12);  color:#c9a84c; border:1px solid rgba(201,168,76,0.25); }
    .badge-red    { background:rgba(200,70,70,0.12);   color:#e07070; border:1px solid rgba(200,70,70,0.25); }
    .badge-blue   { background:rgba(70,130,200,0.12);  color:#70a8e0; border:1px solid rgba(70,130,200,0.25); }
    .badge-gray   { background:rgba(140,130,120,0.1);  color:#8a7560; border:1px solid rgba(140,130,120,0.2); }
    .actions-cell { display:flex; gap:0.4rem; align-items:center; }
    .btn-sm { padding:0.3rem 0.7rem; font-size:0.65rem; letter-spacing:0.06em; text-transform:uppercase; border-radius:2px; cursor:pointer; text-decoration:none; transition:all 0.2s; font-family:'DM Sans',sans-serif; white-space:nowrap; border:none; }
    .btn-sm-outline { background:transparent; border:1px solid rgba(201,168,76,0.18); color:#8a7560; }
    .btn-sm-outline:hover { border-color:rgba(201,168,76,0.35); color:#c8bba5; }
    .btn-sm-danger { background:transparent; border:1px solid rgba(200,70,70,0.18); color:#8a7560; }
    .btn-sm-danger:hover { border-color:rgba(200,70,70,0.4); color:#e07070; }
    .status-select { padding:0.25rem 0.5rem; background:#110e0a; border:1px solid rgba(201,168,76,0.15); color:#c8bba5; border-radius:2px; font-size:0.72rem; outline:none; font-family:'DM Sans',sans-serif; cursor:pointer; }
    .empty-row td { text-align:center; color:#5c5040; font-style:italic; font-family:'Cormorant Garamond',serif; padding:3rem; }
</style>

<div class="page-actions">
    <div>
        <div style="font-family:'Cormorant Garamond',serif; font-size:1.1rem; color:#f0e8d5; font-style:italic; margin-bottom:0.2rem;">
            Todas as Reservas
        </div>
        <div class="page-desc">Gerencie check-ins, check-outs e confirmações</div>
    </div>
</div>

<div class="summary-row">
    <div class="summary-pill"><strong>{{ $counts['total'] }}</strong> Total do Mês</div>
    <div class="summary-pill"><strong style="color:#5cc890;">{{ $counts['confirmado'] }}</strong> Confirmadas</div>
    <div class="summary-pill"><strong style="color:#c9a84c;">{{ $counts['pendente'] }}</strong> Pendentes</div>
    <div class="summary-pill"><strong style="color:#e07070;">{{ $counts['cancelado'] }}</strong> Canceladas</div>
    <div class="summary-pill"><strong style="color:#70a8e0;">{{ $counts['andamento'] }}</strong> Em Andamento</div>
</div>

<form method="GET" class="filters">
    <input type="text" name="search" class="filter-input" placeholder="Buscar hóspede..." value="{{ request('search') }}" style="min-width:220px;">
    <select name="status" class="filter-select" onchange="this.form.submit()">
        <option value="">Todos os status</option>
        @foreach(['pendente'=>'Pendente','confirmado'=>'Confirmado','andamento'=>'Em Andamento','concluido'=>'Concluído','cancelado'=>'Cancelado'] as $v => $l)
            <option value="{{ $v }}" {{ request('status') === $v ? 'selected' : '' }}>{{ $l }}</option>
        @endforeach
    </select>
    <select name="tipo" class="filter-select" onchange="this.form.submit()">
        <option value="">Todos os tipos</option>
        <option value="deluxe"       {{ request('tipo') === 'deluxe'       ? 'selected' : '' }}>Deluxe</option>
        <option value="premium"      {{ request('tipo') === 'premium'      ? 'selected' : '' }}>Premium</option>
        <option value="presidencial" {{ request('tipo') === 'presidencial' ? 'selected' : '' }}>Presidencial</option>
    </select>
    @if(request()->hasAny(['search','status','tipo']))
        <a href="{{ route('admin.reservas.index') }}" style="font-size:0.75rem; color:#8a7560; text-decoration:none; align-self:center;" onmouseover="this.style.color='#e07070'" onmouseout="this.style.color='#8a7560'">✕ Limpar</a>
    @endif
</form>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Hóspede</th>
                <th>Quarto</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Noites</th>
                <th>Total</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservations as $r)
            <tr>
                <td style="color:#5c5040; font-size:0.75rem;">#{{ $r->id }}</td>
                <td>
                    <div class="guest-cell">
                        <div class="guest-avatar">{{ substr($r->user->name, 0, 1) }}</div>
                        <div>
                            <div class="guest-name">{{ $r->user->name }}</div>
                            <div class="guest-email">{{ $r->user->email }}</div>
                        </div>
                    </div>
                </td>
                <td>{{ $r->room->name ?? '—' }} {{ $r->room ? 'Nº'.$r->room->number : '' }}</td>
                <td>{{ $r->check_in->format('d/m/Y') }}</td>
                <td>{{ $r->check_out->format('d/m/Y') }}</td>
                <td style="text-align:center;">{{ $r->nights }}</td>
                <td style="color:#c9a84c; font-weight:500;">{{ $r->formatted_total }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.reservas.status', $r) }}">
                        @csrf @method('PATCH')
                        <select name="status" class="status-select" onchange="this.form.submit()">
                            @foreach(['pendente'=>'Pendente','confirmado'=>'Confirmado','andamento'=>'Andamento','concluido'=>'Concluído','cancelado'=>'Cancelado'] as $v => $l)
                                <option value="{{ $v }}" {{ $r->status === $v ? 'selected' : '' }}>{{ $l }}</option>
                            @endforeach
                        </select>
                    </form>
                </td>
                <td>
                    <div class="actions-cell">
                        <form method="POST" action="{{ route('admin.reservas.destroy', $r) }}"
                              onsubmit="return confirm('Remover esta reserva?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-sm btn-sm-danger">✕</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr class="empty-row"><td colspan="9">Nenhuma reserva encontrada</td></tr>
            @endforelse
        </tbody>
    </table>

    @if($reservations->hasPages())
    <div style="padding:0.9rem 1.25rem; border-top:1px solid rgba(201,168,76,0.07); display:flex; align-items:center; justify-content:space-between;">
        <div style="font-size:0.75rem; color:#5c5040;">
            Exibindo {{ $reservations->firstItem() }}–{{ $reservations->lastItem() }} de {{ $reservations->total() }}
        </div>
        <div>{{ $reservations->links() }}</div>
    </div>
    @endif
</div>
@endsection
