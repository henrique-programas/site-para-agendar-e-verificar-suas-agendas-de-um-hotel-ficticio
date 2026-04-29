@extends('layouts.admin')

@section('page-title', 'Usuários')
@section('breadcrumb', 'Usuários')

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
    .summary-pill strong {
        color: #f0e8d5;
        font-size: 1rem;
        font-family: 'Cormorant Garamond', serif;
        font-style: italic;
    }

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

    .user-cell { display: flex; align-items: center; gap: 0.75rem; }
    .user-avatar {
        width: 36px; height: 36px;
        border-radius: 50%;
        background: rgba(201,168,76,0.1);
        border: 1px solid rgba(201,168,76,0.2);
        display: flex; align-items: center; justify-content: center;
        font-size: 0.85rem;
        color: #c9a84c;
        font-family: 'Cormorant Garamond', serif;
        font-style: italic;
        flex-shrink: 0;
    }
    .user-avatar.admin-av {
        background: rgba(201,168,76,0.18);
        border-color: rgba(201,168,76,0.4);
    }
    .user-name  { font-size: 0.85rem; color: #f0e8d5; }
    .user-email { font-size: 0.7rem;  color: #5c5040; }

    .badge {
        display: inline-block;
        padding: 0.2rem 0.65rem;
        border-radius: 2px;
        font-size: 0.62rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
    }
    .badge-gold  { background: rgba(201,168,76,0.15); color: #c9a84c; border: 1px solid rgba(201,168,76,0.3); }
    .badge-gray  { background: rgba(140,130,120,0.1); color: #8a7560; border: 1px solid rgba(140,130,120,0.2); }
    .badge-green { background: rgba(60,160,100,0.12); color: #5cc890; border: 1px solid rgba(60,160,100,0.25); }
    .badge-red   { background: rgba(200,70,70,0.12);  color: #e07070; border: 1px solid rgba(200,70,70,0.25); }

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
    .btn-sm-promote {
        background: transparent;
        border: 1px solid rgba(201,168,76,0.2);
        color: #8a7560;
    }
    .btn-sm-promote:hover { border-color: rgba(201,168,76,0.45); color: #c9a84c; }

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
            Gerenciar Usuários
        </div>
        <div class="page-desc">Visualize, promova e gerencie as contas cadastradas</div>
    </div>
    <a href="#" style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.65rem 1.4rem;background:#c9a84c;color:#0a0806;border:none;border-radius:2px;font-size:0.75rem;font-weight:500;letter-spacing:0.1em;text-transform:uppercase;text-decoration:none;transition:background 0.2s;" onmouseover="this.style.background='#e2c47a'" onmouseout="this.style.background='#c9a84c'">
        + Novo Usuário
    </a>
</div>

<div class="summary-row">
    <div class="summary-pill"><strong>248</strong> Total de Usuários</div>
    <div class="summary-pill"><strong style="color:#c9a84c;">3</strong> Admins</div>
    <div class="summary-pill"><strong style="color:#5cc890;">245</strong> Clientes</div>
    <div class="summary-pill"><strong>8</strong> Novos esta semana</div>
</div>

<div class="filters">
    <input type="text" class="filter-input" placeholder="Buscar por nome ou e-mail..." style="min-width:240px;">
    <select class="filter-select">
        <option value="">Todos os perfis</option>
        <option>Admin</option>
        <option>Cliente</option>
    </select>
    <select class="filter-select">
        <option value="">Ordenar por</option>
        <option>Mais recentes</option>
        <option>Mais antigos</option>
        <option>Nome A–Z</option>
    </select>
</div>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Usuário</th>
                <th>Perfil</th>
                <th>Reservas</th>
                <th>Cadastro</th>
                <th>Último Acesso</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach([
                ['name'=>'Administrador',  'email'=>'admin@calmind.com',    'role'=>'admin',   'reservas'=>0,  'created'=>'15/01/2024','last'=>'Hoje',       'active'=>true],
                ['name'=>'Fernanda Lima',  'email'=>'fernanda@email.com',   'role'=>'client',  'reservas'=>5,  'created'=>'10/03/2025','last'=>'Ontem',      'active'=>true],
                ['name'=>'Ricardo Mota',   'email'=>'ricardo@email.com',    'role'=>'client',  'reservas'=>2,  'created'=>'22/06/2025','last'=>'28/04/2026', 'active'=>true],
                ['name'=>'Carla Souza',    'email'=>'carla@email.com',      'role'=>'client',  'reservas'=>8,  'created'=>'05/09/2024','last'=>'27/04/2026', 'active'=>true],
                ['name'=>'Paulo Henrique', 'email'=>'paulo@email.com',      'role'=>'client',  'reservas'=>1,  'created'=>'14/11/2025','last'=>'20/04/2026', 'active'=>false],
                ['name'=>'Ana Beatriz',    'email'=>'ana@email.com',        'role'=>'client',  'reservas'=>3,  'created'=>'02/01/2026','last'=>'29/04/2026', 'active'=>true],
                ['name'=>'Marcos Vieira',  'email'=>'marcos@email.com',     'role'=>'client',  'reservas'=>4,  'created'=>'18/02/2026','last'=>'Hoje',       'active'=>true],
                ['name'=>'Juliana Castro', 'email'=>'juliana@email.com',    'role'=>'client',  'reservas'=>6,  'created'=>'07/03/2026','last'=>'Hoje',       'active'=>true],
            ] as $u)
            <tr>
                <td>
                    <div class="user-cell">
                        <div class="user-avatar {{ $u['role'] === 'admin' ? 'admin-av' : '' }}">
                            {{ substr($u['name'], 0, 1) }}
                        </div>
                        <div>
                            <div class="user-name">{{ $u['name'] }}</div>
                            <div class="user-email">{{ $u['email'] }}</div>
                        </div>
                    </div>
                </td>
                <td>
                    @if($u['role'] === 'admin')
                        <span class="badge badge-gold">Admin</span>
                    @else
                        <span class="badge badge-gray">Cliente</span>
                    @endif
                </td>
                <td style="text-align:center; color:#f0e8d5;">{{ $u['reservas'] }}</td>
                <td>{{ $u['created'] }}</td>
                <td>{{ $u['last'] }}</td>
                <td>
                    @if($u['active'])
                        <span class="badge badge-green">Ativo</span>
                    @else
                        <span class="badge badge-red">Inativo</span>
                    @endif
                </td>
                <td>
                    <div class="actions-cell">
                        <a href="#" class="btn-sm btn-sm-outline">Ver</a>
                        @if($u['role'] === 'client')
                            <a href="#" class="btn-sm btn-sm-promote" title="Promover a admin">↑ Admin</a>
                        @endif
                        <a href="#" class="btn-sm btn-sm-danger">✕</a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        <div class="pagination-info">Exibindo 1–8 de 248 usuários</div>
        <div class="pagination-btns">
            <a href="#" class="page-btn">‹</a>
            <a href="#" class="page-btn active">1</a>
            <a href="#" class="page-btn">2</a>
            <a href="#" class="page-btn">3</a>
            <span style="color:#5c5040; font-size:0.8rem; padding: 0 0.25rem;">…</span>
            <a href="#" class="page-btn">31</a>
            <a href="#" class="page-btn">›</a>
        </div>
    </div>
</div>
@endsection
