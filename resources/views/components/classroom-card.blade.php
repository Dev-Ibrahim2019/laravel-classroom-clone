<a href="{{ $classroom->url }}" class="block">
    <div class="classroom-card">
        <img class="w-full h-48 object-cover" src="{{ asset($classroom->cover_image_path) }}"
            alt="{{ $classroom->name }} image">
        <div class="p-4">
            <h2 class="text-xl font-semibold text-gray-800 font-sans">{{ $classroom->name }}</h2>
            <p class="mt-1 text-gray-600 text-sm">{{ $classroom->section }} - {{ $classroom->room }}</p>
            <span class="primary-button">View Details</span>
        </div>
    </div>
</a>
