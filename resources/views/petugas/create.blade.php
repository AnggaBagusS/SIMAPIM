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
      Tambah Petugas
    </li>
  @endsection
  @include('layouts.partial.breadcrumb')

  <!-- Content -->
  <main class="w-full lg:ps-64">
    <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
      <div  class="w-full max-w-5xl bg-white dark:bg-neutral-800 rounded-lg shadow p-6">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">Tambah Petugas</h1>

        <form action="{{ route('petugas.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- First Name -->
            <div>
              <label for="firstname" class="block text-gray-700 dark:text-neutral-200 mb-1">First Name</label>
              <input type="text" name="firstname" id="firstname" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
            </div>

            <!-- Email -->
            <div>
              <label for="email" class="block text-gray-700 dark:text-neutral-200 mb-1">Email</label>
              <input type="email" name="email" id="email" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
            </div>

            <!-- Last Name -->
            <div>
              <label for="lastname" class="block text-gray-700 dark:text-neutral-200 mb-1">Last Name</label>
              <input type="text" name="lastname" id="lastname"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
            </div>

            <!-- Password -->
            <div>
              <label for="password" class="block text-gray-700 dark:text-neutral-200 mb-1">Password</label>
              <input type="password" name="password" id="password" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
            </div>

            <!-- User Role -->
            <div>
              <label for="type" class="block text-gray-700 dark:text-neutral-200 mb-1">User Role</label>
              <select name="type" id="type"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                <option value="2" selected>Petugas</option>
                <option value="1">Admin</option>
              </select>
            </div>

            <!-- Confirm Password -->
            <div>
              <label for="password_confirmation" class="block text-gray-700 dark:text-neutral-200 mb-1">Confirm Password</label>
              <input type="password" name="password_confirmation" id="password_confirmation" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
            </div>

            <!-- Avatar -->
            <div class="col-span-1 md:col-span-2">
              <label for="avatar" class="block text-gray-700 dark:text-neutral-200 mb-1">Avatar</label>
              <input type="file" name="avatar" id="avatar"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">

              <div class="mt-4 flex justify-center">
                <div class="w-24 h-24 rounded-full border border-gray-300 flex items-center justify-center text-sm text-gray-400">
                  Avatar
                </div>
              </div>
            </div>
          </div>

          <!-- Buttons -->
          <div class="flex justify-end mt-6 space-x-2">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Save</button>
            <a href="/" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-md">Cancel</a>
          </div>
        </form>
      </div>
    <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
  </main>
  <!-- End Content -->

  @include('layouts.partial.script')
</body>
</html>
