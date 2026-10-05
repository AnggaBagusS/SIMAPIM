@extends('layouts.app')

@section('title', 'Edit Petugas: ' . $user->firstname . ' - SIMAPIM')
@section('page-title', 'Edit Petugas')

@section('content')
  <!-- Page Header -->
  <div class="flex items-center justify-between mb-2">
    <div>
      <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-slate-900">Perbarui Data Petugas</h1>
      <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Perbarui profil, informasi kontak, atau ubah kata sandi akun.</p>
    </div>
    <a href="{{ route('petugas.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold shadow-xs transition">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
      <span>Kembali</span>
    </a>
  </div>

  <!-- Form Card -->
  <div class="max-w-4xl mx-auto bg-white rounded-3xl border border-slate-200/80 shadow-xs p-6 sm:p-8">
    <form action="{{ route('petugas.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
      @csrf
      @method('PUT')

      <!-- Avatar Upload Section -->
      <div class="flex flex-col sm:flex-row items-center gap-6 pb-6 border-b border-slate-100">
        <div class="relative group">
          <img id="avatar_preview" 
               src="{{ asset('storage/avatars/' . ($user->avatar ?? 'no-image-available.png')) }}" 
               alt="{{ $user->firstname }}" 
               class="w-24 h-24 rounded-full object-cover border-4 border-slate-100 shadow-md"
               onerror="this.onerror=null;this.src='{{ asset('storage/avatars/no-image-available.png') }}';">
          <label for="avatar_input" class="absolute bottom-0 right-0 p-2 rounded-full bg-brand-600 hover:bg-brand-500 text-white cursor-pointer shadow-lg transition">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <input id="avatar_input" type="file" name="avatar" accept="image/*" class="sr-only" onchange="previewAvatar(this)">
          </label>
        </div>
        <div class="text-center sm:text-left">
          <h3 class="text-sm font-bold text-slate-800">Foto Profil Saat Ini</h3>
          <p class="text-xs text-slate-500 mt-0.5">Klik tombol kamera untuk mengganti foto profil. Format JPG/PNG, maks 2 MB.</p>
          @error('avatar')<p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>@enderror
        </div>
      </div>

      <!-- Input Fields -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        
        <!-- Nama Depan -->
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Depan <span class="text-rose-500">*</span></label>
          <input type="text" name="firstname" value="{{ old('firstname', $user->firstname) }}" required
            class="block w-full py-2.5 px-3.5 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition shadow-xs">
          @error('firstname')<p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Nama Belakang -->
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Belakang</label>
          <input type="text" name="lastname" value="{{ old('lastname', $user->lastname) }}"
            class="block w-full py-2.5 px-3.5 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition shadow-xs">
          @error('lastname')<p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Email -->
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Email <span class="text-rose-500">*</span></label>
          <input type="email" name="email" value="{{ old('email', $user->email) }}" required
            class="block w-full py-2.5 px-3.5 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition shadow-xs">
          @error('email')<p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Password Baru (Opsional) -->
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1.5">Ubah Kata Sandi (Opsional)</label>
          <input type="password" name="password"
            placeholder="Kosongkan jika tidak ingin mengubah password"
            class="block w-full py-2.5 px-3.5 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition shadow-xs">
          <p class="text-[10px] text-slate-400 mt-1">Hanya isi jika ingin mereset password akun ini.</p>
          @error('password')<p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>@enderror
        </div>

      </div>

      <!-- Action Buttons -->
      <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
        <a href="{{ route('petugas.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 text-xs font-semibold transition">
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
