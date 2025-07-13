<a href="{{ route('classrooms.show', $classroom->id) }}" class="block">
    <div class="classroom-card">
        <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $classroom->cover_image_path ) ?? 'https://placehold.co/400x200?text=Classroom+Image' }}"
            alt="{{ $classroom->name }} image">
        <div class="p-4">
            <h2 class="text-xl font-semibold text-gray-800 font-sans">{{ $classroom->name }}</h2>
            <p class="mt-1 text-gray-600 text-sm">{{ $classroom->section }} - {{ $classroom->room }}</p>
            <span class="primary-button">View Details</span>
        </div>
    </div>
</a>
