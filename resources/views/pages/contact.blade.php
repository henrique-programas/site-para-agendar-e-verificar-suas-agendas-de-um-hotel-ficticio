@extends('layouts.app')
@section('title', 'Contato — Calm Mind Resort & Spa')
@section('content')

<!-- ===== HERO ===== -->
<section class="relative pt-44 pb-28">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1586611292717-f828b167408c?w=1400&q=80"
             alt="Contato" class="w-full h-full object-cover" style="filter: brightness(0.18);">
        <div class="absolute inset-0" style="background: linear-gradient(to bottom, var(--ink) 0%, transparent 30%, var(--ink) 100%);"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-6 lg:px-12">
        <span class="line-gold"></span>
        <p class="text-xs uppercase tracking-[0.25em] mb-3" style="color: var(--gold);">Fale Conosco</p>
        <h1 class="font-display text-6xl md:text-7xl" style="color: var(--cream); font-style: italic;">
            Entre em<br>Contato
        </h1>
        <p class="mt-6 max-w-md text-sm leading-relaxed" style="color: var(--muted-2);">
            Nossa equipe está disponível para tornar sua experiência inesquecível desde o primeiro contato.
        </p>
    </div>
</section>

<!-- ===== INFO + FORMULÁRIO ===== -->
<section style="background: var(--ink);" class="py-24">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-16">

            <!-- Informações (esquerda) -->
            <div class="lg:col-span-2">
                <span class="line-gold"></span>
                <h2 class="font-display text-3xl mb-8" style="color: var(--cream); font-style: italic;">
                    Como podemos ajudar?
                </h2>

                <div class="space-y-8">
                    @foreach([
                        ['icon' => '📞', 'label' => 'Telefone',    'val' => '+55 (11) 9999-9999',     'sub' => 'Segunda a domingo, 8h – 21h'],
                        ['icon' => '✉️', 'label' => 'Email',       'val' => 'contato@calmmind.com',   'sub' => 'Respondemos em até 24h'],
                        ['icon' => '📍', 'label' => 'Endereço',    'val' => 'Av. Brasil, 1000',        'sub' => 'São Paulo — SP, Brasil'],
                    ] as $c)
                    <div class="flex gap-4">
                        <div class="w-10 h-10 flex items-center justify-center flex-shrink-0 rounded-sm text-xl"
                             style="background: var(--ink-3); border: 1px solid rgba(201,168,76,0.12);">
                            {{ $c['icon'] }}
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-widest mb-1" style="color: var(--gold);">{{ $c['label'] }}</p>
                            <p class="text-sm mb-1" style="color: var(--cream);">{{ $c['val'] }}</p>
                            <p class="text-xs" style="color: var(--muted-2);">{{ $c['sub'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Divisor -->
                <div class="divider-gold my-10"></div>

                <!-- Horários -->
                <h3 class="text-xs uppercase tracking-widest mb-6" style="color: var(--gold);">Horários</h3>
                <div class="space-y-3 text-sm" style="color: var(--muted-2);">
                    <div class="flex justify-between">
                        <span>Recepção</span>
                        <span style="color: var(--cream-dim);">24h / 7 dias</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Café da Manhã</span>
                        <span style="color: var(--cream-dim);">6h – 11h</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Restaurante</span>
                        <span style="color: var(--cream-dim);">12h – 23h</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Spa</span>
                        <span style="color: var(--cream-dim);">8h – 22h</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Piscinas</span>
                        <span style="color: var(--cream-dim);">7h – 20h</span>
                    </div>
                </div>
            </div>

            <!-- Formulário (direita) -->
            <div class="lg:col-span-3">
                <div class="p-8 md:p-10 rounded-sm" style="background: var(--ink-3); border: 1px solid rgba(201,168,76,0.1);">
                    @if(session('success'))
                    <div class="mb-6 px-4 py-3 rounded-sm text-xs uppercase tracking-widest"
                         style="background: rgba(46,125,138,0.15); color: var(--teal-light); border: 1px solid rgba(46,125,138,0.2);">
                        ✓ Mensagem enviada com sucesso!
                    </div>
                    @endif

                    <h3 class="font-display text-2xl mb-8" style="color: var(--cream); font-style: italic;">
                        Envie sua mensagem
                    </h3>

                    <form action="/contato/enviar" method="POST" class="space-y-5">
                        @csrf

                        <!-- Nome + Email -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            @foreach([['Nome Completo','text','name','Seu nome'],['Email','email','email','seu@email.com']] as $f)
                            <div>
                                <label class="block text-xs uppercase tracking-widest mb-2" style="color: var(--muted-2);">
                                    {{ $f[0] }} <span style="color: var(--gold);">*</span>
                                </label>
                                <input type="{{ $f[1] }}" name="{{ $f[2] }}" placeholder="{{ $f[3] }}" required
                                       class="w-full px-4 py-3 text-sm rounded-sm focus:outline-none transition-colors duration-200"
                                       style="background: var(--ink-2); border: 1px solid rgba(201,168,76,0.12); color: var(--cream);"
                                       onfocus="this.style.borderColor='rgba(201,168,76,0.4)'"
                                       onblur="this.style.borderColor='rgba(201,168,76,0.12)'">
                                @error($f[2])<p class="text-xs mt-1" style="color: #e07070;">{{ $message }}</p>@enderror
                            </div>
                            @endforeach
                        </div>

                        <!-- Telefone + Assunto -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs uppercase tracking-widest mb-2" style="color: var(--muted-2);">Telefone</label>
                                <input type="tel" name="phone" placeholder="(11) 99999-9999"
                                       class="w-full px-4 py-3 text-sm rounded-sm focus:outline-none transition-colors duration-200"
                                       style="background: var(--ink-2); border: 1px solid rgba(201,168,76,0.12); color: var(--cream);"
                                       onfocus="this.style.borderColor='rgba(201,168,76,0.4)'"
                                       onblur="this.style.borderColor='rgba(201,168,76,0.12)'">
                            </div>
                            <div>
                                <label class="block text-xs uppercase tracking-widest mb-2" style="color: var(--muted-2);">
                                    Assunto <span style="color: var(--gold);">*</span>
                                </label>
                                <select name="subject" required
                                        class="w-full px-4 py-3 text-sm rounded-sm focus:outline-none"
                                        style="background: var(--ink-2); border: 1px solid rgba(201,168,76,0.12); color: var(--cream);">
                                    <option value="">Selecione</option>
                                    <option value="reserva">Reserva</option>
                                    <option value="preco">Preços e Tarifas</option>
                                    <option value="evento">Eventos & Corporativo</option>
                                    <option value="outro">Outro</option>
                                </select>
                            </div>
                        </div>

                        <!-- Datas -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            @foreach([['Check-in','date','checkin'],['Check-out','date','checkout']] as $f)
                            <div>
                                <label class="block text-xs uppercase tracking-widest mb-2" style="color: var(--muted-2);">{{ $f[0] }}</label>
                                <input type="{{ $f[1] }}" name="{{ $f[2] }}"
                                       class="w-full px-4 py-3 text-sm rounded-sm focus:outline-none transition-colors duration-200"
                                       style="background: var(--ink-2); border: 1px solid rgba(201,168,76,0.12); color: var(--cream);"
                                       onfocus="this.style.borderColor='rgba(201,168,76,0.4)'"
                                       onblur="this.style.borderColor='rgba(201,168,76,0.12)'">
                            </div>
                            @endforeach
                        </div>

                        <!-- Tipo de quarto -->
                        <div>
                            <label class="block text-xs uppercase tracking-widest mb-2" style="color: var(--muted-2);">Tipo de Acomodação</label>
                            <select name="room_type"
                                    class="w-full px-4 py-3 text-sm rounded-sm focus:outline-none"
                                    style="background: var(--ink-2); border: 1px solid rgba(201,168,76,0.12); color: var(--cream);">
                                <option value="">Não definido</option>
                                <option>Quarto Deluxe</option>
                                <option>Suite Premium</option>
                                <option>Suíte Presidencial</option>
                                <option>Suite Nupcial</option>
                                <option>Suite Família</option>
                                <option>Studio Deluxe</option>
                            </select>
                        </div>

                        <!-- Mensagem -->
                        <div>
                            <label class="block text-xs uppercase tracking-widest mb-2" style="color: var(--muted-2);">
                                Mensagem <span style="color: var(--gold);">*</span>
                            </label>
                            <textarea name="message" rows="5" required
                                      placeholder="Escreva sua mensagem..."
                                      class="w-full px-4 py-3 text-sm rounded-sm focus:outline-none resize-none transition-colors duration-200"
                                      style="background: var(--ink-2); border: 1px solid rgba(201,168,76,0.12); color: var(--cream);"
                                      onfocus="this.style.borderColor='rgba(201,168,76,0.4)'"
                                      onblur="this.style.borderColor='rgba(201,168,76,0.12)'"></textarea>
                            @error('message')<p class="text-xs mt-1" style="color: #e07070;">{{ $message }}</p>@enderror
                        </div>

                        <!-- Newsletter -->
                        <div class="flex items-center gap-3">
                            <input type="checkbox" name="newsletter" id="newsletter"
                                   class="w-4 h-4 rounded-sm"
                                   style="accent-color: var(--gold);">
                            <label for="newsletter" class="text-xs" style="color: var(--muted-2);">
                                Quero receber ofertas e novidades exclusivas
                            </label>
                        </div>

                        <!-- Botão -->
                        <div class="pt-2">
                            <button type="submit" class="btn-gold w-full justify-center">
                                Enviar Mensagem
                            </button>
                            <p class="text-center text-xs mt-4" style="color: var(--muted);">
                                * Respondemos em até 24 horas úteis
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== FAQ ===== -->
<section style="background: var(--ink-2); border-top: 1px solid rgba(201,168,76,0.1);" class="py-24">
    <div class="max-w-3xl mx-auto px-6 lg:px-12">
        <div class="text-center mb-14">
            <span class="line-gold mx-auto" style="margin: 0 auto 1.5rem;"></span>
            <h2 class="font-display text-4xl" style="color: var(--cream); font-style: italic;">
                Perguntas Frequentes
            </h2>
        </div>

        <div class="space-y-3">
            @foreach([
                ['q' => 'Qual é a política de cancelamento?',          'a' => 'Cancelamentos até 7 dias antes recebem reembolso integral. Dentro desse prazo, aplica-se uma taxa de 50% do valor total da reserva.'],
                ['q' => 'Quais formas de pagamento são aceitas?',       'a' => 'Aceitamos cartões de crédito e débito, transferência bancária e Pix. O pagamento pode ser feito na reserva ou até 48h antes da chegada.'],
                ['q' => 'Vocês oferecem transfer do aeroporto?',        'a' => 'Sim! Oferecemos serviço de transfer com agendamento prévio. Consulte disponibilidade e valores ao realizar sua reserva.'],
                ['q' => 'Aceitam animais de estimação?',                'a' => 'Aceitamos cães e gatos de pequeno porte com taxa adicional. Temos quartos especialmente preparados para hóspedes com pets.'],
                ['q' => 'O resort possui acessibilidade?',              'a' => 'Sim. Todos os ambientes contam com rampas, elevadores adaptados e quartos equipados para hóspedes com mobilidade reduzida.'],
            ] as $faq)
            <details class="rounded-sm group cursor-pointer"
                     style="background: var(--ink-3); border: 1px solid rgba(201,168,76,0.1);">
                <summary class="flex items-center justify-between px-6 py-5 text-sm font-medium" style="color: var(--cream); list-style: none;">
                    <span>{{ $faq['q'] }}</span>
                    <span class="ml-4 flex-shrink-0 text-lg transition-transform duration-300 group-open:rotate-45"
                          style="color: var(--gold);">+</span>
                </summary>
                <div class="px-6 pb-5 text-sm leading-relaxed" style="color: var(--muted-2);">
                    {{ $faq['a'] }}
                </div>
            </details>
            @endforeach
        </div>
    </div>
</section>

<!-- ===== CTA FINAL ===== -->
<section style="background: var(--ink); border-top: 1px solid rgba(201,168,76,0.1);" class="py-20">
    <div class="max-w-3xl mx-auto px-6 text-center">
        <h2 class="font-display text-4xl mb-4" style="color: var(--cream); font-style: italic;">
            Ainda tem dúvidas?
        </h2>
        <p class="text-sm mb-8" style="color: var(--muted-2);">Ligue agora ou use nosso chat em tempo real.</p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="tel:+5511999999999" class="btn-gold">📞 Ligar Agora</a>
            <button class="btn-outline">💬 Chat ao Vivo</button>
        </div>
    </div>
</section>

@endsection