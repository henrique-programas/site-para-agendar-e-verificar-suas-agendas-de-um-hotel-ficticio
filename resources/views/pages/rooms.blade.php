@extends('layouts.app')

@section('title', 'Nossos Quartos - Calm Mind Resort & Spa')

@section('content')
<!-- Header -->
<section class="pt-32 pb-20 bg-bg-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="line-accent mx-auto mb-6"></div>
            <h1 class="font-display text-5xl md:text-6xl text-secondary-dark mb-6">
                Nossos Quartos
            </h1>
            <p class="text-xl text-text-light max-w-2xl mx-auto">
                Acomodações sofisticadas com vistas deslumbrantes e conforto de classe mundial
            </p>
        </div>
    </div>
</section>

<!-- Filtros -->
<section class="py-12 bg-white border-b border-gray-200 sticky top-20 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <form class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div>
                <label class="block text-sm font-semibold text-secondary-dark mb-2">Tipo de Quarto</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary text-sm">
                    <option>Todos</option>
                    <option>Deluxe</option>
                    <option>Premium</option>
                    <option>Presidencial</option>
                    <option>Suite Nupcial</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-secondary-dark mb-2">Entrada</label>
                <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary text-sm">
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-secondary-dark mb-2">Saída</label>
                <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary text-sm">
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-secondary-dark mb-2">Faixa de Preço</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary text-sm">
                    <option>Qualquer preço</option>
                    <option>Até R$ 500</option>
                    <option>R$ 500 - R$ 1000</option>
                    <option>Acima de R$ 1000</option>
                </select>
            </div>
            
            <div class="flex items-end">
                <button type="submit" class="btn-primary w-full text-sm">
                    Filtrar
                </button>
            </div>
        </form>
    </div>
</section>

