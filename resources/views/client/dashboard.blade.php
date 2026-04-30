@extends('layouts.app')

@section('title', 'Minha Conta')

@section('content')
<div style="min-height: 100vh; padding-top: 100px; padding-bottom: 4rem; background: var(--ink);">
    <div class="max-w-5xl mx-auto px-6 lg:px-12">

        {{-- Cabeçalho --}}
        <div style="margin-bottom: 2.5rem;">
            <span style="display:block; width:48px; height:1px; background:var(--gold); margin-bottom:1.25rem;"></span>
            <p style="font-size:0.68rem; text-transform:uppercase; letter-spacing:0.28em; color:var(--gold); margin-bottom:0.5rem;">
                Área do Hóspede
            </p>
            <h1 style="font-family:'Cormorant Garamond',serif; font-size:2.8rem; color:var(--cream); font-style:italic; line-height:1.1;">
                Olá, {{ auth()->user()->name }}
            </h1>
            <p style="color:var(--muted-2); font-size:0.85rem; margin-top:0.5rem;">
                Gerencie suas reservas e preferências
            </p>
        </div>

        {{-- Alerts via SweetAlert (layout) --}}

        {{-- Banner de acesso admin --}}
        @if(auth()->user()->role === 'admin')
        <a href="{{ route('admin.dashboard') }}" style="display:block; text-decoration:none; margin-bottom:1.75rem;">
            <div style="
                background: linear-gradient(135deg, rgba(201,168,76,0.12) 0%, rgba(201,168,76,0.04) 100%);
                border: 1px solid rgba(201,168,76,0.35);
                border-radius: 3px;
                padding: 1.1rem 1.5rem;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 1rem;
                transition: border-color 0.2s, background 0.2s;"
                onmouseover="this.style.borderColor='rgba(201,168,76,0.6)'; this.style.background='linear-gradient(135deg,rgba(201,168,76,0.18) 0%,rgba(201,168,76,0.07) 100%)'"
                onmouseout="this.style.borderColor='rgba(201,168,76,0.35)'; this.style.background='linear-gradient(135deg,rgba(201,168,76,0.12) 0%,rgba(201,168,76,0.04) 100%)'">
                <div style="display:flex; align-items:center; gap:0.9rem;">
                    <div style="width:36px;height:36px;background:rgba(201,168,76,0.15);border:1px solid rgba(201,168,76,0.35);border-radius:2px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg width="16" height="16" fill="none" stroke="#c9a84c" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0H3"/>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size:0.62rem;text-transform:uppercase;letter-spacing:0.2em;color:var(--gold);margin-bottom:0.1rem;">Acesso Administrativo</div>
                        <div style="font-family:'Cormorant Garamond',serif;font-size:1.1rem;color:var(--cream);font-style:italic;">
                            Você tem permissões de administrador
                        </div>
                    </div>
                </div>
                <span style="font-size:0.72rem;text-transform:uppercase;letter-spacing:0.12em;color:var(--gold);white-space:nowrap;">
                    Ir para o painel →
                </span>
            </div>
        </a>
        @endif

        {{-- Cards de ação rápida --}}
        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:1rem; margin-bottom:2.5rem;">

            <a href="{{ route('reservation.index') }}" style="text-decoration:none;">
                <div style="background:var(--ink-3); border:1px solid rgba(201,168,76,0.1); border-radius:3px; padding:1.5rem; transition: border-color 0.2s, transform 0.2s;"
                     onmouseover="this.style.borderColor='rgba(201,168,76,0.28)'; this.style.transform='translateY(-2px)'"
                     onmouseout="this.style.borderColor='rgba(201,168,76,0.1)'; this.style.transform='translateY(0)'">
                    <div style="width:40px;height:40px;background:rgba(201,168,76,0.08);border:1px solid rgba(201,168,76,0.15);border-radius:2px;display:flex;align-items:center;justify-content:center;margin-bottom:1rem;">
                        <svg width="18" height="18" fill="none" stroke="#c9a84c" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                        </svg>
                    </div>
                    <div style="font-size:0.65rem;text-transform:uppercase;letter-spacing:0.18em;color:var(--muted-2);margin-bottom:0.25rem;">Minhas</div>
                    <div style="font-family:'Cormorant Garamond',serif;font-size:1.3rem;color:var(--cream);font-style:italic;">Reservas</div>
                </div>
            </a>

            <a href="{{ route('rooms') }}" style="text-decoration:none;">
                <div style="background:var(--ink-3); border:1px solid rgba(201,168,76,0.1); border-radius:3px; padding:1.5rem; transition: border-color 0.2s, transform 0.2s;"
                     onmouseover="this.style.borderColor='rgba(201,168,76,0.28)'; this.style.transform='translateY(-2px)'"
                     onmouseout="this.style.borderColor='rgba(201,168,76,0.1)'; this.style.transform='translateY(0)'">
                    <div style="width:40px;height:40px;background:rgba(201,168,76,0.08);border:1px solid rgba(201,168,76,0.15);border-radius:2px;display:flex;align-items:center;justify-content:center;margin-bottom:1rem;">
                        <svg width="18" height="18" fill="none" stroke="#c9a84c" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21"/>
                        </svg>
                    </div>
                    <div style="font-size:0.65rem;text-transform:uppercase;letter-spacing:0.18em;color:var(--muted-2);margin-bottom:0.25rem;">Explorar</div>
                    <div style="font-family:'Cormorant Garamond',serif;font-size:1.3rem;color:var(--cream);font-style:italic;">Quartos</div>
                </div>
            </a>

            <a href="{{ route('profile.edit') }}" style="text-decoration:none;">
                <div style="background:var(--ink-3); border:1px solid rgba(201,168,76,0.1); border-radius:3px; padding:1.5rem; transition: border-color 0.2s, transform 0.2s;"
                     onmouseover="this.style.borderColor='rgba(201,168,76,0.28)'; this.style.transform='translateY(-2px)'"
                     onmouseout="this.style.borderColor='rgba(201,168,76,0.1)'; this.style.transform='translateY(0)'">
                    <div style="width:40px;height:40px;background:rgba(201,168,76,0.08);border:1px solid rgba(201,168,76,0.15);border-radius:2px;display:flex;align-items:center;justify-content:center;margin-bottom:1rem;">
                        <svg width="18" height="18" fill="none" stroke="#c9a84c" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                        </svg>
                    </div>
                    <div style="font-size:0.65rem;text-transform:uppercase;letter-spacing:0.18em;color:var(--muted-2);margin-bottom:0.25rem;">Cadastro</div>
                    <div style="font-family:'Cormorant Garamond',serif;font-size:1.3rem;color:var(--cream);font-style:italic;">Dados pessoais</div>
                </div>
            </a>

        </div>

        {{-- Últimas reservas --}}
        <div style="margin-bottom:0.75rem;display:flex;align-items:center;justify-content:space-between;">
            <h2 style="font-family:'Cormorant Garamond',serif;font-size:1.4rem;color:var(--cream);font-style:italic;">
                Últimas Reservas
            </h2>
            <a href="{{ route('reservation.index') }}" style="font-size:0.72rem;text-transform:uppercase;letter-spacing:0.12em;color:var(--gold);text-decoration:none;">
                Ver todas →
            </a>
        </div>

        <div style="background:var(--ink-3);border:1px solid rgba(201,168,76,0.08);border-radius:3px;overflow:hidden;">
            <table style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr>
                        <th style="font-size:0.6rem;text-transform:uppercase;letter-spacing:0.18em;color:var(--muted-2);padding:0.85rem 1.25rem;border-bottom:1px solid rgba(201,168,76,0.07);text-align:left;font-weight:400;">Quarto</th>
                        <th style="font-size:0.6rem;text-transform:uppercase;letter-spacing:0.18em;color:var(--muted-2);padding:0.85rem 1.25rem;border-bottom:1px solid rgba(201,168,76,0.07);text-align:left;font-weight:400;">Check-in</th>
                        <th style="font-size:0.6rem;text-transform:uppercase;letter-spacing:0.18em;color:var(--muted-2);padding:0.85rem 1.25rem;border-bottom:1px solid rgba(201,168,76,0.07);text-align:left;font-weight:400;">Check-out</th>
                        <th style="font-size:0.6rem;text-transform:uppercase;letter-spacing:0.18em;color:var(--muted-2);padding:0.85rem 1.25rem;border-bottom:1px solid rgba(201,168,76,0.07);text-align:left;font-weight:400;">Total</th>
                        <th style="font-size:0.6rem;text-transform:uppercase;letter-spacing:0.18em;color:var(--muted-2);padding:0.85rem 1.25rem;border-bottom:1px solid rgba(201,168,76,0.07);text-align:left;font-weight:400;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(($latestReservations ?? collect()) as $r)
                        @php
                            $label = match ($r->status) {
                                'pendente'   => 'Pendente',
                                'confirmado' => 'Pago/Confirmado',
                                'andamento'  => 'Em andamento',
                                'concluido'  => 'Finalizado',
                                'cancelado'  => 'Cancelado',
                                default      => $r->status,
                            };
                        @endphp
                        <tr>
                            <td style="padding:0.95rem 1.25rem; border-bottom:1px solid rgba(201,168,76,0.05);">
                                <div style="color:var(--cream); font-weight:500;">
                                    {{ $r->room->name ?? '—' }}
                                </div>
                                <div style="font-size:0.78rem; color:var(--muted-2);">
                                    Nº {{ $r->room->number ?? '—' }} · {{ $r->room ? ucfirst($r->room->type) : '—' }}
                                </div>
                            </td>
                            <td style="padding:0.95rem 1.25rem; border-bottom:1px solid rgba(201,168,76,0.05); color:var(--cream-dim);">
                                {{ optional($r->check_in)->format('d/m/Y') }}
                            </td>
                            <td style="padding:0.95rem 1.25rem; border-bottom:1px solid rgba(201,168,76,0.05); color:var(--cream-dim);">
                                {{ optional($r->check_out)->format('d/m/Y') }}
                            </td>
                            <td style="padding:0.95rem 1.25rem; border-bottom:1px solid rgba(201,168,76,0.05); color:var(--gold); font-weight:500;">
                                {{ $r->formatted_total }}
                            </td>
                            <td style="padding:0.95rem 1.25rem; border-bottom:1px solid rgba(201,168,76,0.05); color:var(--muted-2); text-transform:uppercase; letter-spacing:0.12em; font-size:0.65rem;">
                                {{ $label }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding:3rem 1.25rem; text-align:center; color:var(--muted-2); font-size:0.85rem; font-style:italic; font-family:'Cormorant Garamond',serif;">
                                Nenhuma reserva encontrada. <a href="{{ route('checkin') }}" style="color:var(--gold);">Reserve seu quarto →</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Mensagens --}}
        <div style="margin-top:2.5rem; margin-bottom:0.75rem; display:flex; align-items:center; justify-content:space-between; gap:1rem; flex-wrap:wrap;">
            <h2 style="font-family:'Cormorant Garamond',serif;font-size:1.4rem;color:var(--cream);font-style:italic;">
                Mensagens
                @if(($unreadFromAdmin ?? 0) > 0)
                    <span style="margin-left:0.6rem; font-size:0.7rem; letter-spacing:0.12em; text-transform:uppercase; color:var(--gold);">
                        ({{ $unreadFromAdmin }} nova{{ $unreadFromAdmin > 1 ? 's' : '' }})
                    </span>
                @endif
            </h2>
            <a href="{{ route('chat') }}" style="font-size:0.72rem;text-transform:uppercase;letter-spacing:0.12em;color:var(--gold);text-decoration:none;">
                Abrir chat →
            </a>
        </div>

        <div style="background:var(--ink-3);border:1px solid rgba(201,168,76,0.08);border-radius:3px;overflow:hidden; padding: 1rem 1.25rem;">
            @forelse(($latestMessages ?? collect()) as $m)
                <div style="padding:0.75rem 0; {{ !$loop->last ? 'border-bottom:1px solid rgba(201,168,76,0.07);' : '' }}">
                    <div style="display:flex; align-items:center; justify-content:space-between; gap:1rem;">
                        <div style="font-size:0.65rem; text-transform:uppercase; letter-spacing:0.12em; color: var(--muted-2);">
                            {{ $m->sender === 'user' ? 'Você' : 'Equipe' }}
                        </div>
                        <div style="font-size:0.72rem; color: var(--muted-2);">
                            {{ $m->created_at->format('d/m H:i') }}
                        </div>
                    </div>
                    <div style="margin-top:0.35rem; color: var(--cream-dim); font-size:0.9rem; line-height:1.45;">
                        {{ \Illuminate\Support\Str::limit($m->message, 140) }}
                    </div>
                </div>
            @empty
                <div style="text-align:center; color:var(--muted-2); font-size:0.9rem; font-style:italic; font-family:'Cormorant Garamond',serif; padding: 1.5rem 0;">
                    Nenhuma mensagem ainda. <a href="{{ route('chat') }}" style="color:var(--gold);">Abrir chat →</a>
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection
