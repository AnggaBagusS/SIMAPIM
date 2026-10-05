<!-- ========== ADMIN SIDEBAR ========== -->
<aside id="hs-application-sidebar" class="hs-overlay [--auto-close:lg]
  hs-overlay-open:translate-x-0
  -translate-x-full transition-all duration-300 transform
  w-64 h-full hidden fixed inset-y-0 start-0 z-60
  bg-slate-900 border-e border-slate-800
  lg:block lg:translate-x-0 lg:end-auto lg:bottom-0 shadow-2xl" role="dialog" tabindex="-1" aria-label="Sidebar">
  
  <div class="relative flex flex-col h-full max-h-full">
    
    <!-- Sidebar Brand Header -->
    <div class="px-6 py-5 flex items-center gap-3 border-b border-slate-800/80">
      <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-brand-600 to-indigo-500 p-2 shadow-lg shadow-brand-500/20 flex items-center justify-center shrink-0">
        <img src="{{ asset('assets/Logo_Lampung.png') }}" class="w-full h-full object-contain filter drop-shadow" alt="SIMAPIM Logo">
      </div>
      <div class="flex flex-col">
        <span class="text-base font-bold text-white tracking-wide leading-tight">SIMAPIM</span>
        <span class="text-[11px] font-medium text-slate-400">Agenda Pimpinan</span>
      </div>
    </div>

    <!-- Navigation List -->
    <div class="h-full overflow-y-auto px-4 py-4 space-y-6">
      
      <!-- Group: UTAMA -->
      <div>
        <p class="px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">Menu Utama</p>
        <ul class="space-y-1">
          <li>
            <a href="{{ route('DashboardAdmin') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('DashboardAdmin') ? 'bg-brand-600 text-white shadow-md shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
              <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
              </svg>
              <span>Dashboard</span>
            </a>
          </li>
        </ul>
      </div>

      <!-- Group: AGENDA -->
      <div>
        <p class="px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">Manajemen Agenda</p>
        <ul class="space-y-1">
          <li>
            <a href="{{ route('agenda.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('agenda.index') || request()->routeIs('agenda.show') ? 'bg-brand-600 text-white shadow-md shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
              <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
              </svg>
              <span>Daftar Agenda</span>
            </a>
          </li>
          <li>
            <a href="{{ route('agenda.create') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('agenda.create') ? 'bg-brand-600 text-white shadow-md shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
              <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
              </svg>
              <span>Tambah Agenda Baru</span>
            </a>
          </li>
        </ul>
      </div>

      <!-- Group: PETUGAS -->
      <div>
        <p class="px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">Pengguna & Petugas</p>
        <ul class="space-y-1">
          <li>
            <a href="{{ route('petugas.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('petugas.index') || request()->routeIs('petugas.show') ? 'bg-brand-600 text-white shadow-md shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
              <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
              </svg>
              <span>Daftar Petugas</span>
            </a>
          </li>
          <li>
            <a href="{{ route('petugas.create') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('petugas.create') ? 'bg-brand-600 text-white shadow-md shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
              <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
              </svg>
              <span>Tambah Petugas</span>
            </a>
          </li>
        </ul>
      </div>

      <!-- Group: AKUN -->
      <div>
        <p class="px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">Pengaturan</p>
        <ul class="space-y-1">
          <li>
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('profile.edit') ? 'bg-brand-600 text-white shadow-md shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
              <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
              <span>Profil Akun</span>
            </a>
          </li>
          <li>
            <a href="{{ route('activity-log.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('activity-log.*') ? 'bg-brand-600 text-white shadow-md shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
              <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
              <span>Audit Trail (Log Aktivitas)</span>
            </a>
          </li>
          <li>
            <button type="button" onclick="confirmLogout()" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-rose-400 hover:bg-rose-500/10 hover:text-rose-300 transition text-start cursor-pointer">
              <svg class="w-4 h-4 shrink-0 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
              </svg>
              <span>Keluar (Logout)</span>
            </button>
          </li>
        </ul>
      </div>

    </div>

    <!-- Sidebar Bottom Card -->
    <div class="p-4 border-t border-slate-800/80">
      <div class="p-3 rounded-xl bg-slate-800/60 border border-slate-700/50 flex items-center justify-between">
        <div>
          <p class="text-[11px] font-semibold text-white">SIMAPIM v2.0</p>
          <p class="text-[10px] text-slate-400">Pemerintah Provinsi</p>
        </div>
        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse" title="System Online"></span>
      </div>
    </div>

  </div>
</aside>