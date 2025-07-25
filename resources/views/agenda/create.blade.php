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
      Tambah Agenda
    </li>
  @endsection
  @include('layouts.partial.breadcrumb')

  <main class="w-full lg:ps-64">
    <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
      <div class="max-w-5xl mx-auto bg-white dark:bg-neutral-800 rounded-lg shadow p-6">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">Tambah Agenda</h1>

        <form action="{{ route('agenda.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Judul Acara -->
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-white mb-1">Judul Acara</label>
              <input type="text" name="judul_acara" required class="w-full border rounded px-3 py-2">
            </div>

            <!-- Tanggal -->
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-white mb-1">Tanggal</label>
              <input type="date" name="tanggal" required class="w-full border rounded px-3 py-2">
            </div>

            <!-- File Sambutan -->
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-white mb-1">File Sambutan (PDF)</label>
              <input
                type="file"
                name="file_sambutan"
                accept="application/pdf"
                class="w-full border rounded px-3 py-2"
              >
              @error('file_sambutan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
              <p class="text-xs text-gray-500 mt-1">Hanya file PDF. Maksimal 2 MB.</p>
            </div>


            <!-- Hari -->
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-white mb-1">Hari</label>
              <input type="text" name="hari" class="w-full border rounded px-3 py-2">
            </div>

            <!-- Link -->
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-white mb-1">Link (Tautan)</label>
              <input type="text" name="link" class="w-full border rounded px-3 py-2">
            </div>

            <!-- Lokasi -->
            <div class="md:col-span-2">
              <label class="block text-sm font-medium text-gray-700 dark:text-white mb-1">Lokasi</label>
              <textarea name="lokasi" rows="2" class="w-full border rounded px-3 py-2"></textarea>
            </div>

            <!-- Pejabat -->
            <div class="md:col-span-2">
              <label class="block text-sm font-medium text-gray-700 dark:text-white mb-1">Pejabat</label>
              <input type="text" name="pejabat" class="w-full border rounded px-3 py-2">
            </div>

            <!-- Petugas -->
            <div class="md:col-span-2">
              <label class="block text-sm font-medium text-gray-700 dark:text-white mb-1">Petugas</label>
              <div class="grid grid-cols-2 gap-2">
                @foreach($users as $user)
                <label class="flex items-center space-x-2 text-sm text-gray-800 dark:text-white">
                  <input type="checkbox" name="user_ids[]" value="{{ $user->id }}" class="border-gray-300 rounded text-blue-600">
                  <span>{{ $user->firstname }} {{ $user->lastname }}</span>
                </label>
                @endforeach
              </div>
              <a href="{{ route('petugas.create') }}" class="mt-2 inline-block text-blue-600 text-sm hover:underline">+ Tambah Petugas</a>
            </div>
          </div>

          <div class="flex justify-end space-x-2 mt-6">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
            <a href="{{ route('agenda.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </main>

  @include('layouts.partial.script')
</body>
</html>
