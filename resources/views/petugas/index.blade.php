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
      Daftar Petugas
    </li>
  @endsection
  @include('layouts.partial.breadcrumb')

<!-- Content -->
<div class="w-full lg:ps-64">
  <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
      <!-- Card -->
      <div class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
          <div class="p-1.5 min-w-full inline-block align-middle">
            <div class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden dark:bg-neutral-800 dark:border-neutral-700">
              
              <!-- Header -->
              <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
                <div>
                  <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                    Daftar Petugas
                  </h2>
                </div>
              </div>
              <!-- End Header -->

              <!-- Table -->
              <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                <thead class="bg-gray-50 dark:bg-neutral-800">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">No</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Action</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                  @foreach($users as $index => $user)
                  <tr>
                    <td class="px-6 py-3">{{ $index + 1 }}</td>
                    <td class="px-6 py-3 font-semibold text-gray-900 dark:text-white">{{ $user->firstname }} {{ $user->lastname }}</td>
                    <td class="px-6 py-3 text-gray-700 dark:text-neutral-300">{{ $user->email }}</td>
                    <td class="px-6 py-3 text-gray-700 dark:text-neutral-300">
                      {{ $user->type == 1 ? 'Admin' : 'Petugas' }}
                    </td>
                    <td class="px-6 py-3 space-x-2">
                      <a href="{{ route('petugas.show', $user->id) }}"
                        class="inline-block px-3 py-1 text-xs bg-blue-100 text-blue-600 rounded hover:bg-blue-200">
                        View
                      </a>
                      <a href="{{ route('petugas.edit', $user->id) }}"
                        class="inline-block px-3 py-1 text-xs bg-yellow-100 text-yellow-600 rounded hover:bg-yellow-200">
                        Edit
                      </a>
                      <form action="{{ route('petugas.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                          class="px-3 py-1 text-xs bg-red-100 text-red-600 rounded hover:bg-red-200">
                          Delete
                        </button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <!-- End Table -->

              <!-- Footer -->
              <div class="px-6 py-4 border-t border-gray-200 dark:border-neutral-700">
                {{ $users->links() }}
              </div>
              <!-- End Footer -->

            </div>
          </div>
        </div>
      </div>
      <!-- End Card -->
  </div>
</div>
<!-- End Content -->

  @include('layouts.partial.script')
</body>
</html>
