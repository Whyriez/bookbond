@extends('layouts.app')
@section('title', 'Home')
@section('home', 'active')

@section('content')

    <!-- Welcome Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold mb-2">Selamat Datang kembali, {{ Auth::user()->name }}!</h1>
            <p class="text-gray-600">Siap menemukan buku favorit Anda berikutnya?</p>
        </div>

        <div class="mt-4 md:mt-0 flex items-center space-x-4">
            <div class="relative">
                <input type="text" placeholder="Cari buku, penulis, genre..."
                    class="pl-10 pr-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent w-full md:w-64">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>

            <div class="w-10 h-10 rounded-full bg-violet-100 flex items-center justify-center">
                <span class="text-violet-600 font-medium">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</span>
            </div>
        </div>
    </div>

    <!-- Reading Stats -->
    <div class="reading-stats p-6 mb-8 text-white">
        <h2 class="text-xl font-bold mb-4">Dashboard</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="stat-card p-4">
                <p class="text-sm opacity-80">Buku yang Ingin Dibaca</p>
                <div class="flex items-end space-x-2">
                    <span class="text-3xl font-bold">{{ $wantToReadCount }}</span>
                </div>
            </div>

            <div class="stat-card p-4">
                <p class="text-sm opacity-80">Komunitas Anda</p>
                <div class="flex items-end space-x-2">
                    <span class="text-3xl font-bold">{{ $communityCount }}</span>
                </div>
            </div>


            {{-- <div class="stat-card p-4">
                <p class="text-sm opacity-80">Reading Goal</p>
                <div class="flex items-end space-x-2">
                    <span class="text-3xl font-bold">48%</span>
                    <span class="text-sm opacity-80">completed</span>
                </div>
            </div>

            <div class="stat-card p-4">
                <p class="text-sm opacity-80">Want to Read</p>
                <div class="flex items-end space-x-2">
                    <span class="text-3xl font-bold">24</span>
                    <span class="text-sm opacity-80">books</span>
                </div>
            </div> --}}
        </div>
    </div>

    <!-- Book Recommendations -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
            <h2 class="text-2xl font-bold">Direkomendasikan untuk Anda</h2>

            <!-- Genre Tabs -->
            <div class="flex space-x-4 mt-4 md:mt-0 overflow-x-auto pb-2">
                <div class="genre-tab active whitespace-nowrap px-2 py-1 font-medium" data-genre="all">Semua
                </div>
                @foreach ($genres as $genre)
                    <div class="genre-tab whitespace-nowrap px-2 py-1 font-medium" data-genre="{{ strtolower($genre) }}">
                        {{ ucfirst($genre) }}
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Book Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @if ($books->isEmpty())
                <div class="col-span-full flex justify-center items-center text-center text-gray-500">
                    <p>Tidak ada buku yang direkomendasikan tersedia untuk Anda.</p>
                </div>
            @else
                @foreach ($books as $book)
                    @php
                        $isAdded = in_array($book->id, $wantToReadBookIds ?? []);
                    @endphp
                    <div class="book-card bg-white rounded-lg shadow-md overflow-hidden"
                        data-genre="{{ strtolower($book->categories->pluck('name')->implode(',')) }}">
                        <div class="bg-violet-100 relative">
                            <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->name }}"
                                class="w-full h-full object-cover">
                            <button
                                class="want-to-read-btn px-3 py-1 rounded-full text-sm font-medium shadow-md
                                {{ $isAdded ? 'added bg-violet-600 text-white' : 'bg-white text-violet-600 hover:bg-violet-50' }}"
                                data-book-id="{{ $book->id }}">
                                {!! $isAdded ? '<i class="fas fa-check mr-1"></i> Added' : '<i class="fas fa-bookmark mr-1"></i> Want to Read' !!}
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
                            <p class="text-gray-600 text-sm mb-3">oleh {{ $book->author }}</p>

                            <p class="text-gray-700 text-sm mb-4 line-clamp-3">{{ $book->description }}</p>

                            <div class="flex justify-between items-center">
                                <a href="{{ route('home.book.detail', $book->id) }}"
                                    class="btn-outline px-3 py-1.5 rounded-md text-sm">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

    </div>

    <!-- Book Clubs Section -->
    {{-- <div class="mb-8">
        <h2 class="text-2xl font-bold mb-6">Upcoming Book Club Meetings</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="book-club-card bg-white p-5 shadow-md">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="font-bold text-lg">Fantasy Readers Club</h3>
                    <span class="bg-violet-100 text-violet-800 text-xs px-2 py-1 rounded">Tomorrow</span>
                </div>
                <p class="text-sm text-gray-600 mb-3">Discussing "The Midnight Crown" by Sarah J. Maas</p>
                <div class="flex items-center text-sm text-gray-600 mb-4">
                    <i class="far fa-clock mr-2"></i>
                    <span>7:00 PM - 8:30 PM</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex -space-x-2">
                        <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center border-2 border-white">
                            <span class="text-red-600 text-xs font-medium">AB</span>
                        </div>
                        <div
                            class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center border-2 border-white">
                            <span class="text-blue-600 text-xs font-medium">TK</span>
                        </div>
                        <div
                            class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center border-2 border-white">
                            <span class="text-green-600 text-xs font-medium">MJ</span>
                        </div>
                        <div
                            class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center border-2 border-white">
                            <span class="text-gray-600 text-xs font-medium">+5</span>
                        </div>
                    </div>
                    <button class="text-violet-600 hover:text-violet-800 font-medium text-sm">
                        Join Meeting
                    </button>
                </div>
            </div>

            <div class="book-club-card bg-white p-5 shadow-md">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="font-bold text-lg">Mystery Lovers</h3>
                    <span class="bg-amber-100 text-amber-800 text-xs px-2 py-1 rounded">In 3 days</span>
                </div>
                <p class="text-sm text-gray-600 mb-3">Discussing "The Silent Witness" by Agatha Reynolds
                </p>
                <div class="flex items-center text-sm text-gray-600 mb-4">
                    <i class="far fa-clock mr-2"></i>
                    <span>6:30 PM - 8:00 PM</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex -space-x-2">
                        <div
                            class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center border-2 border-white">
                            <span class="text-purple-600 text-xs font-medium">SL</span>
                        </div>
                        <div
                            class="w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center border-2 border-white">
                            <span class="text-yellow-600 text-xs font-medium">RB</span>
                        </div>
                        <div
                            class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center border-2 border-white">
                            <span class="text-gray-600 text-xs font-medium">+3</span>
                        </div>
                    </div>
                    <button class="text-violet-600 hover:text-violet-800 font-medium text-sm">
                        Join Meeting
                    </button>
                </div>
            </div>

            <div class="book-club-card bg-white p-5 shadow-md">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="font-bold text-lg">Sci-Fi Explorers</h3>
                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">Next Week</span>
                </div>
                <p class="text-sm text-gray-600 mb-3">Discussing "Quantum Horizon" by Robert Chen</p>
                <div class="flex items-center text-sm text-gray-600 mb-4">
                    <i class="far fa-clock mr-2"></i>
                    <span>7:30 PM - 9:00 PM</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex -space-x-2">
                        <div
                            class="w-8 h-8 rounded-full bg-pink-100 flex items-center justify-center border-2 border-white">
                            <span class="text-pink-600 text-xs font-medium">EW</span>
                        </div>
                        <div
                            class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center border-2 border-white">
                            <span class="text-indigo-600 text-xs font-medium">JD</span>
                        </div>
                        <div
                            class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center border-2 border-white">
                            <span class="text-gray-600 text-xs font-medium">+7</span>
                        </div>
                    </div>
                    <button class="text-violet-600 hover:text-violet-800 font-medium text-sm">
                        Join Meeting
                    </button>
                </div>
            </div>
        </div>
    </div> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle
          

            // Genre filtering
            const genreTabs = document.querySelectorAll('.genre-tab');
            const bookCards = document.querySelectorAll('.book-card');

            genreTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    genreTabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');

                    const genre = this.getAttribute('data-genre');

                    bookCards.forEach(card => {
                        const cardGenres = card.getAttribute('data-genre').split(',');
                        if (genre === 'all' || cardGenres.includes(genre)) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });


            // Want to Read button functionality
            const wantToReadBtns = document.querySelectorAll('.want-to-read-btn');

            wantToReadBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const bookId = this.dataset.bookId;
                    const button = this;

                    fetch(`/books/${bookId}/want-to-read`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content'),
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                bookId: bookId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'added') {
                                button.innerHTML = '<i class="fas fa-check mr-1"></i> Added';
                                button.classList.add('added', 'bg-violet-600', 'text-white');
                                button.classList.remove('bg-white', 'text-violet-600');
                            } else if (data.status === 'removed') {
                                button.innerHTML =
                                    '<i class="fas fa-bookmark mr-1"></i> Want to Read';
                                button.classList.remove('added', 'bg-violet-600', 'text-white');
                                button.classList.add('bg-white', 'text-violet-600');
                            }
                        });
                });
            });


            // Book card hover effect
            const bookCovers = document.querySelectorAll('.book-cover');

            bookCovers.forEach(cover => {
                cover.addEventListener('mouseover', function() {
                    const btn = this.querySelector('.want-to-read-btn');
                    btn.style.opacity = '1';
                });

                cover.addEventListener('mouseout', function() {
                    const btn = this.querySelector('.want-to-read-btn');
                    if (!btn.classList.contains('added')) {
                        btn.style.opacity = '0';
                    }
                });
            });
        });
    </script>

@endsection
