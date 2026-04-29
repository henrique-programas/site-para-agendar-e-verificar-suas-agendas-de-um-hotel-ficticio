<x-guest-layout>
<div class="min-h-screen flex">

    <!-- Lado esquerdo — imagem -->
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">
        <div class="absolute inset-0" style="
            background-image: url('https://images.unsplash.com/photo-1566073771259-6a8506099945?w=1200&q=80');
            background-size: cover;
            background-position: center;
            filter: brightness(0.45);
        "></div>
        <div class="absolute inset-0" style="background: linear-gradient(to right, transparent 60%, #0a0806 100%);"></div>
        <div class="relative flex flex-col justify-end p-16">
            <p style="color: #c9a84c; font-size: 0.7rem; letter-spacing: 0.3em; text-transform: uppercase; margin-bottom: 1rem;">Resort & Spa</p>
            <h1 style="font-family: 'Cormorant Garamond', serif; font-size: 4rem; color: #f0e8d5; font-style: italic; line-height: 1;">
                Calm<span style="color: #c9a84c;">Mind</span>
            </h1>
            <p style="color: #8a7560; font-size: 0.85rem; margin-top: 1rem; max-width: 300px; line-height: 1.6;">
                Seu refúgio de tranquilidade e elegância.
            </p>
        </div>
    </div>

    <!-- Lado direito — formulário -->
    <div class="w-full lg:w-1/2 flex items-center justify-center px-8 py-16" style="background: #0a0806;">
        <div class="w-full max-w-md">

            <!-- Logo mobile -->
            <div class="lg:hidden text-center mb-12">
                <h1 style="font-family: 'Cormorant Garamond', serif; font-size: 3rem; color: #f0e8d5; font-style: italic;">
                    Calm<span style="color: #c9a84c;">Mind</span>
                </h1>
            </div>

            <div style="margin-bottom: 2.5rem;">
                <span style="display:block; width:48px; height:1px; background:#c9a84c; margin-bottom:1.5rem;"></span>
                <h2 style="font-family: 'Cormorant Garamond', serif; font-size: 2.5rem; color: #f0e8d5; font-style: italic;">
                    Bem-vindo de volta
                </h2>
                <p style="color: #8a7560; font-size: 0.85rem; margin-top: 0.5rem;">
                    Acesse sua conta para gerenciar suas reservas
                </p>
            </div>

            <!-- Erro de sessão -->
            @if (session('status'))
                <div style="background: rgba(46,125,138,0.15); border: 1px solid rgba(46,125,138,0.3); color: #3fa0b0; padding: 0.75rem 1rem; border-radius: 2px; margin-bottom: 1.5rem; font-size: 0.85rem;">
                    {{ session('status') }}
                </div>
            @endif

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

                <!-- Link para cadastro -->
                <p style="text-align:center; font-size:0.82rem; color:#5c5040; padding-top:0.5rem;">
                    Não tem conta?
                    <a href="{{ route('register') }}"
                       style="color:#c9a84c; text-decoration:none; margin-left:0.25rem;"
                       onmouseover="this.style.color='#e2c47a'"
                       onmouseout="this.style.color='#c9a84c'">
                        Criar conta
                    </a>
                </p>
            </form>
        </div>
    </div>
</div>
</x-guest-layout>