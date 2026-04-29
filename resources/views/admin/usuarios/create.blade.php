@extends('layouts.admin')

@section('page-title', 'Novo Usuário')
@section('breadcrumb', '<a href="'.route('admin.usuarios.index').'" style="color:#c9a84c;">Usuários</a> / Novo')

@section('content')
<style>
    .form-card { background:#1c1610; border:1px solid rgba(201,168,76,0.1); border-radius:3px; padding:2rem; max-width:520px; }
    .form-group { display:flex; flex-direction:column; gap:0.5rem; margin-bottom:1.25rem; }
    label { font-size:0.65rem; text-transform:uppercase; letter-spacing:0.15em; color:#8a7560; }
    .form-input, .form-select { padding:0.8rem 1rem; background:#110e0a; border:1px solid rgba(201,168,76,0.12); color:#f0e8d5; border-radius:2px; font-size:0.88rem; outline:none; font-family:'DM Sans',sans-serif; transition:border-color 0.2s; width:100%; }
    .form-input:focus, .form-select:focus { border-color:rgba(201,168,76,0.4); }
    .form-input::placeholder { color:#5c5040; }
    .error-msg { font-size:0.75rem; color:#e07070; margin-top:0.2rem; }
    .form-actions { display:flex; gap:0.75rem; margin-top:1.75rem; padding-top:1.5rem; border-top:1px solid rgba(201,168,76,0.08); }
    .btn-gold { display:inline-flex; align-items:center; gap:0.5rem; padding:0.7rem 1.6rem; background:#c9a84c; color:#0a0806; border:none; border-radius:2px; font-size:0.75rem; font-weight:500; letter-spacing:0.12em; text-transform:uppercase; cursor:pointer; transition:background 0.2s; font-family:'DM Sans',sans-serif; }
    .btn-gold:hover { background:#e2c47a; }
    .btn-cancel { display:inline-flex; align-items:center; padding:0.7rem 1.4rem; background:transparent; border:1px solid rgba(201,168,76,0.18); color:#8a7560; border-radius:2px; font-size:0.75rem; letter-spacing:0.12em; text-transform:uppercase; cursor:pointer; text-decoration:none; transition:all 0.2s; font-family:'DM Sans',sans-serif; }
    .btn-cancel:hover { border-color:rgba(201,168,76,0.35); color:#c8bba5; }
    .role-info { font-size:0.75rem; color:#5c5040; margin-top:0.35rem; line-height:1.5; }
</style>

<div class="form-card">
    <form method="POST" action="{{ route('admin.usuarios.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Nome completo *</label>
            <input id="name" name="name" type="text" class="form-input"
                   value="{{ old('name') }}" placeholder="Nome do usuário" required autofocus>
            @error('name') <span class="error-msg">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="email">Email *</label>
            <input id="email" name="email" type="email" class="form-input"
                   value="{{ old('email') }}" placeholder="email@exemplo.com" required>
            @error('email') <span class="error-msg">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="role">Perfil *</label>
            <select id="role" name="role" class="form-select" required onchange="updateRoleInfo(this.value)">
                <option value="client" {{ old('role','client') === 'client' ? 'selected' : '' }}>Cliente</option>
                <option value="admin"  {{ old('role') === 'admin' ? 'selected' : '' }}>Administrador</option>
            </select>
            <p id="role-info" class="role-info">Acesso à área do hóspede: reservas e perfil.</p>
            @error('role') <span class="error-msg">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="password">Senha *</label>
            <input id="password" name="password" type="password" class="form-input"
                   placeholder="Mínimo 8 caracteres" required>
            @error('password') <span class="error-msg">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmar senha *</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="form-input"
                   placeholder="Repita a senha" required>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-gold">Criar Usuário</button>
            <a href="{{ route('admin.usuarios.index') }}" class="btn-cancel">Cancelar</a>
        </div>
    </form>
</div>

<script>
const roleInfo = {
    client: 'Acesso à área do hóspede: reservas e perfil.',
    admin:  'Acesso completo ao painel administrativo.'
};
function updateRoleInfo(val) {
    document.getElementById('role-info').textContent = roleInfo[val] ?? '';
}
</script>
@endsection
