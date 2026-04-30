<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 20)->nullable();
            $table->char('cpf', 11)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('gender', 1)->nullable();

            $table->string('address_street', 120)->nullable();
            $table->string('address_number', 15)->nullable();
            $table->string('address_complement', 80)->nullable();
            $table->string('address_neighborhood', 80)->nullable();
            $table->string('address_city', 80)->nullable();
            $table->char('address_state', 2)->nullable();
            $table->char('cep', 8)->nullable();

            $table->unique('cpf');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['cpf']);
            $table->dropColumn([
                'phone',
                'cpf',
                'birth_date',
                'gender',
                'address_street',
                'address_number',
                'address_complement',
                'address_neighborhood',
                'address_city',
                'address_state',
                'cep',
            ]);
        });
    }
};
