<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Http\Resources\AgendaResource;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AgendaController extends Controller
{
    /**
     * Dapatkan daftar seluruh agenda dengan filter tanggal, status, dan kata kunci pencarian.
     */
    public function index(Request $request)
    {
        $query = Agenda::with('petugas');

        // Filter rentang tanggal
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $start = Carbon::parse($request->start_date)->startOfDay();
            $end = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('tanggal', [$start, $end]);
        } elseif ($request->filled('start_date')) {
            $query->where('tanggal', '>=', Carbon::parse($request->start_date)->startOfDay());
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Pencarian judul acara, lokasi, atau pejabat
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul_acara', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%")
                  ->orWhere('pejabat', 'like', "%{$search}%");
            });
        }

        $query->orderBy('tanggal', 'desc');

        if ($request->boolean('all')) {
            $agendas = $query->get();
            return response()->json([
                'success' => true,
                'message' => 'Data agenda berhasil dimuat.',
                'data'    => AgendaResource::collection($agendas),
            ]);
        }

        $perPage = (int) $request->input('per_page', 10);
        $paginated = $query->paginate($perPage);

        return AgendaResource::collection($paginated)->additional([
            'success' => true,
            'message' => 'Data agenda berhasil dimuat.',
        ]);
    }

    /**
     * Dapatkan daftar agenda yang khusus ditugaskan kepada pengguna yang sedang login (Staff/Petugas).
     */
    public function myAgendas(Request $request)
    {
        $user = $request->user();

        $query = $user->agendas()->with('petugas')->orderBy('tanggal', 'desc');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->boolean('all')) {
            $agendas = $query->get();
            return response()->json([
                'success' => true,
                'message' => 'Daftar tugas dinas berhasil dimuat.',
                'data'    => AgendaResource::collection($agendas),
            ]);
        }

        $perPage = (int) $request->input('per_page', 10);
        $paginated = $query->paginate($perPage);

        return AgendaResource::collection($paginated)->additional([
            'success' => true,
            'message' => 'Daftar tugas dinas berhasil dimuat.',
        ]);
    }

    /**
     * Dapatkan detail rincian satu agenda.
     */
    public function show($id)
    {
        $agenda = Agenda::with('petugas')->find($id);

        if (!$agenda) {
            return response()->json([
                'success' => false,
                'message' => 'Agenda tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail agenda berhasil dimuat.',
            'data'    => new AgendaResource($agenda),
        ]);
    }

    /**
     * Simpan agenda baru (Khusus Admin).
     */
    public function store(Request $request)
    {
        if ($request->user()->type != 1) {
            return response()->json(['success' => false, 'message' => 'Akses ditolak. Hanya Administrator yang dapat menambah agenda.'], 403);
        }

        $validated = $request->validate([
            'judul_acara'   => 'required|string|max:255',
            'tanggal'       => 'required|date',
            'hari'          => 'nullable|string|max:50',
            'jam_mulai'     => 'nullable',
            'jam_selesai'   => 'nullable',
            'status'        => 'required|in:terjadwal,berlangsung,selesai,batal',
            'lokasi'        => 'nullable|string',
            'pejabat'       => 'nullable|string|max:255',
            'link'          => 'nullable|url|max:1000',
            'file_sambutan' => 'nullable|file|mimes:pdf|max:2048',
            'user_ids'      => 'required|array|min:1',
            'user_ids.*'    => 'exists:users,id',
        ]);

        $filename = null;
        if ($request->hasFile('file_sambutan')) {
            $path = $request->file('file_sambutan')->store('sambutan', 'public');
            $filename = basename($path);
        }

        $agenda = Agenda::create([
            'judul_acara'   => $validated['judul_acara'],
            'tanggal'       => $validated['tanggal'],
            'hari'          => $validated['hari'] ?? null,
            'jam_mulai'     => $validated['jam_mulai'] ?? null,
            'jam_selesai'   => $validated['jam_selesai'] ?? null,
            'status'        => $validated['status'] ?? 'terjadwal',
            'lokasi'        => $validated['lokasi'] ?? null,
            'pejabat'       => $validated['pejabat'] ?? null,
            'link'          => $validated['link'] ?? null,
            'file_sambutan' => $filename,
            'user_ids'      => implode(',', $validated['user_ids']),
        ]);

        $agenda->petugas()->sync($validated['user_ids']);
        $agenda->load('petugas');

        return response()->json([
            'success' => true,
            'message' => 'Agenda berhasil dibuat.',
            'data'    => new AgendaResource($agenda),
        ], 201);
    }

    /**
     * Perbarui agenda (Khusus Admin).
     */
    public function update(Request $request, $id)
    {
        if ($request->user()->type != 1) {
            return response()->json(['success' => false, 'message' => 'Akses ditolak. Hanya Administrator yang dapat mengubah agenda.'], 403);
        }

        $agenda = Agenda::find($id);
        if (!$agenda) {
            return response()->json(['success' => false, 'message' => 'Agenda tidak ditemukan.'], 404);
        }

        $validated = $request->validate([
            'judul_acara'   => 'required|string|max:255',
            'tanggal'       => 'required|date',
            'hari'          => 'nullable|string|max:50',
            'jam_mulai'     => 'nullable',
            'jam_selesai'   => 'nullable',
            'status'        => 'required|in:terjadwal,berlangsung,selesai,batal',
            'lokasi'        => 'nullable|string',
            'pejabat'       => 'nullable|string|max:255',
            'link'          => 'nullable|url|max:1000',
            'file_sambutan' => 'nullable|file|mimes:pdf|max:2048',
            'user_ids'      => 'required|array|min:1',
            'user_ids.*'    => 'exists:users,id',
        ]);

        $agenda->judul_acara = $validated['judul_acara'];
        $agenda->tanggal     = $validated['tanggal'];
        $agenda->hari        = $validated['hari'] ?? $agenda->hari;
        $agenda->jam_mulai   = $validated['jam_mulai'] ?? null;
        $agenda->jam_selesai = $validated['jam_selesai'] ?? null;
        $agenda->status      = $validated['status'];
        $agenda->lokasi      = $validated['lokasi'] ?? null;
        $agenda->pejabat     = $validated['pejabat'] ?? null;
        $agenda->link        = $validated['link'] ?? null;
        $agenda->user_ids    = implode(',', $validated['user_ids']);

        if ($request->hasFile('file_sambutan')) {
            if ($agenda->file_sambutan && Storage::disk('public')->exists('sambutan/' . $agenda->file_sambutan)) {
                Storage::disk('public')->delete('sambutan/' . $agenda->file_sambutan);
            }

            $path = $request->file('file_sambutan')->store('sambutan', 'public');
            $agenda->file_sambutan = basename($path);
        }

        $agenda->save();
        $agenda->petugas()->sync($validated['user_ids']);
        $agenda->load('petugas');

        return response()->json([
            'success' => true,
            'message' => 'Agenda berhasil diperbarui.',
            'data'    => new AgendaResource($agenda),
        ]);
    }

    /**
     * Perbarui tautan Google Drive dokumentasi (Bisa oleh Petugas Terkait / Admin).
     */
    public function updateLinkDokumentasi(Request $request, $id)
    {
        $agenda = Agenda::find($id);
        if (!$agenda) {
            return response()->json(['success' => false, 'message' => 'Agenda tidak ditemukan.'], 404);
        }

        $request->validate([
            'link' => 'nullable|url|max:1000',
        ], [
            'link.url' => 'Format tautan Google Drive harus berupa URL yang valid (diawali https://).',
        ]);

        $oldLink = $agenda->link;
        $agenda->link = $request->link;
        $agenda->save();

        \activity('agenda')
            ->performedOn($agenda)
            ->causedBy($request->user())
            ->withProperties(['old_link' => $oldLink, 'new_link' => $request->link])
            ->log('Memperbarui tautan Google Drive via Mobile API');

        return response()->json([
            'success' => true,
            'message' => 'Link Google Drive dokumentasi berhasil disimpan.',
            'data'    => new AgendaResource($agenda->load('petugas')),
        ]);
    }

    /**
     * Hapus agenda (Khusus Admin).
     */
    public function destroy(Request $request, $id)
    {
        if ($request->user()->type != 1) {
            return response()->json(['success' => false, 'message' => 'Akses ditolak. Hanya Administrator yang dapat menghapus agenda.'], 403);
        }

        $agenda = Agenda::find($id);
        if (!$agenda) {
            return response()->json(['success' => false, 'message' => 'Agenda tidak ditemukan.'], 404);
        }

        if ($agenda->file_sambutan && Storage::disk('public')->exists('sambutan/' . $agenda->file_sambutan)) {
            Storage::disk('public')->delete('sambutan/' . $agenda->file_sambutan);
        }

        $agenda->petugas()->detach();
        $agenda->delete();

        return response()->json([
            'success' => true,
            'message' => 'Agenda berhasil dihapus.',
        ]);
    }
}
