@extends('layouts.app')

@section('title', 'Tambah Petugas Baru - SIMAPIM')
@section('page-title', 'Tambah Petugas')

@section('content')
  <!-- Page Header -->
  <div class="flex items-center justify-between mb-2">
    <div>
      <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-slate-900">Tambah Petugas Baru</h1>
      <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Daftarkan akun administrator atau staf petugas pendamping baru.</p>
    </div>
    <a href="{{ route('petugas.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold shadow-xs transition">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
      <span>Kembali</span>
    </a>
  </div>

  <!-- Form Card -->
  <div class="max-w-4xl mx-auto bg-white rounded-3xl border border-slate-200/80 shadow-xs p-6 sm:p-8">
    <form action="{{ route('petugas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
      @csrf

      <!-- Avatar Upload Section -->
      <div class="flex flex-col sm:flex-row items-center gap-6 pb-6 border-b border-slate-100">
        <div class="relative group">
          <img id="avatar_preview" 
               src="{{ asset('storage/avatars/no-image-available.png') }}" 
               alt="Preview Avatar" 
               class="w-24 h-24 rounded-full object-cover border-4 border-slate-100 shadow-md">
          <label for="avatar_input" class="absolute bottom-0 right-0 p-2 rounded-full bg-brand-600 hover:bg-brand-500 text-white cursor-pointer shadow-lg transition">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <input id="avatar_input" type="file" name="avatar" accept="image/*" class="sr-only" onchange="previewAvatar(this)">
          </label>
        </div>
        <div class="text-center sm:text-left">
          <h3 class="text-sm font-bold text-slate-800">Foto Profil Pengguna</h3>
          <p class="text-xs text-slate-500 mt-0.5">Unggah foto format JPG, JPEG, atau PNG (Maksimal 2 MB). Opsional.</p>
          @error('avatar')<p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>@enderror
        </div>
      </div>

      <!-- Input Fields -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        
        <!-- Nama Depan -->
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Depan <span class="text-rose-500">*</span></label>
          <input type="text" name="firstname" value="{{ old('firstname') }}" required
            placeholder="Contoh: Ahmad"
            class="block w-full py-2.5 px-3.5 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition shadow-xs">
          @error('firstname')<p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Nama Belakang -->
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Belakang</label>
          <input type="text" name="lastname" value="{{ old('lastname') }}"
            placeholder="Contoh: Pratama"
            class="block w-full py-2.5 px-3.5 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition shadow-xs">
          @error('lastname')<p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Email -->
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Email <span class="text-rose-500">*</span></label>
          <input type="email" name="email" value="{{ old('email') }}" required
            placeholder="petugas@instansi.go.id"
            class="block w-full py-2.5 px-3.5 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition shadow-xs">
          @error('email')<p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Role User -->
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1.5">Peran / Hak Akses <span class="text-rose-500">*</span></label>
          <select name="type" required class="block w-full py-2.5 px-3.5 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition shadow-xs">
            <option value="2" {{ old('type') == '2' ? 'selected' : '' }}>Petugas / Staf (Akses Portal Petugas)</option>
            <option value="1" {{ old('type') == '1' ? 'selected' : '' }}>Administrator (Akses Penuh Kelola Sistem)</option>
          </select>
          @error('type')<p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Password -->
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kata Sandi <span class="text-rose-500">*</span></label>
          <input type="password" name="password" required
            placeholder="Minimal 6 karakter"
            class="block w-full py-2.5 px-3.5 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition shadow-xs">
          @error('password')<p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Confirm Password -->
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1.5">Konfirmasi Kata Sandi <span class="text-rose-500">*</span></label>
          <input type="password" name="password_confirmation" required
            placeholder="Ulangi kata sandi"
            class="block w-full py-2.5 px-3.5 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition shadow-xs">
        </div>

      </div>

      <!-- Action Buttons -->
      <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
        <a href="{{ route('petugas.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 text-xs font-semibold transition">
          Batal
        </a>
        <button type="submit" class="px-6 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-500 text-white text-xs font-bold shadow-lg shadow-brand-600/25 transition transform active:scale-95">
          Daftarkan Petugas
        </button>
      </div>

    </form>
  </div>
@endsection

@section('scripts')
<script>
  function previewAvatar(input) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('avatar_preview').src = e.target.result;
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
@endsection
