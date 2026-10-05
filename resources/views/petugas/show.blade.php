@extends('layouts.app')

@section('title', 'Profil Petugas: ' . $user->firstname . ' - SIMAPIM')
@section('page-title', 'Detail Petugas')

@section('content')
  <!-- Page Header -->
  <div class="flex items-center justify-between mb-2">
    <div>
      <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-slate-900">Profil Petugas</h1>
      <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Informasi akun pengguna dan rincian penugasan.</p>
    </div>
    <div class="flex items-center gap-2">
      <a href="{{ route('petugas.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold shadow-xs transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        <span>Kembali</span>
      </a>
      <a href="{{ route('petugas.edit', $user->id) }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-brand-600 hover:bg-brand-500 text-white text-xs font-semibold shadow-xs transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
        <span>Edit Akun</span>
      </a>
    </div>
  </div>

  <!-- Profile Card -->
  <div class="max-w-3xl mx-auto bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
    <!-- Top Pattern Banner -->
    <div class="h-28 bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 relative">
      <div class="absolute -right-8 -top-8 w-40 h-40 rounded-full bg-brand-500/20 blur-2xl"></div>
    </div>

    <!-- Profile Header Info -->
    <div class="px-6 sm:px-8 pb-8 pt-0 relative">
      <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 -mt-14 mb-6">
        <div class="flex items-end gap-4">
          <img src="{{ asset('storage/avatars/' . ($user->avatar ?? 'no-image-available.png')) }}" 
               alt="{{ $user->firstname }}" 
               class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-lg bg-white"
               onerror="this.onerror=null;this.src='{{ asset('storage/avatars/no-image-available.png') }}';">
          <div class="mb-1">
            <h2 class="text-xl font-bold text-slate-900">{{ $user->firstname }} {{ $user->lastname }}</h2>
            <p class="text-xs text-slate-500">{{ $user->email }}</p>
          </div>
        </div>

        <div>
          @if($user->type == 1)
            <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
              <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
              Administrator
            </span>
          @else
            <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-xs font-semibold bg-brand-50 text-brand-700 border border-brand-200">
              <span class="w-1.5 h-1.5 rounded-full bg-brand-500"></span>
              Petugas / Staf
            </span>
          @endif
        </div>
      </div>

      <!-- Information Details -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 border-t border-slate-100 text-xs">
        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
          <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Nama Lengkap</p>
          <p class="text-sm font-bold text-slate-800 mt-1">{{ $user->firstname }} {{ $user->lastname ?? '-' }}</p>
        </div>

        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
          <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Alamat Email Kedinasan</p>
          <p class="text-sm font-bold text-slate-800 mt-1">{{ $user->email }}</p>
        </div>

        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
          <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Status Akses Akun</p>
          <p class="text-sm font-bold text-emerald-600 mt-1 flex items-center gap-1.5">
            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            Aktif & Terverifikasi
          </p>
        </div>

        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
          <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Tanggal Bergabung</p>
          <p class="text-sm font-bold text-slate-800 mt-1">
            {{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->isoFormat('D MMMM Y') : 'Terdaftar di sistem' }}
          </p>
        </div>
      </div>

    </div>
  </div>
@endsection
