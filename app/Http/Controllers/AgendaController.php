<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\User;
use App\Http\Requests\StoreAgendaRequest;
use App\Http\Requests\UpdateAgendaRequest;
use App\Http\Requests\UpdateLinkDokumentasiRequest;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        // Gunakan Eager Loading 'petugas' untuk mengeliminasi query N+1
        $query = Agenda::with('petugas');

        // Filter berdasarkan tanggal jika tersedia
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $start = Carbon::parse($request->start_date)->startOfDay();
            $end = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('tanggal', [$start, $end]);
        }

        // Filter berdasarkan status jika tersedia
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $agendas = $query->orderBy('tanggal', 'desc')->get();

        return view('agenda.index', compact('agendas'));
    }

    public function show($id)
    {
        $agenda = Agenda::with('petugas')->findOrFail($id);
        return view('agenda.show', compact('agenda'));
    }

    public function showStaff($id)
    {
        $agenda = Agenda::with('petugas')->findOrFail($id);
        return view('agenda.showStaff', compact('agenda'));
    }

    public function updateLinkDokumentasi(UpdateLinkDokumentasiRequest $request, $id)
    {
        $agenda = Agenda::findOrFail($id);
        $oldLink = $agenda->link;
        $agenda->link = $request->link;
        $agenda->save();

        // Audit Trail manual untuk log perubahan link dokumentasi
        \activity('agenda')
            ->performedOn($agenda)
            ->causedBy(auth()->user())
            ->withProperties(['old_link' => $oldLink, 'new_link' => $request->link])
            ->log('Memperbarui tautan Google Drive dokumentasi kegiatan');

        return redirect()->back()->with('success', 'Link Google Drive dokumentasi kegiatan berhasil disimpan.');
    }

    public function create()
    {
        $users = User::where('type', 2)->get(); // type 2 = staff / petugas
        return view('agenda.create', compact('users'));
    }

    public function store(StoreAgendaRequest $request)
    {
        $filename = null;
        if ($request->hasFile('file_sambutan')) {
            // Standarisasi Laravel Storage API
            $path = $request->file('file_sambutan')->store('sambutan', 'public');
            $filename = basename($path);
        }

        $agenda = Agenda::create([
            'judul_acara'   => $request->judul_acara,
            'tanggal'       => $request->tanggal,
            'hari'          => $request->hari,
            'jam_mulai'     => $request->jam_mulai,
            'jam_selesai'   => $request->jam_selesai,
            'status'        => $request->status ?? 'terjadwal',
            'lokasi'        => $request->lokasi,
            'pejabat'       => $request->pejabat,
            'link'          => $request->link,
            'file_sambutan' => $filename,
            'user_ids'      => implode(',', $request->user_ids),
        ]);

        // Simpan relasi petugas ke tabel pivot agenda_user
        $agenda->petugas()->sync($request->user_ids);

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $agenda = Agenda::with('petugas')->findOrFail($id);
        $users = User::where('type', 2)->get();
        return view('agenda.edit', compact('agenda', 'users'));
    }

    public function update(UpdateAgendaRequest $request, $id)
    {
        $agenda = Agenda::findOrFail($id);

        $agenda->judul_acara = $request->judul_acara;
        $agenda->tanggal     = $request->tanggal;
        $agenda->hari        = $request->hari;
        $agenda->jam_mulai   = $request->jam_mulai;
        $agenda->jam_selesai = $request->jam_selesai;
        $agenda->status      = $request->status;
        $agenda->lokasi      = $request->lokasi;
        $agenda->pejabat     = $request->pejabat;
        $agenda->link        = $request->link;
        $agenda->user_ids    = implode(',', $request->user_ids);

        if ($request->hasFile('file_sambutan')) {
            // Hapus file lama jika ada via Laravel Storage API
            if ($agenda->file_sambutan && Storage::disk('public')->exists('sambutan/' . $agenda->file_sambutan)) {
                Storage::disk('public')->delete('sambutan/' . $agenda->file_sambutan);
            }

            // Simpan file baru via Laravel Storage API
            $path = $request->file('file_sambutan')->store('sambutan', 'public');
            $agenda->file_sambutan = basename($path);
        }

        $agenda->save();

        // Sinkronisasi relasi petugas di tabel pivot agenda_user
        $agenda->petugas()->sync($request->user_ids);

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil diupdate!');
    }

    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);

        // Hapus file sambutan via Laravel Storage API
        if ($agenda->file_sambutan && Storage::disk('public')->exists('sambutan/' . $agenda->file_sambutan)) {
            Storage::disk('public')->delete('sambutan/' . $agenda->file_sambutan);
        }

        // Hapus relasi pivot sebelum atau otomatis via cascade foreign key
        $agenda->petugas()->detach();
        $agenda->delete();

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil dihapus.');
    }
}
