@extends('layouts.admin')

@section('page-title', 'Reservas')
@section('breadcrumb', 'Reservas')

@section('content')
<style>
    .page-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.75rem;
        gap: 1rem;
        flex-wrap: wrap;
    }
    .page-desc { font-size: 0.82rem; color: #5c5040; }

    /* Sumário rápido */
    .summary-row {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.75rem;
        flex-wrap: wrap;
    }
    .summary-pill {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.6rem 1.1rem;
        background: #1c1610;
        border: 1px solid rgba(201,168,76,0.1);
        border-radius: 2px;
        font-size: 0.78rem;
        color: #8a7560;
    }
    .summary-pill strong { color: #f0e8d5; font-size: 1rem; font-family: 'Cormorant Garamond', serif; font-style: italic; }

    /* Filtros */
    .filters {
        display: flex;
        gap: 0.75rem;
        margin-bottom: 1.25rem;
        flex-wrap: wrap;
        align-items: center;
    }
    .filter-select, .filter-input {
        padding: 0.55rem 0.9rem;
        background: #1c1610;
        border: 1px solid rgba(201,168,76,0.12);
        color: #c8bba5;
        border-radius: 2px;
        font-size: 0.8rem;
        outline: none;
        font-family: 'DM Sans', sans-serif;
        transition: border-color 0.2s;
    }
    .filter-select:focus, .filter-input:focus { border-color: rgba(201,168,76,0.35); }
    .filter-input::placeholder { color: #5c5040; }

    /* Tabela */
    .table-wrap {
        background: #1c1610;
        border: 1px solid rgba(201,168,76,0.08);
        border-radius: 3px;
        overflow: hidden;
    }
    table { width: 100%; border-collapse: collapse; }
    thead th {
        font-size: 0.62rem;
        text-transform: uppercase;
        letter-spacing: 0.18em;
        color: #5c5040;
        padding: 0.9rem 1.25rem;
        border-bottom: 1px solid rgba(201,168,76,0.07);
        text-align: left;
        font-weight: 400;
        white-space: nowrap;
    }
    tbody td {
        font-size: 0.83rem;
        color: #c8bba5;
        padding: 0.9rem 1.25rem;
        border-bottom: 1px solid rgba(201,168,76,0.05);
        vertical-align: middle;
    }
    tbody tr:last-child td { border-bottom: none; }
    tbody tr:hover td { background: rgba(201,168,76,0.03); }

    .guest-cell { display: flex; align-items: center; gap: 0.65rem; }
    .guest-avatar {
        width: 30px; height: 30px;
        border-radius: 50%;
        background: rgba(201,168,76,0.1);
        border: 1px solid rgba(201,168,76,0.2);
        display: flex; align-items: center; justify-content: center;
        font-size: 0.7rem;
        color: #c9a84c;
        font-family: 'Cormorant Garamond', serif;
        font-style: italic;
        flex-shrink: 0;
    }
    .guest-name  { font-size: 0.85rem; color: #f0e8d5; }
    .guest-email { font-size: 0.7rem;  color: #5c5040; }

    .badge {
        display: inline-block;
        padding: 0.2rem 0.65rem;
        border-radius: 2px;
        font-size: 0.62rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        white-space: nowrap;
    }
    .badge-green  { background: rgba(60,160,100,0.12);  color: #5cc890; border: 1px solid rgba(60,160,100,0.25); }
    .badge-yellow { background: rgba(201,168,76,0.12);  color: #c9a84c; border: 1px solid rgba(201,168,76,0.25); }
    .badge-red    { background: rgba(200,70,70,0.12);   color: #e07070; border: 1px solid rgba(200,70,70,0.25); }
    .badge-blue   { background: rgba(70,130,200,0.12);  color: #70a8e0; border: 1px solid rgba(70,130,200,0.25); }

    .actions-cell { display: flex; gap: 0.4rem; }
    .btn-sm {
        padding: 0.3rem 0.7rem;
        font-size: 0.65rem;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        border-radius: 2px;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s;
        font-family: 'DM Sans', sans-serif;
        white-space: nowrap;
    }
    .btn-sm-outline {
        background: transparent;
        border: 1px solid rgba(201,168,76,0.18);
        color: #8a7560;
    }
    .btn-sm-outline:hover { border-color: rgba(201,168,76,0.35); color: #c8bba5; }
    .btn-sm-danger {
        background: transparent;
        border: 1px solid rgba(200,70,70,0.18);
        color: #8a7560;
    }
    .btn-sm-danger:hover { border-color: rgba(200,70,70,0.4); color: #e07070; }

    /* Paginação */
    .pagination {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.9rem 1.25rem;
        border-top: 1px solid rgba(201,168,76,0.07);
    }
    .pagination-info { font-size: 0.75rem; color: #5c5040; }
    .pagination-btns { display: flex; gap: 0.35rem; }
    .page-btn {
        width: 30px; height: 30px;
        display: flex; align-items: center; justify-content: center;
        background: transparent;
        border: 1px solid rgba(201,168,76,0.12);
        color: #8a7560;
        border-radius: 2px;
        font-size: 0.78rem;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s;
    }
    .page-btn:hover { border-color: rgba(201,168,76,0.3); color: #c9a84c; }
    .page-btn.active { background: rgba(201,168,76,0.12); border-color: rgba(201,168,76,0.3); color: #c9a84c; }
</style>

<div class="page-actions">
    <div>
        <div style="font-family: 'Cormorant Garamond', serif; font-size:1.1rem; color:#f0e8d5; font-style:italic; margin-bottom:0.2rem;">
            Todas as Reservas
        </div>
        <div class="page-desc">Gerencie check-ins, check-outs e confirmações</div>
    </div>
    <a href="#" style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.65rem 1.4rem;background:#c9a84c;color:#0a0806;border:none;border-radius:2px;font-size:0.75rem;font-weight:500;letter-spacing:0.1em;text-transform:uppercase;text-decoration:none;transition:background 0.2s;" onmouseover="this.style.background='#e2c47a'" onmouseout="this.style.background='#c9a84c'">
        + Nova Reserva
    </a>
</div>

<div class="summary-row">
    <div class="summary-pill"><strong>48</strong> Total do Mês</div>
    <div class="summary-pill"><strong style="color:#5cc890;">32</strong> Confirmadas</div>
    <div class="summary-pill"><strong style="color:#c9a84c;">9</strong> Pendentes</div>
    <div class="summary-pill"><strong style="color:#e07070;">4</strong> Canceladas</div>
    <div class="summary-pill"><strong style="color:#70a8e0;">3</strong> Em Andamento</div>
</div>

<div class="filters">
    <input type="text" class="filter-input" placeholder="Buscar hóspede ou ID..." style="min-width:220px;">
    <select class="filter-select">
        <option value="">Todos os status</option>
        <option>Confirmado</option>
        <option>Pendente</option>
        <option>Cancelado</option>
        <option>Em andamento</option>
    </select>
    <select class="filter-select">
        <option value="">Todos os quartos</option>
        <option>Deluxe</option>
        <option>Premium</option>
        <option>Presidencial</option>
    </select>
    <input type="date" class="filter-input" title="Data check-in">
</div>

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
            @foreach([
                ['id'=>'#1042','name'=>'Fernanda Lima',   'email'=>'fernanda@email.com', 'room'=>'Suite Premium 201',      'in'=>'02/05/2026','out'=>'05/05/2026','nights'=>3,'total'=>'R$ 2.250','status'=>'confirmado'],
                ['id'=>'#1041','name'=>'Ricardo Mota',    'email'=>'ricardo@email.com',  'room'=>'Quarto Deluxe 101',       'in'=>'03/05/2026','out'=>'06/05/2026','nights'=>3,'total'=>'R$ 1.350','status'=>'pendente'],
                ['id'=>'#1040','name'=>'Carla Souza',     'email'=>'carla@email.com',    'room'=>'Suíte Presidencial 301',  'in'=>'04/05/2026','out'=>'08/05/2026','nights'=>4,'total'=>'R$ 4.800','status'=>'confirmado'],
                ['id'=>'#1039','name'=>'Paulo Henrique',  'email'=>'paulo@email.com',    'room'=>'Quarto Deluxe 102',       'in'=>'04/05/2026','out'=>'05/05/2026','nights'=>1,'total'=>'R$ 450',  'status'=>'cancelado'],
                ['id'=>'#1038','name'=>'Ana Beatriz',     'email'=>'ana@email.com',      'room'=>'Suite Premium 201',       'in'=>'06/05/2026','out'=>'09/05/2026','nights'=>3,'total'=>'R$ 2.250','status'=>'confirmado'],
                ['id'=>'#1037','name'=>'Marcos Vieira',   'email'=>'marcos@email.com',   'room'=>'Quarto Deluxe 101',       'in'=>'29/04/2026','out'=>'02/05/2026','nights'=>3,'total'=>'R$ 1.350','status'=>'andamento'],
                ['id'=>'#1036','name'=>'Juliana Castro',  'email'=>'juliana@email.com',  'room'=>'Suíte Presidencial 302',  'in'=>'28/04/2026','out'=>'30/04/2026','nights'=>2,'total'=>'R$ 2.400','status'=>'andamento'],
                ['id'=>'#1035','name'=>'Diego Almeida',   'email'=>'diego@email.com',    'room'=>'Suite Premium 202',       'in'=>'10/05/2026','out'=>'12/05/2026','nights'=>2,'total'=>'R$ 1.500','status'=>'pendente'],
            ] as $r)
            <tr>
                <td style="color:#5c5040; font-size:0.75rem;">{{ $r['id'] }}</td>
                <td>
                    <div class="guest-cell">
                        <div class="guest-avatar">{{ substr($r['name'], 0, 1) }}</div>
                        <div>
                            <div class="guest-name">{{ $r['name'] }}</div>
                            <div class="guest-email">{{ $r['email'] }}</div>
                        </div>
                    </div>
                </td>
                <td>{{ $r['room'] }}</td>
                <td>{{ $r['in'] }}</td>
                <td>{{ $r['out'] }}</td>
                <td style="text-align:center;">{{ $r['nights'] }}</td>
                <td style="color:#c9a84c; font-weight:500;">{{ $r['total'] }}</td>
                <td>
                    @if($r['status'] === 'confirmado')
                        <span class="badge badge-green">Confirmado</span>
                    @elseif($r['status'] === 'pendente')
                        <span class="badge badge-yellow">Pendente</span>
                    @elseif($r['status'] === 'cancelado')
                        <span class="badge badge-red">Cancelado</span>
                    @else
                        <span class="badge badge-blue">Em andamento</span>
                    @endif
                </td>
                <td>
                    <div class="actions-cell">
                        <a href="#" class="btn-sm btn-sm-outline">Ver</a>
                        <a href="#" class="btn-sm btn-sm-outline">Editar</a>
                        <a href="#" class="btn-sm btn-sm-danger">✕</a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        <div class="pagination-info">Exibindo 1–8 de 48 reservas</div>
        <div class="pagination-btns">
            <a href="#" class="page-btn">‹</a>
            <a href="#" class="page-btn active">1</a>
            <a href="#" class="page-btn">2</a>
            <a href="#" class="page-btn">3</a>
            <a href="#" class="page-btn">›</a>
        </div>
    </div>
</div>
@endsection
