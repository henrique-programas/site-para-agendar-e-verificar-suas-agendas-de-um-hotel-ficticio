@extends('layouts.app')

@section('title', 'Contato - Calm Mind Resort & Spa')

@section('content')
<!-- Header -->
<section class="pt-32 pb-20 bg-bg-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="line-accent mx-auto mb-6"></div>
            <h1 class="font-display text-5xl md:text-6xl text-secondary-dark mb-6">
                Entre em Contato
            </h1>
            <p class="text-xl text-text-light max-w-2xl mx-auto">
                Estamos aqui para ajudar com qualquer dúvida ou pedido especial
            </p>
        </div>
    </div>
</section>

<!-- Informações de Contato -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <!-- Telefone -->
            <div class="card-elegant p-8 text-center">
                <div class="text-5xl mb-6">📞</div>
                <h3 class="font-display text-2xl text-secondary-dark mb-4">Telefone</h3>
                <p class="text-text-light mb-4">
                    Ligue para reservas, informações e pedidos especiais
                </p>
                <a href="tel:+5511999999999" class="text-accent font-semibold hover:underline">
                    +55 (11) 9999-9999
                </a>
                <p class="text-sm text-text-light mt-4">
                    Segunda a domingo, 8h às 21h
                </p>
            </div>

            <!-- Email -->
            <div class="card-elegant p-8 text-center">
                <div class="text-5xl mb-6">✉️</div>
                <h3 class="font-display text-2xl text-secondary-dark mb-4">Email</h3>
                <p class="text-text-light mb-4">
                    Envie sua mensagem e responderemos em até 24h
                </p>
                <a href="mailto:contato@calmmind.com" class="text-accent font-semibold hover:underline">
                    contato@calmmind.com
                </a>
                <p class="text-sm text-text-light mt-4">
                    Para informações gerais
                </p>
            </div>

            <!-- Localização -->
            <div class="card-elegant p-8 text-center">
                <div class="text-5xl mb-6">📍</div>
                <h3 class="font-display text-2xl text-secondary-dark mb-4">Localização</h3>
                <p class="text-text-light mb-4">
                    Visite-nos pessoalmente
                </p>
                <p class="text-accent font-semibold">
                    Avenida Brasileira, 1000<br>
                    São Paulo, SP 01433-000<br>
                    Brasil
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Mapa (mockup) -->
<section class="py-16 bg-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="rounded-lg overflow-hidden h-96 bg-gray-300 flex items-center justify-center">
            <div class="text-center">
                <p class="text-5xl mb-4">🗺️</p>
                <p class="text-gray-700 font-semibold">Mapa interativo do resort</p>
                <p class="text-gray-600 text-sm mt-2">Google Maps integrado (implementar com API)</p>
            </div>
        </div>
    </div>
</section>

