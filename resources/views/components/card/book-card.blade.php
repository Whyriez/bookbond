<div class="book-card bg-white rounded-lg shadow-md overflow-hidden" data-genre="{{ $book->categories->first()->name }}">
    <div class=" bg-violet-100 relative">
        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->name }}" class="w-full h-full object-cover">
        <button
            class="want-to-read-btn px-3 py-1 rounded-full text-sm font-medium shadow-md
                                {{ $isAdded ? 'added bg-violet-600 text-white' : 'bg-white text-violet-600 hover:bg-violet-50' }}"
            data-book-id="{{ $book->id }}">
            {!! $isAdded ? '<i class="fas fa-check mr-1"></i> Ditambahkan' : '<i class="fas fa-bookmark mr-1"></i> Ingin Membaca' !!}
        </button>
    </div>

    <div class="p-4">
        <div class="flex flex-wrap gap-2 mb-3">
            @foreach ($book->categories as $category)
                <span class="genre-pill bg-pink-100 text-pink-800 text-xs px-2 py-1 rounded-full">
                    {{ $category->name }}
                </span>
            @endforeach
        </div>

        <h3 class="font-bold text-lg mb-1">{{ $book->name }}</h3>
        <p class="text-gray-600 text-sm mb-3">by {{ $book->author }}</p>

        <p class="text-gray-700 text-sm mb-4 line-clamp-3">{{ $book->description }}</p>

        <div class="flex justify-between items-center">
            <a href="{{ route('home.book.detail', $book->id) }}" class="btn-outline px-3 py-1.5 rounded-md text-sm">
                Lihat Detail
            </a>
        </div>
    </div>
</div>
