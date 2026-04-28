<!-- COMPONENTES BLADE REUTILIZÁVEIS -->

<!-- ============================================================================
     1. COMPONENTE: BOTÃO
     ============================================================================ -->

<!-- resources/views/components/button.blade.php -->

<button 
  type="{{ $type ?? 'button' }}"
  class="btn-{{ $variant ?? 'primary' }} {{ $class ?? '' }}"
  {{ $attributes }}
>
  {{ $slot }}
</button>

<!-- USO: <x-button variant="primary">Clique aqui</x-button> -->

---

<!-- ============================================================================
     2. COMPONENTE: CARD
     ============================================================================ -->

<!-- resources/views/components/card.blade.php -->

<div class="card-elegant {{ $class ?? '' }}">
  @if($title ?? null)
    <div class="p-8 border-b border-gray-200">
      <h3 class="font-display text-2xl text-secondary-dark">{{ $title }}</h3>
    </div>
  @endif

  <div class="p-8">
    {{ $slot }}
  </div>

  @if($footer ?? null)
    <div class="p-8 border-t border-gray-200 bg-bg-light">
      {{ $footer }}
    </div>
  @endif
</div>

<!-- USO: 
<x-card title="Título do Card">
  Conteúdo aqui
</x-card>
-->

---

<!-- ============================================================================
     3. COMPONENTE: ALERT
     ============================================================================ -->

<!-- resources/views/components/alert.blade.php -->

@if($message)
  <div class="alert alert-{{ $type ?? 'info' }} rounded-lg p-4 mb-4">
    <div class="flex gap-3">
      <span class="text-2xl">
        @switch($type ?? 'info')
          @case('success')
            ✅
            @break
          @case('error')
            ❌
            @break
          @case('warning')
            ⚠️
            @break
          @default
            ℹ️
        @endswitch
      </span>
      <div>
        @if($title ?? null)
          <h4 class="font-semibold">{{ $title }}</h4>
        @endif
        <p>{{ $message }}</p>
      </div>
    </div>
  </div>
@endif

<style>
  .alert-success {
    background-color: #D1FAE5;
    border: 1px solid #6EE7B7;
    color: #065F46;
  }
  .alert-error {
    background-color: #FEE2E2;
    border: 1px solid #FECACA;
    color: #7F1D1D;
  }
  .alert-warning {
    background-color: #FEF3C7;
    border: 1px solid #FCD34D;
    color: #78350F;
  }
  .alert-info {
    background-color: #DBEAFE;
    border: 1px solid #93C5FD;
    color: #1E40AF;
  }
</style>

<!-- USO:
<x-alert type="success" title="Sucesso!" message="Operação realizada com sucesso!" />
<x-alert type="error" message="Erro ao processar" />
-->

---

<!-- ============================================================================
     4. COMPONENTE: FORM INPUT
     ============================================================================ -->

<!-- resources/views/components/form-input.blade.php -->

<div class="mb-6">
  @if($label ?? null)
    <label class="block text-sm font-semibold text-secondary-dark mb-3">
      {{ $label }}
      @if($required ?? false)
        <span class="text-red-500">*</span>
      @endif
    </label>
  @endif

  <input 
    type="{{ $type ?? 'text' }}"
    name="{{ $name }}"
    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-elegant {{ $class ?? '' }}"
    placeholder="{{ $placeholder ?? '' }}"
    value="{{ old($name, $value ?? '') }}"
    {{ $attributes }}
  >

  @error($name)
    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
  @enderror

  @if($hint ?? null)
    <p class="text-text-light text-sm mt-2">{{ $hint }}</p>
  @endif
</div>

<!-- USO:
<x-form-input 
  name="email" 
  label="Email" 
  type="email"
  placeholder="seu@email.com"
  required
/>
-->

---

<!-- ============================================================================
     5. COMPONENTE: FORM SELECT
     ============================================================================ -->

<!-- resources/views/components/form-select.blade.php -->

