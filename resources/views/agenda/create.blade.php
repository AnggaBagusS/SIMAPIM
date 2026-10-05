@extends('layouts.app')

@section('title', 'Tambah Agenda Baru - SIMAPIM')
@section('page-title', 'Tambah Agenda')

@section('content')
  <!-- Page Header -->
  <div class="flex items-center justify-between mb-2">
    <div>
      <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-slate-900">Tambah Agenda Baru</h1>
      <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Isi rincian kegiatan pimpinan dan tentukan petugas pendamping.</p>
    </div>
    <a href="{{ route('agenda.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold shadow-xs transition">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
      <span>Kembali</span>
    </a>
  </div>

  <!-- Form Card -->
  <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs p-6 sm:p-8">
    <form action="{{ route('agenda.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
      @csrf

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
            <input type="text" name="judul_acara" value="{{ old('judul_acara') }}" required
              placeholder="Contoh: Rapat Koordinasi Penanganan Bencana Wilayah"
              class="block w-full py-2.5 px-3.5 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition shadow-xs">
            @error('judul_acara')<p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>@enderror
          </div>

          <!-- Pejabat yang Hadir -->
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Pejabat yang Dihadiri / Diwakili</label>
            <input type="text" name="pejabat" value="{{ old('pejabat') }}"
              placeholder="Contoh: Gubernur / Sekretaris Daerah"
              class="block w-full py-2.5 px-3.5 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition shadow-xs">
            @error('pejabat')<p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>@enderror
          </div>

          <!-- Link Google Drive Dokumentasi -->
          <div>
            <div class="flex items-center justify-between mb-1.5">
              <label class="block text-xs font-semibold text-slate-700">Link Google Drive Dokumentasi (Opsional)</label>
              <span class="text-[10px] text-emerald-700 bg-emerald-50 border border-emerald-200/80 px-2 py-0.5 rounded-full font-medium">Bisa diisi oleh Petugas</span>
            </div>
            <input type="url" name="link" value="{{ old('link') }}"
              placeholder="https://drive.google.com/drive/folders/..."
              class="block w-full py-2.5 px-3.5 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition shadow-xs">
            <p class="text-[11px] text-slate-400 mt-1">Folder Google Drive dokumentasi hasil kegiatan (dapat dikosongkan dan dilengkapi petugas lapangan).</p>
            @error('link')<p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>@enderror
          </div>

          <!-- Lokasi Kegiatan -->
          <div class="md:col-span-2">
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Lokasi / Tempat Pelaksanaan</label>
            <textarea name="lokasi" rows="2"
              placeholder="Contoh: Ruang Rapat Utama Lantai 2, Kantor Gubernur"
              class="block w-full py-2.5 px-3.5 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition shadow-xs">{{ old('lokasi') }}</textarea>
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
            <input type="date" id="tanggal_input" name="tanggal" value="{{ old('tanggal') }}" required onchange="autoFillDay(this.value)"
              class="block w-full py-2.5 px-3.5 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition shadow-xs">
            @error('tanggal')<p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>@enderror
          </div>

          <!-- Hari (Auto-filled) -->
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Hari</label>
            <input type="text" id="hari_input" name="hari" value="{{ old('hari') }}"
              placeholder="Otomatis terisi setelah memilih tanggal"
              class="block w-full py-2.5 px-3.5 text-xs text-slate-900 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition shadow-xs">
            @error('hari')<p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>@enderror
          </div>

          <!-- Status Agenda -->
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Status Agenda <span class="text-rose-500">*</span></label>
            <select name="status" required class="block w-full py-2.5 px-3.5 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition shadow-xs">
              <option value="terjadwal" {{ old('status', 'terjadwal') == 'terjadwal' ? 'selected' : '' }}>Terjadwal</option>
              <option value="berlangsung" {{ old('status') == 'berlangsung' ? 'selected' : '' }}>Sedang Berlangsung</option>
              <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
              <option value="batal" {{ old('status') == 'batal' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
            @error('status')<p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>@enderror
          </div>

          <!-- Jam Mulai -->
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Jam Mulai</label>
            <input type="time" name="jam_mulai" value="{{ old('jam_mulai', '09:00') }}"
              class="block w-full py-2.5 px-3.5 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition shadow-xs">
            @error('jam_mulai')<p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>@enderror
          </div>

          <!-- Jam Selesai -->
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Jam Selesai</label>
            <input type="time" name="jam_selesai" value="{{ old('jam_selesai', '12:00') }}"
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

        <div class="border-2 border-dashed border-slate-200 rounded-2xl p-6 text-center hover:border-brand-500 transition">
          <svg class="w-10 h-10 mx-auto text-slate-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
          <label for="file_sambutan" class="cursor-pointer text-xs font-bold text-brand-600 hover:text-brand-700">
            <span>Pilih Berkas PDF</span>
            <input id="file_sambutan" type="file" name="file_sambutan" accept="application/pdf" class="sr-only" onchange="previewFileName(this)">
          </label>
          <p id="file_name_display" class="text-xs text-slate-500 mt-1">Hanya format PDF, ukuran maksimal 2 MB</p>
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

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
          @forelse($users as $user)
            <label class="flex items-center gap-3 p-3.5 rounded-2xl border border-slate-200/80 hover:border-brand-500 hover:bg-brand-50/20 cursor-pointer transition">
              <input type="checkbox" name="user_ids[]" value="{{ $user->id }}" 
                {{ is_array(old('user_ids')) && in_array($user->id, old('user_ids')) ? 'checked' : '' }}
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
          Simpan Agenda
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
