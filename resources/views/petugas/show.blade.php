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
      <a href="{{ route('petugas.index') }}" class="hover:underline">Petugas</a>
      <svg class="shrink-0 mx-3 overflow-visible size-2.5 text-gray-400 dark:text-neutral-500" viewBox="0 0 16 16"><path d="M5 1L10.69 7.16c.18.19.18.49 0 .68L5 14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
    </li>
    <li class="text-sm font-semibold text-gray-800 truncate dark:text-neutral-400" aria-current="page">
      Detail Petugas
    </li>
  @endsection
  @include('layouts.partial.breadcrumb')

  <main class="w-full lg:ps-64">
    <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
      <div class="max-w-3xl mx-auto bg-white dark:bg-neutral-800 rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-6">
          <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Detail Petugas</h1>
          <a href="{{ url()->previous() }}"
            class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 text-sm">
            ← Kembali
          </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Avatar -->
          <div class="md:col-span-2 flex justify-center">
            <img src="{{ asset('storage/avatars/' . $user->avatar) }}"
                alt="Avatar"
                class="w-32 h-32 rounded-full border object-cover">
          </div>

          <!-- Nama Depan -->
          <div>
            <label class="block text-sm text-gray-600 dark:text-neutral-300 mb-1">Nama Depan</label>
            <div class="text-base font-medium text-gray-900 dark:text-white">
              {{ $user->firstname }}
            </div>
          </div>

          <!-- Nama Belakang -->
          <div>
            <label class="block text-sm text-gray-600 dark:text-neutral-300 mb-1">Nama Belakang</label>
            <div class="text-base font-medium text-gray-900 dark:text-white">
              {{ $user->lastname }}
            </div>
          </div>

          <!-- Email -->
          <div class="md:col-span-2">
            <label class="block text-sm text-gray-600 dark:text-neutral-300 mb-1">Email</label>
            <div class="text-base font-medium text-gray-900 dark:text-white">
              {{ $user->email }}
            </div>
          </div>

          <!-- Role -->
          <div class="md:col-span-2">
            <label class="block text-sm text-gray-600 dark:text-neutral-300 mb-1">Role</label>
            <div class="text-base font-medium text-gray-900 dark:text-white">
              {{ $user->type == 1 ? 'Admin' : 'Petugas' }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  @include('layouts.partial.script')
</body>
</html>