<div class="mb-6">
  @if($label ?? null)
    <label class="block text-sm font-semibold text-secondary-dark mb-3">
      {{ $label }}
      @if($required ?? false)
        <span class="text-red-500">*</span>
      @endif
    </label>
  @endif

  <select 
    name="{{ $name }}"
    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-elegant {{ $class ?? '' }}"
    {{ $attributes }}
  >
    @if($placeholder ?? null)
      <option value="">{{ $placeholder }}</option>
    @endif

    @foreach($options as $value => $label)
      <option value="{{ $value }}" @selected(old($name) == $value || $value == ($selected ?? null))>
        {{ $label }}
      </option>
    @endforeach
  </select>

  @error($name)
    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
  @enderror
</div>

<!-- USO:
<x-form-select 
  name="room_type"
  label="Tipo de Quarto"
  :options="['deluxe' => 'Deluxe', 'premium' => 'Premium']"
  required
/>
-->

---

<!-- ============================================================================
     6. COMPONENTE: FORM TEXTAREA
     ============================================================================ -->

<!-- resources/views/components/form-textarea.blade.php -->

<div class="mb-6">
  @if($label ?? null)
    <label class="block text-sm font-semibold text-secondary-dark mb-3">
      {{ $label }}
      @if($required ?? false)
        <span class="text-red-500">*</span>
      @endif
    </label>
  @endif

  <textarea 
    name="{{ $name }}"
    rows="{{ $rows ?? 6 }}"
    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-elegant resize-none {{ $class ?? '' }}"
    placeholder="{{ $placeholder ?? '' }}"
    {{ $attributes }}
  >{{ old($name, $value ?? '') }}</textarea>

  @error($name)
    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
  @enderror

  @if($maxLength ?? null)
    <p class="text-text-light text-sm mt-2">Máximo de caracteres: {{ $maxLength }}</p>
  @endif
</div>

<!-- USO:
<x-form-textarea 
  name="message"
  label="Mensagem"
  placeholder="Digite sua mensagem..."
  required
/>
-->

---

<!-- ============================================================================
     7. COMPONENTE: SECTION HEADER (Título de Seção)
     ============================================================================ -->

<!-- resources/views/components/section-header.blade.php -->

<div class="text-center mb-16">
  @if($showLine ?? true)
    <div class="line-accent mx-auto mb-6"></div>
  @endif

  @if($title ?? null)
    <h2 class="font-display text-4xl md:text-5xl text-secondary-dark mb-6">
      {!! $title !!}
    </h2>
  @endif

  @if($subtitle ?? null)
    <p class="text-lg text-text-light max-w-2xl mx-auto">
      {{ $subtitle }}
    </p>
  @endif

  {{ $slot ?? '' }}
</div>

<!-- USO:
<x-section-header 
  title="Nossos Serviços"
  subtitle="Tudo para sua comodidade"
/>
-->

---

<!-- ============================================================================
     8. COMPONENTE: ROOM CARD
     ============================================================================ -->

<!-- resources/views/components/room-card.blade.php -->

<div class="card-elegant group overflow-hidden">
  <div class="relative h-80 overflow-hidden bg-gray-300">
    <img src="{{ $room->image }}" 
         alt="{{ $room->name }}" 
         class="w-full h-full object-cover group-hover:scale-110 transition-elegant duration-700">
    @if($room->badge)
      <div class="absolute top-4 left-4">
        <span class="bg-accent text-secondary-dark px-4 py-2 rounded-full text-xs font-bold uppercase">
          {{ $room->badge }}
        </span>
      </div>
    @endif
  </div>

  <div class="p-8">
    <h3 class="font-display text-2xl text-secondary-dark mb-2">{{ $room->name }}</h3>
    
    @if($room->rating)
      <div class="flex items-center mb-4 text-sm text-accent">
        <span>⭐⭐⭐⭐</span>
        <span class="text-text-light ml-2">({{ $room->rating }}/5)</span>
      </div>
    @endif

    <p class="text-text-light mb-6 text-sm">{{ $room->description }}</p>

    <div class="border-t border-gray-200 pt-6">
      <div class="flex items-center justify-between mb-4">
        <span class="font-display text-2xl text-secondary-dark font-bold">R$ {{ number_format($room->price, 2, ',', '.') }}</span>
        <span class="text-sm text-text-light">/noite</span>
      </div>
      <a href="{{ route('room.detail', $room->id) }}" class="btn-secondary w-full text-sm">
        Ver Detalhes
      </a>
    </div>
  </div>
