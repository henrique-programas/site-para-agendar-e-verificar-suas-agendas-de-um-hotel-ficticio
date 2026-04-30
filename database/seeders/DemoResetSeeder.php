<?php

namespace Database\Seeders;

use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DemoResetSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            // 1) Libera todos os quartos ocupados (mantém "manutencao")
            Room::query()
                ->where('status', 'ocupado')
                ->update(['status' => 'disponivel']);

            // 2) Para demo: cancela qualquer reserva que ainda "prende" fluxo
            Reservation::query()
                ->whereIn('status', ['pendente', 'confirmado', 'andamento'])
                ->update([
                    'status'       => 'cancelado',
                    'cancelled_at' => now(),
                    'checked_in_at' => null,
                    'checked_out_at' => null,
                ]);

            // 3) Garante que quartos com reservas canceladas não fiquem presos como "ocupado"
            Room::query()
                ->where('status', '!=', 'manutencao')
                ->update(['status' => 'disponivel']);

            // 4) Cria reservas de exemplo para o usuário de teste
            /** @var User|null $user */
            $user = User::query()->where('email', 'test@example.com')->first() ?? User::query()->first();
            if (!$user) {
                return;
            }

            $rooms = Room::query()
                ->where('status', '!=', 'manutencao')
                ->orderBy('id')
                ->take(3)
                ->get();

            if ($rooms->count() < 3) {
                return;
            }

            $today = Carbon::today();

            // A) Pendente (a pagar)
            $this->makeReservation($user->id, $rooms[0], $today->copy()->addDays(10), $today->copy()->addDays(12), 'pendente');

            // B) Paga/confirmada
            $this->makeReservation($user->id, $rooms[1], $today->copy()->addDays(15), $today->copy()->addDays(18), 'confirmado');

            // C) Finalizada (concluída)
            $res = $this->makeReservation($user->id, $rooms[2], $today->copy()->subDays(5), $today->copy()->subDays(2), 'concluido');
            if ($res) {
                $res->update([
                    'checked_in_at'  => $today->copy()->subDays(5)->setTime(15, 0),
                    'checked_out_at' => $today->copy()->subDays(2)->setTime(12, 0),
                ]);
            }
        });
    }

    private function makeReservation(int $userId, Room $room, Carbon $checkIn, Carbon $checkOut, string $status): ?Reservation
    {
        $nights = max(1, $checkIn->diffInDays($checkOut));

        return Reservation::create([
            'user_id'         => $userId,
            'room_id'         => $room->id,
            'check_in'        => $checkIn->toDateString(),
            'check_out'       => $checkOut->toDateString(),
            'guests'          => min(2, (int) $room->capacity),
            'price_per_night' => $room->price_per_night,
            'total_price'     => $room->price_per_night * $nights,
            'status'          => $status,
            'confirmed_at'    => $status !== 'pendente' ? now() : null,
            'cancelled_at'    => null,
            'notes'           => 'Reserva de demonstração.',
        ]);
    }
}

