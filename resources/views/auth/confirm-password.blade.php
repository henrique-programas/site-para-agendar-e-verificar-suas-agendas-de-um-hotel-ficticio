<x-guest-layout>
    <x-auth-shell
        title="Confirmar senha"
        subtitle="Por segurança, confirme sua senha para continuar"
        :back-url="route('dashboard')"
        back-label="Conta">

        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
            @csrf

            <!-- Senha -->
            <div>
                <label for="password" style="display:block; font-size:0.7rem; text-transform:uppercase; letter-spacing:0.15em; color:#8a7560; margin-bottom:0.6rem;">
                    Senha
                </label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                       style="width:100%; padding:0.85rem 1rem; background:#1c1610; border:1px solid rgba(201,168,76,0.15); color:#f0e8d5; border-radius:2px; font-size:0.9rem; outline:none; transition: border-color 0.2s;"
                       onfocus="this.style.borderColor='rgba(201,168,76,0.5)'" onblur="this.style.borderColor='rgba(201,168,76,0.15)'"
                       placeholder="••••••••">
                @error('password')
                    <p style="color:#e07070; font-size:0.78rem; margin-top:0.4rem;">{{ $message }}</p>
                @enderror
            </div>

            <div style="padding-top: 0.5rem;">
                <button type="submit"
                        style="width:100%; padding:0.95rem; background:#c9a84c; color:#0a0806; font-size:0.75rem; font-weight:500; letter-spacing:0.15em; text-transform:uppercase; border:none; border-radius:2px; cursor:pointer; transition: background 0.2s;"
                        onmouseover="this.style.background='#e2c47a'" onmouseout="this.style.background='#c9a84c'">
                    Confirmar
                </button>
            </div>
        </form>
    </x-auth-shell>
</x-guest-layout>
