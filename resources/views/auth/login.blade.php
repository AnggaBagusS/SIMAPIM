<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - SIMAPIM (Sistem Informasi Manajemen Agenda Pimpinan)</title>
  <link rel="shortcut icon" href="{{ asset('assets/Logo_Lampung.png') }}" type="image/png">
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['"Plus Jakarta Sans"', 'sans-serif'],
          },
          colors: {
            brand: {
              50: '#eef2ff',
              100: '#e0e7ff',
              500: '#6366f1',
              600: '#4f46e5',
              700: '#4338ca',
            }
          }
        }
      }
    }
  </script>
</head>
<body class="h-full font-sans antialiased bg-slate-950 text-slate-800">
  <div class="min-h-full flex">
    
    <!-- Left Hero Brand Column (Desktop) -->
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 p-12 flex-col justify-between">
      <!-- Background Ambient Glows -->
      <div class="absolute -top-32 -left-32 w-96 h-96 rounded-full bg-indigo-500/20 blur-3xl pointer-events-none"></div>
      <div class="absolute -bottom-32 -right-32 w-96 h-96 rounded-full bg-blue-500/20 blur-3xl pointer-events-none"></div>

      <!-- Header / Logo -->
      <div class="relative z-10 flex items-center gap-3">
        <div class="w-12 h-12 rounded-2xl bg-white/10 backdrop-blur-md p-2.5 border border-white/20 shadow-xl flex items-center justify-center">
          <img src="{{ asset('assets/Logo_Lampung.png') }}" alt="Logo Lampung" class="w-full h-full object-contain filter drop-shadow">
        </div>
        <div>
          <h1 class="text-xl font-bold tracking-tight text-white leading-none">SIMAPIM</h1>
          <p class="text-xs text-indigo-300 font-medium mt-1">Pemerintah Provinsi</p>
        </div>
      </div>

      <!-- Feature Highlight / Value Proposition -->
      <div class="relative z-10 my-auto max-w-lg space-y-6">
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-indigo-500/10 border border-indigo-400/20 text-indigo-300 text-xs font-semibold">
          <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
          Platform Manajemen Agenda Pimpinan Terpadu
        </div>

        <h2 class="text-4xl font-extrabold text-white leading-tight tracking-tight">
          Koordinasi Jadwal & Agenda Eksekutif Lebih Cepat, Tepat, dan Terstruktur.
        </h2>

        <p class="text-sm text-slate-300 leading-relaxed">
          Kelola jadwal pimpinan daerah, koordinasi petugas lapangan, berkas sambutan kedinasan, dan dokumentasi secara tersentralisasi dalam satu sistem terintegrasi.
        </p>

        <!-- Feature Points -->
        <div class="grid grid-cols-2 gap-4 pt-4 border-t border-white/10">
          <div class="flex items-start gap-3">
            <div class="w-8 h-8 rounded-lg bg-indigo-500/20 flex items-center justify-center text-indigo-400 shrink-0">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
              </svg>
            </div>
            <div>
              <p class="text-xs font-bold text-white">Jadwal Real-Time</p>
              <p class="text-[11px] text-slate-400">Sinkronisasi status kegiatan</p>
            </div>
          </div>
          <div class="flex items-start gap-3">
            <div class="w-8 h-8 rounded-lg bg-indigo-500/20 flex items-center justify-center text-indigo-400 shrink-0">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
              </svg>
            </div>
            <div>
              <p class="text-xs font-bold text-white">Disposisi Petugas</p>
              <p class="text-[11px] text-slate-400">Distribusi tugas staf terdata</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer Info -->
      <div class="relative z-10 text-xs text-slate-400">
        &copy; {{ date('Y') }} SIMAPIM. Hak Cipta Dilindungi Undang-Undang.
      </div>
    </div>

    <!-- Right Login Form Column -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 lg:p-16 bg-slate-50">
      <div class="w-full max-w-md space-y-8 bg-white p-8 sm:p-10 rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-100">
        
        <!-- Mobile Logo (shown only on small screens) -->
        <div class="lg:hidden flex items-center gap-3 mb-2">
          <div class="w-10 h-10 rounded-xl bg-brand-50 p-2 border border-brand-100 flex items-center justify-center">
            <img src="{{ asset('assets/Logo_Lampung.png') }}" alt="Logo" class="w-full h-full object-contain">
          </div>
          <div>
            <h2 class="text-lg font-bold text-slate-900 leading-tight">SIMAPIM</h2>
            <p class="text-xs text-slate-500">Agenda Pimpinan</p>
          </div>
        </div>

        <div>
          <h2 class="text-2xl font-bold tracking-tight text-slate-900">
            Selamat Datang Kembali
          </h2>
          <p class="text-xs text-slate-500 mt-1">
            Silakan masukkan kredensial akun Anda untuk mengakses portal SIMAPIM.
          </p>
        </div>

        @if ($errors->any())
          <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200/80 text-rose-800 text-xs flex items-start gap-3">
            <svg class="w-4 h-4 text-rose-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <div>
              <p class="font-semibold">Autentikasi Gagal</p>
              <p class="text-rose-600 mt-0.5">Email atau password yang Anda masukkan tidak sesuai.</p>
            </div>
          </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
          @csrf

          <!-- Email Input -->
          <div>
            <label for="email" class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Email</label>
            <div class="relative">
              <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                </svg>
              </div>
              <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                placeholder="nama@instansi.go.id"
                class="block w-full ps-10 pe-4 py-2.5 text-xs text-slate-900 placeholder:text-slate-400 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition shadow-xs">
            </div>
          </div>

          <!-- Password Input -->
          <div>
            <div class="flex items-center justify-between mb-1.5">
              <label for="password" class="block text-xs font-semibold text-slate-700">Kata Sandi</label>
            </div>
            <div class="relative">
              <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
              </div>
              <input type="password" id="password" name="password" required
                placeholder="••••••••"
                class="block w-full ps-10 pe-10 py-2.5 text-xs text-slate-900 placeholder:text-slate-400 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition shadow-xs">
              <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 end-0 flex items-center pe-3.5 text-slate-400 hover:text-slate-600 focus:outline-none">
                <svg id="eye-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
              </button>
            </div>
          </div>

          <!-- Submit Button -->
          <button type="submit"
            class="w-full flex justify-center items-center gap-2 py-3 px-4 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-brand-600 to-indigo-600 hover:from-brand-700 hover:to-indigo-700 active:scale-[0.99] shadow-lg shadow-brand-500/25 transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
            <span>Masuk ke SIMAPIM</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
          </button>
        </form>

        <!-- Quick Credentials Hint for Testing -->
        <div class="pt-4 border-t border-slate-100">
          <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-2">Akun Uji Coba Cepat:</p>
          <div class="grid grid-cols-2 gap-2 text-[11px]">
            <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200/80 cursor-pointer hover:bg-brand-50 hover:border-brand-200 transition" onclick="fillLogin('admin@admin.com', 'admin123')">
              <p class="font-bold text-slate-700">Administrator</p>
              <p class="text-slate-500 text-[10px] truncate">admin@admin.com</p>
            </div>
            <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200/80 cursor-pointer hover:bg-brand-50 hover:border-brand-200 transition" onclick="fillLogin('budi@staff.com', 'password123')">
              <p class="font-bold text-slate-700">Petugas / Staff</p>
              <p class="text-slate-500 text-[10px] truncate">budi@staff.com</p>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>

  <script>
    function togglePasswordVisibility() {
      const passwordInput = document.getElementById('password');
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
      } else {
        passwordInput.type = 'password';
      }
    }

    function fillLogin(email, pass) {
      document.getElementById('email').value = email;
      document.getElementById('password').value = pass;
    }
  </script>
</body>
</html>
