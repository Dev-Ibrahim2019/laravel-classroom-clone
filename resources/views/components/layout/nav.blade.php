<nav class="bg-white border-b border-gray-200 px-4 py-2 flex items-center justify-between shadow-sm">
    <!-- Left: Logo/Title -->
    <div>
        <a href="{{ route('classrooms.index') }}" class="flex items-center space-x-3">
            <img src="https://www.gstatic.com/classroom/logo_square_rounded.svg" class="h-8 w-8" alt="Logo"
                data-iml="749250.3000000119">
            <span class="text-xl font-semibold text-gray-900">{{ config('app.name', 'Classroom ') }}</span>
        </a>
    </div>

    <!-- Right: Icons and Avatar -->
    <div class="flex items-center space-x-4">

        <a href="{{ route('classrooms.create') }}" class="p-2 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white" title="create classroom">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
        </a>

        <!-- Notification Bell -->
        <button class="p-2 rounded-full hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
        </button>

        <!-- User Avatar -->
        <button class="flex items-center focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-full">
            <img class="h-8 w-8 rounded-full" src="https://randomuser.me/api/portraits/men/32.jpg" alt="User avatar" />
        </button>
    </div>
</nav>
