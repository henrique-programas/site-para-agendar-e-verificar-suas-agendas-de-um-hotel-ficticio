<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();

            // Identificação
            $table->string('number', 10)->unique()->comment('Número/código do quarto, ex: 101, 302');
            $table->string('name');                                        // "Suite Premium"
            $table->enum('type', ['deluxe', 'premium', 'presidencial']);

            // Precificação
            $table->decimal('price_per_night', 8, 2);

            // Status operacional
            $table->enum('status', ['disponivel', 'ocupado', 'manutencao'])->default('disponivel');

            // Detalhes
            $table->unsignedTinyInteger('capacity')->default(2);           // nº de hóspedes
            $table->text('description')->nullable();
            $table->json('amenities')->nullable();                          // ["King","WiFi","Banheira"]
            $table->string('image_url')->nullable();

            $table->timestamps();
            $table->softDeletes();                                         // permite "remover" sem apagar do BD
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
