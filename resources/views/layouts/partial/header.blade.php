<!-- ========== HEADER ========== -->
<header class="sticky top-0 inset-x-0 flex flex-wrap md:justify-start md:flex-nowrap z-40 w-full bg-white/90 backdrop-blur-md border-b border-slate-200/80 text-sm py-3 lg:ps-64 transition-all">
  <nav class="px-4 sm:px-6 lg:px-8 flex basis-full items-center w-full mx-auto justify-between">
    
    <!-- Left: Mobile Toggle & Mobile Logo -->
    <div class="flex items-center gap-3">
      <button type="button" class="lg:hidden p-2 inline-flex justify-center items-center gap-2 rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-brand-500 transition" data-hs-overlay="#hs-application-sidebar" aria-controls="hs-application-sidebar" aria-label="Toggle navigation">
        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      <div class="lg:hidden flex items-center gap-2">
        <img src="{{ asset('assets/Logo_Lampung.png') }}" class="w-7 h-7 object-contain" alt="Logo">
        <span class="font-bold text-slate-800 text-base tracking-tight">SIMAPIM</span>
      </div>

      <!-- Quick Date Widget (Desktop) -->
      <div class="hidden md:flex items-center gap-2 text-xs font-medium text-slate-500 bg-slate-100/80 px-3 py-1.5 rounded-full border border-slate-200/60">
        <svg class="w-3.5 h-3.5 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <span>{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</span>
      </div>
    </div>

    <!-- Right: User Profile Dropdown -->
    <div class="flex items-center gap-3">
      <!-- Role Badge -->
      <span class="hidden sm:inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-xs font-semibold {{ Auth::user()->type == 1 ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-brand-50 text-brand-700 border border-brand-200' }}">
        <span class="w-1.5 h-1.5 rounded-full {{ Auth::user()->type == 1 ? 'bg-amber-500' : 'bg-brand-500' }}"></span>
        {{ Auth::user()->type == 1 ? 'Administrator' : 'Petugas' }}
      </span>

      <!-- User Dropdown Menu -->
      <div class="relative inline-flex" id="user-dropdown-container">
        <button id="hs-dropdown-account" 
                type="button" 
                onclick="toggleUserDropdown(event)"
                class="inline-flex items-center gap-x-2.5 p-1 pe-3 text-sm font-semibold rounded-full border border-slate-200 bg-white hover:bg-slate-50 shadow-xs focus:outline-none transition cursor-pointer"
                aria-expanded="false"
                aria-haspopup="true">
          <img class="w-8 h-8 rounded-full object-cover border border-slate-200" 
               src="{{ asset('storage/avatars/' . (Auth::user()->avatar ?? 'no-image-available.png')) }}" 
               alt="{{ Auth::user()->firstname }}"
               onerror="this.onerror=null;this.src='{{ asset('storage/avatars/no-image-available.png') }}';">
          <span class="text-slate-700 text-xs font-semibold max-w-[120px] truncate hidden md:inline-block">
            {{ Auth::user()->firstname }}
          </span>
          <svg class="w-3.5 h-3.5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>

        <!-- Dropdown Menu Body -->
        <div id="user-dropdown-menu" 
             class="hidden absolute end-0 top-full mt-2 min-w-64 bg-white shadow-2xl rounded-2xl p-2 border border-slate-100 z-50 divide-y divide-slate-100 transition-all duration-150" 
             role="menu" 
             aria-labelledby="hs-dropdown-account">
          <div class="py-2.5 px-3">
            <p class="text-xs font-medium text-slate-400">Masuk sebagai</p>
            <p class="text-sm font-bold text-slate-800 truncate">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</p>
            <p class="text-xs text-slate-500 truncate">{{ Auth::user()->email }}</p>
          </div>

          <div class="py-1.5 space-y-0.5">
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-x-3 py-2 px-3 text-xs font-medium text-slate-700 rounded-xl hover:bg-slate-100 transition">
              <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
              Pengaturan Profil
            </a>
          </div>

          <div class="pt-1.5">
            <form id="logout-form" method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="button" onclick="confirmLogout()" class="w-full flex items-center gap-x-3 py-2 px-3 text-xs font-semibold text-rose-600 rounded-xl hover:bg-rose-50 transition cursor-pointer">
                <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Keluar Aplikasi
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </nav>
</header>

<script>
  function toggleUserDropdown(event) {
    event.stopPropagation();
    const menu = document.getElementById('user-dropdown-menu');
    const btn = document.getElementById('hs-dropdown-account');
    if (!menu) return;

    const isHidden = menu.classList.contains('hidden');
    if (isHidden) {
      menu.classList.remove('hidden');
      if (btn) btn.setAttribute('aria-expanded', 'true');
    } else {
      menu.classList.add('hidden');
      if (btn) btn.setAttribute('aria-expanded', 'false');
    }
  }

  // Close dropdown when clicking outside
  document.addEventListener('click', function(event) {
    const menu = document.getElementById('user-dropdown-menu');
    const btn = document.getElementById('hs-dropdown-account');
    if (menu && !menu.classList.contains('hidden')) {
      if (!menu.contains(event.target) && !btn.contains(event.target)) {
        menu.classList.add('hidden');
        if (btn) btn.setAttribute('aria-expanded', 'false');
      }
    }
  });

  // Close dropdown on Escape key
  document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
      const menu = document.getElementById('user-dropdown-menu');
      const btn = document.getElementById('hs-dropdown-account');
      if (menu && !menu.classList.contains('hidden')) {
        menu.classList.add('hidden');
        if (btn) btn.setAttribute('aria-expanded', 'false');
      }
    }
  });

  function confirmLogout() {
    Swal.fire({
      title: 'Konfirmasi Keluar',
      text: 'Apakah Anda yakin ingin mengakhiri sesi saat ini?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#4f46e5',
      cancelButtonColor: '#94a3b8',
      confirmButtonText: 'Ya, Keluar',
      cancelButtonText: 'Batal',
      reverseButtons: true,
      customClass: {
        popup: 'rounded-2xl shadow-xl'
      }
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('logout-form').submit();
      }
    });
  }
</script>
