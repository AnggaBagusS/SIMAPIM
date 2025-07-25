<!DOCTYPE html>
<html lang="en">
<head>
  @include('layouts.partial.link')
</head>
<body class="bg-gray-100 dark:bg-neutral-900">
  @include('layouts.partial.header')
  @include('layouts.partial.sidebarStaff')

  @section('breadcrumb')
    <li class="flex items-center text-sm text-gray-800 dark:text-neutral-400">
      <a href="{{ route('DashboardStaff') }}" class="hover:underline">Agenda</a>
      <svg class="shrink-0 mx-3 overflow-visible size-2.5 text-gray-400 dark:text-neutral-500" viewBox="0 0 16 16"><path d="M5 1L10.69 7.16c.18.19.18.49 0 .68L5 14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
    </li>
    <li class="text-sm font-semibold text-gray-800 truncate dark:text-neutral-400" aria-current="page">
      Detail Agenda
    </li>
  @endsection
  @include('layouts.partial.breadcrumb')

  <main class="w-full lg:ps-64">
    <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
      <h1 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">Detail Agenda</h1>
      

      <!-- Detail Arsip -->
      <div class="bg-white dark:bg-neutral-800 rounded-lg shadow p-6 mb-6">
          <div class="flex justify-end">
              <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white hover:bg-blue-600 rounded shadow-sm text-sm font-medium">
                  Kembali
              </a>
          </div>
        <h2 class="text-lg font-bold text-gray-800 dark:text-white mb-4 border-b pb-2">
          Detail Arsip Agenda Pimpinan
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700 dark:text-white">
          <div><strong>Judul Acara</strong><br>{{ $agenda->judul_acara }}</div>
          <div><strong>Tanggal</strong><br>{{ \Carbon\Carbon::parse($agenda->tanggal)->format('d-m-Y') }} ({{ \Carbon\Carbon::parse($agenda->tanggal)->isoFormat('dddd') }})</div>
          <div><strong>Lokasi</strong><br>{{ $agenda->lokasi }}</div>
          <div><strong>Pejabat Hadir</strong><br>{{ $agenda->pejabat }}</div>

          <div class="md:col-span-2">
            <strong>File Sambutan</strong><br>
            @if ($agenda->file_sambutan)
              📄 <a href="{{ asset('storage/sambutan/' . $agenda->file_sambutan) }}" target="_blank" class="text-blue-600 hover:underline">Lihat File</a>
            @else
              <span class="text-gray-500">Tidak ada file</span>
            @endif
          </div>

          <div class="md:col-span-2">
            <strong>Link Terkait</strong><br>
            @if ($agenda->link)
              <a href="{{ $agenda->link }}" target="_blank" class="text-blue-600 hover:underline">{{ $agenda->link }}</a>
            @else
              <span class="text-gray-500">Tidak tersedia</span>
            @endif
          </div>
        </div>
      </div>

      <!-- Petugas Agenda -->
      <div class="bg-white dark:bg-neutral-800 rounded-lg shadow p-6">
        <h2 class="text-lg font-bold text-gray-800 dark:text-white mb-4 border-b pb-2">Petugas Agenda:</h2>

        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
          @foreach($agenda->petugas as $petugas)
            <div class="flex items-center space-x-3">
              <img src="{{ asset('storage/avatars/' . ($petugas->avatar ?? 'no-image-available.png')) }}"
                   alt="Avatar" class="w-12 h-12 rounded-full object-cover border">
              <span class="text-sm font-medium text-gray-900 dark:text-white">
                {{ $petugas->firstname }} {{ $petugas->lastname }}
              </span>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </main>

  @include('layouts.partial.script')
</body>
</html>
