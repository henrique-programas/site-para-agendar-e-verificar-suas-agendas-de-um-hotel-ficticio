@extends('layouts.app')
@section('title', 'Acomodações — Calm Mind Resort & Spa')
@section('content')

<!-- ===== HERO ===== -->
<section class="relative pt-40 pb-28 overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1596928519198-83e0b5c8d900?w=1400&q=80"
             alt="Quartos" class="w-full h-full object-cover" style="filter: brightness(0.22);">
        <div class="absolute inset-0" style="background: linear-gradient(to bottom, var(--ink) 0%, transparent 30%, var(--ink) 100%);"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-6 lg:px-12">
        @auth
        <div style="margin-bottom:1.25rem;">
            <a href="{{ route('dashboard') }}" class="btn-outline" style="display:inline-flex; padding:0.55rem 1rem; font-size:0.72rem;">
                ← Voltar para Minha conta
            </a>
        </div>
        @endauth
        <span class="line-gold"></span>
        <p class="text-xs uppercase tracking-[0.25em] mb-3" style="color: var(--gold);">Acomodações</p>
        <h1 class="font-display text-6xl md:text-7xl" style="color: var(--cream); font-style: italic;">
            Quartos & Suítes
        </h1>
        <p class="mt-6 max-w-xl text-sm leading-relaxed" style="color: var(--muted-2);">
            Cada acomodação é um mundo próprio — pensada para oferecer conforto excepcional, privacidade e detalhes que surpreendem a cada descoberta.
        </p>
    </div>
</section>

<!-- ===== FILTROS ===== -->
<div id="filter-bar" style="background: var(--ink-2); border-top: 1px solid rgba(201,168,76,0.08); border-bottom: 1px solid rgba(201,168,76,0.08); position: sticky; top: 80px; z-index: 40; transition: border-color 0.3s;">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 py-5">
        <form id="filter-form" method="GET" action="{{ route('rooms') }}" class="flex flex-wrap items-end gap-5">

            {{-- Busca por nome --}}
            <div class="flex-1" style="min-width: 180px; max-width: 280px;">
                <label class="block text-xs uppercase tracking-widest mb-2" style="color: var(--muted-2);">Buscar</label>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Nome ou número…"
                       id="filter-search"
                       class="w-full px-4 py-2 text-xs rounded-sm focus:outline-none"
                       style="background: var(--ink-3); border: 1px solid rgba(201,168,76,0.12); color: var(--cream);">
            </div>

            {{-- Tipo --}}
            <div>
                <label class="block text-xs uppercase tracking-widest mb-2" style="color: var(--muted-2);">Tipo</label>
                <select name="type" id="filter-type"
                        class="px-4 py-2 text-xs rounded-sm focus:outline-none"
                        style="background: var(--ink-3); border: 1px solid rgba(201,168,76,0.12); color: var(--cream); min-width: 130px;">
                    <option value="todos" {{ request('type','todos') === 'todos' ? 'selected' : '' }}>Todos</option>
                    <option value="standard"     {{ request('type') === 'standard'     ? 'selected' : '' }}>Standard</option>
                    <option value="deluxe"       {{ request('type') === 'deluxe'       ? 'selected' : '' }}>Deluxe</option>
                    <option value="suite"        {{ request('type') === 'suite'        ? 'selected' : '' }}>Suíte</option>
                    <option value="presidential" {{ request('type') === 'presidential' ? 'selected' : '' }}>Presidencial</option>
                </select>
            </div>

            {{-- Preço --}}
            <div>
                <label class="block text-xs uppercase tracking-widest mb-2" style="color: var(--muted-2);">Preço</label>
                <select name="price" id="filter-price"
                        class="px-4 py-2 text-xs rounded-sm focus:outline-none"
                        style="background: var(--ink-3); border: 1px solid rgba(201,168,76,0.12); color: var(--cream);">
                    <option value="">Qualquer</option>
                    <option value="ate500"    {{ request('price') === 'ate500'    ? 'selected' : '' }}>Até R$ 500</option>
                    <option value="500a1000"  {{ request('price') === '500a1000'  ? 'selected' : '' }}>R$ 500 – R$ 1.000</option>
                    <option value="acima1000" {{ request('price') === 'acima1000' ? 'selected' : '' }}>Acima R$ 1.000</option>
                </select>
            </div>

            {{-- Capacidade --}}
            <div>
                <label class="block text-xs uppercase tracking-widest mb-2" style="color: var(--muted-2);">Hóspedes</label>
                <select name="capacity" id="filter-capacity"
                        class="px-4 py-2 text-xs rounded-sm focus:outline-none"
                        style="background: var(--ink-3); border: 1px solid rgba(201,168,76,0.12); color: var(--cream);">
                    <option value="">Qualquer</option>
                    <option value="1" {{ request('capacity') === '1' ? 'selected' : '' }}>1 hóspede</option>
                    <option value="2" {{ request('capacity') === '2' ? 'selected' : '' }}>2 hóspedes</option>
                    <option value="3" {{ request('capacity') === '3' ? 'selected' : '' }}>3 hóspedes</option>
                    <option value="4" {{ request('capacity') === '4' ? 'selected' : '' }}>4+ hóspedes</option>
                </select>
            </div>

            {{-- Indicador de loading --}}
            <div id="filter-loading" class="self-end pb-2 hidden">
                <span class="text-xs uppercase tracking-widest" style="color: var(--gold); opacity: 0.7;">
                    <span style="display:inline-block; animation: spin 1s linear infinite;">◌</span> Filtrando…
                </span>
            </div>

            @if(request()->hasAny(['type','price','search','capacity']))
                <a href="{{ route('rooms') }}" id="filter-clear"
                   class="text-xs uppercase tracking-widest self-end pb-2"
                   style="color: var(--muted);"
                   onmouseover="this.style.color='var(--gold)'" onmouseout="this.style.color='var(--muted)'">
                    ✕ Limpar
                </a>
            @endif
        </form>
    </div>
