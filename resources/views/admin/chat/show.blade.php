@extends('layouts.admin')

@section('page-title', 'Chat')
@section('breadcrumb')
    <a href="{{ route('admin.chat.index') }}">Chat</a> / {{ $user->name }}
@endsection

@section('content')
<style>
    .wrap { display:grid; grid-template-columns: 1fr; gap:1rem; }
    .card { background:#1c1610; border:1px solid rgba(201,168,76,0.08); border-radius:3px; overflow:hidden; }
    .head { padding:1rem 1.25rem; border-bottom:1px solid rgba(201,168,76,0.07); display:flex; align-items:center; justify-content:space-between; gap:1rem; }
    .title { font-family:'Cormorant Garamond',serif; color:#f0e8d5; font-style:italic; font-size:1.2rem; }
    .sub { font-size:0.75rem; color:#8a7560; }
    .box { height: 460px; overflow:auto; padding: 0.75rem 1rem; }
    .row { display:flex; margin:0.55rem 0; }
    .row.user { justify-content:flex-start; }
    .row.admin { justify-content:flex-end; }
    .bubble { max-width:78%; padding:0.7rem 0.9rem; border-radius:10px; font-size:0.9rem; line-height:1.4; color:#f0e8d5; }
    .bubble.user { background: rgba(140,130,120,0.12); border: 1px solid rgba(201,168,76,0.10); }
    .bubble.admin { background: rgba(201,168,76,0.18); border: 1px solid rgba(201,168,76,0.35); }
    .meta { margin-top:0.35rem; font-size:0.68rem; letter-spacing:0.08em; text-transform:uppercase; color:#8a7560; }
    .form { padding:1rem 1.25rem; border-top:1px solid rgba(201,168,76,0.07); display:flex; gap:0.5rem; }
    .input { flex:1; padding:0.75rem 0.9rem; background:#110e0a; border:1px solid rgba(201,168,76,0.12); color:#f0e8d5; border-radius:2px; outline:none; }
    .btn { padding:0.75rem 1.25rem; background:#c9a84c; color:#0a0806; border:none; border-radius:2px; font-size:0.75rem; letter-spacing:0.15em; text-transform:uppercase; cursor:pointer; }
    .btn:hover { background:#e2c47a; }
    .link { font-size:0.75rem; color:#8a7560; text-decoration:none; border:1px solid rgba(201,168,76,0.12); padding:0.45rem 0.8rem; border-radius:2px; }
    .link:hover { color:#c8bba5; border-color:rgba(201,168,76,0.35); }
</style>

<div class="wrap">
    <div class="card">
        <div class="head">
            <div>
                <div class="title">{{ $user->name }}</div>
                <div class="sub">{{ $user->email }}</div>
            </div>
            <a class="link" href="{{ route('admin.chat.index') }}">← Voltar</a>
        </div>

        <div id="chat-box" class="box">
            @php $lastId = 0; @endphp
            @foreach($messages as $m)
                @php $lastId = $m->id; @endphp
                <div class="row {{ $m->sender }}">
                    <div class="bubble {{ $m->sender }}">
                        <div style="opacity:0.95;">{{ $m->message }}</div>
                        <div class="meta">
                            {{ $m->sender === 'admin' ? 'Equipe' : 'Cliente' }} · {{ $m->created_at->format('d/m H:i') }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <form method="POST" action="{{ route('admin.chat.store', $user) }}" class="form">
            @csrf
            <input name="message" required maxlength="2000" class="input" placeholder="Digite sua resposta...">
            <button class="btn" type="submit">Enviar</button>
        </form>
    </div>
</div>

<script>
    (function () {
        const box = document.getElementById('chat-box');
        if (box) box.scrollTop = box.scrollHeight;

        let afterId = {{ $lastId ?? 0 }};
        const pollUrl = @json(route('admin.chat.poll', $user));

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
                    const row = document.createElement('div');
                    row.className = 'row ' + m.sender;

                    const bubble = document.createElement('div');
                    bubble.className = 'bubble ' + m.sender;

                    const msg = document.createElement('div');
                    msg.style.opacity = '0.95';
                    msg.innerHTML = escapeHtml(m.message);

                    const meta = document.createElement('div');
                    meta.className = 'meta';
                    const dt = new Date(m.created_at);
                    const d = String(dt.getDate()).padStart(2,'0');
                    const mo = String(dt.getMonth()+1).padStart(2,'0');
                    const h = String(dt.getHours()).padStart(2,'0');
                    const mi = String(dt.getMinutes()).padStart(2,'0');
                    meta.textContent = (m.sender === 'admin' ? 'Equipe' : 'Cliente') + ' · ' + d + '/' + mo + ' ' + h + ':' + mi;

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

