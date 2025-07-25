<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Agenda;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $agendas = Agenda::orderBy('tanggal', 'asc')->take(5)->get();
        foreach ($agendas as $agenda) {
            $agenda->petugas = User::whereIn('id', explode(',', $agenda->user_ids))->get();
        }

        $totalAgenda = Agenda::count();
        $totalPetugas = User::where('type', 2)->count();

        if ($user->type == 1) {
            // Admin
            return view('DashboardAdmin', compact('agendas', 'totalAgenda', 'totalPetugas'));
        } else if ($user->type == 2) {
            // Staff
            return view('DashboardStaff', compact('agendas', 'totalAgenda'));
        }
    }
}
