<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Agenda;
use App\Models\User;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Eager load relasi petugas via pivot table
        $agendas = Agenda::with('petugas')->orderBy('tanggal', 'asc')->take(5)->get();

        $totalAgenda = Agenda::count();
        $totalPetugas = User::where('type', 2)->count();

        if ($user->type == 1) {
            // Admin: ambil juga 5 riwayat aktivitas terbaru
            $recentActivities = Activity::with(['causer', 'subject'])->latest()->take(5)->get();
            return view('DashboardAdmin', compact('agendas', 'totalAgenda', 'totalPetugas', 'recentActivities'));
        } else if ($user->type == 2) {
            // Staff: hitung juga berapa agenda yang ditugaskan ke staf ini
            $totalTugasSaya = $user->agendas()->count();
            return view('DashboardStaff', compact('agendas', 'totalAgenda', 'totalTugasSaya'));
        }
    }
}
