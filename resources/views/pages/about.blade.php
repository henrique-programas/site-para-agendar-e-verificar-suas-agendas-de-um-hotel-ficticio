@extends('layouts.app')

@section('title', 'Sobre Nós - Calm Mind Resort & Spa')

@section('content')
<!-- Hero Section -->
<section class="pt-32 pb-20 bg-gradient-to-r from-secondary-dark to-primary text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="font-display text-5xl md:text-6xl mb-6">
                Sobre o Calm<span class="text-accent">Mind</span>
            </h1>
            <p class="text-xl max-w-2xl mx-auto font-light">
                Uma história de excelência, bem-estar e hospitalidade de classe mundial
            </p>
        </div>
    </div>
</section>

<!-- Nossa História -->
<section class="py-20 bg-bg-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <!-- Imagem -->
            <div class="rounded-lg overflow-hidden shadow-2xl order-2 md:order-1">
                <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=600&q=80" 
                     alt="Vista aérea do resort" 
                     class="w-full h-full object-cover">
            </div>

            <!-- Conteúdo -->
            <div class="order-1 md:order-2">
                <div class="line-accent mb-6"></div>
                <h2 class="font-display text-4xl text-secondary-dark mb-6">
                    Uma Jornada de Bem-Estar
                </h2>
                
                <p class="text-text-light text-lg mb-6 leading-relaxed">
                    O Calm Mind Resort & Spa foi fundado em 2018 com uma visão clara: criar um refúgio onde nossos hóspedes pudessem escapar do caos do dia a dia e reconectar-se consigo mesmos através de experiências de bem-estar incomparáveis.
                </p>

                <p class="text-text-light mb-6 leading-relaxed">
                    Localizando em um cenário natural deslumbrante, nossas instalações foram cuidadosamente projetadas por arquitetos de renome mundial, combinando elementos modernos com influências naturais. Cada detalhe foi pensado para criar uma atmosfera de serenidade e elegância.
                </p>

                <p class="text-text-light mb-8 leading-relaxed">
                    Ao longo dos anos, evoluímos para nos tornar um destino de referência na região, conhecido por nossa excelência em serviço, sustentabilidade ambiental e compromisso genuíno com o bem-estar de cada hóspede.
                </p>

                <button class="btn-secondary">
                    Saiba Mais
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Missão, Visão e Valores -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="line-accent mx-auto mb-6"></div>
            <h2 class="font-display text-4xl text-secondary-dark">
                Nossos Pilares
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Missão -->
            <div class="card-elegant p-8">
                <div class="text-5xl mb-6">🎯</div>
                <h3 class="font-display text-2xl text-secondary-dark mb-4">Missão</h3>
                <p class="text-text-light leading-relaxed">
                    Proporcionar experiências transformadoras de bem-estar e hospitalidade excepcional, criando memórias inesquecíveis que perduram muito além da hospedagem.
                </p>
            </div>

            <!-- Visão -->
            <div class="card-elegant p-8">
                <div class="text-5xl mb-6">🌟</div>
                <h3 class="font-display text-2xl text-secondary-dark mb-4">Visão</h3>
                <p class="text-text-light leading-relaxed">
                    Ser reconhecido globalmente como o destino premium de bem-estar e luxo, onde a excelência e a inovação convergem para transformar vidas.
                </p>
            </div>

            <!-- Valores -->
            <div class="card-elegant p-8">
                <div class="text-5xl mb-6">💎</div>
                <h3 class="font-display text-2xl text-secondary-dark mb-4">Valores</h3>
                <p class="text-text-light leading-relaxed">
                    Integridade, excelência, sustentabilidade, inovação e humanidade. Estes princípios guiam cada ação e decisão que tomamos.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Números que Falam -->
