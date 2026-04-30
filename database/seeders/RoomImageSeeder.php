<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomImageSeeder extends Seeder
{
    public function run(): void
    {
        $imagesByType = [
            'deluxe' => [
                'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=1400&q=80&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1540518614846-7eded433c457?w=1400&q=80&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=1400&q=80&auto=format&fit=crop',
            ],
            'premium' => [
                'https://images.unsplash.com/photo-1519710164239-da123dc03ef4?w=1400&q=80&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1540518614846-7eded433c457?w=1400&q=80&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=1400&q=80&auto=format&fit=crop',
            ],
            'presidencial' => [
                'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=1400&q=80&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1445019980597-93fa8acb246c?w=1400&q=80&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=1400&q=80&auto=format&fit=crop',
            ],
        ];

        $counters = ['deluxe' => 0, 'premium' => 0, 'presidencial' => 0];

        Room::query()->orderBy('id')->chunk(200, function ($rooms) use (&$counters, $imagesByType) {
            foreach ($rooms as $room) {
                $type = $room->type;
                if (!isset($imagesByType[$type])) {
                    continue;
                }

                $idx = $counters[$type] % count($imagesByType[$type]);
                $counters[$type]++;

                $room->update([
                    'image_url' => $imagesByType[$type][$idx],
                ]);
            }
        });
    }
}

