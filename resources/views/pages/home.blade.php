@extends('layouts.app')

@section('title', 'Página Inicial - Calm Mind Resort & Spa')

@section('content')
<!-- Hero Section -->
<section class="relative h-screen bg-cover bg-center overflow-hidden" 
         style="background-image: linear-gradient(rgba(45, 122, 138, 0.3), rgba(61, 40, 23, 0.4)), url('https://images.unsplash.com/photo-1571896349842-b46d0e36f0bb?w=1200&q=80');">
    
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="text-center text-white px-4 animate-fade-in-up">
            <p class="text-sm font-semibold tracking-[0.2em] text-accent mb-6 uppercase">
                Boas-vindas ao
            </p>
            
            <h1 class="font-display text-7xl md:text-8xl font-bold mb-6 drop-shadow-lg">
                Calm<span class="text-accent">Mind</span>
            </h1>
            
            <p class="text-xl md:text-2xl font-light mb-12 max-w-2xl mx-auto drop-shadow-md">
                Resort & Spa
            </p>
            
            <p class="text-lg text-gray-100 mb-12 max-w-xl mx-auto font-light">
                Seu refúgio de tranquilidade onde a elegância encontra a natureza
            </p>
            
            <button class="btn-primary bg-white text-secondary-dark hover:bg-gray-100">
                Saiba Mais
            </button>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
        </svg>
    </div>
</section>

<!-- Bem-vindo ao Resort -->
<section class="py-20 bg-bg-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <!-- Conteúdo -->
            <div class="animate-fade-in-up">
                <div class="mb-6">
                    <div class="line-accent mb-6"></div>
                    <h2 class="font-display text-4xl md:text-5xl text-secondary-dark mb-6">
                        Bem-vindo ao Calm<span class="text-accent">Mind</span>
                    </h2>
                </div>
                
                <p class="text-lg text-text-light mb-6 leading-relaxed">
                    Mergulhe em uma experiência de luxo e tranquilidade. Nosso resort combina arquitetura contemporânea, design sofisticado e serviços impecáveis para criar seu refúgio perfeito.
                </p>
                
                <p class="text-text-light mb-8 leading-relaxed">
                    Com quartos espaçosos, piscinas de águas cristalinas e um spa de classe mundial, cada momento é uma celebração de bem-estar e elegância.
                </p>
                
                <button class="btn-secondary">
                    Explore Nossos Quartos
                </button>
            </div>
            
            <!-- Imagem -->
            <div class="rounded-lg overflow-hidden shadow-2xl">
                <img src="https://images.unsplash.com/photo-1552895881-20fbb8b60bca?w=600&q=80" 
                     alt="Calm Mind Resort" 
                     class="w-full h-full object-cover hover:scale-105 transition-elegant duration-500">
            </div>
        </div>
    </div>
</section>

<!-- Destaques -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="line-accent mx-auto mb-6"></div>
            <h2 class="font-display text-4xl md:text-5xl text-secondary-dark mb-6">
                Experiências Excepcionais
            </h2>
            <p class="text-lg text-text-light max-w-2xl mx-auto">
                Cada detalhe foi cuidadosamente pensado para proporcionar conforto e bem-estar
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Card 1 -->
            <div class="card-elegant p-8">
                <div class="text-5xl mb-6">🏊</div>
                <h3 class="font-display text-2xl text-secondary-dark mb-4">Piscinas Luxuosas</h3>
                <p class="text-text-light">
                    Piscinas de borda infinita com vistas panorâmicas e serviço de bar à beira d'água.
                </p>
            </div>

            <!-- Card 2 -->
            <div class="card-elegant p-8">
                <div class="text-5xl mb-6">🧖</div>
                <h3 class="font-display text-2xl text-secondary-dark mb-4">Spa Premium</h3>
                <p class="text-text-light">
                    Tratamentos exclusivos com produtos naturais e terapeutas especializados.
                </p>
            </div>

            <!-- Card 3 -->
            <div class="card-elegant p-8">
                <div class="text-5xl mb-6">🍽️</div>
                <h3 class="font-display text-2xl text-secondary-dark mb-4">Gastronomia</h3>
                <p class="text-text-light">
                    Restaurantes gourmet com chefs renomados e culinária internacional.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Quartos em Destaque -->
<section class="py-20 bg-bg-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="line-accent mx-auto mb-6"></div>
            <h2 class="font-display text-4xl md:text-5xl text-secondary-dark mb-6">
                Conheça Nossos Quartos
            </h2>
            <p class="text-lg text-text-light max-w-2xl mx-auto">
                Alguns quartos com belas vistas para sua estadia perfeita
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                ['title' => 'Quarto Deluxe', 'price' => 'R$ 450/noite', 'image' => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=500&q=80'],
                ['title' => 'Suite Premium', 'price' => 'R$ 750/noite', 'image' => 'https://images.unsplash.com/photo-1578683078519-94f3b6c49f15?w=500&q=80'],
                ['title' => 'Suíte Presidencial', 'price' => 'R$ 1200/noite', 'image' => 'https://images.unsplash.com/photo-1591088398332-8c716432dd4d?w=500&q=80']
            ] as $room)
                <div class="card-elegant overflow-hidden">
                    <div class="relative h-64 overflow-hidden bg-gray-200">
                        <img src="{{ $room['image'] }}" 
                             alt="{{ $room['title'] }}" 
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-8">
                        <h3 class="font-display text-2xl text-secondary-dark mb-4">{{ $room['title'] }}</h3>
                        <p class="text-text-light mb-6">
                            Texto descritivo sobre o quarto com suas características principais e comodidades inclusas.
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-semibold text-accent">{{ $room['price'] }}</span>
                            <button class="btn-secondary text-sm">Ver Detalhes</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('rooms') }}" class="btn-primary">
                Ver Todos os Quartos
            </a>
        </div>
    </div>
</section>

<!-- Chamada para Ação -->
<section class="py-20 bg-gradient-to-r from-secondary-dark to-secondary-dark/90 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="font-display text-4xl md:text-5xl mb-8">
            Pronto para sua próxima aventura?
        </h2>
        <p class="text-xl mb-10 text-gray-200">
            Reserve seu quarto agora e aproveite ofertas exclusivas
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <button class="btn-primary bg-white text-secondary-dark hover:bg-gray-100">
                Fazer Reserva
            </button>
            <button class="btn-secondary border-white text-white hover:bg-white hover:text-secondary-dark">
                Verificar Disponibilidade
            </button>
        </div>
    </div>
</section>

<!-- CTA Verificar Disponibilidade -->
<section class="py-16 bg-white border-t border-gray-200">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-bg-light rounded-lg p-8 md:p-12">
            <h3 class="font-display text-3xl text-secondary-dark mb-8 text-center">
                Verificar Disponibilidade
            </h3>
            
            <form class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-secondary-dark mb-2">Entrada</label>
                    <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary">
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-secondary-dark mb-2">Saída</label>
                    <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary">
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-secondary-dark mb-2">Hóspedes</label>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary">
                        <option>1 Hóspede</option>
                        <option>2 Hóspedes</option>
                        <option>3 Hóspedes</option>
                        <option>4+ Hóspedes</option>
                    </select>
                </div>
                
                <div class="flex items-end">
                    <button type="submit" class="btn-primary w-full">
                        Buscar
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
