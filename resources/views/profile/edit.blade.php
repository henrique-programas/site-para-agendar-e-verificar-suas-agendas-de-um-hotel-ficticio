@extends('layouts.app')

@section('title', 'Dados pessoais')

@php
    $u = $user;
    $fmtCpf = function (?string $d) {
        $d = preg_replace('/\D/', '', (string) ($d ?? ''));
        if (strlen($d) !== 11) {
            return '';
        }
        return substr($d, 0, 3).'.'.substr($d, 3, 3).'.'.substr($d, 6, 3).'-'.substr($d, 9, 2);
    };
    $fmtPhone = function (?string $d) {
        $d = preg_replace('/\D/', '', (string) ($d ?? ''));
        if (strlen($d) !== 11) {
            return $d;
        }
        return '(' . substr($d, 0, 2) . ') ' . substr($d, 2, 5) . '-' . substr($d, 7, 4);
    };
    $fmtCep = function (?string $d) {
        $d = preg_replace('/\D/', '', (string) ($d ?? ''));
        if (strlen($d) !== 8) {
            return $d;
        }
        return substr($d, 0, 5) . '-' . substr($d, 5, 3);
    };
@endphp

@section('content')
<div style="min-height:100vh;padding-top:100px;padding-bottom:4rem;background:var(--ink);">
    <div class="max-w-5xl mx-auto px-6 lg:px-12">

        <div style="margin-bottom:2rem;display:flex;align-items:flex-end;justify-content:space-between;gap:1rem;flex-wrap:wrap;">
            <div>
                <span style="display:block;width:48px;height:1px;background:var(--gold);margin-bottom:1rem;"></span>
                <h1 style="font-family:'Cormorant Garamond',serif;font-size:2.4rem;color:var(--cream);font-style:italic;">
                    Dados pessoais
                </h1>
                <p style="color:var(--muted-2);font-size:0.85rem;margin-top:0.35rem;">
                    Atualize suas informações e endereço
                </p>
            </div>
            <a href="{{ route('dashboard') }}" class="btn-outline" style="padding:0.55rem 1.1rem;">← Voltar para Minha conta</a>
        </div>

        @php
            $inStyle = 'width:100%;padding:0.75rem 0.9rem;background:var(--ink-2);border:1px solid rgba(201,168,76,0.12);color:var(--cream);border-radius:2px;outline:none;font-size:0.9rem;';
            $labStyle = 'display:block;font-size:0.65rem;text-transform:uppercase;letter-spacing:0.14em;color:var(--muted-2);margin-bottom:0.45rem;';
        @endphp

        <!-- Dados cadastrais -->
        <div class="card-dark" style="padding:1.75rem;margin-bottom:1.5rem;border-radius:3px;">
            <h2 style="font-family:'Cormorant Garamond',serif;color:var(--gold);font-size:1.2rem;margin-bottom:1.25rem;font-style:italic;">
                Informações gerais
            </h2>

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <div style="display:grid;gap:1.1rem;">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-2">
                            <label style="{{ $labStyle }}">Nome completo</label>
                            <input name="name" type="text" required value="{{ old('name', $u->name) }}" style="{{ $inStyle }}"/>
                            @error('name') <p style="color:#e07070;font-size:0.8rem;margin-top:0.35rem;">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label style="{{ $labStyle }}">E-mail</label>
                            <input name="email" type="email" required value="{{ old('email', $u->email) }}" style="{{ $inStyle }}" autocomplete="email"/>
                            @error('email') <p style="color:#e07070;font-size:0.8rem;margin-top:0.35rem;">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label style="{{ $labStyle }}">Celular (WhatsApp)</label>
                            <input name="phone" type="text" placeholder="(11) 99999-9999" value="{{ old('phone', $fmtPhone($u->phone)) }}" style="{{ $inStyle }}"/>
                            @error('phone') <p style="color:#e07070;font-size:0.8rem;margin-top:0.35rem;">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label style="{{ $labStyle }}">CPF</label>
                            <input name="cpf" type="text" maxlength="14" placeholder="000.000.000-00" value="{{ old('cpf', $fmtCpf($u->cpf)) }}" style="{{ $inStyle }}"/>
                            @error('cpf') <p style="color:#e07070;font-size:0.8rem;margin-top:0.35rem;">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label style="{{ $labStyle }}">Data de nascimento</label>
                            <input name="birth_date" type="date" value="{{ old('birth_date', optional($u->birth_date)->format('Y-m-d')) }}" style="{{ $inStyle }}"/>
                            @error('birth_date') <p style="color:#e07070;font-size:0.8rem;margin-top:0.35rem;">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label style="{{ $labStyle }}">Gênero</label>
                            @php $g = old('gender', $u->gender); @endphp
                            <select name="gender" style="{{ $inStyle }}">
                                <option value="">Prefiro não informar</option>
                                <option value="M" @selected($g === 'M')>Masculino</option>
                                <option value="F" @selected($g === 'F')>Feminino</option>
                                <option value="O" @selected($g === 'O')>Outro</option>
                                <option value="N" @selected($g === 'N')>Não binário</option>
                            </select>
                            @error('gender') <p style="color:#e07070;font-size:0.8rem;margin-top:0.35rem;">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <hr style="border:none;border-top:1px solid rgba(201,168,76,0.1);margin:0.35rem 0;">

                    <h3 style="font-size:0.68rem;letter-spacing:0.22em;text-transform:uppercase;color:var(--muted-2);">Endereço</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-2">
                            <label style="{{ $labStyle }}">Logradouro</label>
                            <input name="address_street" type="text" value="{{ old('address_street', $u->address_street) }}" style="{{ $inStyle }}"/>
                            @error('address_street') <p style="color:#e07070;font-size:0.8rem;margin-top:0.35rem;">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label style="{{ $labStyle }}">Número</label>
                            <input name="address_number" type="text" value="{{ old('address_number', $u->address_number) }}" style="{{ $inStyle }}"/>
                            @error('address_number') <p style="color:#e07070;font-size:0.8rem;margin-top:0.35rem;">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label style="{{ $labStyle }}">Complemento</label>
                            <input name="address_complement" type="text" value="{{ old('address_complement', $u->address_complement) }}" style="{{ $inStyle }}"/>
                            @error('address_complement') <p style="color:#e07070;font-size:0.8rem;margin-top:0.35rem;">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label style="{{ $labStyle }}">Bairro</label>
                            <input name="address_neighborhood" type="text" value="{{ old('address_neighborhood', $u->address_neighborhood) }}" style="{{ $inStyle }}"/>
                            @error('address_neighborhood') <p style="color:#e07070;font-size:0.8rem;margin-top:0.35rem;">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label style="{{ $labStyle }}">Cidade</label>
                            <input name="address_city" type="text" value="{{ old('address_city', $u->address_city) }}" style="{{ $inStyle }}"/>
                            @error('address_city') <p style="color:#e07070;font-size:0.8rem;margin-top:0.35rem;">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label style="{{ $labStyle }}">UF</label>
                            <input name="address_state" type="text" maxlength="2" placeholder="SP" value="{{ old('address_state', $u->address_state) }}" style="{{ $inStyle }}" class="uppercase"/>
                            @error('address_state') <p style="color:#e07070;font-size:0.8rem;margin-top:0.35rem;">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label style="{{ $labStyle }}">CEP</label>
                            <input name="cep" type="text" maxlength="9" placeholder="00000-000" value="{{ old('cep', $fmtCep($u->cep)) }}" style="{{ $inStyle }}"/>
                            @error('cep') <p style="color:#e07070;font-size:0.8rem;margin-top:0.35rem;">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-gold mt-8" style="margin-top:1.5rem;">Salvar dados</button>
            </form>
        </div>

        <!-- Senha -->
        <div class="card-dark" style="padding:1.75rem;margin-bottom:1.5rem;border-radius:3px;">
            <h2 style="font-family:'Cormorant Garamond',serif;color:var(--gold);font-size:1.2rem;margin-bottom:0.85rem;font-style:italic;">
                Alterar senha
            </h2>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div style="display:grid;gap:1rem;max-width:28rem;">
                    <div>
                        <label style="{{ $labStyle }}">Senha atual</label>
                        <input type="password" name="current_password" autocomplete="current-password" style="{{ $inStyle }}"/>
                        @error('current_password', 'updatePassword')
                            <p style="color:#e07070;font-size:0.8rem;margin-top:0.35rem;">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label style="{{ $labStyle }}">Nova senha</label>
                        <input type="password" name="password" autocomplete="new-password" style="{{ $inStyle }}"/>
                        @error('password', 'updatePassword')
                            <p style="color:#e07070;font-size:0.8rem;margin-top:0.35rem;">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label style="{{ $labStyle }}">Confirmar nova senha</label>
                        <input type="password" name="password_confirmation" autocomplete="new-password" style="{{ $inStyle }}"/>
                        @error('password_confirmation', 'updatePassword')
                            <p style="color:#e07070;font-size:0.8rem;margin-top:0.35rem;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn-outline mt-8" style="margin-top:1.25rem;">Atualizar senha</button>
            </form>
        </div>

        <!-- Excluir conta -->
        <div class="card-dark" style="padding:1.75rem;border-radius:3px;border-color:rgba(200,70,70,0.25);">
            <h2 style="font-family:'Cormorant Garamond',serif;color:#e07070;font-size:1.2rem;margin-bottom:0.5rem;font-style:italic;">
                Excluir conta
            </h2>
            <p style="color:var(--muted-2);font-size:0.85rem;margin-bottom:1.25rem;max-width:36rem;line-height:1.55;">
                Sua conta e dados associados serão removidos. Digite sua senha para confirmar.
            </p>

            <form method="POST" action="{{ route('profile.destroy') }}"
                  data-swal-title="Excluir conta?"
                  data-swal-text="Esta ação é permanente. Tem certeza?"
                  data-swal-confirm="Excluir"
                  data-swal-icon="warning">
                @csrf
                @method('delete')

                <div style="max-width:20rem;">
                    <label style="{{ $labStyle }}">Senha</label>
                    <input type="password" name="password" autocomplete="current-password" required style="{{ $inStyle }}"/>
                    @error('password', 'userDeletion')
                        <p style="color:#e07070;font-size:0.8rem;margin-top:0.35rem;">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn-outline-dark" style="margin-top:1.1rem;border-color:rgba(224,112,112,0.5);color:#e07070;">
                    Excluir minha conta
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
