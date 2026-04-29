<x-guest-layout>
    <x-auth-shell
        title="Bem-vindo de volta"
        subtitle="Acesse sua conta para gerenciar suas reservas"
        :back-url="route('home')"
        back-label="Início">

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label style="display:block; font-size:0.7rem; text-transform:uppercase; letter-spacing:0.15em; color:#8a7560; margin-bottom:0.6rem;">
                    Email
                </label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                       style="width:100%; padding:0.85rem 1rem; background:#1c1610; border:1px solid rgba(201,168,76,0.15); color:#f0e8d5; border-radius:2px; font-size:0.9rem; outline:none; transition: border-color 0.2s;"
                       onfocus="this.style.borderColor='rgba(201,168,76,0.5)'"
                       onblur="this.style.borderColor='rgba(201,168,76,0.15)'"
                       placeholder="seu@email.com">
                @error('email')
                    <p style="color:#e07070; font-size:0.78rem; margin-top:0.4rem;">{{ $message }}</p>
                @enderror
            </div>

            <!-- Senha -->
            <div>
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:0.6rem;">
                    <label style="font-size:0.7rem; text-transform:uppercase; letter-spacing:0.15em; color:#8a7560;">
                        Senha
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           style="font-size:0.75rem; color:#c9a84c; text-decoration:none;"
                           onmouseover="this.style.color='#e2c47a'"
                           onmouseout="this.style.color='#c9a84c'">
                            Esqueceu a senha?
                        </a>
                    @endif
                </div>
                <input type="password" name="password" required
                       style="width:100%; padding:0.85rem 1rem; background:#1c1610; border:1px solid rgba(201,168,76,0.15); color:#f0e8d5; border-radius:2px; font-size:0.9rem; outline:none; transition: border-color 0.2s;"
                       onfocus="this.style.borderColor='rgba(201,168,76,0.5)'"
                       onblur="this.style.borderColor='rgba(201,168,76,0.15)'"
                       placeholder="••••••••">
                @error('password')
                    <p style="color:#e07070; font-size:0.78rem; margin-top:0.4rem;">{{ $message }}</p>
                @enderror
            </div>

            <!-- Lembrar-me -->
            <div style="display:flex; align-items:center; gap:0.6rem;">
                <input type="checkbox" name="remember" id="remember"
                       style="width:1rem; height:1rem; accent-color: #c9a84c;">
                <label for="remember" style="font-size:0.82rem; color:#8a7560; cursor:pointer;">
                    Lembrar minha conta
                </label>
            </div>

            <!-- Botão -->
            <div style="padding-top: 0.5rem;">
                <button type="submit"
                        style="width:100%; padding:0.95rem; background:#c9a84c; color:#0a0806; font-size:0.75rem; font-weight:500; letter-spacing:0.15em; text-transform:uppercase; border:none; border-radius:2px; cursor:pointer; transition: background 0.2s;"
                        onmouseover="this.style.background='#e2c47a'"
                        onmouseout="this.style.background='#c9a84c'">
                    Entrar
                </button>
            </div>
        </form>

        <x-slot:footer>
            <p style="text-align:center; font-size:0.82rem; color:#5c5040; padding-top:0.5rem;">
                Não tem conta?
                <a href="{{ route('register') }}"
                   style="color:#c9a84c; text-decoration:none; margin-left:0.25rem;"
                   onmouseover="this.style.color='#e2c47a'"
                   onmouseout="this.style.color='#c9a84c'">
                    Criar conta
                </a>
            </p>
        </x-slot:footer>
    </x-auth-shell>
</x-guest-layout>