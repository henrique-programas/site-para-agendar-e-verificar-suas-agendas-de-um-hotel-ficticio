@extends('layouts.app')

@section('title', 'Chat ao Vivo')

@section('content')
<div style="min-height: 100vh; padding-top: 110px; padding-bottom: 4rem; background: var(--ink);">
    <div class="max-w-4xl mx-auto px-6 lg:px-12">
        <div style="margin-bottom: 1.25rem; display:flex; align-items:flex-end; justify-content:space-between; gap:1rem; flex-wrap:wrap;">
            <div>
                <span class="line-gold"></span>
                <h1 class="font-display text-4xl" style="color: var(--cream); font-style: italic;">Chat ao Vivo</h1>
                <p class="mt-3 text-sm" style="color: var(--muted-2);">Fale com nossa equipe. Suas mensagens ficam salvas.</p>
            </div>
            <a href="{{ route('contact') }}" class="btn-outline" style="padding:0.55rem 1rem;">Voltar</a>
        </div>

        <div class="card-dark" style="padding: 1rem; border-radius: 4px;">
            <div id="chat-box" style="height: 420px; overflow:auto; padding: 0.5rem;">
                @php $lastId = 0; @endphp
                @foreach($messages as $m)
                    @php $lastId = $m->id; @endphp
                    <div style="display:flex; margin:0.55rem 0; {{ $m->sender === 'user' ? 'justify-content:flex-end;' : 'justify-content:flex-start;' }}">
                        <div style="
                            max-width: 78%;
                            padding: 0.7rem 0.9rem;
                            border-radius: 10px;
                            font-size: 0.9rem;
                            line-height: 1.4;
                            background: {{ $m->sender === 'user' ? 'rgba(201,168,76,0.18)' : 'rgba(140,130,120,0.12)' }};
                            border: 1px solid {{ $m->sender === 'user' ? 'rgba(201,168,76,0.35)' : 'rgba(201,168,76,0.10)' }};
                            color: var(--cream);
                        ">
                            <div style="opacity:0.95;">{{ $m->message }}</div>
                            <div style="margin-top:0.35rem; font-size:0.68rem; letter-spacing:0.08em; text-transform:uppercase; color: var(--muted-2);">
                                {{ $m->sender === 'user' ? 'Você' : 'Equipe' }} · {{ $m->created_at->format('d/m H:i') }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <form method="POST" action="{{ route('chat.store') }}" style="margin-top: 0.75rem; display:flex; gap:0.5rem;">
                @csrf
                <input id="chat-input" name="message" required maxlength="2000" placeholder="Digite sua mensagem..."
                       style="flex:1; padding:0.75rem 0.9rem; background:var(--ink-2); border:1px solid rgba(201,168,76,0.12); color:var(--cream); border-radius:2px; outline:none;">
                <button type="submit" class="btn-gold" style="padding:0.75rem 1.25rem;">Enviar</button>
            </form>
        </div>
    </div>
</div>

<script>
    (function () {
        const box = document.getElementById('chat-box');
        if (box) box.scrollTop = box.scrollHeight;

        let afterId = {{ $lastId ?? 0 }};
        const pollUrl = @json(route('chat.poll'));

        function escapeHtml(s) {
            return (s || '').replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#039;');
        }

        async function poll() {
            try {
                const r = await fetch(pollUrl + '?after_id=' + afterId, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                if (!r.ok) return;
                const data = await r.json();
                if (!data.messages || data.messages.length === 0) return;

                for (const m of data.messages) {
                    afterId = Math.max(afterId, m.id);
                    const isUser = m.sender === 'user';
                    const row = document.createElement('div');
                    row.style.display = 'flex';
                    row.style.margin = '0.55rem 0';
                    row.style.justifyContent = isUser ? 'flex-end' : 'flex-start';

                    const bubble = document.createElement('div');
                    bubble.style.maxWidth = '78%';
                    bubble.style.padding = '0.7rem 0.9rem';
                    bubble.style.borderRadius = '10px';
                    bubble.style.fontSize = '0.9rem';
                    bubble.style.lineHeight = '1.4';
                    bubble.style.background = isUser ? 'rgba(201,168,76,0.18)' : 'rgba(140,130,120,0.12)';
                    bubble.style.border = '1px solid ' + (isUser ? 'rgba(201,168,76,0.35)' : 'rgba(201,168,76,0.10)');
                    bubble.style.color = 'var(--cream)';

                    const msg = document.createElement('div');
                    msg.style.opacity = '0.95';
                    msg.innerHTML = escapeHtml(m.message);

                    const meta = document.createElement('div');
                    meta.style.marginTop = '0.35rem';
                    meta.style.fontSize = '0.68rem';
                    meta.style.letterSpacing = '0.08em';
                    meta.style.textTransform = 'uppercase';
                    meta.style.color = 'var(--muted-2)';

                    const dt = new Date(m.created_at);
                    const d = String(dt.getDate()).padStart(2,'0');
                    const mo = String(dt.getMonth()+1).padStart(2,'0');
                    const h = String(dt.getHours()).padStart(2,'0');
                    const mi = String(dt.getMinutes()).padStart(2,'0');
                    meta.textContent = (isUser ? 'Você' : 'Equipe') + ' · ' + d + '/' + mo + ' ' + h + ':' + mi;

                    bubble.appendChild(msg);
                    bubble.appendChild(meta);
                    row.appendChild(bubble);
                    box.appendChild(row);
                }

                box.scrollTop = box.scrollHeight;
            } catch {}
        }

        setInterval(poll, 2500);
    })();
</script>
@endsection

