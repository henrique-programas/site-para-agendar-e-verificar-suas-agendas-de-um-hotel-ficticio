<x-guest-layout>
    <x-auth-shell
        title="Esqueceu sua senha?"
        subtitle="Informe seu email para enviarmos um link de redefinição"
        :back-url="route('login')"
        back-label="Login">

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" style="display:block; font-size:0.7rem; text-transform:uppercase; letter-spacing:0.15em; color:#8a7560; margin-bottom:0.6rem;">
                    Email
                </label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                       style="width:100%; padding:0.85rem 1rem; background:#1c1610; border:1px solid rgba(201,168,76,0.15); color:#f0e8d5; border-radius:2px; font-size:0.9rem; outline:none; transition: border-color 0.2s;"
                       onfocus="this.style.borderColor='rgba(201,168,76,0.5)'" onblur="this.style.borderColor='rgba(201,168,76,0.15)'"
                       placeholder="seu@email.com">
                @error('email')
                    <p style="color:#e07070; font-size:0.78rem; margin-top:0.4rem;">{{ $message }}</p>
                @enderror
            </div>

            <div style="padding-top: 0.5rem;">
                <button type="submit"
                        style="width:100%; padding:0.95rem; background:#c9a84c; color:#0a0806; font-size:0.75rem; font-weight:500; letter-spacing:0.15em; text-transform:uppercase; border:none; border-radius:2px; cursor:pointer; transition: background 0.2s;"
                        onmouseover="this.style.background='#e2c47a'" onmouseout="this.style.background='#c9a84c'">
                    Enviar link de redefinição
                </button>
            </div>
        </form>

        <x-slot:footer>
            <p style="text-align:center; font-size:0.82rem; color:#5c5040;">
                Lembrou a senha?
                <a href="{{ route('login') }}"
                   style="color:#c9a84c; text-decoration:none; margin-left:0.25rem;"
                   onmouseover="this.style.color='#e2c47a'" onmouseout="this.style.color='#c9a84c'">
                    Voltar para o login
                </a>
            </p>
        </x-slot:footer>
    </x-auth-shell>
</x-guest-layout>
