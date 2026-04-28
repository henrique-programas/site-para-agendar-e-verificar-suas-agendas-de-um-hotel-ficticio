# 🎨 Calm Mind Resort & Spa - Frontend Only

Sistema de frontend **puro HTML/Blade + Tailwind CSS** para um resort luxuoso.

---

## 📦 Arquivos Entregues

### **Views Blade (5 arquivos)**
- `app.blade.php` - Layout principal com navegação e footer
- `home.blade.php` - Homepage com hero, destaques e quartos
- `rooms.blade.php` - Página de quartos com filtros
- `about.blade.php` - Página sobre o resort
- `contact.blade.php` - Página de contato com formulário

### **Configuração (1 arquivo)**
- `tailwind.config.js` - Tailwind CSS customizado

---

## ⚡ Quick Start

### **1. Setup Inicial**

```bash
# Crie um projeto Laravel novo
composer create-project laravel/laravel calm-mind
cd calm-mind

# Instale Tailwind CSS
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p

# Instale dependências
npm install
```

### **2. Configure Tailwind**

Copie o arquivo `tailwind.config.js` para a raiz do seu projeto.

### **3. Configure arquivo CSS**

Crie `resources/css/app.css` com:

```css
@tailwind base;
@tailwind components;
@tailwind utilities;
```

### **4. Organize as Views**

```
resources/views/
├── layouts/
│   └── app.blade.php          ← Copie aqui
├── pages/
│   ├── home.blade.php         ← Copie aqui
│   ├── rooms.blade.php        ← Copie aqui
│   ├── about.blade.php        ← Copie aqui
│   └── contact.blade.php      ← Copie aqui
```

### **5. Crie as Rotas Básicas**

Em `routes/web.php`:

```php
<?php

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/quartos', function () {
    return view('pages.rooms');
})->name('rooms');

Route::get('/sobre', function () {
    return view('pages.about');
})->name('about');

Route::get('/contato', function () {
    return view('pages.contact');
})->name('contact');
```

### **6. Build CSS**

```bash
# Desenvolvimento (com watch)
npm run dev

# Produção
npm run build
```

### **7. Inicie o servidor**

```bash
php artisan serve
```

Acesse em `http://localhost:8000` 🚀

---

## 🎨 Design

### **Paleta de Cores**

```css
Primary:    #2d7a8a (Azul Teal)
Secondary:  #3d2817 (Marrom)
Accent:     #c4a47a (Bege/Ouro)
BG Light:   #f5f1e8 (Bege Claro)
BG White:   #fefbf7 (Branco Quente)
Text Dark:  #2a2a2a
Text Light: #6b6b6b
```

### **Fontes**

```
Display: Playfair Display (serif) - Titles
Body:    Lato (sans-serif) - Content
```

As fontes já estão importadas via Google Fonts no `app.blade.php`

---

## 📱 Responsividade

Todos os arquivos são **100% responsivos**:
- ✅ Mobile (< 640px)
- ✅ Tablet (640px - 1024px)
- ✅ Desktop (> 1024px)

---

## 🔧 Customização

### **Mudar Cores**

Edite `tailwind.config.js`:

```javascript
colors: {
  'primary': '#SEU_COR',
  'secondary': '#SEU_COR',
  // ... resto das cores
}
```

### **Mudar Fontes**

Edite `app.blade.php`:

```html
<link href="https://fonts.googleapis.com/css2?family=NOVA_FONTE&display=swap" rel="stylesheet">
```

E `tailwind.config.js`:

```javascript
fontFamily: {
  'display': ['NOVA_FONTE', 'serif'],
}
```

---

## 📝 Estrutura das Páginas

### **home.blade.php**
- Hero section com imagem de fundo
- Seção "Bem-vindo"
- Cards de destaques
- Quartos em destaque
- Verificador de disponibilidade
- CTA (Call-to-Action)

### **rooms.blade.php**
- Header
- Filtros (tipo, datas, preço)
- Grid de 6 tipos de quartos
- Cards elegantes com preços
- Paginação

### **about.blade.php**
- História do resort
- Missão, Visão, Valores
- Números (ocupação, prêmios)
- Serviços oferecidos
- Sustentabilidade
- Equipe
- Prêmios e reconhecimentos

### **contact.blade.php**
- Informações de contato
- Formulário completo
- FAQ com dropdown
- Horários de funcionamento
- Mapa (placeholder)

---

## 🚀 Componentes Reutilizáveis

Já implementados nos arquivos:

- `btn-primary` - Botão principal
- `btn-secondary` - Botão secundário
- `card-elegant` - Cards com hover
- `line-accent` - Linha decorativa
- `transition-elegant` - Transições suaves

Use em qualquer lugar do HTML:

```html
<button class="btn-primary">Clique</button>
<div class="card-elegant p-8">Conteúdo</div>
```

---

## 📊 Tipos de Quartos

| Tipo | Preço | Ícone |
|------|-------|-------|
| Quarto Deluxe | R$ 450/noite | 🏩 |
| Suite Premium | R$ 750/noite | 🏨 |
| Suíte Presidencial | R$ 1.200/noite | 👑 |
| Suite Nupcial | R$ 950/noite | 💕 |
| Suite Família | R$ 650/noite | 👨‍👩‍👧‍👦 |
| Studio Deluxe | R$ 350/noite | 🎪 |

---

## 🎯 Links das Páginas

- Home: `/`
- Quartos: `/quartos`
- Sobre: `/sobre`
- Contato: `/contato`

---

## 💡 Dicas

### **1. Adicionar Fontes Extras**

Edite o `<head>` em `app.blade.php`:

```html
<link href="https://fonts.googleapis.com/css2?family=NOVA_FONTE&display=swap" rel="stylesheet">
```

### **2. Adicionar Ícones**

Use emojis ou importe uma biblioteca:

```html
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
```

### **3. Adicionar Imagens**

Coloque em `public/images/`:

```html
<img src="{{ asset('images/seu-arquivo.jpg') }}" alt="Descrição">
```

### **4. Customizar Espaçamento**

Tailwind já tem classes prontas:
- `p-4` - Padding
- `m-4` - Margin
- `gap-4` - Gap

### **5. Adicionar Animações**

As animações já estão definidas:
- `animate-fade-in-up`
- `animate-fade-in`
- `animate-bounce`

Use em qualquer elemento:

```html
<div class="animate-fade-in-up">Conteúdo</div>
```

---

## 🔗 Links Úteis

- [Tailwind CSS Docs](https://tailwindcss.com/docs)
- [Blade Templating](https://laravel.com/docs/blade)
- [Google Fonts](https://fonts.google.com)
- [Unsplash (Imagens)](https://unsplash.com)

---

## ✅ Checklist de Implementação

- [ ] Criar projeto Laravel
- [ ] Instalar Tailwind CSS
- [ ] Copiar `tailwind.config.js`
- [ ] Copiar arquivos `.blade.php`
- [ ] Criar rotas em `web.php`
- [ ] Executar `npm run dev`
- [ ] Iniciar servidor com `php artisan serve`
- [ ] Testar em diferentes tamanhos de tela
- [ ] Customizar cores conforme necessário
- [ ] Adicionar imagens reais

---

## 🎉 Pronto para Usar!

Todos os arquivos estão prontos para serem copiados e usados. Sem dependências de backend, sem controllers, sem models.

**Basta copiar, colar e rodar!**

---

Desenvolvido com ❤️ para o Calm Mind Resort & Spa
