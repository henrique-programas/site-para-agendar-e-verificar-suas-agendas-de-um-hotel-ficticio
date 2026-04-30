<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomTestSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            // Apaga todos os quartos (reservas associadas são removidas via FK cascade)
            Room::query()->withTrashed()->forceDelete();

            $rooms = [
                ['number' => '101', 'name' => 'Deluxe Jardim',         'type' => 'deluxe',       'price_per_night' => 520,  'status' => 'disponivel', 'capacity' => 2],
                ['number' => '102', 'name' => 'Deluxe Clássico',       'type' => 'deluxe',       'price_per_night' => 610,  'status' => 'disponivel', 'capacity' => 2],
                ['number' => '103', 'name' => 'Deluxe Família',        'type' => 'deluxe',       'price_per_night' => 740,  'status' => 'disponivel', 'capacity' => 3],

                ['number' => '201', 'name' => 'Premium Varanda',       'type' => 'premium',     'price_per_night' => 980,  'status' => 'disponivel', 'capacity' => 2],
                ['number' => '202', 'name' => 'Premium Vista Lago',    'type' => 'premium',     'price_per_night' => 1150, 'status' => 'disponivel', 'capacity' => 3],
                ['number' => '203', 'name' => 'Premium Família',       'type' => 'premium',     'price_per_night' => 1320, 'status' => 'disponivel', 'capacity' => 4],

                ['number' => '301', 'name' => 'Presidencial Sky',      'type' => 'presidencial','price_per_night' => 2200, 'status' => 'disponivel', 'capacity' => 2],
                ['number' => '302', 'name' => 'Presidencial Lounge',   'type' => 'presidencial','price_per_night' => 2650, 'status' => 'disponivel', 'capacity' => 4],
                ['number' => '303', 'name' => 'Presidencial Royal',    'type' => 'presidencial','price_per_night' => 3100, 'status' => 'manutencao', 'capacity' => 4],

                ['number' => '401', 'name' => 'Deluxe Sunset',         'type' => 'deluxe',       'price_per_night' => 690,  'status' => 'disponivel', 'capacity' => 2],
                ['number' => '402', 'name' => 'Premium Serenity',      'type' => 'premium',     'price_per_night' => 1240, 'status' => 'ocupado',    'capacity' => 2],
                ['number' => '403', 'name' => 'Deluxe Conforto',       'type' => 'deluxe',       'price_per_night' => 560,  'status' => 'disponivel', 'capacity' => 2],
            ];

            foreach ($rooms as $data) {
                $img = match ($data['type']) {
                    'deluxe' => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=1400&q=80&auto=format&fit=crop',
                    'premium' => 'https://images.unsplash.com/photo-1540518614846-7eded433c457?w=1400&q=80&auto=format&fit=crop',
                    'presidencial' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=1400&q=80&auto=format&fit=crop',
                    default => null,
                };

                Room::create([
                    ...$data,
                    'description' => 'Quarto de teste para validação do sistema de reservas.',
                    'amenities'   => ['Wi‑Fi', 'Ar-condicionado', 'Café da manhã', 'TV'],
                    'image_url'   => $img,
                ]);
            }
        });
    }
}

