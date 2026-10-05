@extends('layouts.app')

@section('title', 'Detail Agenda: ' . $agenda->judul_acara . ' - SIMAPIM')
@section('page-title', 'Detail Agenda')

@section('content')
  @php
    $isToday = \Carbon\Carbon::parse($agenda->tanggal)->isToday();
    $isPast = \Carbon\Carbon::parse($agenda->tanggal)->isPast() && !$isToday;
  @endphp

  <!-- Action Bar & Navigation -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <a href="{{ route('agenda.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-slate-800 transition">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
      <span>Kembali ke Daftar Agenda</span>
    </a>
    <div class="flex items-center gap-2">
      <a href="{{ route('agenda.edit', $agenda->id) }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-semibold shadow-xs transition">
        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
        <span>Edit Agenda</span>
      </a>
      <form id="delete-agenda-{{ $agenda->id }}" action="{{ route('agenda.destroy', $agenda->id) }}" method="POST" class="inline">
        @csrf
        @method('DELETE')
        <button type="button" onclick="confirmDelete(event, 'delete-agenda-{{ $agenda->id }}', '{{ addslashes($agenda->judul_acara) }}')" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-semibold border border-rose-200 transition">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
          <span>Hapus</span>
        </button>
      </form>
    </div>
  </div>

  <!-- Executive Dossier Hero Card -->
  <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
    <div class="p-6 sm:p-8 border-b border-slate-100 bg-gradient-to-r from-slate-50/50 to-white">
      <div class="flex flex-wrap items-center gap-2 mb-3">
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold border {{ $agenda->status_badge['class'] }}">
          <span class="w-2 h-2 rounded-full {{ $agenda->status_badge['dot'] }}"></span>
          {{ $agenda->status_badge['label'] }}
        </span>
        @if($isToday)
          <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            HARI INI
          </span>
        @endif
        <span class="text-xs text-slate-400">&bull; ID Agenda #{{ $agenda->id }}</span>
      </div>

      <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight leading-tight">
        {{ $agenda->judul_acara }}
      </h1>

      <div class="mt-4 flex flex-wrap items-center gap-6 text-xs text-slate-600">
        <div class="flex items-center gap-2">
          <svg class="w-4 h-4 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
          <span><strong>{{ $agenda->hari }}</strong>, {{ \Carbon\Carbon::parse($agenda->tanggal)->isoFormat('D MMMM Y') }}</span>
        </div>
        <div class="flex items-center gap-2">
          <svg class="w-4 h-4 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          <span>Pukul: <strong class="text-slate-800">{{ $agenda->waktu_formatted }}</strong></span>
        </div>
        <div class="flex items-center gap-2">
          <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
          <span>Pejabat: <strong class="text-slate-800">{{ $agenda->pejabat ?? '-' }}</strong></span>
        </div>
      </div>
    </div>

    <!-- Detail Information Grid -->
    <div class="p-6 sm:p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
      
      <!-- Lokasi -->
      <div class="p-5 rounded-2xl bg-slate-50/70 border border-slate-100 flex items-start gap-4">
        <div class="w-10 h-10 rounded-xl bg-blue-50 border border-blue-100 text-blue-600 flex items-center justify-center shrink-0">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <div>
          <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Lokasi / Tempat</p>
          <p class="text-sm font-bold text-slate-800 mt-1 leading-relaxed">{{ $agenda->lokasi ?? 'Lokasi belum ditentukan' }}</p>
        </div>
      </div>

      <!-- Dokumentasi Kegiatan (Google Drive) -->
      <div class="p-5 rounded-2xl bg-slate-50/70 border border-slate-100 flex items-start gap-4">
        <div class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
        </div>
        <div>
          <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Dokumentasi Kegiatan (Google Drive)</p>
          @if($agenda->link)
            <div class="mt-2 flex flex-wrap items-center gap-2">
              <a href="{{ $agenda->link }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold transition shadow-xs">
                <span>Buka Google Drive</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
              </a>
              <span class="text-[11px] text-slate-500 italic">(Diisi oleh Petugas)</span>
            </div>
          @else
            <p class="text-xs text-amber-600 mt-1 flex items-center gap-1 font-medium">
              <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
              Belum diunggah oleh petugas lapangan
            </p>
          @endif
        </div>
      </div>

      <!-- File Sambutan -->
      <div class="md:col-span-2 p-5 rounded-2xl bg-slate-50/70 border border-slate-100 flex items-center justify-between">
        <div class="flex items-center gap-4">
          <div class="w-12 h-12 rounded-2xl bg-rose-50 border border-rose-100 text-rose-600 flex items-center justify-center shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
          </div>
          <div>
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Naskah Sambutan / Dokumen Acara</p>
            @if($agenda->file_sambutan)
              <p class="text-sm font-bold text-slate-800 mt-0.5">{{ $agenda->file_sambutan }}</p>
            @else
              <p class="text-xs text-slate-400 mt-0.5 italic">Belum ada file naskah sambutan yang diunggah</p>
            @endif
          </div>
        </div>

        @if($agenda->file_sambutan)
          <a href="{{ asset('storage/sambutan/' . $agenda->file_sambutan) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-rose-600 hover:bg-rose-500 text-white text-xs font-bold shadow-md shadow-rose-600/20 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
            <span>Unduh Berkas PDF</span>
          </a>
        @endif
      </div>

    </div>
  </div>

  <!-- Tim Petugas Pendamping -->
  <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs p-6 sm:p-8">
    <div class="mb-5 pb-3 border-b border-slate-100 flex items-center justify-between">
      <div>
        <h2 class="text-base font-bold text-slate-900">Petugas Pendamping Lapangan</h2>
        <p class="text-xs text-slate-500 mt-0.5">Staf yang didelegasikan untuk mengawal kelancaran kegiatan dinas ini.</p>
      </div>
      <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-brand-50 text-brand-700">
        {{ count($agenda->petugas) }} Petugas
      </span>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
      @forelse($agenda->petugas as $petugas)
        <div class="flex items-center gap-3.5 p-4 rounded-2xl bg-slate-50 border border-slate-200/80">
          <img src="{{ asset('storage/avatars/' . ($petugas->avatar ?? 'no-image-available.png')) }}" 
               alt="{{ $petugas->firstname }}" 
               class="w-12 h-12 rounded-full object-cover border border-slate-200 shadow-xs"
               onerror="this.onerror=null;this.src='{{ asset('storage/avatars/no-image-available.png') }}';">
          <div class="min-w-0">
            <p class="text-xs font-bold text-slate-800 truncate">{{ $petugas->firstname }} {{ $petugas->lastname }}</p>
            <p class="text-[11px] text-slate-500 truncate">{{ $petugas->email }}</p>
            <span class="inline-block mt-1 text-[10px] font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-100">
              Petugas Bertugas
            </span>
          </div>
        </div>
      @empty
        <div class="col-span-full p-6 text-center text-xs text-slate-400 italic">
          Belum ada petugas yang didelegasikan untuk agenda ini.
        </div>
      @endforelse
    </div>
  </div>
@endsection
