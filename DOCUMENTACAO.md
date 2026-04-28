# Calm Mind Resort & Spa - Documentação do Projeto

## 📋 Visão Geral

Sistema completo de gerenciamento de resort com Laravel e Tailwind CSS, incluindo:
- **Área Pública**: Site bonito e responsivo para clientes
- **Área do Cliente**: Gerenciamento de reservas e perfil
- **Área Administrativa**: Dashboard com métricas e gerenciamento completo

---

## 🏗️ Estrutura do Projeto

### Diretórios Principal

```
projeto/
├── app/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Room.php
│   │   ├── Reservation.php
│   │   ├── Contact.php
│   │   └── Payment.php
│   │
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── PageController.php
│   │   │   ├── ReservationController.php
│   │   │   ├── RoomController.php
│   │   │   ├── UserController.php
│   │   │   ├── ContactController.php
│   │   │   └── AdminController.php
│   │   │
│   │   └── Middleware/
│   │       ├── IsAdmin.php
│   │       └── IsClient.php
│   │
│   └── Services/
│       ├── ReservationService.php
│       ├── PaymentService.php
│       └── EmailService.php
│
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php (Layout Principal)
│   │   │
│   │   ├── pages/
│   │   │   ├── home.blade.php
│   │   │   ├── about.blade.php
│   │   │   ├── rooms.blade.php
│   │   │   ├── room-detail.blade.php
│   │   │   ├── contact.blade.php
│   │   │   └── availability.blade.php
│   │   │
│   │   ├── client/
│   │   │   ├── dashboard.blade.php
│   │   │   ├── reservations.blade.php
│   │   │   ├── reservation-detail.blade.php
│   │   │   ├── booking.blade.php
│   │   │   ├── profile.blade.php
│   │   │   └── history.blade.php
│   │   │
│   │   ├── admin/
│   │   │   ├── dashboard.blade.php
│   │   │   ├── reservations.blade.php
│   │   │   ├── rooms.blade.php
│   │   │   ├── pricing.blade.php
│   │   │   ├── users.blade.php
│   │   │   └── reports.blade.php
│   │   │
│   │   ├── auth/
│   │   │   ├── login.blade.php
│   │   │   └── register.blade.php
│   │   │
│   │   ├── components/
│   │   │   └── (componentes reutilizáveis)
│   │   │
│   │   └── emails/
│   │       ├── reservation-confirmation.blade.php
│   │       ├── contact-reply.blade.php
│   │       └── welcome.blade.php
│   │
│   ├── css/
│   │   └── app.css (com Tailwind CSS)
│   │
│   └── js/
│       └── app.js
│
├── database/
│   ├── migrations/
│   │   ├── create_users_table.php
│   │   ├── create_rooms_table.php
│   │   ├── create_reservations_table.php
│   │   ├── create_contacts_table.php
│   │   ├── create_payments_table.php
│   │   └── create_room_images_table.php
│   │
│   ├── seeders/
│   │   ├── DatabaseSeeder.php
│   │   ├── UserSeeder.php
│   │   ├── RoomSeeder.php
│   │   └── ReservationSeeder.php
│   │
│   └── factories/
│       ├── UserFactory.php
│       ├── RoomFactory.php
│       └── ReservationFactory.php
│
├── routes/
│   └── web.php (todas as rotas)
│
├── tests/
│   ├── Feature/
│   │   ├── ReservationTest.php
│   │   ├── RoomTest.php
│   │   └── AuthTest.php
│   │
│   └── Unit/
│       └── ReservationServiceTest.php
│
├── config/
│   ├── app.php
│   ├── database.php
│   └── mail.php
│
├── .env.example
├── composer.json
├── package.json
├── tailwind.config.js
├── vite.config.js
└── README.md
```

---

## 🎨 Design & Styling

### Paleta de Cores

```css
:root {
    --primary: #2d7a8a;           /* Azul Teal */
    --primary-light: #4a9fb5;     /* Azul Teal Claro */
    --secondary: #3d2817;         /* Marrom Escuro */
    --secondary-dark: #2a1810;    /* Marrom Muito Escuro */
    --accent: #c4a47a;            /* Bege/Ouro */
    --bg-light: #f5f1e8;          /* Bege Claro */
    --bg-white: #fefbf7;          /* Branco Quente */
    --text-dark: #2a2a2a;         /* Texto Escuro */
    --text-light: #6b6b6b;        /* Texto Claro */
}
```

