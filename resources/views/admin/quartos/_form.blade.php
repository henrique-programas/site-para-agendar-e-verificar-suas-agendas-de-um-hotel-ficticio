<style>
    .form-card { background:#1c1610; border:1px solid rgba(201,168,76,0.1); border-radius:3px; padding:2rem; max-width:780px; }
    .form-grid { display:grid; grid-template-columns:1fr 1fr; gap:1.25rem; }
    .form-group { display:flex; flex-direction:column; gap:0.5rem; }
    .form-group.full { grid-column:1/-1; }
    label { font-size:0.65rem; text-transform:uppercase; letter-spacing:0.15em; color:#8a7560; }
    .form-input, .form-select, .form-textarea {
        padding:0.8rem 1rem; background:#110e0a; border:1px solid rgba(201,168,76,0.12);
        color:#f0e8d5; border-radius:2px; font-size:0.88rem; outline:none;
        font-family:'DM Sans',sans-serif; transition:border-color 0.2s;
    }
    .form-input:focus, .form-select:focus, .form-textarea:focus { border-color:rgba(201,168,76,0.4); }
    .form-input::placeholder, .form-textarea::placeholder { color:#5c5040; }
    .form-textarea { resize:vertical; min-height:100px; }
    .error-msg { font-size:0.75rem; color:#e07070; margin-top:0.2rem; }
    .amenities-grid { display:flex; flex-wrap:wrap; gap:0.6rem; margin-top:0.35rem; }
    .amenity-check { display:flex; align-items:center; gap:0.45rem; cursor:pointer; }
    .amenity-check input { width:1rem; height:1rem; accent-color:#c9a84c; cursor:pointer; }
    .amenity-check span { font-size:0.8rem; color:#8a7560; }
    .form-actions { display:flex; gap:0.75rem; margin-top:1.75rem; padding-top:1.5rem; border-top:1px solid rgba(201,168,76,0.08); }
    .btn-gold { display:inline-flex; align-items:center; gap:0.5rem; padding:0.7rem 1.6rem; background:#c9a84c; color:#0a0806; border:none; border-radius:2px; font-size:0.75rem; font-weight:500; letter-spacing:0.12em; text-transform:uppercase; cursor:pointer; transition:background 0.2s; font-family:'DM Sans',sans-serif; }
    .btn-gold:hover { background:#e2c47a; }
    .btn-cancel { display:inline-flex; align-items:center; padding:0.7rem 1.4rem; background:transparent; border:1px solid rgba(201,168,76,0.18); color:#8a7560; border-radius:2px; font-size:0.75rem; letter-spacing:0.12em; text-transform:uppercase; cursor:pointer; text-decoration:none; transition:all 0.2s; font-family:'DM Sans',sans-serif; }
    .btn-cancel:hover { border-color:rgba(201,168,76,0.35); color:#c8bba5; }
    .img-preview { width:100%; height:140px; object-fit:cover; border-radius:2px; margin-top:0.5rem; border:1px solid rgba(201,168,76,0.12); display:none; }
    @media(max-width:600px){ .form-grid{ grid-template-columns:1fr; } }
</style>

@php
    $amenitiesOpcoes = ['King','Queen','WiFi','AC','Frigobar','Banheira','Varanda','Sala','Butler','Spa','Vista Mar','Cozinha'];
    $amenitiesAtivas = old('amenities', $room?->amenities ?? []);
@endphp

<div class="form-card">
    <form method="POST" action="{{ $route }}">
        @csrf
        @if($method === 'PUT') @method('PUT') @endif

        <div class="form-grid">

            {{-- Número --}}
            <div class="form-group">
                <label for="number">Número do Quarto *</label>
                <input id="number" name="number" type="text" class="form-input"
                       value="{{ old('number', $room?->number) }}" placeholder="101" required>
                @error('number') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            {{-- Nome --}}
            <div class="form-group">
                <label for="name">Nome *</label>
                <input id="name" name="name" type="text" class="form-input"
                       value="{{ old('name', $room?->name) }}" placeholder="Suite Premium" required>
                @error('name') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            {{-- Tipo --}}
            <div class="form-group">
                <label for="type">Tipo *</label>
                <select id="type" name="type" class="form-select" required>
                    <option value="">Selecione...</option>
                    @foreach(['deluxe'=>'Deluxe','premium'=>'Premium','presidencial'=>'Presidencial'] as $val => $label)
                        <option value="{{ $val }}" {{ old('type', $room?->type) === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('type') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            {{-- Status --}}
            <div class="form-group">
                <label for="status">Status *</label>
                <select id="status" name="status" class="form-select" required>
                    @foreach(['disponivel'=>'Disponível','ocupado'=>'Ocupado','manutencao'=>'Manutenção'] as $val => $label)
                        <option value="{{ $val }}" {{ old('status', $room?->status ?? 'disponivel') === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('status') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            {{-- Preço --}}
            <div class="form-group">
                <label for="price_per_night">Diária (R$) *</label>
                <input id="price_per_night" name="price_per_night" type="number" step="0.01" min="1" class="form-input"
                       value="{{ old('price_per_night', $room?->price_per_night) }}" placeholder="450.00" required>
                @error('price_per_night') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            {{-- Capacidade --}}
            <div class="form-group">
                <label for="capacity">Capacidade (hóspedes) *</label>
                <input id="capacity" name="capacity" type="number" min="1" max="20" class="form-input"
                       value="{{ old('capacity', $room?->capacity ?? 2) }}" required>
                @error('capacity') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            {{-- URL da imagem --}}
            <div class="form-group full">
                <label for="image_url">URL da Imagem</label>
                <input id="image_url" name="image_url" type="url" class="form-input"
                       value="{{ old('image_url', $room?->image_url) }}"
                       placeholder="https://images.unsplash.com/..."
                       oninput="previewImg(this.value)">
                <img id="img-preview" class="img-preview"
                     src="{{ old('image_url', $room?->image_url) }}"
                     style="{{ old('image_url', $room?->image_url) ? 'display:block;' : '' }}">
                @error('image_url') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            {{-- Descrição --}}
            <div class="form-group full">
                <label for="description">Descrição</label>
                <textarea id="description" name="description" class="form-textarea"
                          placeholder="Descreva o quarto...">{{ old('description', $room?->description) }}</textarea>
                @error('description') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            {{-- Comodidades --}}
            <div class="form-group full">
                <label>Comodidades</label>
                <div class="amenities-grid">
                    @foreach($amenitiesOpcoes as $a)
                        <label class="amenity-check">
                            <input type="checkbox" name="amenities[]" value="{{ $a }}"
                                   {{ in_array($a, $amenitiesAtivas) ? 'checked' : '' }}>
                            <span>{{ $a }}</span>
                        </label>
                    @endforeach
                </div>
                @error('amenities') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

        </div>

        <div class="form-actions">
            <button type="submit" class="btn-gold">
                {{ $room ? 'Salvar Alterações' : 'Criar Quarto' }}
            </button>
            <a href="{{ route('admin.quartos.index') }}" class="btn-cancel">Cancelar</a>
        </div>
    </form>
</div>

<script>
function previewImg(url) {
    const img = document.getElementById('img-preview');
    if (url) {
        img.src = url;
        img.style.display = 'block';
        img.onerror = () => img.style.display = 'none';
    } else {
        img.style.display = 'none';
    }
}
</script>
