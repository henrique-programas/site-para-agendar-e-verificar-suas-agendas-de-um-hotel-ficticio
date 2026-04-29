@extends('layouts.admin')

@section('page-title', 'Usuários')
@section('breadcrumb', 'Usuários')

@section('content')
<style>
    .page-actions { display:flex; align-items:center; justify-content:space-between; margin-bottom:1.75rem; gap:1rem; flex-wrap:wrap; }
    .page-desc { font-size:0.82rem; color:#5c5040; }
    .btn-gold { display:inline-flex; align-items:center; gap:0.5rem; padding:0.65rem 1.4rem; background:#c9a84c; color:#0a0806; border:none; border-radius:2px; font-size:0.75rem; font-weight:500; letter-spacing:0.1em; text-transform:uppercase; cursor:pointer; text-decoration:none; transition:background 0.2s; font-family:'DM Sans',sans-serif; }
    .btn-gold:hover { background:#e2c47a; }
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
    .user-cell { display:flex; align-items:center; gap:0.75rem; }
    .user-avatar { width:36px; height:36px; border-radius:50%; background:rgba(201,168,76,0.1); border:1px solid rgba(201,168,76,0.2); display:flex; align-items:center; justify-content:center; font-size:0.85rem; color:#c9a84c; font-family:'Cormorant Garamond',serif; font-style:italic; flex-shrink:0; }
    .user-avatar.admin-av { background:rgba(201,168,76,0.18); border-color:rgba(201,168,76,0.4); }
    .user-name  { font-size:0.85rem; color:#f0e8d5; }
    .user-email { font-size:0.7rem; color:#5c5040; }
    .badge { display:inline-block; padding:0.2rem 0.65rem; border-radius:2px; font-size:0.62rem; letter-spacing:0.1em; text-transform:uppercase; }
    .badge-gold  { background:rgba(201,168,76,0.15); color:#c9a84c; border:1px solid rgba(201,168,76,0.3); }
    .badge-gray  { background:rgba(140,130,120,0.1); color:#8a7560; border:1px solid rgba(140,130,120,0.2); }
    .actions-cell { display:flex; gap:0.4rem; align-items:center; }
    .btn-sm { padding:0.3rem 0.7rem; font-size:0.65rem; letter-spacing:0.06em; text-transform:uppercase; border-radius:2px; cursor:pointer; text-decoration:none; transition:all 0.2s; font-family:'DM Sans',sans-serif; white-space:nowrap; }
    .btn-sm-outline  { background:transparent; border:1px solid rgba(201,168,76,0.18); color:#8a7560; }
    .btn-sm-outline:hover { border-color:rgba(201,168,76,0.35); color:#c8bba5; }
    .btn-sm-danger  { background:transparent; border:1px solid rgba(200,70,70,0.18); color:#8a7560; }
    .btn-sm-danger:hover { border-color:rgba(200,70,70,0.4); color:#e07070; }
    .btn-sm-promote { background:transparent; border:1px solid rgba(201,168,76,0.2); color:#8a7560; }
    .btn-sm-promote:hover { border-color:rgba(201,168,76,0.45); color:#c9a84c; }
    .btn-sm-demote  { background:transparent; border:1px solid rgba(140,130,120,0.2); color:#8a7560; }
    .btn-sm-demote:hover { border-color:rgba(140,130,120,0.45); color:#c8bba5; }
    .empty-row td { text-align:center; color:#5c5040; font-style:italic; font-family:'Cormorant Garamond',serif; padding:3rem; }
    .you-badge { font-size:0.6rem; background:rgba(201,168,76,0.08); color:#5c5040; border:1px solid rgba(201,168,76,0.1); padding:0.1rem 0.4rem; border-radius:2px; margin-left:0.35rem; text-transform:uppercase; letter-spacing:0.08em; }
</style>

<div class="page-actions">
    <div>
        <div style="font-family:'Cormorant Garamond',serif; font-size:1.1rem; color:#f0e8d5; font-style:italic; margin-bottom:0.2rem;">
            Gerenciar Usuários
        </div>
        <div class="page-desc">Visualize, promova e gerencie as contas cadastradas</div>
    </div>
    <a href="{{ route('admin.usuarios.create') }}" class="btn-gold">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
        Novo Usuário
    </a>
</div>

<div class="summary-row">
    <div class="summary-pill"><strong>{{ $counts['total'] }}</strong> Total</div>
    <div class="summary-pill"><strong style="color:#c9a84c;">{{ $counts['admins'] }}</strong> Admins</div>
    <div class="summary-pill"><strong style="color:#5cc890;">{{ $counts['clientes'] }}</strong> Clientes</div>
    <div class="summary-pill"><strong>{{ $counts['novos_semana'] }}</strong> Novos esta semana</div>
</div>

<form method="GET" class="filters">
    <input type="text" name="search" class="filter-input" placeholder="Buscar por nome ou e-mail..." value="{{ request('search') }}" style="min-width:240px;">
    <select name="role" class="filter-select" onchange="this.form.submit()">
        <option value="">Todos os perfis</option>
        <option value="admin"  {{ request('role') === 'admin'  ? 'selected' : '' }}>Admin</option>
        <option value="client" {{ request('role') === 'client' ? 'selected' : '' }}>Cliente</option>
    </select>
    @if(request()->hasAny(['search','role']))
        <a href="{{ route('admin.usuarios.index') }}" style="font-size:0.75rem; color:#8a7560; text-decoration:none; align-self:center;" onmouseover="this.style.color='#e07070'" onmouseout="this.style.color='#8a7560'">✕ Limpar</a>
    @endif
    <button type="submit" style="padding:0.55rem 1rem; background:rgba(201,168,76,0.1); border:1px solid rgba(201,168,76,0.2); color:#c9a84c; border-radius:2px; font-size:0.75rem; cursor:pointer; font-family:'DM Sans',sans-serif; transition:all 0.2s;" onmouseover="this.style.background='rgba(201,168,76,0.18)'" onmouseout="this.style.background='rgba(201,168,76,0.1)'">Buscar</button>
</form>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Usuário</th>
                <th>Perfil</th>
                <th>Reservas</th>
                <th>Cadastro</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $u)
            <tr>
                <td>
                    <div class="user-cell">
                        <div class="user-avatar {{ $u->role === 'admin' ? 'admin-av' : '' }}">
                            {{ substr($u->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="user-name">
                                {{ $u->name }}
                                @if($u->id === auth()->id())
                                    <span class="you-badge">você</span>
                                @endif
                            </div>
                            <div class="user-email">{{ $u->email }}</div>
                        </div>
                    </div>
                </td>
                <td>
                    @if($u->role === 'admin')
                        <span class="badge badge-gold">Admin</span>
                    @else
                        <span class="badge badge-gray">Cliente</span>
                    @endif
                </td>
                <td style="text-align:center; color:#f0e8d5;">{{ $u->reservations_count }}</td>
                <td>{{ $u->created_at->format('d/m/Y') }}</td>
                <td>
                    <div class="actions-cell">
                        @if($u->id !== auth()->id())
                            {{-- Promover / Rebaixar --}}
                            @if($u->role === 'client')
                                <form method="POST" action="{{ route('admin.usuarios.role', $u) }}">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="role" value="admin">
                                    <button type="submit" class="btn-sm btn-sm-promote" title="Promover a admin">↑ Admin</button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('admin.usuarios.role', $u) }}">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="role" value="client">
                                    <button type="submit" class="btn-sm btn-sm-demote" title="Rebaixar a cliente">↓ Cliente</button>
                                </form>
                            @endif

                            {{-- Remover --}}
                            <form method="POST" action="{{ route('admin.usuarios.destroy', $u) }}"
                                  onsubmit="return confirm('Remover o usuário {{ addslashes($u->name) }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm btn-sm-danger">✕</button>
                            </form>
                        @else
                            <span style="font-size:0.72rem; color:#5c5040; font-style:italic;">—</span>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr class="empty-row"><td colspan="5">Nenhum usuário encontrado</td></tr>
            @endforelse
        </tbody>
    </table>

    @if($users->hasPages())
    <div style="padding:0.9rem 1.25rem; border-top:1px solid rgba(201,168,76,0.07); display:flex; align-items:center; justify-content:space-between;">
        <div style="font-size:0.75rem; color:#5c5040;">
            Exibindo {{ $users->firstItem() }}–{{ $users->lastItem() }} de {{ $users->total() }}
        </div>
        <div>{{ $users->links() }}</div>
    </div>
    @endif
</div>
@endsection
