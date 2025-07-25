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
      Edit Petugas
    </li>
  @endsection
  @include('layouts.partial.breadcrumb')

  <!-- ========== MAIN CONTENT ========== -->

  <!-- Content -->
  <div class="w-full lg:ps-64">
    <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
      <div class="mt-6 bg-white dark:bg-neutral-800 rounded-lg shadow p-6 max-w-2xl mx-auto">
        <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Edit Petugas</h2>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <!-- First Name -->
          <div class="mb-4">
            <label class="block text-gray-700 dark:text-neutral-200">First Name</label>
            <input type="text" name="firstname" value="{{ old('firstname', auth()->user()->firstname) }}" required
              class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300">
          </div>

          <!-- Last Name -->
          <div class="mb-4">
            <label class="block text-gray-700 dark:text-neutral-200">Last Name</label>
            <input type="text" name="lastname" value="{{ old('lastname', auth()->user()->lastname) }}"
              class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300">
          </div>

          <!-- Email -->
          <div class="mb-4">
            <label class="block text-gray-700 dark:text-neutral-200">Email</label>
            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
              class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300">
          </div>

          <!-- Password -->
          <div class="mb-4">
            <label class="block text-gray-700 dark:text-neutral-200">Password</label>
            <input type="password" name="password"
              class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300">
            <p class="text-sm text-gray-500 mt-1">Leave this blank if you don't want to change the password.</p>
          </div>

          <!-- Avatar -->
          <div class="mb-4">
            <label class="block text-gray-700 dark:text-neutral-200">Avatar</label>
            <input type="file" name="avatar"
              class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300">

            @if(auth()->user()->avatar)
              <div class="flex justify-center mt-3">
                <img src="{{ asset('storage/avatars/' . auth()->user()->avatar) }}" class="w-20 h-20 rounded-full border object-cover" alt="Avatar">
              </div>
            @endif
          </div>

          <!-- Action Buttons -->
          <div class="flex justify-end space-x-2 mt-6">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Save</button>
            <a href="{{ url()->previous() }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-md">Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Content -->

  @include('layouts.partial.script')
</body>
</html>
