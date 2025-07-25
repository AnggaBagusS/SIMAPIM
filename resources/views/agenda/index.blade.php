<!DOCTYPE html>
<html lang="en">
<head>
  @include('layouts.partial.link')
</head>
<body class="bg-gray-50 dark:bg-neutral-900">
  @include('layouts.partial.header')
  @include('layouts.partial.sidebar')
  @section('breadcrumb')
    <li class="flex items-center text-sm text-gray-800 dark:text-neutral-400">
      <a href="{{ route('agenda.index') }}" class="hover:underline">Agenda</a>
      <svg class="shrink-0 mx-3 overflow-visible size-2.5 text-gray-400 dark:text-neutral-500" viewBox="0 0 16 16"><path d="M5 1L10.69 7.16c.18.19.18.49 0 .68L5 14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
    </li>
    <li class="text-sm font-semibold text-gray-800 truncate dark:text-neutral-400" aria-current="page">
      Daftar Agenda
    </li>
  @endsection
  @include('layouts.partial.breadcrumb')

  <main class="w-full lg:ps-64">
    <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
      <div class="max-w-7xl mx-auto bg-white dark:bg-neutral-800 rounded-lg shadow p-6">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-white mb-4">Daftar Agenda</h1>

        <!-- Filter -->
        <form method="GET" action="{{ route('agenda.index') }}" class="mb-4 flex flex-wrap gap-2 items-end">
          <div>
            <label class="block text-sm text-gray-600 dark:text-white mb-1">Tanggal Awal</label>
            <input type="date" name="start_date" value="{{ request('start_date') }}" class="border px-3 py-1 rounded w-full">
          </div>
          <div>
            <label class="block text-sm text-gray-600 dark:text-white mb-1">Tanggal Akhir</label>
            <input type="date" name="end_date" value="{{ request('end_date') }}" class="border px-3 py-1 rounded w-full">
          </div>
          <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Filter</button>
          </div>
          <div>
            <a href="{{ route('agenda.index') }}" class="inline-flex items-center bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 text-sm font-medium">Reset</a>
          </div>
        </form>

        <!-- Table -->
        <div class="overflow-x-visible">
          <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-100 dark:bg-neutral-700 text-gray-700 dark:text-neutral-300">
              <tr>
                <th class="px-4 py-2 text-left">No</th>
                <th class="px-4 py-2 text-left">Judul Acara</th>
                <th class="px-4 py-2 text-left">Tanggal</th>
                <th class="px-4 py-2 text-left">Hari</th>
                <th class="px-4 py-2 text-left">Lokasi</th>
                <th class="px-4 py-2 text-left">Pejabat</th>
                <th class="px-4 py-2 text-left">Petugas</th>
                <th class="px-4 py-2 text-left">File</th>
                <th class="px-4 py-2 text-left">Action</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:bg-neutral-800 dark:divide-neutral-700">
              @foreach ($agendas as $index => $agenda)
                <tr>
                  <td class="px-4 py-2">{{ $index + 1 }}</td>
                  <td class="px-4 py-2">{{ $agenda->judul_acara }}</td>
                  <td class="px-4 py-2">{{ \Carbon\Carbon::parse($agenda->tanggal)->format('d-m-Y') }}</td>
                  <td class="px-4 py-2">{{ $agenda->hari }}</td>
                  <td class="px-4 py-2">{{ $agenda->lokasi }}</td>
                  <td class="px-4 py-2">{{ $agenda->pejabat }}</td>
                  <td class="px-4 py-2 space-y-1">
                    @foreach ($agenda->petugas as $petugas)
                      <span class="inline-block bg-blue-600 text-white text-xs px-2 py-1 rounded">
                        {{ $petugas->firstname }} {{ $petugas->lastname }}
                      </span><br>
                    @endforeach
                  </td>
                  <td class="px-4 py-2 text-center">
                    @if ($agenda->file_sambutan)
                      <a href="{{ asset('storage/sambutan/' . $agenda->file_sambutan) }}" target="_blank" class="text-blue-500 hover:underline">
                        📄
                      </a>
                    @endif
                  </td>
                  <td class="px-4 py-2 text-sm">
                    <div class="relative inline-block text-left">
                      <button onclick="toggleDropdown({{ $agenda->id }})"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-2 py-1 rounded">
                        Action
                      </button>
                      <div id="dropdown-{{ $agenda->id }}"
                        class="absolute z-50 mt-2 w-32 bg-white border border-gray-200 rounded shadow-md hidden">
                        <a href="{{ route('agenda.show', $agenda->id) }}"
                          class="block px-4 py-2 text-sm hover:bg-gray-100">View</a>
                        <a href="{{ route('agenda.edit', $agenda->id) }}"
                          class="block px-4 py-2 text-sm hover:bg-yellow-100">Edit</a>

                        @if ($agenda->link)
                          <a href="{{ $agenda->link }}" target="_blank"
                            class="block px-4 py-2 text-sm text-blue-600 hover:bg-blue-100">Go to Link</a>
                        @endif

                        <form method="POST" action="{{ route('agenda.destroy', $agenda->id) }}"
                          onsubmit="return confirm('Yakin hapus agenda ini?')">
                          @csrf @method('DELETE')
                          <button type="submit"
                            class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-100">Delete</button>
                        </form>
                      </div>

                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>

  @include('layouts.partial.script')


</body>
</html>
