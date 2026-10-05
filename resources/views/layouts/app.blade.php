<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
  @include('layouts.partial.link')
  @yield('styles')
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-full flex flex-col font-sans selection:bg-brand-500 selection:text-white">

  <!-- Header -->
  @include('layouts.partial.header')

  <!-- Role-based Dynamic Sidebar -->
  @if(Auth::check() && Auth::user()->type == 1)
    @include('layouts.partial.sidebar')
  @else
    @include('layouts.partial.sidebarStaff')
  @endif

  <!-- Mobile Breadcrumb Bar -->
  <div class="sticky top-0 inset-x-0 z-20 bg-white/80 backdrop-blur-md border-b border-slate-200/80 px-4 py-2.5 lg:hidden flex items-center gap-3">
    <button type="button" class="p-1.5 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-100" data-hs-overlay="#hs-application-sidebar">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
    </button>
    <div class="text-xs font-semibold text-slate-600 truncate">
      @yield('page-title', 'SIMAPIM')
    </div>
  </div>

  <!-- Main Content Wrapper -->
  <main class="w-full lg:ps-64 flex-1 pb-16 transition-all duration-300">
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8 space-y-6">
      @yield('content')
    </div>
  </main>

  <!-- Global Scripts & Toasts -->
  @include('layouts.partial.script')
  @yield('scripts')

</body>
</html>
