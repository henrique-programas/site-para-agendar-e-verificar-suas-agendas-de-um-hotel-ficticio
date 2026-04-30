@extends('layouts.admin')

@section('page-title', 'Chat')
@section('breadcrumb', 'Chat')

@section('content')
<style>
    .card { background:#1c1610; border:1px solid rgba(201,168,76,0.08); border-radius:3px; overflow:hidden; }
    table { width:100%; border-collapse:collapse; }
    thead th { font-size:0.62rem; text-transform:uppercase; letter-spacing:0.18em; color:#5c5040; padding:0.9rem 1.25rem; border-bottom:1px solid rgba(201,168,76,0.07); text-align:left; font-weight:400; }
    tbody td { font-size:0.85rem; color:#c8bba5; padding:0.9rem 1.25rem; border-bottom:1px solid rgba(201,168,76,0.05); }
    tbody tr:hover td { background:rgba(201,168,76,0.03); }
    .empty { padding:3rem; text-align:center; color:#5c5040; font-style:italic; font-family:'Cormorant Garamond',serif; }
    .btn { display:inline-flex; padding:0.35rem 0.7rem; font-size:0.65rem; letter-spacing:0.06em; text-transform:uppercase; border-radius:2px; cursor:pointer; text-decoration:none; border:1px solid rgba(201,168,76,0.18); color:#8a7560; }
    .btn:hover { border-color:rgba(201,168,76,0.35); color:#c8bba5; }
</style>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Email</th>
                <th>Última mensagem</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            @forelse($conversations as $u)
                <tr>
                    <td style="color:#f0e8d5;">{{ $u->name }}</td>
                    <td style="color:#8a7560;">{{ $u->email }}</td>
                    <td>{{ optional($u->chat_messages_max_created_at)->format('d/m/Y H:i') ?? '—' }}</td>
                    <td><a class="btn" href="{{ route('admin.chat.show', $u) }}">Abrir</a></td>
                </tr>
            @empty
                <tr><td colspan="4" class="empty">Nenhuma conversa ainda.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

