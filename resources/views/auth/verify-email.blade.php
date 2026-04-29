<x-guest-layout>
    <x-auth-shell
        title="Verifique seu email"
        subtitle="Enviamos um link de verificação para seu email. Confirme para continuar.">

        @if (session('status') === 'verification-link-sent')
            <div style="background: rgba(60,160,100,0.12); border: 1px solid rgba(60,160,100,0.25); color: #5cc890; padding: 0.75rem 1rem; border-radius: 2px; margin-bottom: 1.5rem; font-size: 0.85rem;">
                Um novo link de verificação foi enviado para o seu email.
            </div>
        @endif

        <div style="background: rgba(201,168,76,0.06); border: 1px solid rgba(201,168,76,0.12); color: #8a7560; padding: 0.85rem 1rem; border-radius: 2px; margin-bottom: 1.5rem; font-size: 0.85rem; line-height: 1.65;">
            Se não encontrar na caixa de entrada, verifique o spam/lixo eletrônico. Você pode solicitar um novo envio abaixo.
        </div>

        <div style="display:flex; gap:0.75rem; flex-wrap:wrap;">
            <form method="POST" action="{{ route('verification.send') }}" style="flex:1; min-width:220px;">
                @csrf
                <button type="submit"
                        style="width:100%; padding:0.95rem; background:#c9a84c; color:#0a0806; font-size:0.75rem; font-weight:500; letter-spacing:0.15em; text-transform:uppercase; border:none; border-radius:2px; cursor:pointer; transition: background 0.2s;"
                        onmouseover="this.style.background='#e2c47a'" onmouseout="this.style.background='#c9a84c'">
                    Reenviar verificação
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}" style="min-width:180px;">
                @csrf
                <button type="submit"
                        style="width:100%; padding:0.95rem; background:transparent; border:1px solid rgba(201,168,76,0.2); color:#8a7560; font-size:0.75rem; font-weight:500; letter-spacing:0.15em; text-transform:uppercase; border-radius:2px; cursor:pointer; transition: all 0.2s;"
                        onmouseover="this.style.borderColor='rgba(201,168,76,0.45)'; this.style.color='#c9a84c'"
                        onmouseout="this.style.borderColor='rgba(201,168,76,0.2)'; this.style.color='#8a7560'">
                    Sair
                </button>
            </form>
        </div>
    </x-auth-shell>
</x-guest-layout>
