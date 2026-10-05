<!-- ========== STAFF SIDEBAR ========== -->
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
        <span class="text-[11px] font-medium text-emerald-400">Portal Petugas</span>
      </div>
    </div>

    <!-- Navigation List -->
    <div class="h-full overflow-y-auto px-4 py-4 space-y-6">
      
      <!-- Group: UTAMA -->
      <div>
        <p class="px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">Menu Petugas</p>
        <ul class="space-y-1">
          <li>
            <a href="{{ route('DashboardStaff') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('DashboardStaff') ? 'bg-brand-600 text-white shadow-md shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
              <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
              </svg>
              <span>Dashboard Petugas</span>
            </a>
          </li>
        </ul>
      </div>

      <!-- Group: AKUN -->
      <div>
        <p class="px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">Akun Anda</p>
        <ul class="space-y-1">
          <li>
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('profile.edit') ? 'bg-brand-600 text-white shadow-md shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
              <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
              </svg>
              <span>Profil Saya</span>
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