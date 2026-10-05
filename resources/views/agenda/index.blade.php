@extends('layouts.app')

@section('title', 'Daftar Agenda Pimpinan - SIMAPIM')
@section('page-title', 'Daftar Agenda')

@section('content')
  <!-- Page Header -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-slate-900">Daftar Agenda Pimpinan</h1>
      <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Kelola, saring, dan pantau seluruh jadwal kegiatan kedinasan.</p>
    </div>
    <a href="{{ route('agenda.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-500 text-white text-xs font-bold shadow-lg shadow-brand-600/25 transition transform active:scale-95 shrink-0 self-start sm:self-auto">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
      <span>Tambah Agenda Baru</span>
    </a>
  </div>

  <!-- Filter Card -->
  <div class="p-4 sm:p-5 bg-white rounded-2xl border border-slate-200/80 shadow-xs">
    <form method="GET" action="{{ route('agenda.index') }}" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-3 items-end">
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1">Tanggal Mulai</label>
        <input type="date" name="start_date" value="{{ request('start_date') }}" class="block w-full py-2 px-3 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition shadow-xs">
      </div>
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1">Tanggal Selesai</label>
        <input type="date" name="end_date" value="{{ request('end_date') }}" class="block w-full py-2 px-3 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition shadow-xs">
      </div>
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1">Status Agenda</label>
        <select name="status" class="block w-full py-2 px-3 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition shadow-xs">
          <option value="">Semua Status</option>
          <option value="terjadwal" {{ request('status') == 'terjadwal' ? 'selected' : '' }}>Terjadwal</option>
          <option value="berlangsung" {{ request('status') == 'berlangsung' ? 'selected' : '' }}>Sedang Berlangsung</option>
          <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
          <option value="batal" {{ request('status') == 'batal' ? 'selected' : '' }}>Dibatalkan</option>
        </select>
      </div>
      <div class="flex items-center gap-2 sm:col-span-2 md:col-span-2">
        <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 py-2 px-4 rounded-xl text-xs font-semibold text-white bg-slate-900 hover:bg-slate-800 transition shadow-xs">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
          <span>Terapkan Filter</span>
        </button>
        @if(request('start_date') || request('end_date') || request('status'))
          <a href="{{ route('agenda.index') }}" class="inline-flex items-center justify-center py-2 px-3 rounded-xl text-xs font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 transition">
            Reset
          </a>
        @endif
      </div>
    </form>
  </div>

  <!-- Agenda Table Card -->
  <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
    @if($agendas->isEmpty())
      <div class="p-12 text-center">
        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-slate-100 flex items-center justify-center text-slate-400">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <h3 class="text-sm font-bold text-slate-800">Tidak Ada Agenda Ditemukan</h3>
        <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">Tidak ada kegiatan yang sesuai dengan filter pencarian Anda.</p>
        <div class="mt-4">
          <a href="{{ route('agenda.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-brand-600 text-white text-xs font-bold hover:bg-brand-700 transition">
            + Buat Agenda Baru
          </a>
        </div>
      </div>
    @else
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-slate-50/75 border-b border-slate-100 text-[11px] font-bold uppercase tracking-wider text-slate-500">
              <th class="py-3.5 px-5">Waktu Pelaksanaan</th>
              <th class="py-3.5 px-5">Judul Kegiatan & Pejabat</th>
              <th class="py-3.5 px-5">Tempat / Lokasi</th>
              <th class="py-3.5 px-5">Status</th>
              <th class="py-3.5 px-5">Petugas Ditugaskan</th>
              <th class="py-3.5 px-5">Berkas & Dokumentasi</th>
              <th class="py-3.5 px-5 text-end">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100 text-xs">
            @foreach($agendas as $agenda)
              @php
                $isToday = \Carbon\Carbon::parse($agenda->tanggal)->isToday();
                $isPast = \Carbon\Carbon::parse($agenda->tanggal)->isPast() && !$isToday;
                $statusBadge = $agenda->status_badge;
              @endphp
              <tr class="hover:bg-slate-50/60 transition">
                
                <!-- Waktu -->
                <td class="py-4 px-5 whitespace-nowrap">
                  <div class="flex items-center gap-3">
                    <div class="text-center p-2 rounded-xl border {{ $isToday ? 'bg-emerald-50 border-emerald-200 text-emerald-800 font-bold' : ($isPast ? 'bg-slate-50 border-slate-200 text-slate-500' : 'bg-brand-50 border-brand-200 text-brand-800') }} min-w-[54px]">
                      <span class="block text-[10px] uppercase font-bold">{{ \Carbon\Carbon::parse($agenda->tanggal)->isoFormat('MMM') }}</span>
                      <span class="block text-base font-extrabold leading-none mt-0.5">{{ \Carbon\Carbon::parse($agenda->tanggal)->format('d') }}</span>
                    </div>
                    <div>
                      <p class="font-bold text-slate-800">{{ $agenda->hari }}</p>
                      <p class="text-[11px] font-semibold text-brand-600 flex items-center gap-1 mt-0.5">
                        <svg class="w-3 h-3 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ $agenda->waktu_formatted }}</span>
                      </p>
                    </div>
                  </div>
                </td>

                <!-- Agenda -->
                <td class="py-4 px-5">
                  <div class="max-w-xs sm:max-w-sm">
                    <a href="{{ route('agenda.show', $agenda->id) }}" class="font-bold text-slate-900 hover:text-brand-600 transition block text-xs sm:text-sm">
                      {{ $agenda->judul_acara }}
                    </a>
                    <div class="mt-1 flex items-center gap-1.5 text-[11px] text-slate-500">
                      <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                      <span>Pejabat: <strong class="text-slate-700">{{ $agenda->pejabat ?? '-' }}</strong></span>
                    </div>
                  </div>
                </td>

                <!-- Lokasi -->
                <td class="py-4 px-5">
                  <div class="flex items-start gap-1.5 max-w-[200px] text-slate-600">
                    <svg class="w-3.5 h-3.5 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span class="text-[11px] line-clamp-2">{{ $agenda->lokasi ?? '-' }}</span>
                  </div>
                </td>

                <!-- Status -->
                <td class="py-4 px-5 whitespace-nowrap">
                  <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold border {{ $statusBadge['class'] }}">
                    <span class="w-1.5 h-1.5 rounded-full {{ $statusBadge['dot'] }}"></span>
                    {{ $statusBadge['label'] }}
                  </span>
                </td>

                <!-- Petugas -->
                <td class="py-4 px-5">
                  <div class="flex flex-wrap gap-1 max-w-[180px]">
                    @forelse($agenda->petugas as $p)
                      <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-slate-100 text-slate-700 text-[10px] font-medium border border-slate-200/60">
                        <span class="w-1.5 h-1.5 rounded-full bg-brand-500"></span>
                        {{ $p->firstname }}
                      </span>
                    @empty
                      <span class="text-slate-400 text-[11px] italic">Belum ada</span>
                    @endforelse
                  </div>
                </td>

                <!-- Dokumen -->
                <td class="py-4 px-5 whitespace-nowrap">
                  <div class="flex items-center gap-2">
                    @if($agenda->file_sambutan)
                      <a href="{{ asset('storage/sambutan/' . $agenda->file_sambutan) }}" target="_blank" class="p-1.5 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 border border-rose-200/60 transition" title="Unduh Berkas Sambutan (PDF)">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                      </a>
                    @endif
                    @if($agenda->link)
                      <a href="{{ $agenda->link }}" target="_blank" class="p-1.5 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 border border-emerald-200/60 transition" title="Buka Dokumentasi (Google Drive)">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                      </a>
                    @endif
                    @if(!$agenda->file_sambutan && !$agenda->link)
                      <span class="text-slate-400 text-[11px]">-</span>
                    @endif
                  </div>
                </td>

                <!-- Aksi -->
                <td class="py-4 px-5 text-end whitespace-nowrap">
                  <div class="inline-flex items-center gap-1.5">
                    <a href="{{ route('agenda.show', $agenda->id) }}" class="p-2 rounded-xl bg-slate-100 hover:bg-brand-50 hover:text-brand-600 text-slate-600 transition" title="Detail Agenda">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </a>
                    <a href="{{ route('agenda.edit', $agenda->id) }}" class="p-2 rounded-xl bg-slate-100 hover:bg-amber-50 hover:text-amber-600 text-slate-600 transition" title="Edit Agenda">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </a>
                    <form id="delete-agenda-{{ $agenda->id }}" action="{{ route('agenda.destroy', $agenda->id) }}" method="POST" class="inline">
                      @csrf
                      @method('DELETE')
                      <button type="button" onclick="confirmDelete(event, 'delete-agenda-{{ $agenda->id }}', '{{ addslashes($agenda->judul_acara) }}')" class="p-2 rounded-xl bg-slate-100 hover:bg-rose-50 hover:text-rose-600 text-slate-600 transition" title="Hapus Agenda">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                      </button>
                    </form>
                  </div>
                </td>

              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
@endsection