<!-- Quartos Grid -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Grid de Quartos -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            <!-- Quarto 1: Deluxe -->
            <div class="card-elegant group overflow-hidden">
                <div class="relative h-80 overflow-hidden bg-gray-300">
                    <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=600&q=80" 
                         alt="Quarto Deluxe" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-elegant duration-700">
                    <div class="absolute top-4 left-4">
                        <span class="bg-accent text-secondary-dark px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wide">
                            Deluxe
                        </span>
                    </div>
                </div>
                <div class="p-8">
                    <h3 class="font-display text-2xl text-secondary-dark mb-2">Quarto Deluxe</h3>
                    <div class="flex items-center mb-4 text-sm text-accent">
                        <span>⭐⭐⭐⭐</span>
                        <span class="text-text-light ml-2">(4.5/5)</span>
                    </div>
                    
                    <p class="text-text-light mb-6 text-sm leading-relaxed">
                        Quartos espaçosos com vistas para o jardim, cama king-size premium e banheiro com acabamentos luxuosos.
                    </p>
                    
                    <!-- Amenidades -->
                    <div class="mb-6 space-y-2 text-sm text-text-light">
                        <div class="flex items-center">
                            <span class="mr-3">🛏️</span>
                            <span>Cama King ou Twin</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-3">📺</span>
                            <span>Smart TV 55"</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-3">🌡️</span>
                            <span>Ar condicionado inteligente</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-3">📶</span>
                            <span>WiFi de alta velocidade</span>
                        </div>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="font-display text-2xl text-secondary-dark font-bold">R$ 450</span>
                            <span class="text-sm text-text-light">/noite</span>
                        </div>
                        <button class="btn-secondary w-full text-sm">
                            Ver Detalhes
                        </button>
                    </div>
                </div>
            </div>

            <!-- Quarto 2: Premium -->
            <div class="card-elegant group overflow-hidden md:col-span-1">
                <div class="relative h-80 overflow-hidden bg-gray-300">
                    <img src="https://images.unsplash.com/photo-1578683078519-94f3b6c49f15?w=600&q=80" 
                         alt="Suite Premium" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-elegant duration-700">
                    <div class="absolute top-4 left-4 flex gap-2">
                        <span class="bg-primary text-white px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wide">
                            Premium
                        </span>
                        <span class="bg-accent text-secondary-dark px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wide">
                            Popular
                        </span>
                    </div>
                </div>
                <div class="p-8">
                    <h3 class="font-display text-2xl text-secondary-dark mb-2">Suite Premium</h3>
                    <div class="flex items-center mb-4 text-sm text-accent">
                        <span>⭐⭐⭐⭐⭐</span>
                        <span class="text-text-light ml-2">(4.9/5)</span>
                    </div>
                    
                    <p class="text-text-light mb-6 text-sm leading-relaxed">
                        Suíte espaçosa com sala de estar, cama king-size, banheiro de mármore e varanda com vista para o resort.
                    </p>
                    
                    <!-- Amenidades -->
                    <div class="mb-6 space-y-2 text-sm text-text-light">
                        <div class="flex items-center">
                            <span class="mr-3">🛏️</span>
                            <span>Cama King-size California</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-3">🛋️</span>
                            <span>Sala de estar separada</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-3">🚿</span>
                            <span>Banheiro luxuoso c/ jacuzzi</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-3">🏞️</span>
                            <span>Varanda privativa espaçosa</span>
                        </div>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="font-display text-2xl text-secondary-dark font-bold">R$ 750</span>
                            <span class="text-sm text-text-light">/noite</span>
                        </div>
                        <button class="btn-secondary w-full text-sm">
                            Ver Detalhes
                        </button>
                    </div>
                </div>
            </div>

            <!-- Quarto 3: Presidencial -->
            <div class="card-elegant group overflow-hidden lg:col-span-1">
                <div class="relative h-80 overflow-hidden bg-gray-300">
                    <img src="https://images.unsplash.com/photo-1591088398332-8c716432dd4d?w=600&q=80" 
                         alt="Suíte Presidencial" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-elegant duration-700">
                    <div class="absolute top-4 left-4">
                        <span class="bg-secondary-dark text-accent px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wide">
                            Luxo
                        </span>
                    </div>
                </div>
                <div class="p-8">
                    <h3 class="font-display text-2xl text-secondary-dark mb-2">Suíte Presidencial</h3>
                    <div class="flex items-center mb-4 text-sm text-accent">
                        <span>⭐⭐⭐⭐⭐</span>
                        <span class="text-text-light ml-2">(5/5)</span>
                    </div>
                    
                    <p class="text-text-light mb-6 text-sm leading-relaxed">
                        Nossa suíte mais luxuosa com 150m², dois quartos, sala de estar, cozinha e vista panorâmica completa.
                    </p>
                    
                    <!-- Amenidades -->
                    <div class="mb-6 space-y-2 text-sm text-text-light">
                        <div class="flex items-center">
                            <span class="mr-3">🏠</span>
                            <span>2 Quartos + Sala estar</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-3">🍽️</span>
                            <span>Cozinha completa</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-3">🌅</span>
                            <span>Varanda de 80m²</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-3">🎵</span>
                            <span>Som surround & home theater</span>
                        </div>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="font-display text-2xl text-secondary-dark font-bold">R$ 1.200</span>
                            <span class="text-sm text-text-light">/noite</span>
                        </div>
                        <button class="btn-secondary w-full text-sm">
                            Ver Detalhes
                        </button>
                    </div>
                </div>
            </div>

            <!-- Quarto 4: Suite Nupcial -->
            <div class="card-elegant group overflow-hidden">
                <div class="relative h-80 overflow-hidden bg-gray-300">
                    <img src="https://images.unsplash.com/photo-1569495285382-649f3061fb6f?w=600&q=80" 
                         alt="Suite Nupcial" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-elegant duration-700">
                    <div class="absolute top-4 left-4">
                        <span class="bg-pink-400 text-white px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wide">
                            Romântica
                        </span>
                    </div>
                </div>
                <div class="p-8">
                    <h3 class="font-display text-2xl text-secondary-dark mb-2">Suite Nupcial</h3>
                    <div class="flex items-center mb-4 text-sm text-accent">
                        <span>⭐⭐⭐⭐⭐</span>
                        <span class="text-text-light ml-2">(5/5)</span>
                    </div>
                    
                    <p class="text-text-light mb-6 text-sm leading-relaxed">
                        Suíte romântica perfeita para casamentos e lua de mel com banhão privado e decoração especial.
                    </p>
                    
                    <!-- Amenidades -->
                    <div class="mb-6 space-y-2 text-sm text-text-light">
                        <div class="flex items-center">
                            <span class="mr-3">🛁</span>
                            <span>Banhão privado espaçoso</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-3">🕯️</span>
                            <span>Iluminação romântica</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-3">🍷</span>
                            <span>Mini adega de vinhos</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-3">💐</span>
                            <span>Decoração floral diária</span>
                        </div>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="font-display text-2xl text-secondary-dark font-bold">R$ 950</span>
                            <span class="text-sm text-text-light">/noite</span>
                        </div>
                        <button class="btn-secondary w-full text-sm">
                            Ver Detalhes
                        </button>
                    </div>
                </div>
            </div>

            <!-- Quarto 5: Familia -->
            <div class="card-elegant group overflow-hidden">
                <div class="relative h-80 overflow-hidden bg-gray-300">
                    <img src="https://images.unsplash.com/photo-1596928519198-83e0b5c8d900?w=600&q=80" 
                         alt="Suite Familia" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-elegant duration-700">
                    <div class="absolute top-4 left-4">
                        <span class="bg-blue-400 text-white px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wide">
                            Familia
                        </span>
                    </div>
                </div>
                <div class="p-8">
                    <h3 class="font-display text-2xl text-secondary-dark mb-2">Suite Família</h3>
                    <div class="flex items-center mb-4 text-sm text-accent">
                        <span>⭐⭐⭐⭐</span>
                        <span class="text-text-light ml-2">(4.6/5)</span>
                    </div>
                    
                    <p class="text-text-light mb-6 text-sm leading-relaxed">
                        Espaçosa com dois quartos, sala de estar grande, perfeita para famílias e grupos de amigos.
                    </p>
                    
                    <!-- Amenidades -->
                    <div class="mb-6 space-y-2 text-sm text-text-light">
                        <div class="flex items-center">
                            <span class="mr-3">👨‍👩‍👧‍👦</span>
                            <span>2-4 hóspedes confortáveis</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-3">🎮</span>
                            <span>Área de lazer com jogos</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-3">🧸</span>
                            <span>Serviço baby-sitting</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-3">🍽️</span>
                            <span>Kitchenette equipada</span>
                        </div>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="font-display text-2xl text-secondary-dark font-bold">R$ 650</span>
                            <span class="text-sm text-text-light">/noite</span>
                        </div>
                        <button class="btn-secondary w-full text-sm">
                            Ver Detalhes
                        </button>
                    </div>
                </div>
            </div>

            <!-- Quarto 6: Studio -->
            <div class="card-elegant group overflow-hidden">
                <div class="relative h-80 overflow-hidden bg-gray-300">
                    <img src="https://images.unsplash.com/photo-1512694712202-b4f91e6ca4eb?w=600&q=80" 
                         alt="Studio Deluxe" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-elegant duration-700">
                    <div class="absolute top-4 left-4">
                        <span class="bg-green-400 text-white px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wide">
                            Econômico
                        </span>
                    </div>
                </div>
                <div class="p-8">
                    <h3 class="font-display text-2xl text-secondary-dark mb-2">Studio Deluxe</h3>
                    <div class="flex items-center mb-4 text-sm text-accent">
                        <span>⭐⭐⭐⭐</span>
                        <span class="text-text-light ml-2">(4.4/5)</span>
                    </div>
                    
                    <p class="text-text-light mb-6 text-sm leading-relaxed">
                        Compacto e elegante com o essencial para viajantes, cama confortável e banheiro completo.
                    </p>
                    
                    <!-- Amenidades -->
                    <div class="mb-6 space-y-2 text-sm text-text-light">
                        <div class="flex items-center">
                            <span class="mr-3">🚶</span>
                            <span>Ideal para mochileiros</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-3">💰</span>
                            <span>Melhor relação custo/benefício</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-3">🧴</span>
                            <span>Toiletries premium inclusos</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-3">📍</span>
                            <span>Localização central</span>
                        </div>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="font-display text-2xl text-secondary-dark font-bold">R$ 350</span>
                            <span class="text-sm text-text-light">/noite</span>
                        </div>
                        <button class="btn-secondary w-full text-sm">
                            Ver Detalhes
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Paginação -->
        <div class="flex justify-center items-center gap-4 mt-16">
            <button class="px-4 py-2 rounded-lg border border-gray-300 text-text-dark hover:bg-bg-light transition-elegant">← Anterior</button>
            
            <div class="flex gap-2">
                <button class="w-10 h-10 rounded-lg bg-secondary-dark text-white font-bold">1</button>
                <button class="w-10 h-10 rounded-lg border border-gray-300 text-text-dark hover:bg-bg-light transition-elegant">2</button>
                <button class="w-10 h-10 rounded-lg border border-gray-300 text-text-dark hover:bg-bg-light transition-elegant">3</button>
            </div>
            
            <button class="px-4 py-2 rounded-lg border border-gray-300 text-text-dark hover:bg-bg-light transition-elegant">Próxima →</button>
        </div>
    </div>
</section>

<!-- CTA Final -->
<section class="py-20 bg-secondary-dark text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="font-display text-4xl md:text-5xl mb-6">
            Não encontrou o quarto ideal?
        </h2>
        <p class="text-lg text-gray-300 mb-8">
            Fale com nossos consultores para opções personalizadas
        </p>
        <a href="{{ route('contact') }}" class="btn-primary bg-white text-secondary-dark hover:bg-gray-100">
            Entre em Contato
        </a>
    </div>
</section>
@endsection
