@extends('layouts.app')

@section('title', 'Minhas Reservas')

@section('content')
<div style="min-height: 100vh; padding-top: 110px; padding-bottom: 4rem; background: var(--ink);">
    <div class="max-w-6xl mx-auto px-6 lg:px-12">

        <div style="margin-bottom: 2rem; display:flex; align-items:flex-end; justify-content:space-between; gap: 1rem; flex-wrap:wrap;">
            <div>
                <span class="line-gold"></span>
                <p class="text-xs uppercase tracking-[0.25em] mb-3" style="color: var(--gold);">Área do Hóspede</p>
                <h1 class="font-display text-5xl" style="color: var(--cream); font-style: italic; line-height: 1.1;">
                    Minhas Reservas
                </h1>
                <p class="mt-4 text-sm" style="color: var(--muted-2);">
                    Acompanhe o status e o histórico das suas reservas.
                </p>
            </div>

            <a href="{{ route('checkin') }}" class="btn-gold" style="padding:0.85rem 1.6rem;">
                Nova reserva
            </a>
        </div>

        @php
            $pillBase = 'display:inline-flex; align-items:center; gap:0.5rem; padding:0.55rem 0.9rem; border-radius:2px; font-size:0.7rem; letter-spacing:0.12em; text-transform:uppercase; text-decoration:none; border:1px solid rgba(201,168,76,0.12); color: var(--muted-2); background: rgba(28,22,16,0.6);';
            $pillOn   = 'border-color: rgba(201,168,76,0.35); color: var(--gold); background: rgba(201,168,76,0.08);';
        @endphp

        <div style="display:flex; flex-wrap:wrap; gap:0.6rem; margin-bottom: 1.25rem;">
            <a href="{{ route('reservation.index', ['f' => 'todas']) }}"
               style="{{ $pillBase }} {{ ($filter ?? request('f','todas')) === 'todas' ? $pillOn : '' }}">
                Todas <span style="opacity:0.75;">({{ $counts['todas'] ?? 0 }})</span>
            </a>
            <a href="{{ route('reservation.index', ['f' => 'pendentes']) }}"
               style="{{ $pillBase }} {{ ($filter ?? request('f')) === 'pendentes' ? $pillOn : '' }}">
                Pendentes <span style="opacity:0.75;">({{ $counts['pendentes'] ?? 0 }})</span>
            </a>
            <a href="{{ route('reservation.index', ['f' => 'pagas']) }}"
               style="{{ $pillBase }} {{ ($filter ?? request('f')) === 'pagas' ? $pillOn : '' }}">
                Pagas <span style="opacity:0.75;">({{ $counts['pagas'] ?? 0 }})</span>
            </a>
            <a href="{{ route('reservation.index', ['f' => 'finalizadas']) }}"
               style="{{ $pillBase }} {{ ($filter ?? request('f')) === 'finalizadas' ? $pillOn : '' }}">
                Finalizadas <span style="opacity:0.75;">({{ $counts['finalizadas'] ?? 0 }})</span>
            </a>
            <a href="{{ route('reservation.index', ['f' => 'canceladas']) }}"
               style="{{ $pillBase }} {{ ($filter ?? request('f')) === 'canceladas' ? $pillOn : '' }}">
                Canceladas <span style="opacity:0.75;">({{ $counts['canceladas'] ?? 0 }})</span>
            </a>
        </div>

        {{-- Alerts via SweetAlert (layout) --}}

        <div style="background:var(--ink-3); border:1px solid rgba(201,168,76,0.08); border-radius:3px; overflow:hidden;">
            <table style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr>
                        <th style="font-size:0.6rem;text-transform:uppercase;letter-spacing:0.18em;color:var(--muted-2);padding:0.85rem 1.25rem;border-bottom:1px solid rgba(201,168,76,0.07);text-align:left;font-weight:400;">Quarto</th>
                        <th style="font-size:0.6rem;text-transform:uppercase;letter-spacing:0.18em;color:var(--muted-2);padding:0.85rem 1.25rem;border-bottom:1px solid rgba(201,168,76,0.07);text-align:left;font-weight:400;">Check-in</th>
                        <th style="font-size:0.6rem;text-transform:uppercase;letter-spacing:0.18em;color:var(--muted-2);padding:0.85rem 1.25rem;border-bottom:1px solid rgba(201,168,76,0.07);text-align:left;font-weight:400;">Check-out</th>
                        <th style="font-size:0.6rem;text-transform:uppercase;letter-spacing:0.18em;color:var(--muted-2);padding:0.85rem 1.25rem;border-bottom:1px solid rgba(201,168,76,0.07);text-align:left;font-weight:400;">Total</th>
                        <th style="font-size:0.6rem;text-transform:uppercase;letter-spacing:0.18em;color:var(--muted-2);padding:0.85rem 1.25rem;border-bottom:1px solid rgba(201,168,76,0.07);text-align:left;font-weight:400;">Status</th>
                        <th style="font-size:0.6rem;text-transform:uppercase;letter-spacing:0.18em;color:var(--muted-2);padding:0.85rem 1.25rem;border-bottom:1px solid rgba(201,168,76,0.07);text-align:left;font-weight:400;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservations as $r)
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
                                {{ $label }}
                            </td>
                            <td style="padding:0.95rem 1.25rem; border-bottom:1px solid rgba(201,168,76,0.05);">
                                <div style="display:flex; gap:0.5rem; flex-wrap:wrap;">
                                    @if($r->status === 'pendente')
                                        <form method="POST" action="{{ route('reservation.fakePay', $r) }}">
                                            @csrf @method('PATCH')
                                            <button type="submit"
                                                    style="padding:0.45rem 0.75rem; font-size:0.62rem; letter-spacing:0.12em; text-transform:uppercase; border-radius:2px; cursor:pointer; border:1px solid rgba(60,160,100,0.25); background:rgba(60,160,100,0.08); color:#5cc890;"
                                                    onmouseover="this.style.borderColor='rgba(60,160,100,0.45)';"
                                                    onmouseout="this.style.borderColor='rgba(60,160,100,0.25)';">
                                                Pagar (teste)
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('reservation.cancel', $r) }}"
                                              onsubmit="return confirm('Cancelar esta reserva?')">
                                            @csrf @method('PATCH')
                                            <button type="submit"
                                                    style="padding:0.45rem 0.75rem; font-size:0.62rem; letter-spacing:0.12em; text-transform:uppercase; border-radius:2px; cursor:pointer; border:1px solid rgba(200,70,70,0.25); background:rgba(200,70,70,0.08); color:#e07070;"
                                                    onmouseover="this.style.borderColor='rgba(200,70,70,0.45)';"
                                                    onmouseout="this.style.borderColor='rgba(200,70,70,0.25)';">
                                                Cancelar
                                            </button>
                                        </form>
                                    @elseif($r->status === 'confirmado' && !$r->checked_in_at)
                                        <form method="POST" action="{{ route('reservation.cancel', $r) }}"
                                              onsubmit="return confirm('Cancelar esta reserva confirmada?')">
                                            @csrf @method('PATCH')
                                            <button type="submit"
                                                    style="padding:0.45rem 0.75rem; font-size:0.62rem; letter-spacing:0.12em; text-transform:uppercase; border-radius:2px; cursor:pointer; border:1px solid rgba(200,70,70,0.25); background:rgba(200,70,70,0.08); color:#e07070;"
                                                    onmouseover="this.style.borderColor='rgba(200,70,70,0.45)';"
                                                    onmouseout="this.style.borderColor='rgba(200,70,70,0.25)';">
                                                Cancelar
                                            </button>
                                        </form>
                                    @else
                                        <span style="font-size:0.78rem; color: var(--muted-2);">—</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding:3rem 1.25rem; text-align:center; color:var(--muted-2); font-size:0.9rem; font-style:italic; font-family:'Cormorant Garamond',serif;">
                                Nenhuma reserva encontrada. <a href="{{ route('checkin') }}" style="color:var(--gold);">Fazer uma reserva →</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($reservations->hasPages())
            <div style="margin-top:1.25rem;">
                {{ $reservations->links() }}
            </div>
        @endif

    </div>
</div>
@endsection

