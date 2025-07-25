<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        $query = Agenda::query();

        // Filter berdasarkan tanggal jika tersedia
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $start = Carbon::parse($request->start_date)->startOfDay();
            $end = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('tanggal', [$start, $end]);
        }

        $agendas = $query->orderBy('tanggal', 'desc')->get();

        // Ambil petugas untuk tiap agenda dari field user_ids (CSV)
        foreach ($agendas as $agenda) {
            $userIds = explode(',', $agenda->user_ids);
            $agenda->petugas = User::whereIn('id', $userIds)->get();
        }

        return view('agenda.index', compact('agendas'));
    }

    public function show($id)
    {
        $agenda = Agenda::findOrFail($id);
        $agenda->petugas = User::whereIn('id', explode(',', $agenda->user_ids))->get();
        return view('agenda.show', compact('agenda'));
    }

    public function showStaff($id)
    {
        $agenda = Agenda::findOrFail($id);
        $agenda->petugas = User::whereIn('id', explode(',', $agenda->user_ids))->get();
        return view('agenda.showStaff', compact('agenda'));
    }

    public function create()
    {
        $users = User::where('type', 2)->get(); // type 2 = staff
        return view('agenda.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_acara'   => 'required|string|max:255',
            'tanggal'       => 'required|date',
            'hari'          => 'nullable|string|max:20',
            'lokasi'        => 'nullable|string',
            'pejabat'       => 'nullable|string',
            'link'          => 'nullable|url',
            'file_sambutan' => 'nullable|mimes:pdf|max:2048',
            'user_ids'      => 'required|array',
            'user_ids.*'    => 'exists:users,id',
        ]);

        $filename = null;
        if ($request->hasFile('file_sambutan')) {
            $file = $request->file('file_sambutan');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/sambutan'), $filename);
        }

        Agenda::create([
            'judul_acara'   => $request->judul_acara,
            'tanggal'       => $request->tanggal,
            'hari'          => $request->hari,
            'lokasi'        => $request->lokasi,
            'pejabat'       => $request->pejabat,
            'link'          => $request->link,
            'file_sambutan' => $filename,
            'user_ids'      => implode(',', $request->user_ids),
        ]);

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $agenda = Agenda::findOrFail($id);
        $agenda->user_ids = explode(',', $agenda->user_ids); // untuk pre-check checkbox
        $users = User::where('type', 2)->get();
        return view('agenda.edit', compact('agenda', 'users'));
    }

    public function update(Request $request, $id)
    {
        $agenda = Agenda::findOrFail($id);

        $request->validate([
            'judul_acara'   => 'required|string|max:255',
            'tanggal'       => 'required|date',
            'hari'          => 'nullable|string|max:20',
            'lokasi'        => 'nullable|string',
            'pejabat'       => 'nullable|string',
            'link'          => 'nullable|url',
            'file_sambutan' => 'nullable|mimes:pdf|max:2048',
            'user_ids'      => 'required|array',
            'user_ids.*'    => 'exists:users,id',
        ]);

        $agenda->judul_acara = $request->judul_acara;
        $agenda->tanggal     = $request->tanggal;
        $agenda->hari        = $request->hari;
        $agenda->lokasi      = $request->lokasi;
        $agenda->pejabat     = $request->pejabat;
        $agenda->link        = $request->link;
        $agenda->user_ids    = implode(',', $request->user_ids);

        if ($request->hasFile('file_sambutan')) {
            // Hapus file lama
            if ($agenda->file_sambutan && file_exists(public_path('storage/sambutan/' . $agenda->file_sambutan))) {
                unlink(public_path('storage/sambutan/' . $agenda->file_sambutan));
            }

            // Simpan file baru
            $file = $request->file('file_sambutan');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/sambutan'), $filename);
            $agenda->file_sambutan = $filename;
        }

        $agenda->save();

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil diupdate!');
    }

    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);

        if ($agenda->file_sambutan) {
            Storage::disk('public')->delete('sambutan/' . $agenda->file_sambutan);
        }

        $agenda->delete();

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil dihapus.');
    }
}
