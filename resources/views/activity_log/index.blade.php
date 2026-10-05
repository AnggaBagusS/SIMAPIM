@extends('layouts.app')

@section('title', 'Audit Trail & Riwayat Aktivitas - SIMAPIM')
@section('page-title', 'Audit Trail')

@section('content')
  <!-- Page Header -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-2">
    <div>
      <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-slate-900">Audit Trail / Log Aktivitas</h1>
      <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Pantau seluruh riwayat manipulasi data, perubahan jadwal agenda, dan aktivitas petugas.</p>
    </div>
    <div class="flex items-center gap-2">
      <a href="{{ route('DashboardAdmin') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold shadow-xs transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        <span>Kembali ke Dashboard</span>
      </a>
    </div>
  </div>

  <!-- Filter Card -->
  <div class="p-4 sm:p-5 bg-white rounded-2xl border border-slate-200/80 shadow-xs">
    <form method="GET" action="{{ route('activity-log.index') }}" class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 gap-3 items-end">
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1">Kategori Log</label>
        <select name="log_name" class="block w-full py-2 px-3 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition shadow-xs">
          <option value="">Semua Kategori</option>
          <option value="agenda" {{ request('log_name') == 'agenda' ? 'selected' : '' }}>Agenda</option>
          <option value="user" {{ request('log_name') == 'user' ? 'selected' : '' }}>Petugas / User</option>
        </select>
      </div>

      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1">Jenis Aksi (Event)</label>
        <select name="event" class="block w-full py-2 px-3 text-xs text-slate-900 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition shadow-xs">
          <option value="">Semua Aksi</option>
          <option value="created" {{ request('event') == 'created' ? 'selected' : '' }}>Penambahan (Created)</option>
          <option value="updated" {{ request('event') == 'updated' ? 'selected' : '' }}>Perubahan (Updated)</option>
          <option value="deleted" {{ request('event') == 'deleted' ? 'selected' : '' }}>Penghapusan (Deleted)</option>
        </select>
      </div>

      <div class="flex items-center gap-2 sm:col-span-1 md:col-span-2">
        <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 py-2 px-4 rounded-xl text-xs font-semibold text-white bg-slate-900 hover:bg-slate-800 transition shadow-xs">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
          <span>Saring Log</span>
        </button>
        @if(request('log_name') || request('event'))
          <a href="{{ route('activity-log.index') }}" class="inline-flex items-center justify-center py-2 px-3 rounded-xl text-xs font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 transition">
            Reset
          </a>
        @endif
      </div>
    </form>
  </div>

  <!-- Log Table Card -->
  <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
    @if($activities->isEmpty())
      <div class="p-12 text-center">
        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-slate-100 flex items-center justify-center text-slate-400">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <h3 class="text-sm font-bold text-slate-800">Belum Ada Catatan Log Aktivitas</h3>
        <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">Setiap aksi penambahan, pembaruan, dan penghapusan data akan terekam secara otomatis di sini.</p>
      </div>
    @else
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-slate-50/75 border-b border-slate-100 text-[11px] font-bold uppercase tracking-wider text-slate-500">
              <th class="py-3.5 px-5">Waktu Kejadian</th>
              <th class="py-3.5 px-5">Pengguna (Aktor)</th>
              <th class="py-3.5 px-5">Deskripsi Aksi</th>
              <th class="py-3.5 px-5">Target Modul</th>
              <th class="py-3.5 px-5">Perubahan Data (Properti)</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100 text-xs">
            @foreach($activities as $log)
              @php
                $eventClass = match($log->event) {
                    'created' => 'bg-emerald-50 text-emerald-700 border-emerald-200/80',
                    'updated' => 'bg-amber-50 text-amber-700 border-amber-200/80',
                    'deleted' => 'bg-rose-50 text-rose-700 border-rose-200/80',
                    default   => 'bg-slate-100 text-slate-700 border-slate-200',
                };
              @endphp
              <tr class="hover:bg-slate-50/60 transition">
                <!-- Waktu -->
                <td class="py-4 px-5 whitespace-nowrap text-slate-600">
                  <div class="flex items-center gap-2">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <div>
                      <p class="font-bold text-slate-800">{{ $log->created_at->format('d M Y, H:i') }} WIB</p>
                      <p class="text-[10px] text-slate-400">{{ $log->created_at->diffForHumans() }}</p>
                    </div>
                  </div>
                </td>

                <!-- Aktor -->
                <td class="py-4 px-5 whitespace-nowrap">
                  @if($log->causer)
                    <div class="flex items-center gap-2.5">
                      <div class="w-7 h-7 rounded-full bg-brand-50 border border-brand-200 flex items-center justify-center text-brand-700 font-bold text-xs">
                        {{ strtoupper(substr($log->causer->firstname, 0, 1)) }}
                      </div>
                      <div>
                        <p class="font-bold text-slate-800">{{ $log->causer->firstname }} {{ $log->causer->lastname }}</p>
                        <p class="text-[10px] text-slate-400">{{ $log->causer->email }}</p>
                      </div>
                    </div>
                  @else
                    <span class="text-slate-400 italic">Sistem / Seeder</span>
                  @endif
                </td>

                <!-- Deskripsi -->
                <td class="py-4 px-5">
                  <div class="flex items-center gap-2">
                    @if($log->event)
                      <span class="inline-block px-2 py-0.5 rounded-md text-[10px] font-bold uppercase border {{ $eventClass }}">
                        {{ $log->event }}
                      </span>
                    @endif
                    <span class="font-semibold text-slate-800">{{ $log->description }}</span>
                  </div>
                </td>

                <!-- Target -->
                <td class="py-4 px-5 whitespace-nowrap">
                  <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-700 border border-slate-200">
                    {{ ucfirst($log->log_name) }} #{{ $log->subject_id ?? '-' }}
                  </span>
                </td>

                <!-- Properti -->
                <td class="py-4 px-5">
                  @php
                    $attributes = $log->properties['attributes'] ?? $log->properties['new_link'] ?? null;
                    $old = $log->properties['old'] ?? $log->properties['old_link'] ?? null;
                  @endphp
                  @if($attributes || $old)
                    <details class="cursor-pointer text-[11px]">
                      <summary class="text-brand-600 hover:text-brand-700 font-semibold select-none">Lihat Rincian Perubahan</summary>
                      <div class="mt-2 p-2.5 rounded-xl bg-slate-50 border border-slate-200/80 text-[10px] font-mono text-slate-700 max-w-md overflow-x-auto">
                        @if($old)
                          <p class="font-bold text-slate-500 mb-1">Sebelum:</p>
                          <pre class="mb-2 whitespace-pre-wrap">{{ is_array($old) ? json_encode($old, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : $old }}</pre>
                        @endif
                        @if($attributes)
                          <p class="font-bold text-slate-500 mb-1">Sesudah:</p>
                          <pre class="whitespace-pre-wrap">{{ is_array($attributes) ? json_encode($attributes, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : $attributes }}</pre>
                        @endif
                      </div>
                    </details>
                  @else
                    <span class="text-slate-400 text-[11px]">-</span>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      @if($activities->hasPages())
        <div class="p-4 border-t border-slate-100">
          {{ $activities->links() }}
        </div>
      @endif
    @endif
  </div>
@endsection