### Tipografia

- **Display**: Playfair Display (serif) - Títulos e headings
- **Body**: Lato (sans-serif) - Corpo do texto

### Componentes Reutilizáveis

- `btn-primary` - Botão principal
- `btn-secondary` - Botão secundário
- `card-elegant` - Cards com efeito hover
- `line-accent` - Linha decorativa
- `transition-elegant` - Transições suaves

---

## 📄 Modelos de Dados

### User (Usuário)

```php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->string('phone')->nullable();
    $table->string('password');
    $table->date('birth_date')->nullable();
    $table->string('cpf')->nullable();
    $table->string('address')->nullable();
    $table->string('city')->nullable();
    $table->string('state')->nullable();
    $table->string('zip_code')->nullable();
    $table->enum('role', ['client', 'staff', 'admin'])->default('client');
    $table->boolean('is_active')->default(true);
    $table->rememberToken();
    $table->timestamps();
});
```

### Room (Quarto)

```php
Schema::create('rooms', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();
    $table->text('description');
    $table->enum('type', ['deluxe', 'premium', 'presidencial', 'nupcial', 'familia', 'studio']);
    $table->integer('capacity');
    $table->integer('beds');
    $table->decimal('price_per_night', 8, 2);
    $table->integer('quantity')->default(1);
    $table->integer('available')->default(1);
    $table->text('amenities'); // JSON
    $table->integer('floor')->nullable();
    $table->string('view_type')->nullable();
    $table->decimal('size_sqm', 8, 2)->nullable();
    $table->boolean('is_active')->default(true);
    $table->integer('sort_order')->default(0);
    $table->timestamps();
});
```

### Reservation (Reserva)

```php
Schema::create('reservations', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained();
    $table->foreignId('room_id')->constrained();
    $table->dateTime('check_in');
    $table->dateTime('check_out');
    $table->integer('guests');
    $table->integer('nights');
    $table->decimal('total_price', 10, 2);
    $table->enum('status', ['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled'])->default('pending');
    $table->text('special_requests')->nullable();
    $table->string('confirmation_code')->unique();
    $table->boolean('paid')->default(false);
    $table->timestamps();
});
```

### Contact (Contato)

```php
Schema::create('contacts', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email');
    $table->string('phone')->nullable();
    $table->string('subject');
    $table->text('message');
    $table->string('room_type')->nullable();
    $table->date('check_in')->nullable();
    $table->date('check_out')->nullable();
    $table->enum('status', ['new', 'replied', 'closed'])->default('new');
    $table->boolean('subscribe_newsletter')->default(false);
    $table->timestamps();
});
```

### Payment (Pagamento)

```php
Schema::create('payments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('reservation_id')->constrained();
    $table->decimal('amount', 10, 2);
    $table->enum('method', ['credit_card', 'debit_card', 'transfer', 'bitcoin']);
    $table->enum('status', ['pending', 'approved', 'declined', 'refunded']);
    $table->string('transaction_id')->nullable();
    $table->text('response')->nullable();
    $table->timestamps();
});
```

---

## 🔐 Autenticação e Autorização

### Middleware

- `auth` - Usuário autenticado
- `admin` - Usuário com papel admin
- `guest` - Usuário não autenticado

### Roles

- `client` - Cliente comum
- `staff` - Funcionário do resort
- `admin` - Administrador

---

## 📱 Responsividade

O projeto utiliza Tailwind CSS com breakpoints:
- `sm` - 640px
- `md` - 768px
- `lg` - 1024px
- `xl` - 1280px
- `2xl` - 1536px

Todas as páginas são totalmente responsivas!

---

## 🚀 Implementação Passo a Passo

### 1. Configuração Inicial

```bash
# Criar novo projeto Laravel
composer create-project laravel/laravel calm-mind

# Instalar Tailwind CSS
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p

# Instalar dependências
npm install
composer install
```

### 2. Configurar Ambiente

