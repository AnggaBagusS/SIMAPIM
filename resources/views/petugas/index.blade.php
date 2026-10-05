@extends('layouts.app')

@section('title', 'Daftar Petugas - SIMAPIM')
@section('page-title', 'Daftar Petugas')

@section('content')
  <!-- Page Header -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-slate-900">Manajemen Petugas & Pengguna</h1>
      <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Kelola akun administrator dan staf petugas pendamping agenda.</p>
    </div>
    <a href="{{ route('petugas.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-500 text-white text-xs font-bold shadow-lg shadow-brand-600/25 transition transform active:scale-95 shrink-0 self-start sm:self-auto">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
      <span>Tambah Petugas Baru</span>
    </a>
  </div>

  <!-- Petugas Table Card -->
  <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="bg-slate-50/75 border-b border-slate-100 text-[11px] font-bold uppercase tracking-wider text-slate-500">
            <th class="py-3.5 px-5">Pengguna</th>
            <th class="py-3.5 px-5">Email Kedinasan</th>
            <th class="py-3.5 px-5">Peran / Hak Akses</th>
            <th class="py-3.5 px-5">Terdaftar</th>
            <th class="py-3.5 px-5 text-end">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 text-xs">
          @forelse($users as $user)
            <tr class="hover:bg-slate-50/60 transition">
              
              <!-- Pengguna -->
              <td class="py-3.5 px-5 whitespace-nowrap">
                <div class="flex items-center gap-3">
                  <img src="{{ asset('storage/avatars/' . ($user->avatar ?? 'no-image-available.png')) }}" 
                       alt="{{ $user->firstname }}" 
                       class="w-10 h-10 rounded-full object-cover border border-slate-200 shadow-2xs"
                       onerror="this.onerror=null;this.src='{{ asset('storage/avatars/no-image-available.png') }}';">
                  <div>
                    <a href="{{ route('petugas.show', $user->id) }}" class="font-bold text-slate-900 hover:text-brand-600 transition block">
                      {{ $user->firstname }} {{ $user->lastname }}
                    </a>
                    <span class="text-[10px] text-slate-400">ID User: #{{ $user->id }}</span>
                  </div>
                </div>
              </td>

              <!-- Email -->
              <td class="py-3.5 px-5 whitespace-nowrap text-slate-600">
                {{ $user->email }}
              </td>

              <!-- Role -->
              <td class="py-3.5 px-5 whitespace-nowrap">
                @if($user->type == 1)
                  <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full text-[11px] font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                    Administrator
                  </span>
                @else
                  <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full text-[11px] font-semibold bg-brand-50 text-brand-700 border border-brand-200">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-500"></span>
                    Petugas / Staf
                  </span>
                @endif
              </td>

              <!-- Terdaftar -->
              <td class="py-3.5 px-5 whitespace-nowrap text-slate-400 text-[11px]">
                {{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('d M Y') : '-' }}
              </td>

              <!-- Aksi -->
              <td class="py-3.5 px-5 text-end whitespace-nowrap">
                <div class="inline-flex items-center gap-1.5">
                  <a href="{{ route('petugas.show', $user->id) }}" class="p-2 rounded-xl bg-slate-100 hover:bg-brand-50 hover:text-brand-600 text-slate-600 transition" title="Lihat Profil">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                  </a>
                  <a href="{{ route('petugas.edit', $user->id) }}" class="p-2 rounded-xl bg-slate-100 hover:bg-amber-50 hover:text-amber-600 text-slate-600 transition" title="Edit Petugas">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                  </a>
                  @if($user->id !== Auth::id())
                    <form id="delete-user-{{ $user->id }}" action="{{ route('petugas.destroy', $user->id) }}" method="POST" class="inline">
                      @csrf
                      @method('DELETE')
                      <button type="button" onclick="confirmDelete(event, 'delete-user-{{ $user->id }}', '{{ addslashes($user->firstname . ' ' . $user->lastname) }}')" class="p-2 rounded-xl bg-slate-100 hover:bg-rose-50 hover:text-rose-600 text-slate-600 transition" title="Hapus Pengguna">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                      </button>
                    </form>
                  @endif
                </div>
              </td>

            </tr>
          @empty
            <tr>
              <td colspan="5" class="py-12 text-center text-slate-400">
                Belum ada data petugas yang terdaftar.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    @if($users->hasPages())
      <div class="p-4 border-t border-slate-100">
        {{ $users->links() }}
      </div>
    @endif
  </div>
@endsection
