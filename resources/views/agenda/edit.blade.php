@extends('layouts.app')

@section('title', 'Edit Agenda - SIMAPIM')
@section('page-title', 'Edit Agenda')

@section('content')
  <!-- Page Header -->
  <div class="flex items-center justify-between mb-2">
    <div>
      <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-slate-900">Perbarui Agenda Kegiatan</h1>
      <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Perbarui informasi rincian acara atau disposisi petugas.</p>
    </div>
    <a href="{{ route('agenda.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold shadow-xs transition">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
      <span>Kembali</span>
    </a>
  </div>

  <!-- Form Card -->
  <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs p-6 sm:p-8">
    <form action="{{ route('agenda.update', $agenda->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
      @csrf
      @method('PUT')

      <!-- Section 1: Informasi Kegiatan -->
      <div>
        <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
          <span class="w-6 h-6 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center text-xs">1</span>
          Informasi Utama Acara
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <!-- Judul Acara -->
          <div class="md:col-span-2">
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Judul Acara / Kegiatan <span class="text-rose-500">*</span></label>
            <input type="text" name="judul_acara" value="{{ old('judul_acara', $agenda->judul_acara) }}" required
              class="block w-full py-2.5 px-3.5 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition shadow-xs">
            @error('judul_acara')<p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>@enderror
          </div>

          <!-- Pejabat yang Hadir -->
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Pejabat yang Dihadiri / Diwakili</label>
            <input type="text" name="pejabat" value="{{ old('pejabat', $agenda->pejabat) }}"
              class="block w-full py-2.5 px-3.5 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition shadow-xs">
            @error('pejabat')<p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>@enderror
          </div>

          <!-- Link Google Drive Dokumentasi -->
          <div>
            <div class="flex items-center justify-between mb-1.5">
              <label class="block text-xs font-semibold text-slate-700">Link Google Drive Dokumentasi (Opsional)</label>
              <span class="text-[10px] text-emerald-700 bg-emerald-50 border border-emerald-200/80 px-2 py-0.5 rounded-full font-medium">Diisi oleh Petugas</span>
            </div>
            <input type="url" name="link" value="{{ old('link', $agenda->link) }}"
              placeholder="https://drive.google.com/drive/folders/..."
              class="block w-full py-2.5 px-3.5 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition shadow-xs">
            <p class="text-[11px] text-slate-400 mt-1">Tautan folder Google Drive berisi arsip/dokumentasi acara dari petugas lapangan.</p>
            @error('link')<p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>@enderror
          </div>

          <!-- Lokasi Kegiatan -->
          <div class="md:col-span-2">
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Lokasi / Tempat Pelaksanaan</label>
            <textarea name="lokasi" rows="2"
              class="block w-full py-2.5 px-3.5 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition shadow-xs">{{ old('lokasi', $agenda->lokasi) }}</textarea>
            @error('lokasi')<p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>@enderror
          </div>
        </div>
      </div>

      <!-- Section 2: Waktu & Status Pelaksanaan -->
      <div>
        <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
          <span class="w-6 h-6 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center text-xs">2</span>
          Waktu & Status Pelaksanaan
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
          <!-- Tanggal -->
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Tanggal Acara <span class="text-rose-500">*</span></label>
            <input type="date" id="tanggal_input" name="tanggal" value="{{ old('tanggal', \Carbon\Carbon::parse($agenda->tanggal)->format('Y-m-d')) }}" required onchange="autoFillDay(this.value)"
              class="block w-full py-2.5 px-3.5 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition shadow-xs">
            @error('tanggal')<p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>@enderror
          </div>

          <!-- Hari (Auto-filled) -->
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Hari</label>
            <input type="text" id="hari_input" name="hari" value="{{ old('hari', $agenda->hari) }}"
              class="block w-full py-2.5 px-3.5 text-xs text-slate-900 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition shadow-xs">
            @error('hari')<p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>@enderror
          </div>

          <!-- Status Agenda -->
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Status Agenda <span class="text-rose-500">*</span></label>
            <select name="status" required class="block w-full py-2.5 px-3.5 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition shadow-xs">
              <option value="terjadwal" {{ old('status', $agenda->status) == 'terjadwal' ? 'selected' : '' }}>Terjadwal</option>
              <option value="berlangsung" {{ old('status', $agenda->status) == 'berlangsung' ? 'selected' : '' }}>Sedang Berlangsung</option>
              <option value="selesai" {{ old('status', $agenda->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
              <option value="batal" {{ old('status', $agenda->status) == 'batal' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
            @error('status')<p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>@enderror
          </div>

          <!-- Jam Mulai -->
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Jam Mulai</label>
            <input type="time" name="jam_mulai" value="{{ old('jam_mulai', $agenda->jam_mulai ? substr($agenda->jam_mulai, 0, 5) : '09:00') }}"
              class="block w-full py-2.5 px-3.5 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition shadow-xs">
            @error('jam_mulai')<p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>@enderror
          </div>

          <!-- Jam Selesai -->
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Jam Selesai</label>
            <input type="time" name="jam_selesai" value="{{ old('jam_selesai', $agenda->jam_selesai ? substr($agenda->jam_selesai, 0, 5) : '12:00') }}"
              class="block w-full py-2.5 px-3.5 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition shadow-xs">
            @error('jam_selesai')<p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>@enderror
          </div>
        </div>
      </div>

      <!-- Section 3: Berkas Sambutan & Dokumen -->
      <div>
        <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
          <span class="w-6 h-6 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center text-xs">3</span>
          Lampiran Berkas Sambutan (PDF)
        </h2>

        @if($agenda->file_sambutan)
          <div class="mb-3 p-3 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-between">
            <div class="flex items-center gap-3">
              <div class="w-9 h-9 rounded-xl bg-rose-50 border border-rose-200 flex items-center justify-center text-rose-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
              </div>
              <div>
                <p class="text-xs font-bold text-slate-800">{{ $agenda->file_sambutan }}</p>
                <p class="text-[10px] text-slate-500">Berkas sambutan saat ini</p>
              </div>
            </div>
            <a href="{{ asset('storage/sambutan/' . $agenda->file_sambutan) }}" target="_blank" class="px-3 py-1.5 rounded-lg bg-brand-50 text-brand-700 hover:bg-brand-100 text-xs font-semibold transition">
              Lihat Berkas
            </a>
          </div>
        @endif

        <div class="border-2 border-dashed border-slate-200 rounded-2xl p-6 text-center hover:border-brand-500 transition">
          <svg class="w-10 h-10 mx-auto text-slate-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
          <label for="file_sambutan" class="cursor-pointer text-xs font-bold text-brand-600 hover:text-brand-700">
            <span>{{ $agenda->file_sambutan ? 'Ganti Berkas Sambutan (PDF)' : 'Pilih Berkas PDF' }}</span>
            <input id="file_sambutan" type="file" name="file_sambutan" accept="application/pdf" class="sr-only" onchange="previewFileName(this)">
          </label>
          <p id="file_name_display" class="text-xs text-slate-500 mt-1">Kosongkan jika tidak ingin mengubah berkas lama. Maksimal 2 MB.</p>
        </div>
        @error('file_sambutan')<p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>@enderror
      </div>

      <!-- Section 4: Penugasan Petugas -->
      <div>
        <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
          <span class="w-6 h-6 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center text-xs">4</span>
          Disposisi Petugas Pendamping <span class="text-rose-500">*</span>
        </h2>
        <p class="text-xs text-slate-500 mb-3">Pilih satu atau lebih petugas yang ditugaskan untuk mendampingi agenda ini:</p>

        @php
          $currentIds = $agenda->petugas->pluck('id')->toArray();
          if (empty($currentIds) && !empty($agenda->user_ids)) {
              $currentIds = is_array($agenda->user_ids) ? $agenda->user_ids : explode(',', $agenda->user_ids);
          }
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
          @forelse($users as $user)
            <label class="flex items-center gap-3 p-3.5 rounded-2xl border border-slate-200/80 hover:border-brand-500 hover:bg-brand-50/20 cursor-pointer transition">
              <input type="checkbox" name="user_ids[]" value="{{ $user->id }}" 
                {{ in_array($user->id, old('user_ids', $currentIds)) ? 'checked' : '' }}
                class="w-4 h-4 text-brand-600 rounded border-slate-300 focus:ring-brand-500">
              <img src="{{ asset('storage/avatars/' . ($user->avatar ?? 'no-image-available.png')) }}" 
                   alt="{{ $user->firstname }}" 
                   class="w-8 h-8 rounded-full object-cover border border-slate-200"
                   onerror="this.onerror=null;this.src='{{ asset('storage/avatars/no-image-available.png') }}';">
              <div class="min-w-0">
                <p class="text-xs font-bold text-slate-800 truncate">{{ $user->firstname }} {{ $user->lastname }}</p>
                <p class="text-[10px] text-slate-500 truncate">{{ $user->email }}</p>
              </div>
            </label>
          @empty
            <p class="text-xs text-slate-400 italic">Belum ada data petugas terdaftar.</p>
          @endforelse
        </div>
        @error('user_ids')<p class="text-rose-500 text-[11px] mt-2">{{ $message }}</p>@enderror
      </div>

      <!-- Action Buttons -->
      <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
        <a href="{{ route('agenda.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 text-xs font-semibold transition">
          Batal
        </a>
        <button type="submit" class="px-6 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-500 text-white text-xs font-bold shadow-lg shadow-brand-600/25 transition transform active:scale-95">
          Simpan Perubahan
        </button>
      </div>

    </form>
  </div>
@endsection

@section('scripts')
<script>
  function autoFillDay(dateStr) {
    if (!dateStr) return;
    const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    const date = new Date(dateStr);
    if (!isNaN(date.getTime())) {
      document.getElementById('hari_input').value = days[date.getDay()];
    }
  }

  function previewFileName(input) {
    if (input.files && input.files[0]) {
      const file = input.files[0];
      const display = document.getElementById('file_name_display');
      display.innerHTML = `<strong class="text-brand-600 font-semibold">${file.name}</strong> (${(file.size / 1024).toFixed(1)} KB)`;
    }
  }
</script>
@endsection
