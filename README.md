# Agenda de Hotel — Calm Mind Resort & Spa

Sistema web de **reservas de hotel** com área do cliente e painel administrativo. O foco é uma experiência de **demo** completa: disponibilidade por período, criação/gestão de reservas, check-in/check-out, fluxo de “pagamento” fictício e **chat** entre hóspede e empresa.

## Demo online

Acesse o site em produção (hospedagem de demonstração):

**[https://calmmind.rf.gd](https://calmmind.rf.gd)**

> Se o navegador não abrir com `https://`, use **[http://calmmind.rf.gd](http://calmmind.rf.gd)** (alguns hosts gratuitos só entregam HTTP com certificado limitado).

## Resumo (visão comum)

### Funcionalidades (Cliente)
- **Autenticação**: cadastro/login.
- **Quartos**: lista e detalhes do quarto.
- **Disponibilidade**: busca por período (check-in/check-out) e hóspedes.
- **Reserva**: criar reserva e salvar no banco (com cálculo de noites e total).
- **Minhas Reservas**: filtros por status:
  - **Pendentes**, **Pagas**, **Finalizadas**, **Canceladas** (e Todas).
- **Pagamento fictício (teste)**: botão “Pagar (teste)” para confirmar a reserva.
- **Cancelamento**: botão “Cancelar” (para pendente/confirmada antes do check-in).
- **Mensagens**: visualiza últimas mensagens no perfil e acessa o chat quando já iniciou atendimento via Contato.

### Funcionalidades (Admin)
- **Dashboard**: estatísticas e visões rápidas (reservas/quartos) + **mensagens recentes**.
- **Quartos**: CRUD.
- **Reservas**: listagem, alteração de status e remoção.
- **Check-in / Check-out**: grava timestamps reais e avança o fluxo.
- **Chat**: painel para ver conversas e responder clientes.

### UX / Alertas
- Alertas e confirmações no tema do site usando **SweetAlert2** (no lugar de `alert()` / `confirm()`).

## Resumo técnico (para dev)

### Modelagem principal
- **`rooms`**
  - `type` é **ENUM**: `deluxe`, `premium`, `presidencial`
  - `status` é **ENUM**: `disponivel`, `ocupado`, `manutencao`
  - `image_url` para imagens do quarto
- **`reservations`**
  - `check_in` / `check_out` (datas da estadia)
  - `checked_in_at` / `checked_out_at` (eventos reais com data/hora)
  - `status`: `pendente`, `confirmado`, `andamento`, `concluido`, `cancelado`
- **`chat_messages`**
  - `user_id`, `sender` (`user|admin`), `message`, `read_at`

### Disponibilidade (conflito de datas)
Disponibilidade de um quarto é calculada por sobreposição:
- há conflito quando `reserva.check_in < check_out_escolhido` **e** `reserva.check_out > check_in_escolhido`
- reservas com status `cancelado` são ignoradas

Implementação:
- `app/Models/Room.php`: `scopeAvailableBetween($checkIn, $checkOut)`
- `app/Http/Controllers/PagesController.php`: aplica filtro `availableBetween()` em `/quartos`

### Fluxo de status (reserva)
- **Criar reserva**: `pendente`
- **Pagar (teste)** (cliente): `confirmado` + `confirmed_at`
- **Check-in** (admin): `andamento` + `checked_in_at`
- **Check-out** (admin): `concluido` + `checked_out_at`
- **Cancelar** (cliente): `cancelado` + `cancelled_at`
  - ao cancelar, o quarto volta para `disponivel` (se não estiver `manutencao`)

### Chat / atendimento (cliente ↔ admin)
As URLs evitam o segmento `/chat` em **POST** por compatibilidade com firewalls de hospedagem compartilhada.

- Cliente (nomes de rota Laravel: `chat`, `chat.store`, `chat.poll`):
  - `GET /atendimento` (tela)
  - `POST /atendimento/enviar` (envia mensagem)
  - `GET /atendimento/poll` (polling JSON)
- Admin (`admin.chat.*`):
  - `GET /admin/mensagens` (lista conversas)
  - `GET /admin/mensagens/{user}` (conversa)
  - `POST /admin/mensagens/{user}/enviar` (responder)
  - `GET /admin/mensagens/{user}/poll` (polling)

**Regra de acesso**: o cliente **só abre o chat** depois de iniciar atendimento pelo **Contato** (ou seja, ter ao menos 1 mensagem `sender=user` gravada).

### Rotas importantes
- Busca de disponibilidade da Home:
  - `POST /buscar-disponibilidade` → salva parâmetros na session se não autenticado e redireciona para `/quartos` após login
- Contato:
  - `POST /contato/enviar` → salva mensagem em `chat_messages` e redireciona para **`/atendimento`**

### Seeders para demo
- **Quartos de teste (apaga e recria)**:

```bash
php artisan db:seed --class=RoomTestSeeder
```

- **Imagens (só atualiza `image_url`)**:

```bash
php artisan db:seed --class=RoomImageSeeder
```

- **Reset da demo** (libera quartos ocupados e cria 3 reservas de exemplo):

```bash
php artisan db:seed --class=DemoResetSeeder
```

## Tecnologias
- Laravel + PHP
- MySQL
- Blade + Tailwind (via Vite)
- SweetAlert2

## Melhorias futuras
- Pagamento real (Pix/cartão), webhook e conciliação
- Notificações por e-mail/WhatsApp
- “Lidas/não lidas” completas no chat (marcar `read_at` ao abrir conversa)
- Testes automatizados para regras de disponibilidade e fluxo de status