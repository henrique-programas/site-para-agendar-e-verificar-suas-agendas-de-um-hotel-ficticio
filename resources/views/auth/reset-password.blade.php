<x-guest-layout>
    <x-auth-shell
        title="Redefinir senha"
        subtitle="Crie uma nova senha para acessar sua conta"
        :back-url="route('login')"
        back-label="Login">

        <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email -->
            <div>
                <label for="email" style="display:block; font-size:0.7rem; text-transform:uppercase; letter-spacing:0.15em; color:#8a7560; margin-bottom:0.6rem;">
                    Email
                </label>
                <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"
                       style="width:100%; padding:0.85rem 1rem; background:#1c1610; border:1px solid rgba(201,168,76,0.15); color:#f0e8d5; border-radius:2px; font-size:0.9rem; outline:none; transition: border-color 0.2s;"
                       onfocus="this.style.borderColor='rgba(201,168,76,0.5)'" onblur="this.style.borderColor='rgba(201,168,76,0.15)'"
                       placeholder="seu@email.com">
                @error('email')
                    <p style="color:#e07070; font-size:0.78rem; margin-top:0.4rem;">{{ $message }}</p>
                @enderror
            </div>

            <!-- Senha -->
            <div>
                <label for="password" style="display:block; font-size:0.7rem; text-transform:uppercase; letter-spacing:0.15em; color:#8a7560; margin-bottom:0.6rem;">
                    Nova senha
                </label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                       style="width:100%; padding:0.85rem 1rem; background:#1c1610; border:1px solid rgba(201,168,76,0.15); color:#f0e8d5; border-radius:2px; font-size:0.9rem; outline:none; transition: border-color 0.2s;"
                       onfocus="this.style.borderColor='rgba(201,168,76,0.5)'" onblur="this.style.borderColor='rgba(201,168,76,0.15)'"
                       placeholder="••••••••">
                @error('password')
                    <p style="color:#e07070; font-size:0.78rem; margin-top:0.4rem;">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirmar senha -->
            <div>
                <label for="password_confirmation" style="display:block; font-size:0.7rem; text-transform:uppercase; letter-spacing:0.15em; color:#8a7560; margin-bottom:0.6rem;">
                    Confirmar senha
                </label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                       style="width:100%; padding:0.85rem 1rem; background:#1c1610; border:1px solid rgba(201,168,76,0.15); color:#f0e8d5; border-radius:2px; font-size:0.9rem; outline:none; transition: border-color 0.2s;"
                       onfocus="this.style.borderColor='rgba(201,168,76,0.5)'" onblur="this.style.borderColor='rgba(201,168,76,0.15)'"
                       placeholder="••••••••">
                @error('password_confirmation')
                    <p style="color:#e07070; font-size:0.78rem; margin-top:0.4rem;">{{ $message }}</p>
                @enderror
            </div>

            <div style="padding-top: 0.5rem;">
                <button type="submit"
                        style="width:100%; padding:0.95rem; background:#c9a84c; color:#0a0806; font-size:0.75rem; font-weight:500; letter-spacing:0.15em; text-transform:uppercase; border:none; border-radius:2px; cursor:pointer; transition: background 0.2s;"
                        onmouseover="this.style.background='#e2c47a'" onmouseout="this.style.background='#c9a84c'">
                    Salvar nova senha
                </button>
            </div>
        </form>

        <x-slot:footer>
            <p style="text-align:center; font-size:0.82rem; color:#5c5040;">
                Se não foi você, volte para
                <a href="{{ route('login') }}"
                   style="color:#c9a84c; text-decoration:none; margin-left:0.25rem;"
                   onmouseover="this.style.color='#e2c47a'" onmouseout="this.style.color='#c9a84c'">
                    login
                </a>
            </p>
        </x-slot:footer>
    </x-auth-shell>
</x-guest-layout>