<!-- Formulário de Contato -->
<section class="py-20 bg-bg-light">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-xl p-8 md:p-12">
            <div class="mb-12">
                <div class="line-accent mb-6"></div>
                <h2 class="font-display text-3xl text-secondary-dark mb-2">
                    Envie uma Mensagem
                </h2>
                <p class="text-text-light">
                    Preencha o formulário abaixo e nossa equipe entrará em contato em breve
                </p>
            </div>

            <form action="/contact/send" method="POST" class="space-y-6">
                @csrf

                <!-- Nome e Email -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-secondary-dark mb-3">
                            Nome Completo *
                        </label>
                        <input type="text" 
                               name="name" 
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-elegant"
                               placeholder="Seu nome">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-secondary-dark mb-3">
                            Email *
                        </label>
                        <input type="email" 
                               name="email" 
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-elegant"
                               placeholder="seu@email.com">
                    </div>
                </div>

                <!-- Telefone e Assunto -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-secondary-dark mb-3">
                            Telefone
                        </label>
                        <input type="tel" 
                               name="phone"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-elegant"
                               placeholder="(11) 9999-9999">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-secondary-dark mb-3">
                            Assunto *
                        </label>
                        <select name="subject" 
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-elegant">
                            <option value="">Selecione um assunto</option>
                            <option value="reserva">Dúvida sobre Reserva</option>
                            <option value="preco">Informação de Preço</option>
                            <option value="servico">Serviços Especiais</option>
                            <option value="evento">Evento/Corporativo</option>
                            <option value="reclamacao">Feedback/Reclamação</option>
                            <option value="outro">Outro</option>
                        </select>
                    </div>
                </div>

                <!-- Datas -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-secondary-dark mb-3">
                            Data de Entrada (se aplicável)
                        </label>
                        <input type="date" 
                               name="check_in"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-elegant">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-secondary-dark mb-3">
                            Data de Saída (se aplicável)
                        </label>
                        <input type="date" 
                               name="check_out"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-elegant">
                    </div>
                </div>

                <!-- Hóspedes -->
                <div>
                    <label class="block text-sm font-semibold text-secondary-dark mb-3">
                        Número de Hóspedes
                    </label>
                    <select name="guests"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-elegant">
                        <option value="">Selecione</option>
                        <option value="1">1 Hóspede</option>
                        <option value="2">2 Hóspedes</option>
                        <option value="3">3 Hóspedes</option>
                        <option value="4">4 Hóspedes</option>
                        <option value="5+">5 ou mais</option>
                    </select>
                </div>

                <!-- Tipo de Quarto -->
                <div>
                    <label class="block text-sm font-semibold text-secondary-dark mb-3">
                        Tipo de Quarto de Interesse
                    </label>
                    <select name="room_type"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-elegant">
                        <option value="">Selecione</option>
                        <option value="deluxe">Quarto Deluxe</option>
                        <option value="premium">Suite Premium</option>
                        <option value="presidencial">Suíte Presidencial</option>
                        <option value="nupcial">Suite Nupcial</option>
                        <option value="familia">Suite Família</option>
                        <option value="studio">Studio Deluxe</option>
                    </select>
                </div>

                <!-- Mensagem -->
                <div>
                    <label class="block text-sm font-semibold text-secondary-dark mb-3">
                        Mensagem *
                    </label>
                    <textarea name="message" 
                              required
                              rows="6"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-elegant resize-none"
                              placeholder="Digite sua mensagem aqui..."></textarea>
                </div>

                <!-- Checkbox -->
                <div class="flex items-center">
                    <input type="checkbox" 
                           name="newsletter" 
                           id="newsletter"
                           class="w-4 h-4 text-primary rounded">
                    <label for="newsletter" class="ml-3 text-sm text-text-light">
                        Desejo receber ofertas e novidades por email
                    </label>
                </div>

                <!-- Botões -->
                <div class="border-t border-gray-200 pt-8 flex gap-4">
                    <button type="submit" class="btn-primary flex-1">
                        Enviar Mensagem
                    </button>
                    <button type="reset" class="btn-secondary flex-1">
                        Limpar Formulário
                    </button>
                </div>

                <p class="text-sm text-text-light text-center">
                    * Campos obrigatórios. Responderemos em até 24 horas.
                </p>
            </form>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="line-accent mx-auto mb-6"></div>
            <h2 class="font-display text-4xl text-secondary-dark mb-6">
                Perguntas Frequentes
            </h2>
        </div>

        <div class="space-y-6">
            @foreach([
                [
                    'question' => 'Qual é a política de cancelamento?',
                    'answer' => 'As reservas podem ser canceladas até 7 dias antes da data de entrada com reembolso completo. Cancelamentos dentro de 7 dias estão sujeitos a uma taxa de 50% do valor da reserva.'
                ],
                [
                    'question' => 'Quais são as formas de pagamento aceitas?',
                    'answer' => 'Aceitamos cartão de crédito, débito, transferência bancária e Bitcoin. O pagamento pode ser feito no ato da reserva ou até 48 horas antes da chegada.'
                ],
                [
                    'question' => 'Vocês oferecem transfer do aeroporto?',
                    'answer' => 'Sim! Oferecemos serviço de transfer com taxas específicas. Consulte-nos durante a reserva para maiores detalhes.'
                ],
                [
                    'question' => 'Há carga para animais de estimação?',
                    'answer' => 'Aceitamos cães e gatos com taxa adicional de R$ 100 por noite. Existem quartos específicos para hóspedes com pets.'
                ],
                [
                    'question' => 'O resort é acessível para deficientes?',
                    'answer' => 'Sim, temos quartos adaptados com rampa de acesso, banheiros equipados e elevadores em todas as alas.'
                ]
            ] as $faq)
                <details class="border border-gray-200 rounded-lg p-6 cursor-pointer group">
                    <summary class="flex items-center justify-between font-semibold text-secondary-dark">
                        {{ $faq['question'] }}
                        <span class="text-2xl group-open:rotate-180 transition-transform">+</span>
                    </summary>
                    <p class="text-text-light mt-4 leading-relaxed">
                        {{ $faq['answer'] }}
                    </p>
                </details>
            @endforeach
        </div>
    </div>
