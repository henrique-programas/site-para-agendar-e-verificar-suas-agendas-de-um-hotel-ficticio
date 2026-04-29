@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')
<style>
    .stats-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:1.25rem; margin-bottom:2.5rem; }
    .stat-card { background:#1c1610; border:1px solid rgba(201,168,76,0.1); border-radius:3px; padding:1.5rem 1.75rem; display:flex; align-items:flex-start; justify-content:space-between; transition:border-color 0.2s; }
    .stat-card:hover { border-color:rgba(201,168,76,0.25); }
    .stat-label { font-size:0.65rem; text-transform:uppercase; letter-spacing:0.2em; color:#5c5040; margin-bottom:0.5rem; }
    .stat-value { font-family:'Cormorant Garamond',serif; font-size:2.8rem; color:#f0e8d5; font-style:italic; line-height:1; }
    .stat-sub { font-size:0.72rem; color:#5c5040; margin-top:0.4rem; }
    .stat-sub.up { color:#5cc890; }
    .stat-icon { width:40px; height:40px; border-radius:2px; display:flex; align-items:center; justify-content:center; background:rgba(201,168,76,0.08); border:1px solid rgba(201,168,76,0.15); flex-shrink:0; }
    .stat-icon svg { width:20px; height:20px; color:#c9a84c; }
    .section-title { font-family:'Cormorant Garamond',serif; font-size:1.4rem; color:#f0e8d5; font-style:italic; margin-bottom:1rem; }
    .section-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:1rem; }
    .link-gold { font-size:0.72rem; text-transform:uppercase; letter-spacing:0.12em; color:#c9a84c; text-decoration:none; transition:color 0.2s; }
    .link-gold:hover { color:#e2c47a; }
    .table-wrap { background:#1c1610; border:1px solid rgba(201,168,76,0.08); border-radius:3px; overflow:hidden; }
    table { width:100%; border-collapse:collapse; }
    thead th { font-size:0.62rem; text-transform:uppercase; letter-spacing:0.18em; color:#5c5040; padding:0.9rem 1.25rem; border-bottom:1px solid rgba(201,168,76,0.07); text-align:left; font-weight:400; }
    tbody td { font-size:0.83rem; color:#c8bba5; padding:0.85rem 1.25rem; border-bottom:1px solid rgba(201,168,76,0.05); }
    tbody tr:last-child td { border-bottom:none; }
    tbody tr:hover td { background:rgba(201,168,76,0.03); }
    .badge { display:inline-block; padding:0.2rem 0.65rem; border-radius:2px; font-size:0.62rem; letter-spacing:0.1em; text-transform:uppercase; }
    .badge-green  { background:rgba(60,160,100,0.12); color:#5cc890; border:1px solid rgba(60,160,100,0.25); }
    .badge-yellow { background:rgba(201,168,76,0.12); color:#c9a84c; border:1px solid rgba(201,168,76,0.25); }
    .badge-red    { background:rgba(200,70,70,0.12);  color:#e07070; border:1px solid rgba(200,70,70,0.25); }
    .badge-blue   { background:rgba(70,130,200,0.12); color:#70a8e0; border:1px solid rgba(70,130,200,0.25); }
    .badge-gray   { background:rgba(140,130,120,0.1); color:#8a7560; border:1px solid rgba(140,130,120,0.2); }
    .two-col { display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; }
    @media (max-width:900px) { .two-col { grid-template-columns:1fr; } }
    .empty-row td { text-align:center; color:#5c5040; font-style:italic; font-family:'Cormorant Garamond',serif; padding:2rem; }
</style>

{{-- Cards de Estatísticas --}}
<div class="stats-grid">

    <div class="stat-card">
        <div>
            <div class="stat-label">Reservas Hoje</div>
            <div class="stat-value">{{ $stats['reservas_hoje'] }}</div>
            <div class="stat-sub">check-ins previstos</div>
        </div>
        <div class="stat-icon">
            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
        </div>
    </div>

    <div class="stat-card">
        <div>
            <div class="stat-label">Quartos Ocupados</div>
            <div class="stat-value">{{ $stats['quartos_ocupados'] }}</div>
            <div class="stat-sub">de {{ $stats['quartos_total'] }} cadastrados</div>
        </div>
        <div class="stat-icon">
            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21"/></svg>
        </div>
    </div>

    <div class="stat-card">
        <div>
            <div class="stat-label">Receita do Mês</div>
            <div class="stat-value">{{ number_format($stats['receita_mes']/1000, 0) }}k</div>
            <div class="stat-sub">R$ {{ number_format($stats['receita_mes'], 2, ',', '.') }}</div>
        </div>
        <div class="stat-icon">
            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
    </div>

    <div class="stat-card">
        <div>
            <div class="stat-label">Clientes Cadastrados</div>
            <div class="stat-value">{{ $stats['clientes_total'] }}</div>
            <div class="stat-sub {{ $stats['novos_semana'] > 0 ? 'up' : '' }}">
                {{ $stats['novos_semana'] > 0 ? '↑ '.$stats['novos_semana'].' novos esta semana' : 'nenhum novo esta semana' }}
            </div>
        </div>
        <div class="stat-icon">
            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
        </div>
    </div>

</div>

<div class="two-col">

    {{-- Reservas Recentes --}}
    <div>
        <div class="section-header">
            <div class="section-title">Reservas Recentes</div>
            <a href="{{ route('admin.reservas.index') }}" class="link-gold">Ver todas →</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Hóspede</th>
                        <th>Quarto</th>
                        <th>Check-in</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservasRecentes as $r)
                    <tr>
                        <td style="color:#f0e8d5;">{{ $r->user->name }}</td>
                        <td>{{ $r->room->name ?? '—' }}</td>
                        <td>{{ $r->check_in->format('d/m') }}</td>
                        <td>
                            @php $s = $r->status; @endphp
                            @if($s === 'confirmado')     <span class="badge badge-green">Confirmado</span>
                            @elseif($s === 'pendente')   <span class="badge badge-yellow">Pendente</span>
                            @elseif($s === 'andamento')  <span class="badge badge-blue">Andamento</span>
                            @elseif($s === 'concluido')  <span class="badge badge-gray">Concluído</span>
                            @else                        <span class="badge badge-red">Cancelado</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr class="empty-row"><td colspan="4">Nenhuma reserva ainda</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Status dos Quartos --}}
    <div>
        <div class="section-header">
            <div class="section-title">Status dos Quartos</div>
            <a href="{{ route('admin.quartos.index') }}" class="link-gold">Gerenciar →</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Quarto</th>
                        <th>Tipo</th>
                        <th>Diária</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($statusQuartos as $q)
                    <tr>
                        <td style="color:#f0e8d5; font-family:'Cormorant Garamond',serif; font-style:italic;">Nº {{ $q->number }}</td>
                        <td>{{ ucfirst($q->type) }}</td>
                        <td style="color:#c9a84c;">{{ $q->formatted_price }}</td>
                        <td>
                            @if($q->status === 'ocupado')        <span class="badge badge-yellow">Ocupado</span>
                            @elseif($q->status === 'disponivel') <span class="badge badge-green">Disponível</span>
                            @else                                <span class="badge badge-gray">Manutenção</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr class="empty-row"><td colspan="4">Nenhum quarto cadastrado. <a href="{{ route('admin.quartos.create') }}" style="color:#c9a84c;">Adicionar →</a></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