<section class="py-20 bg-secondary-dark text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="font-display text-4xl mb-6">
                Números que Contam Nossa História
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
            <!-- Número 1 -->
            <div>
                <div class="font-display text-5xl text-accent mb-4">45</div>
                <p class="text-gray-300">Suites Luxuosas</p>
            </div>

            <!-- Número 2 -->
            <div>
                <div class="font-display text-5xl text-accent mb-4">8.5k</div>
                <p class="text-gray-300">Hóspedes Satisfeitos</p>
            </div>

            <!-- Número 3 -->
            <div>
                <div class="font-display text-5xl text-accent mb-4">16</div>
                <p class="text-gray-300">Prêmios Internacionais</p>
            </div>

            <!-- Número 4 -->
            <div>
                <div class="font-display text-5xl text-accent mb-4">6.5</div>
                <p class="text-gray-300">Nota Média (Google)</p>
            </div>
        </div>
    </div>
</section>

<!-- Nossos Serviços -->
<section class="py-20 bg-bg-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="line-accent mx-auto mb-6"></div>
            <h2 class="font-display text-4xl text-secondary-dark mb-6">
                Serviços Exclusivos
            </h2>
            <p class="text-lg text-text-light max-w-2xl mx-auto">
                Tudo que você precisa para uma estadia inesquecível
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Serviço 1 -->
            <div class="flex gap-6">
                <div class="text-5xl">🏊</div>
                <div>
                    <h3 class="font-display text-2xl text-secondary-dark mb-3">Piscinas & Água</h3>
                    <p class="text-text-light">
                        Três piscinas aquecidas, piscina infantil, área de hidromassagem e acesso a praia privativa.
                    </p>
                </div>
            </div>

            <!-- Serviço 2 -->
            <div class="flex gap-6">
                <div class="text-5xl">🧖</div>
                <div>
                    <h3 class="font-display text-2xl text-secondary-dark mb-3">Spa Premium</h3>
                    <p class="text-text-light">
                        Massagens terapêuticas, tratamentos faciais, aromaterapia e terapias holísticas personalizadas.
                    </p>
                </div>
            </div>

            <!-- Serviço 3 -->
            <div class="flex gap-6">
                <div class="text-5xl">🍽️</div>
                <div>
                    <h3 class="font-display text-2xl text-secondary-dark mb-3">Gastronomia Gourmet</h3>
                    <p class="text-text-light">
                        Três restaurantes especializados em culinária internacional, drinks artesanais e room service 24h.
                    </p>
                </div>
            </div>

            <!-- Serviço 4 -->
            <div class="flex gap-6">
                <div class="text-5xl">🏋️</div>
                <div>
                    <h3 class="font-display text-2xl text-secondary-dark mb-3">Academia & Fitness</h3>
                    <p class="text-text-light">
                        Academia equipada com aparelhos modernos, aulas de yoga, pilates e personal trainers disponíveis.
                    </p>
                </div>
            </div>

            <!-- Serviço 5 -->
            <div class="flex gap-6">
                <div class="text-5xl">📱</div>
                <div>
                    <h3 class="font-display text-2xl text-secondary-dark mb-3">Tecnologia & Conectividade</h3>
                    <p class="text-text-light">
                        WiFi de alta velocidade, call center 24h, serviço de concierge e assistência com viagens.
                    </p>
                </div>
            </div>

            <!-- Serviço 6 -->
            <div class="flex gap-6">
                <div class="text-5xl">👶</div>
                <div>
                    <h3 class="font-display text-2xl text-secondary-dark mb-3">Serviços Familiares</h3>
                    <p class="text-text-light">
                        Clube infantil, babysitting, áreas de lazer para crianças e programação familiar especial.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sustentabilidade -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <!-- Conteúdo -->
            <div>
                <div class="line-accent mb-6"></div>
                <h2 class="font-display text-4xl text-secondary-dark mb-6">
                    Compromisso com a Sustentabilidade
                </h2>
                
                <p class="text-text-light text-lg mb-6 leading-relaxed">
                    Acreditamos que luxo e responsabilidade ambiental devem caminhar juntos. Por isso, implementamos práticas sustentáveis em todas as operações do resort.
                </p>

                <ul class="space-y-4 mb-8">
                    <li class="flex items-start gap-4">
                        <span class="text-green-500 text-2xl">♻️</span>
                        <div>
                            <h4 class="font-semibold text-secondary-dark mb-1">Energia Renovável</h4>
                            <p class="text-text-light text-sm">60% da energia vem de painéis solares e sistemas geotérmicos</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <span class="text-blue-500 text-2xl">💧</span>
                        <div>
                            <h4 class="font-semibold text-secondary-dark mb-1">Conservação de Água</h4>
                            <p class="text-text-light text-sm">Sistema de reutilização de água e jardins com plantas nativas</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <span class="text-yellow-500 text-2xl">🌱</span>
                        <div>
                            <h4 class="font-semibold text-secondary-dark mb-1">Conservação Florestal</h4>
                            <p class="text-text-light text-sm">Planta 100 árvores por ano para compensar nossa pegada de carbono</p>
                        </div>
                    </li>
                </ul>

                <button class="btn-secondary">
                    Nossa Política de Sustentabilidade
                </button>
            </div>

            <!-- Imagem -->
            <div class="rounded-lg overflow-hidden shadow-2xl">
                <img src="https://images.unsplash.com/photo-1559027615-cd2628902d4a?w=600&q=80" 
                     alt="Sustentabilidade" 
                     class="w-full h-full object-cover">
            </div>
        </div>
    </div>