</section>

<!-- Horário de Funcionamento -->
<section class="py-20 bg-bg-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="line-accent mx-auto mb-6"></div>
            <h2 class="font-display text-4xl text-secondary-dark mb-6">
                Horário de Funcionamento
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-2xl mx-auto">
            <!-- Recepção -->
            <div class="card-elegant p-8">
                <h3 class="font-display text-2xl text-secondary-dark mb-4">Recepção 24h</h3>
                <p class="text-text-light">
                    Nossa recepção está disponível 24 horas por dia, 7 dias por semana para ajudá-lo com qualquer necessidade.
                </p>
            </div>

            <!-- Restaurantes -->
            <div class="card-elegant p-8">
                <h3 class="font-display text-2xl text-secondary-dark mb-4">Restaurantes</h3>
                <ul class="text-text-light space-y-2">
                    <li><strong>Café da Manhã:</strong> 6h às 11h</li>
                    <li><strong>Almoço:</strong> 12h às 15h</li>
                    <li><strong>Jantar:</strong> 18h às 23h</li>
                    <li><strong>Room Service:</strong> 24h</li>
                </ul>
            </div>

            <!-- Spa -->
            <div class="card-elegant p-8">
                <h3 class="font-display text-2xl text-secondary-dark mb-4">Spa</h3>
                <ul class="text-text-light space-y-2">
                    <li><strong>Segunda a Sexta:</strong> 8h às 22h</li>
                    <li><strong>Sábado e Domingo:</strong> 9h às 21h</li>
                    <li>Agendamento recomendado</li>
                </ul>
            </div>

            <!-- Piscina -->
            <div class="card-elegant p-8">
                <h3 class="font-display text-2xl text-secondary-dark mb-4">Piscinas</h3>
                <ul class="text-text-light space-y-2">
                    <li><strong>Todos os dias:</strong> 7h às 20h</li>
                    <li>Bar à beira da piscina: 10h às 19h</li>
                    <li>Guarda-vidas durante todo horário</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- CTA Final -->
<section class="py-20 bg-secondary-dark text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="font-display text-4xl md:text-5xl mb-6">
            Ainda tem dúvidas?
        </h2>
        <p class="text-xl text-gray-300 mb-10">
            Ligue para nosso call center ou use o chat ao vivo
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="tel:+5511999999999" class="btn-primary bg-white text-secondary-dark hover:bg-gray-100">
                📞 Ligar Agora
            </a>
            <button class="btn-secondary border-white text-white hover:bg-white hover:text-secondary-dark">
                💬 Chat ao Vivo
            </button>
        </div>
    </div>
</section>
@endsection