```bash
# Copiar arquivo de ambiente
cp .env.example .env

# Gerar chave da aplicação
php artisan key:generate

# Configurar banco de dados no .env
DB_CONNECTION=mysql
DB_DATABASE=calm_mind
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Criar Migrations

```bash
php artisan make:migration create_users_table
php artisan make:migration create_rooms_table
php artisan make:migration create_reservations_table
php artisan make:migration create_contacts_table
php artisan make:migration create_payments_table
php artisan make:migration create_room_images_table
```

### 4. Executar Migrations

```bash
php artisan migrate
```

### 5. Criar Seeders (Dados de Teste)

```bash
php artisan make:seeder RoomSeeder
php artisan make:seeder UserSeeder
php artisan db:seed
```

### 6. Criar Controllers

```bash
php artisan make:controller PageController
php artisan make:controller ReservationController
php artisan make:controller RoomController -r
php artisan make:controller Admin/ReservationController -r
```

### 7. Configurar Rotas

- Copiar conteúdo de `routes_web.php` para `routes/web.php`

### 8. Criar Views

- Copiar arquivos blade (`.blade.php`) para `resources/views/`

### 9. Build Assets

```bash
npm run build
# ou para desenvolvimento
npm run dev
```

### 10. Iniciar Servidor

```bash
php artisan serve
```

Acesse em `http://localhost:8000`

---

## 🌐 Funcionalidades Principais

### Área Pública (✅ Implementada)

- ✅ Página inicial com hero section
- ✅ Listagem de quartos com filtros
- ✅ Detalhes de quartos
- ✅ Página sobre o resort
- ✅ Página de contato com formulário
- ✅ Verificação de disponibilidade

### Área do Cliente (⏳ A implementar)

- ⏳ Dashboard com reservas
- ⏳ Gerenciamento de reservas
- ⏳ Cancelamento de reservas
- ⏳ Perfil do usuário
- ⏳ Histórico de hospedagens

### Área Administrativa (⏳ A implementar)

- ⏳ Dashboard com métricas
- ⏳ Reservas do dia
- ⏳ Aprovação/Rejeição de reservas
- ⏳ Cadastro de quartos
- ⏳ Gerenciamento de preços
- ⏳ Gerenciamento de usuários
- ⏳ Relatórios (ocupação, receita, hóspedes)

---

## 📧 Email & Notificações

### Templates de Email

- Confirmação de Reserva
- Cancelamento de Reserva
- Resposta ao Contato
- Boas-vindas
- Lembrete de Check-in

### Configuração

```env
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=seu_usuario
MAIL_PASSWORD=sua_senha
MAIL_FROM_ADDRESS=noreply@calmmind.com
MAIL_FROM_NAME="Calm Mind Resort"
```

---

## 💳 Integração de Pagamentos

Suportar:
- Stripe
- PayPal
- Mercado Pago
- Boleto Bancário

---

## 🔍 SEO

- Meta tags dinâmicas
- Sitemap XML
- Robots.txt
- Schema.org markup

---

## 🧪 Testes

```bash
# Executar testes
php artisan test

# Com coverage
php artisan test --coverage
```

---

## 📊 Analytics

Integrar:
- Google Analytics
- Google Search Console
- Hotjar (para heatmaps)

---

## 🌍 Internacionalização

Suportar múltiplas linguagens:
- Português (pt-BR)
- Inglês (en)
- Espanhol (es)

---

## 📝 Próximos Passos

1. **Implementar Dashboard do Cliente**
   - Lista de reservas
   - Cancelamento de reservas
   - Edição de perfil

2. **Implementar Dashboard Administrativo**
   - Métricas e relatórios
   - Gerenciamento de quartos
   - Gerenciamento de preços

3. **Integrar Sistema de Pagamento**
   - Adicionar Stripe/PayPal
   - Recebimento seguro

4. **Aperfeiçoar UX/UI**
   - Adicionar animações
   - Melhorar responsividade

5. **Testes Automatizados**
   - Testes unitários
   - Testes de integração

6. **Deploy**
   - Configurar servidor
   - Setup SSL
   - Backups automáticos

---

## 🐛 Troubleshooting

### Problema: CSS não carregando
- Execute: `npm run build`
- Limpe o cache: `php artisan cache:clear`

### Problema: Banco de dados não conecta
- Verifique `.env`
- Execute: `php artisan migrate:fresh`

### Problema: Rotas não encontradas
- Execute: `php artisan route:clear`
- Execute: `php artisan cache:clear`

---

## 📚 Recursos Úteis

- [Laravel Documentation](https://laravel.com/docs)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Blade Templating](https://laravel.com/docs/blade)
- [Eloquent ORM](https://laravel.com/docs/eloquent)

---

## 👨‍💻 Autor

Desenvolvido com ❤️ para Calm Mind Resort & Spa

---

## 📄 Licença

Este projeto é licenciado sob MIT License.