</div>

<!-- USO:
<x-room-card :room="$room" />
-->

---

<!-- ============================================================================
     9. COMPONENTE: BREADCRUMB
     ============================================================================ -->

<!-- resources/views/components/breadcrumb.blade.php -->

<nav class="flex items-center gap-2 text-sm mb-6">
  @foreach($items as $index => $item)
    @if($index > 0)
      <span class="text-text-light">/</span>
    @endif

    @if($loop->last)
      <span class="text-text-dark font-semibold">{{ $item['label'] }}</span>
    @else
      <a href="{{ $item['url'] }}" class="text-primary hover:text-primary-light transition-elegant">
        {{ $item['label'] }}
      </a>
    @endif
  @endforeach
</nav>

<!-- USO:
<x-breadcrumb :items="[
  ['label' => 'Home', 'url' => '/'],
  ['label' => 'Quartos', 'url' => '/quartos'],
  ['label' => 'Deluxe']
]" />
-->

---

<!-- ============================================================================
     10. COMPONENTE: MODAL
     ============================================================================ -->

<!-- resources/views/components/modal.blade.php -->

<div id="{{ $id }}" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
  <div class="bg-white rounded-lg max-w-md w-full shadow-xl">
    <div class="flex justify-between items-center p-6 border-b border-gray-200">
      <h3 class="font-display text-2xl text-secondary-dark">{{ $title }}</h3>
      <button onclick="document.getElementById('{{ $id }}').classList.add('hidden')" class="text-text-light hover:text-text-dark">
        ✕
      </button>
    </div>

    <div class="p-6">
      {{ $slot }}
    </div>

    @if($footer ?? null)
      <div class="flex gap-3 p-6 border-t border-gray-200">
        {{ $footer }}
      </div>
    @endif
  </div>
</div>

<!-- Script para abrir -->
<script>
function openModal(id) {
  document.getElementById(id).classList.remove('hidden');
}

function closeModal(id) {
  document.getElementById(id).classList.add('hidden');
}
</script>

<!-- USO:
<x-modal id="confirmModal" title="Confirmar Ação">
  <p>Tem certeza que deseja continuar?</p>
  <x-slot name="footer">
    <button onclick="closeModal('confirmModal')" class="btn-secondary flex-1">Cancelar</button>
    <button onclick="confirm()" class="btn-primary flex-1">Confirmar</button>
  </x-slot>
</x-modal>

<button onclick="openModal('confirmModal')">Abrir Modal</button>
-->

---

<!-- ============================================================================
     RESUMO DE COMPONENTES
     ============================================================================ -->

COMPONENTES DISPONÍVEIS:
1. x-button        - Botões reutilizáveis
2. x-card          - Cards com cabeçalho e rodapé
3. x-alert         - Alertas de sucesso, erro, aviso
4. x-form-input    - Inputs de formulário
5. x-form-select   - Selects de formulário
6. x-form-textarea - Textareas de formulário
7. x-section-header- Cabeçalho de seções
8. x-room-card     - Cards de quartos
9. x-breadcrumb    - Navegação breadcrumb
10. x-modal        - Modais reutilizáveis

PRÓXIMOS COMPONENTES A CRIAR:
- x-pagination     - Paginação
- x-loading        - Spinner de carregamento
- x-avatar         - Avatar de usuário
- x-star-rating    - Classificação por estrelas
- x-image-gallery  - Galeria de imagens
- x-tooltip        - Tooltips informativos
- x-tabs           - Abas de conteúdo
- x-progress-bar   - Barra de progresso
- x-empty-state    - Estado vazio
- x-confirmation-dialog - Diálogo de confirmação
