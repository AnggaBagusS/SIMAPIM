@extends('layouts.app')

@section('title', 'Dashboard Administrator - SIMAPIM')
@section('page-title', 'Dashboard Admin')

@section('content')
  <!-- Welcome Hero Banner -->
  <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 p-6 sm:p-8 text-white shadow-xl shadow-slate-900/10 border border-slate-800">
    <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full bg-brand-500/10 blur-3xl pointer-events-none"></div>
    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
      <div class="space-y-2">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-500/20 text-brand-300 text-xs font-semibold border border-brand-400/20">
          <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
          Portal Eksekutif SIMAPIM
        </div>
        <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
          Selamat Datang, {{ Auth::user()->firstname }}! 👋
        </h1>
        <p class="text-xs sm:text-sm text-slate-300 max-w-2xl leading-relaxed">
          Kelola dan pantau seluruh agenda pimpinan daerah, koordinasi petugas lapangan, serta status kesiapan berkas kegiatan secara tersinkronisasi.
        </p>
      </div>
      <div class="flex items-center gap-3 shrink-0">
        <a href="{{ route('agenda.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-500 text-white text-xs font-bold shadow-lg shadow-brand-600/30 transition transform active:scale-95">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
          </svg>
          <span>Tambah Agenda</span>
        </a>
        <a href="{{ route('agenda.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/15 text-white text-xs font-semibold border border-white/10 backdrop-blur-sm transition">
          <span>Semua Agenda</span>
        </a>
      </div>
    </div>
  </div>

  <!-- Metric Stat Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
    
    <!-- Total Agenda -->
    <div class="p-5 bg-white rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md transition group">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Agenda</p>
          <h3 class="text-2xl font-extrabold text-slate-900 mt-1">{{ $totalAgenda }}</h3>
        </div>
        <div class="w-12 h-12 rounded-2xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-brand-600 group-hover:scale-110 transition">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
          </svg>
        </div>
      </div>
      <div class="mt-3 flex items-center gap-1.5 text-[11px] text-slate-500">
        <span class="text-emerald-600 font-semibold flex items-center">
          <svg class="w-3.5 h-3.5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
          Terdaftar
        </span>
        <span>dalam database kegiatan</span>
      </div>
    </div>

    <!-- Total Petugas -->
    <div class="p-5 bg-white rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md transition group">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Petugas Aktif</p>
          <h3 class="text-2xl font-extrabold text-slate-900 mt-1">{{ $totalPetugas }}</h3>
        </div>
        <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 group-hover:scale-110 transition">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
          </svg>
        </div>
      </div>
      <div class="mt-3 flex items-center gap-1.5 text-[11px] text-slate-500">
        <span class="text-emerald-600 font-semibold">Staf Siap Disposisi</span>
        <span>di lapangan</span>
      </div>
    </div>

    <!-- Agenda Terjadwal -->
    <div class="p-5 bg-white rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md transition group">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Agenda Terdekat</p>
          <h3 class="text-2xl font-extrabold text-slate-900 mt-1">{{ $agendas->count() }}</h3>
        </div>
        <div class="w-12 h-12 rounded-2xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600 group-hover:scale-110 transition">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
      </div>
      <div class="mt-3 flex items-center gap-1.5 text-[11px] text-slate-500">
        <span class="text-amber-600 font-semibold">5 Kegiatan</span>
        <span>dalam urutan tanggal</span>
      </div>
    </div>

    <!-- Status Server & Layanan -->
    <div class="p-5 bg-white rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md transition group">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Status SIMAPIM</p>
          <div class="flex items-center gap-2 mt-1">
            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
            <span class="text-base font-extrabold text-slate-900">Operasional</span>
          </div>
        </div>
        <div class="w-12 h-12 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-600 group-hover:scale-110 transition">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
          </svg>
        </div>
      </div>
      <div class="mt-3 text-[11px] text-slate-400">
        Database & auth terhubung stabil
      </div>
    </div>

  </div>

  <!-- Agenda Terdekat Table Card -->
  <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
    <div class="p-5 sm:p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
      <div>
        <h2 class="text-base sm:text-lg font-bold text-slate-900">Jadwal Agenda Pimpinan Terdekat</h2>
        <p class="text-xs text-slate-500 mt-0.5">Daftar kegiatan yang akan berlangsung dalam waktu dekat.</p>
      </div>
      <a href="{{ route('agenda.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-brand-600 hover:text-brand-700 transition">
        <span>Lihat Seluruh Agenda</span>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
      </a>
    </div>

    @if($agendas->isEmpty())
      <div class="p-12 text-center">
        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-slate-100 flex items-center justify-center text-slate-400">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
          </svg>
        </div>
        <h3 class="text-sm font-bold text-slate-800">Belum Ada Agenda Terjadwal</h3>
        <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">Mulai tambahkan kegiatan dinas pertama untuk ditugaskan kepada staf pendamping.</p>
        <div class="mt-4">
          <a href="{{ route('agenda.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-brand-600 text-white text-xs font-bold hover:bg-brand-700 transition">
            + Tambah Agenda
          </a>
        </div>
      </div>
    @else
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-slate-50/75 border-b border-slate-100 text-[11px] font-bold uppercase tracking-wider text-slate-500">
              <th class="py-3.5 px-5">Waktu & Tanggal</th>
              <th class="py-3.5 px-5">Agenda & Pejabat</th>
              <th class="py-3.5 px-5">Lokasi</th>
              <th class="py-3.5 px-5">Status</th>
              <th class="py-3.5 px-5">Petugas Bertugas</th>
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
                
                <!-- Waktu & Tanggal -->
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

                <!-- Agenda & Pejabat -->
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

                <!-- Berkas / Link -->
                <td class="py-4 px-5 whitespace-nowrap">
                  <div class="flex items-center gap-2">
                    @if($agenda->file_sambutan)
                      <a href="{{ asset('storage/sambutan/' . $agenda->file_sambutan) }}" target="_blank" class="p-1.5 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 border border-rose-200/60 transition" title="Unduh File Sambutan (PDF)">
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

  <!-- Recent Activities / Audit Trail Feed -->
  <div class="mt-6 bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
    <div class="p-5 sm:p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
      <div>
        <h2 class="text-base sm:text-lg font-bold text-slate-900 flex items-center gap-2">
          <svg class="w-5 h-5 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          <span>Riwayat Aktivitas Terkini (Audit Trail)</span>
        </h2>
        <p class="text-xs text-slate-500 mt-0.5">Pantau perubahan data agenda dan aksi pengguna secara transparan.</p>
      </div>
      <a href="{{ route('activity-log.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-brand-600 hover:text-brand-700 transition">
        <span>Buka Seluruh Log Aktivitas</span>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
      </a>
    </div>

    @if(isset($recentActivities) && $recentActivities->isNotEmpty())
      <div class="divide-y divide-slate-100">
        @foreach($recentActivities as $log)
          @php
            $badgeColor = match($log->event) {
                'created' => 'bg-emerald-50 text-emerald-700 border-emerald-200/80',
                'updated' => 'bg-amber-50 text-amber-700 border-amber-200/80',
                'deleted' => 'bg-rose-50 text-rose-700 border-rose-200/80',
                default   => 'bg-slate-100 text-slate-700 border-slate-200',
            };
          @endphp
          <div class="p-4 sm:px-6 hover:bg-slate-50/60 transition flex items-center justify-between gap-4 text-xs">
            <div class="flex items-center gap-3 min-w-0">
              <div class="w-8 h-8 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center font-bold text-slate-700 shrink-0">
                {{ strtoupper(substr($log->causer->firstname ?? 'S', 0, 1)) }}
              </div>
              <div class="min-w-0">
                <p class="font-bold text-slate-800 truncate">
                  {{ $log->causer ? ($log->causer->firstname . ' ' . $log->causer->lastname) : 'Sistem' }}
                  <span class="font-normal text-slate-500">— {{ $log->description }}</span>
                </p>
                <p class="text-[10px] text-slate-400 mt-0.5">Modul: {{ ucfirst($log->log_name) }} #{{ $log->subject_id ?? '-' }} &bull; {{ $log->created_at->diffForHumans() }}</p>
              </div>
            </div>
            <div class="shrink-0 flex items-center gap-2">
              @if($log->event)
                <span class="inline-block px-2 py-0.5 rounded-md text-[10px] font-bold uppercase border {{ $badgeColor }}">
                  {{ $log->event }}
                </span>
              @endif
              <span class="text-[11px] text-slate-400 hidden sm:inline">{{ $log->created_at->format('H:i') }} WIB</span>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="p-8 text-center text-xs text-slate-400">
        Belum ada aktivitas yang tercatat dalam sistem.
      </div>
    @endif
  </div>
@endsection