</section>

<!-- Equipe -->
<section class="py-20 bg-bg-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="line-accent mx-auto mb-6"></div>
            <h2 class="font-display text-4xl text-secondary-dark mb-6">
                Nossa Equipe Dedicada
            </h2>
            <p class="text-lg text-text-light max-w-2xl mx-auto">
                Profissionais apaixonados em criar experiências memoráveis
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            @foreach([
                ['name' => 'Carlos Mendes', 'title' => 'Diretor Geral', 'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&q=80'],
                ['name' => 'Ana Silva', 'title' => 'Gerente de Operações', 'image' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400&q=80'],
                ['name' => 'Roberto Costa', 'title' => 'Chefe de Cozinha', 'image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400&q=80'],
                ['name' => 'Marina Santos', 'title' => 'Gerente de Spa', 'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&q=80']
            ] as $staff)
                <div class="text-center">
                    <div class="mb-4 rounded-lg overflow-hidden h-64 bg-gray-300">
                        <img src="{{ $staff['image'] }}" 
                             alt="{{ $staff['name'] }}" 
                             class="w-full h-full object-cover">
                    </div>
                    <h3 class="font-display text-xl text-secondary-dark mb-2">{{ $staff['name'] }}</h3>
                    <p class="text-accent font-semibold">{{ $staff['title'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Prêmios -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="line-accent mx-auto mb-6"></div>
            <h2 class="font-display text-4xl text-secondary-dark mb-6">
                Reconhecimentos
            </h2>
            <p class="text-lg text-text-light">
                Prêmios e certificações que validam nossa excelência
            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            @foreach([
                '🏆 TripAdvisor Traveler\'s Choice',
                '⭐ 5 Estrelas Michelin',
                '🌍 Certificado Green Resort',
                '💎 Luxury Spa Award',
                '🏅 Best Beach Resort 2023',
                '✨ Excellence in Service',
                '🌿 Eco-Friendly Leader',
                '🎖️ Industry Pioneer'
            ] as $award)
                <div class="bg-bg-light rounded-lg p-8 text-center border border-gray-200">
                    <p class="text-2xl mb-4">{{ substr($award, 0, strpos($award, ' ')) }}</p>
                    <p class="text-secondary-dark font-semibold">{{ substr($award, strpos($award, ' ') + 1) }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Final -->
<section class="py-20 bg-gradient-to-r from-secondary-dark to-primary text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="font-display text-4xl md:text-5xl mb-6">
            Vem fazer parte da nossa história
        </h2>
        <p class="text-xl text-gray-200 mb-10">
            Venha experimentar o Calm Mind Resort & Spa
        </p>
        <a href="{{ route('rooms') }}" class="btn-primary bg-white text-secondary-dark hover:bg-gray-100">
            Reserve Agora
        </a>
    </div>
</section>
@endsection
