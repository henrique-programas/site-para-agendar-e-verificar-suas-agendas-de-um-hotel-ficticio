<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            // Relacionamentos
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('room_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Período
            $table->date('check_in');
            $table->date('check_out');
            $table->unsignedTinyInteger('guests')->default(1);

            // Valores (calculados na criação, imutáveis após)
            $table->decimal('price_per_night', 8, 2);
            $table->decimal('total_price', 10, 2);

            // Status do fluxo
            $table->enum('status', ['pendente', 'confirmado', 'andamento', 'concluido', 'cancelado'])
                  ->default('pendente');

            // Extras
            $table->text('notes')->nullable();                             // observações do hóspede
            $table->text('admin_notes')->nullable();                       // observações internas (admin)
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
