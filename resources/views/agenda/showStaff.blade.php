@extends('layouts.app')

@section('title', 'Detail Tugas Agenda: ' . $agenda->judul_acara . ' - SIMAPIM')
@section('page-title', 'Detail Tugas Agenda')

@section('content')
  @php
    $isToday = \Carbon\Carbon::parse($agenda->tanggal)->isToday();
    $isPast = \Carbon\Carbon::parse($agenda->tanggal)->isPast() && !$isToday;
    $isAssignedToMe = $agenda->petugas->contains(Auth::id()) || in_array(Auth::id(), explode(',', $agenda->user_ids ?? ''));
  @endphp

  <!-- Action Bar & Navigation -->
  <div class="flex items-center justify-between mb-2">
    <a href="{{ route('DashboardStaff') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-slate-800 transition">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
      <span>Kembali ke Dashboard Petugas</span>
    </a>
    @if($isAssignedToMe)
      <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-indigo-50 text-brand-700 border border-brand-200">
        <span class="w-2 h-2 rounded-full bg-brand-600 animate-pulse"></span>
        Anda Ditugaskan pada Acara Ini
      </span>
    @endif
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
          <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Lokasi / Tempat Pelaksanaan</p>
          <p class="text-sm font-bold text-slate-800 mt-1 leading-relaxed">{{ $agenda->lokasi ?? 'Lokasi belum ditentukan' }}</p>
        </div>
      </div>

      <!-- File Sambutan -->
      <div class="p-5 rounded-2xl bg-slate-50/70 border border-slate-100 flex items-center justify-between gap-4">
        <div class="flex items-center gap-3.5 min-w-0">
          <div class="w-10 h-10 rounded-xl bg-rose-50 border border-rose-100 text-rose-600 flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
          </div>
          <div class="min-w-0">
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Naskah Sambutan</p>
            @if($agenda->file_sambutan)
              <p class="text-xs font-bold text-slate-800 mt-0.5 truncate max-w-[180px] sm:max-w-xs">{{ $agenda->file_sambutan }}</p>
            @else
              <p class="text-xs text-slate-400 mt-0.5 italic">Belum ada file naskah</p>
            @endif
          </div>
        </div>

        @if($agenda->file_sambutan)
          <a href="{{ asset('storage/sambutan/' . $agenda->file_sambutan) }}" target="_blank" class="shrink-0 inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-rose-600 hover:bg-rose-500 text-white text-xs font-bold shadow-xs transition" title="Unduh Berkas PDF">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
            <span>Unduh</span>
          </a>
        @endif
      </div>

      <!-- Dokumentasi Kegiatan (Google Drive) - Pengisian oleh Petugas -->
      <div class="md:col-span-2 p-5 sm:p-6 rounded-2xl bg-gradient-to-br from-emerald-50/40 via-white to-slate-50/70 border border-emerald-100/80 shadow-xs">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 mb-4 border-b border-emerald-100/60">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-emerald-100/80 border border-emerald-200 text-emerald-700 flex items-center justify-center shrink-0 shadow-xs">
              <!-- Google Drive / Folder Icon -->
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
              </svg>
            </div>
            <div>
              <div class="flex items-center gap-2">
                <h3 class="text-sm font-bold text-slate-900">Dokumentasi Kegiatan (Google Drive)</h3>
                <span class="hidden sm:inline-block px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-100 text-emerald-800">
                  Khusus Petugas
                </span>
              </div>
              <p class="text-xs text-slate-500 mt-0.5">Petugas lapangan bertugas mengisi tautan folder Google Drive hasil dokumentasi acara.</p>
            </div>
          </div>

          <div>
            @if($agenda->link)
              <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Dokumentasi Tersedia
              </span>
            @else
              <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 border border-amber-200">
                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                Belum Diisi Petugas
              </span>
            @endif
          </div>
        </div>

        @if($agenda->link)
          <!-- Tampilan jika link sudah terisi -->
          <div class="space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-3.5 rounded-xl bg-white border border-emerald-200/80 shadow-xs">
              <div class="flex items-center gap-3 min-w-0">
                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                </div>
                <div class="min-w-0">
                  <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Tautan Google Drive Tersimpan</p>
                  <a href="{{ $agenda->link }}" target="_blank" class="text-xs font-bold text-emerald-700 hover:text-emerald-800 hover:underline truncate block max-w-sm sm:max-w-md">
                    {{ $agenda->link }}
                  </a>
                </div>
              </div>

              <div class="flex items-center gap-2 shrink-0">
                <a href="{{ $agenda->link }}" target="_blank" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold shadow-xs transition">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                  <span>Buka Google Drive</span>
                </a>
                <button type="button" onclick="document.getElementById('form-edit-link-staff').classList.toggle('hidden')" class="px-3 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition" title="Ubah Link">
                  Ubah Link
                </button>
              </div>
            </div>

            <!-- Form Ubah Link (Tersedia Toggle) -->
            <div id="form-edit-link-staff" class="hidden p-4 rounded-xl bg-slate-50 border border-slate-200/80">
              <form action="{{ route('agenda.updateLinkDokumentasi', $agenda->id) }}" method="POST" class="space-y-3">
                @csrf
                @method('PUT')
                <label class="block text-xs font-semibold text-slate-700">Perbarui Tautan Folder Google Drive</label>
                <div class="flex flex-col sm:flex-row gap-2">
                  <div class="relative flex-1">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-slate-400">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                    </div>
                    <input type="url" name="link" value="{{ old('link', $agenda->link) }}" required
                      placeholder="https://drive.google.com/drive/folders/..."
                      class="block w-full py-2.5 ps-10 pe-3.5 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 transition shadow-xs">
                  </div>
                  <button type="submit" class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold shadow-xs transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Simpan Perubahan</span>
                  </button>
                </div>
                <p class="text-[11px] text-slate-500">Pastikan izin akses folder Google Drive disetel ke <em>"Siapa saja yang memiliki link dapat melihat"</em>.</p>
              </form>
            </div>
          </div>
        @else
          <!-- Tampilan jika link belum diisi -->
          <div class="space-y-3">
            <div class="p-3.5 rounded-xl bg-amber-50/70 border border-amber-200/60 text-amber-900 text-xs flex items-start gap-2.5">
              <svg class="w-4 h-4 text-amber-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
              <span>Silakan unggah dokumentasi foto/video kegiatan ke <strong>Google Drive</strong>, lalu masukkan tautan folder di bawah ini:</span>
            </div>

            <form action="{{ route('agenda.updateLinkDokumentasi', $agenda->id) }}" method="POST" class="space-y-3">
              @csrf
              @method('PUT')
              <div class="flex flex-col sm:flex-row gap-2">
                <div class="relative flex-1">
                  <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                  </div>
                  <input type="url" name="link" value="{{ old('link') }}" required
                    placeholder="https://drive.google.com/drive/folders/..."
                    class="block w-full py-2.5 ps-10 pe-3.5 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 transition shadow-xs">
                </div>
                <button type="submit" class="inline-flex items-center justify-center gap-1.5 px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold shadow-xs transition">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                  <span>Simpan Link Dokumentasi</span>
                </button>
              </div>
              <p class="text-[11px] text-slate-500">Pastikan folder Google Drive dapat diakses oleh pimpinan dan admin (status: <em>Anyone with the link can view</em>).</p>
            </form>
          </div>
        @endif
      </div>

    </div>
  </div>

  <!-- Rekan Petugas -->
  <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs p-6 sm:p-8">
    <div class="mb-5 pb-3 border-b border-slate-100 flex items-center justify-between">
      <div>
        <h2 class="text-base font-bold text-slate-900">Rekan Petugas Pendamping</h2>
        <p class="text-xs text-slate-500 mt-0.5">Daftar staf yang bersama-sama ditugaskan pada agenda ini.</p>
      </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
      @forelse($agenda->petugas as $petugas)
        <div class="flex items-center gap-3.5 p-4 rounded-2xl {{ $petugas->id == Auth::id() ? 'bg-brand-50/50 border-2 border-brand-300' : 'bg-slate-50 border border-slate-200/80' }}">
          <img src="{{ asset('storage/avatars/' . ($petugas->avatar ?? 'no-image-available.png')) }}" 
               alt="{{ $petugas->firstname }}" 
               class="w-12 h-12 rounded-full object-cover border border-slate-200 shadow-xs"
               onerror="this.onerror=null;this.src='{{ asset('storage/avatars/no-image-available.png') }}';">
          <div class="min-w-0">
            <p class="text-xs font-bold text-slate-800 truncate">
              {{ $petugas->firstname }} {{ $petugas->lastname }}
              @if($petugas->id == Auth::id())
                <span class="text-brand-600 font-semibold">(Anda)</span>
              @endif
            </p>
            <p class="text-[11px] text-slate-500 truncate">{{ $petugas->email }}</p>
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