</div>

<style>
    @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

    #filter-type, #filter-price, #filter-capacity, #filter-search {
        transition: border-color 0.2s;
    }
    #filter-type:focus, #filter-price:focus, #filter-capacity:focus, #filter-search:focus {
        border-color: rgba(201,168,76,0.45) !important;
    }
    .filter-active {
        border-color: rgba(201,168,76,0.45) !important;
        color: var(--gold) !important;
    }
</style>

<!-- ===== GRID DE QUARTOS ===== -->
<section style="background: var(--ink);" class="py-24">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div id="rooms-grid">
            @include('pages.partials.rooms-grid')
        </div>
    </div>
</section>

{{-- Script DEPOIS do #rooms-grid para que getElementById funcione --}}
<script>
(function () {
    const form    = document.getElementById('filter-form');
    const grid    = document.getElementById('rooms-grid');
    const loading = document.getElementById('filter-loading');
    const search  = document.getElementById('filter-search');
    const selects = ['filter-type', 'filter-price', 'filter-capacity']
                        .map(id => document.getElementById(id))
                        .filter(Boolean);

    if (!form || !grid || !loading) return; // segurança: todos os elementos devem existir

    const baseUrl  = form.getAttribute('action');
    const basePath = new URL(baseUrl, location.origin).pathname;

    let abortCtrl = null;
    let debounce;

    /* ── Busca via AJAX ─────────────────────────────────── */
    function fetchRooms(fetchUrl) {
        if (abortCtrl) abortCtrl.abort();
        abortCtrl = new AbortController();

        loading.classList.remove('hidden');
        grid.style.opacity = '0.45';
        grid.style.transition = 'opacity .15s';

        fetch(fetchUrl, {
            signal: abortCtrl.signal,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.text())
        .then(html => {
            grid.innerHTML = html;
            grid.style.opacity = '1';
            loading.classList.add('hidden');
            markActive();
            bindPagination();
        })
        .catch(err => {
            if (err.name !== 'AbortError') {
                grid.style.opacity = '1';
                loading.classList.add('hidden');
            }
        });
    }

    /* ── Constrói URL com os filtros atuais do form ─────── */
    function filterUrl() {
        const params = new URLSearchParams(new FormData(form));
        for (const [k, v] of [...params]) { if (!v) params.delete(k); }
        const url = baseUrl + (params.toString() ? '?' + params.toString() : '');
        history.replaceState(null, '', url);
        return url;
    }

    /* ── Marca visualmente filtros ativos ───────────────── */
    function markActive() {
        selects.forEach(sel => {
            const on = sel.value && sel.value !== 'todos';
            sel.classList.toggle('filter-active', on);
        });
    }

    /* ── Paginação AJAX — só intercepta links para /quartos (não /quartos/123) ─ */
    function bindPagination() {
        grid.querySelectorAll('a').forEach(link => {
            try {
                const url = new URL(link.href, location.origin);
                if (url.pathname !== basePath) return;
            } catch { return; }

            link.addEventListener('click', function (e) {
                e.preventDefault();
                history.replaceState(null, '', this.href);
                fetchRooms(this.href);
                window.scrollTo({
                    top: grid.getBoundingClientRect().top + window.scrollY - 120,
                    behavior: 'smooth'
                });
            });
        });
    }

    /* ── Impede submit por Enter no campo busca ─────────── */
    form.addEventListener('submit', e => e.preventDefault());

    /* ── Eventos dos filtros ─────────────────────────────── */
    selects.forEach(sel => sel.addEventListener('change', () => fetchRooms(filterUrl())));

    if (search) {
        search.addEventListener('input', () => {
            clearTimeout(debounce);
            debounce = setTimeout(() => fetchRooms(filterUrl()), 350);
        });
    }

    /* ── Estado inicial ──────────────────────────────────── */
    markActive();
    bindPagination();
})();
</script>

<!-- ===== CTA ===== -->
<section class="py-20" style="background: var(--ink-2); border-top: 1px solid rgba(201,168,76,0.1);">
    <div class="max-w-3xl mx-auto px-6 text-center">
        <p class="text-xs uppercase tracking-[0.25em] mb-4" style="color: var(--gold);">Atendimento Exclusivo</p>
        <h2 class="font-display text-4xl mb-4" style="color: var(--cream); font-style: italic;">
            Não encontrou o ideal?
        </h2>
        <p class="text-sm mb-8" style="color: var(--muted-2);">
            Nossa equipe cria experiências sob medida para cada hóspede.
        </p>
        <a href="{{ route('contact') }}" class="btn-gold">Falar com Nossa Equipe</a>
    </div>
</section>

@endsection
