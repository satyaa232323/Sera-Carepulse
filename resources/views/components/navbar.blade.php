@props(['mode' => 'navbar'])

@php
$isMobile = request()->header('user-agent') && preg_match('/(iPhone|Android)/', request()->header('user-agent'));
$currentUrl = url()->current();
@endphp

<div>
    @if ($isMobile || $mode === 'sidebar')
    <aside id="sidebar" class="w-64 h-screen bg-white text-black p-4 flex flex-col justify-between absolute z-10 transition-transform duration-300 {{ $mode === 'sidebar' || session('sidebarOpen') === 'true' ? 'translate-x-0' : '-translate-x-full' }}">
        <div>
            <h1 class="text-lg font-bold text-primaryColor">SideNav</h1>
            <nav class="flex flex-col space-y-2">
                <a href="{{ url('/') }}" class="p-2 rounded {{ $currentUrl === url('/') ? 'border-b-2 border-primaryColor' : 'hover:border-b-2 hover:border-gray-300' }}">
                    Home
                </a>
                <a href="{{ url('/diary') }}" class="p-2 rounded {{ $currentUrl === url('/diary') ? 'border-b-2 border-primaryColor' : 'hover:border-b-2 hover:border-gray-300' }}">
                    Diary
                </a>
                <a href="{{ url('/about') }}" class="p-2 rounded {{ $currentUrl === url('/about') ? 'border-b-2 border-primaryColor' : 'hover:border-b-2 hover:border-gray-300' }}">
                    Chat With Joy
                </a>
            </nav>
        </div>
    </aside>
    @else
    <header class="w-full h-16 text-black flex items-center justify-between px-4 fixed z-10 bg-white">
        <div class="flex items-center">
            <img src="/favicon.ico" alt="logo" width="25" height="25" />
            <h1 class="pl-2 text-lg font-bold text-primaryColor">Carepulse</h1>
        </div>
        <nav class="absolute left-1/2 transform -translate-x-1/2 flex gap-x-12 items-center">
            <a href="{{ url('/') }}" class="pb-1 {{ $currentUrl === url('/') ? 'border-b-2 border-primaryColor' : 'hover:border-b-2 hover:border-gray-300' }}">
                Home
            </a>
            <a href="{{ url('/dashboard') }}" class="pb-1 {{ $currentUrl === url('/dashboard') ? 'border-b-2 border-primaryColor' : 'hover:border-b-2 hover:border-gray-300' }}">
                Dashboard
            </a>
            <a href="#features" class="pb-1 {{ $currentUrl === '#features' ? 'border-b-2 border-primaryColor' : 'hover:border-b-2 hover:border-gray-300' }}">
                Features
            </a>
            <a href="#testimonial" class="pb-1 {{ $currentUrl === '#testimonial' ? 'border-b-2 border-primaryColor' : 'hover:border-b-2 hover:border-gray-300' }}">
                Testimonial
            </a>
        </nav>
    </header>
    @endif

    @if ($isMobile && $mode !== 'sidebar')
    <button id="sidebar-toggle" class="fixed top-4 right-4 z-50 p-2 bg-gray-800 text-white rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
            <path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </button>
    @endif
</div>

<script>
    // JavaScript to manage sidebar state
    const sidebar = document.getElementById('sidebar');
    const toggleButton = document.getElementById('sidebar-toggle');

    if (toggleButton) {
        toggleButton.addEventListener('click', () => {
            // Toggle sidebar open/close
            const isSidebarOpen = sidebar.style.transform === 'translateX(0px)';
            sidebar.style.transform = isSidebarOpen ? 'translateX(-100%)' : 'translateX(0)';

            // Store sidebar state in sessionStorage for persistence across page reloads
            sessionStorage.setItem('sidebarOpen', !isSidebarOpen);
        });

        // On page load, check if the sidebar should be open
        if (sessionStorage.getItem('sidebarOpen') === 'true') {
            sidebar.style.transform = 'translateX(0)';
        }
    }
</script>
