<!-- ========== HEADER ========== -->
<header class="sticky top-0 inset-x-0 flex flex-wrap md:justify-start md:flex-nowrap z-48 w-full bg-white border-b border-gray-200 text-sm py-2.5 lg:ps-65 dark:bg-neutral-800 dark:border-neutral-700">
  <!-- SweetAlert2 CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <nav class="px-4 sm:px-6 flex basis-full items-center w-full mx-auto">
    <div class="me-5 lg:me-0 lg:hidden flex items-center">
      <!-- Logo -->
      
      <a class="flex items-center gap-x-2 text-xl font-semibold text-gray-800 dark:text-white" href="#">
        <img src="{{ asset('assets/SIMAPIMLOGO.png') }}" class="w-6 h-6" alt="Logo Lampung">
        <span class="font-bold tracking-wide">SIMAPIM</span>
      </a>
      <!-- End Logo -->
    </div>

    <!-- Right: User Dropdown -->
    <div class="ms-auto flex items-center gap-3">
      <div class="hs-dropdown relative">
        <button id="hs-dropdown-account" type="button" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-full focus:outline-none">
          <img class="w-9 h-9 rounded-full" src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" alt="Avatar">
        </button>

        <div class="hs-dropdown-menu mt-2 hidden min-w-60 bg-white shadow-md rounded-lg dark:bg-neutral-800 dark:border dark:border-neutral-700" role="menu" aria-labelledby="hs-dropdown-account">
          <div class="py-3 px-5 bg-gray-100 rounded-t-lg dark:bg-neutral-700">
            <p class="text-sm text-gray-500 dark:text-neutral-400">Signed in as</p>
            <p class="text-sm font-medium text-gray-800 dark:text-white">{{ Auth::user()->email }}</p>
          </div>

          <div class="p-1.5 space-y-0.5">
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-x-3.5 py-2 px-3 text-sm text-gray-800 rounded-lg hover:bg-gray-100 dark:text-neutral-200 dark:hover:bg-neutral-700">
              <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M12 4v1m0 6v1m-4-3h1m6 0h1M4 6h16M4 18h16" />
              </svg>
              Manage Account
            </a>

          <form id="logout-form" method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="button"
              onclick="confirmLogout()"
              class="w-full flex items-center gap-x-3.5 py-2 px-3 text-sm text-red-600 rounded-lg hover:bg-gray-100 dark:hover:bg-neutral-700">
              <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M17 16l4-4m0 0l-4-4m4 4H7" />
              </svg>
              Logout
            </button>
          </form>
          </div>
        </div>
      </div>
    </div>
    <!-- End Right -->
  </nav>
</header>
<script>
  function confirmLogout() {
    Swal.fire({
      title: 'Yakin ingin keluar?',
      text: "Sesi Anda akan diakhiri.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Ya, logout',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('logout-form').submit();
      }
    });
  }
</script>

<!-- ========== END HEADER ========== -->
