<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\User;
use App\Http\Resources\AgendaResource;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Dapatkan ringkasan dashboard, statistik, dan agenda terdekat.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $today = Carbon::today();

        $totalAgenda = Agenda::count();
        $totalPetugas = User::where('type', 2)->count();
        $totalTugasSaya = $user->agendas()->count();

        // Agenda hari ini
        $agendasToday = Agenda::with('petugas')
            ->whereDate('tanggal', $today)
            ->orderBy('jam_mulai', 'asc')
            ->get();

        // 5 Agenda mendatang
        $upcomingAgendas = Agenda::with('petugas')
            ->whereDate('tanggal', '>=', $today)
            ->orderBy('tanggal', 'asc')
            ->orderBy('jam_mulai', 'asc')
            ->take(5)
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data statistik dashboard berhasil dimuat.',
            'data'    => [
                'statistics' => [
                    'total_agenda'      => $totalAgenda,
                    'total_petugas'     => $totalPetugas,
                    'total_tugas_saya'  => $totalTugasSaya,
                    'total_hari_ini'    => $agendasToday->count(),
                ],
                'agendas_today'     => AgendaResource::collection($agendasToday),
                'upcoming_agendas'  => AgendaResource::collection($upcomingAgendas),
            ],
        ]);
    }
}
