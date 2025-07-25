<!DOCTYPE html>
<html lang="en">
<head>
@include('layouts.partial.link')
</head>

<body class="bg-gray-50 dark:bg-neutral-900">
  @include('layouts.partial.header')
  @include('layouts.partial.sidebarStaff')

  @section('breadcrumb')
    <li class="flex items-center text-sm text-gray-800 dark:text-neutral-400">
      Dashboard Staff
    </li>
  @endsection
  @include('layouts.partial.breadcrumb')

  <!-- ========== MAIN CONTENT ========== -->
  <div class="w-full lg:ps-64">
    <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">

      <!-- Grid Stat Cards -->
      <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">

        <!-- Total Agenda Card -->
        <div class="flex flex-col bg-yellow-400 border border-yellow-300 shadow-2xs rounded-xl">
          <div class="p-4 md:p-5">
            <p class="text-xs uppercase text-black mb-1">Total Agenda</p>
            <div class="flex items-center gap-x-2">
              <h3 class="text-2xl font-bold text-black">{{ $totalAgenda }}</h3>
            </div>
          </div>
        </div>
      </div>
      <!-- End Grid Stat Cards -->


      <!-- Agenda Table Card -->
      <div class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
          <div class="p-1.5 min-w-full inline-block align-middle">
            <div class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden dark:bg-neutral-800 dark:border-neutral-700">
              
              <!-- Header -->
              <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
                <div>
                  <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                    Dashboard Petugas
                  </h2>
                  <p class="text-sm text-gray-500 dark:text-neutral-400">
                    Selamat datang, <strong>{{ Auth::user()->firstname }}</strong>!
                  </p>
                </div>
              </div>
              <!-- End Header -->

              <!-- Table -->
              <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                <thead class="bg-gray-50 dark:bg-neutral-800">
                  <tr>
                    <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">No</th>
                    <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Judul Acara</th>
                    <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Pejabat</th>
                    <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Petugas</th>
                    <th class="px-6 py-3 text-end text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Aksi</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                  @foreach($agendas as $index => $agenda)
                  <tr>
                    <td class="px-6 py-3">{{ $index + 1 }}</td>
                    <td class="px-6 py-3">
                      <strong class="text-gray-800 dark:text-white">{{ $agenda->judul_acara }}</strong><br>
                      <span class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($agenda->tanggal)->translatedFormat('l, d M Y') }}</span>
                    </td>
                    <td class="px-6 py-3">{{ $agenda->pejabat }}</td>
                    <td class="px-6 py-3 space-y-1">
                      @foreach($agenda->petugas as $petugas)
                        <span class="inline-block bg-blue-600 text-white text-xs px-2 py-1 rounded">
                          {{ $petugas->firstname }} {{ $petugas->lastname }}
                        </span>
                      @endforeach
                    </td>
                    <td class="px-6 py-3 text-end">
                      <a href="{{ url('/agenda/staff/' . $agenda->id) }}" class="inline-flex items-center gap-x-1 text-sm text-white bg-blue-600 px-3 py-1.5 rounded hover:bg-blue-700">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M10.293 15.707a1 1 0 001.414 0l5.707-5.707a1 1 0 000-1.414l-5.707-5.707a1 1 0 10-1.414 1.414L14.586 9H3a1 1 0 100 2h11.586l-4.293 4.293a1 1 0 000 1.414z"/>
                        </svg>
                        Lihat
                      </a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <!-- End Table -->

            </div>
          </div>
        </div>
      </div>
      <!-- End Agenda Table Card -->

    </div>
  </div>
  <!-- ========== END MAIN CONTENT ========== -->

  @include('layouts.partial.script')
</body>
</html>