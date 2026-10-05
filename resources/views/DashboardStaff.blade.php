@extends('layouts.app')

@section('title', 'Dashboard Petugas - SIMAPIM')
@section('page-title', 'Dashboard Petugas')

@section('content')
  <!-- Welcome Hero Banner -->
  <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 p-6 sm:p-8 text-white shadow-xl shadow-slate-900/10 border border-slate-800">
    <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full bg-brand-500/10 blur-3xl pointer-events-none"></div>
    <div class="relative z-10 space-y-2">
      <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 text-xs font-semibold border border-emerald-400/20">
        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
        Portal Khusus Petugas Lapangan
      </div>
      <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
        Selamat Bertugas, {{ Auth::user()->firstname }}! 👋
      </h1>
      <p class="text-xs sm:text-sm text-slate-300 max-w-2xl leading-relaxed">
        Berikut adalah jadwal agenda pimpinan dan daftar penugasan acara dinas. Pastikan kelengkapan berkas sambutan dan koordinasi lokasi telah siap.
      </p>
    </div>
  </div>

  <!-- Metric Stat Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
    
    <!-- Total Agenda Terdaftar -->
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
      <div class="mt-3 text-[11px] text-slate-500">
        Agenda aktif dalam kalender kerja
      </div>
    </div>

    <!-- Agenda Ditugaskan Ke Saya -->
    <div class="p-5 bg-white rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md transition group">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Tugas Saya</p>
          <h3 class="text-2xl font-extrabold text-slate-900 mt-1">{{ $totalTugasSaya ?? 0 }}</h3>
        </div>
        <div class="w-12 h-12 rounded-2xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-brand-600 group-hover:scale-110 transition">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
          </svg>
        </div>
      </div>
      <div class="mt-3 text-[11px] text-slate-500">
        Agenda yang menugaskan Anda
      </div>
    </div>

    <!-- Status Penugasan -->
    <div class="p-5 bg-white rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md transition group">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Status Akun</p>
          <div class="flex items-center gap-2 mt-1">
            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
            <span class="text-base font-extrabold text-slate-900">Petugas Siap</span>
          </div>
        </div>
        <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 group-hover:scale-110 transition">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
      </div>
      <div class="mt-3 text-[11px] text-slate-500">
        Siap menerima disposisi tugas dinas
      </div>
    </div>

  </div>

  <!-- Agenda List Table -->
  <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
    <div class="p-5 sm:p-6 border-b border-slate-100 flex items-center justify-between">
      <div>
        <h2 class="text-base sm:text-lg font-bold text-slate-900">Jadwal Agenda Pimpinan</h2>
        <p class="text-xs text-slate-500 mt-0.5">Klik "Lihat Detail" untuk memeriksa informasi lengkap dan berkas sambutan.</p>
      </div>
    </div>

    @if($agendas->isEmpty())
      <div class="p-12 text-center">
        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-slate-100 flex items-center justify-center text-slate-400">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
          </svg>
        </div>
        <h3 class="text-sm font-bold text-slate-800">Tidak Ada Agenda Terjadwal</h3>
        <p class="text-xs text-slate-500 mt-1">Saat ini belum ada agenda kegiatan yang tercatat di sistem.</p>
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
              <th class="py-3.5 px-5">Tim Petugas</th>
              <th class="py-3.5 px-5">Dokumentasi GDrive</th>
              <th class="py-3.5 px-5 text-end">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100 text-xs">
            @foreach($agendas as $agenda)
              @php
                $isToday = \Carbon\Carbon::parse($agenda->tanggal)->isToday();
                $isPast = \Carbon\Carbon::parse($agenda->tanggal)->isPast() && !$isToday;
                $isAssignedToMe = $agenda->petugas->contains(Auth::id()) || in_array(Auth::id(), explode(',', $agenda->user_ids ?? ''));
                $statusBadge = $agenda->status_badge;
              @endphp
              <tr class="hover:bg-slate-50/60 transition {{ $isAssignedToMe ? 'bg-brand-50/30' : '' }}">
                
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
                      @if($isAssignedToMe)
                        <span class="inline-block mt-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-indigo-100 text-indigo-700">Tugas Anda</span>
                      @endif
                    </div>
                  </div>
                </td>

                <!-- Agenda & Pejabat -->
                <td class="py-4 px-5">
                  <div class="max-w-xs sm:max-w-sm">
                    <a href="{{ url('/agenda/staff/' . $agenda->id) }}" class="font-bold text-slate-900 hover:text-brand-600 transition block text-xs sm:text-sm">
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

                <!-- Tim Petugas -->
                <td class="py-4 px-5">
                  <div class="flex flex-wrap gap-1 max-w-[180px]">
                    @forelse($agenda->petugas as $p)
                      <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg {{ $p->id == Auth::id() ? 'bg-indigo-100 text-indigo-800 font-bold border border-indigo-200' : 'bg-slate-100 text-slate-700 font-medium border border-slate-200/60' }} text-[10px]">
                        {{ $p->firstname }}
                      </span>
                    @empty
                      <span class="text-slate-400 text-[11px] italic">Belum ada</span>
                    @endforelse
                  </div>
                </td>

                <!-- Dokumentasi GDrive -->
                <td class="py-4 px-5 whitespace-nowrap">
                  @if($agenda->link)
                    <a href="{{ $agenda->link }}" target="_blank" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-700 border border-emerald-200/80 hover:bg-emerald-100 transition text-[11px] font-semibold" title="Buka Folder Google Drive Dokumentasi">
                      <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                      <span>Tersedia</span>
                      <svg class="w-3 h-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                  @else
                    <a href="{{ url('/agenda/staff/' . $agenda->id) }}" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-amber-50 text-amber-700 border border-amber-200/80 hover:bg-amber-100 transition text-[11px] font-semibold" title="Klik untuk melengkapi link dokumentasi">
                      <svg class="w-3 h-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                      <span>Isi Dokumentasi</span>
                    </a>
                  @endif
                </td>

                <!-- Aksi -->
                <td class="py-4 px-5 text-end whitespace-nowrap">
                  <a href="{{ url('/agenda/staff/' . $agenda->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-brand-600 hover:bg-brand-500 text-white text-xs font-semibold shadow-sm transition">
                    <span>Lihat Detail</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                  </a>
                </td>

              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
@endsection