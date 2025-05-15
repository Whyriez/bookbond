@extends('layouts.app')
@section('title', 'Discover')
@section('discover', 'active')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl md:text-4xl font-bold mb-2">Jelajahi</h1>
        <p class="text-gray-600">Jelajahi buku, komunitas, dan toko buku baru berdasarkan minat Anda</p>
    </div>

    <!-- Search and Filter Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="search-container w-full md:w-1/3">
                <form action="{{ route('home.discover.search') }}" method="GET">
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        <input type="text" name="search" placeholder="Cari buku, komunitas, atau toko"
                            class="search-input w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent">
                    </div>
                </form>
            </div>

            <div class="flex flex-wrap gap-2">
                <a href="{{ route('home.discover') }}"
                    class="filter-pill px-3 py-1.5 rounded-full bg-gray-100 text-sm font-medium active">Semua</a>
                <a href="{{ route('home.discover.search', ['type' => 'books']) }}"
                    class="filter-pill px-3 py-1.5 rounded-full bg-gray-100 text-sm font-medium">Buku</a>
                <a href="{{ route('home.discover.search', ['type' => 'communities']) }}"
                    class="filter-pill px-3 py-1.5 rounded-full bg-gray-100 text-sm font-medium">Komunitas</a>
                <a href="{{ route('home.discover.search', ['type' => 'bookstores']) }}"
                    class="filter-pill px-3 py-1.5 rounded-full bg-gray-100 text-sm font-medium">Toko buku</a>
            </div>

            <div class="flex items-center">
                <span class="text-sm text-gray-600 mr-2">Filter by:</span>
                <form id="genre-filter-form" action="{{ route('home.discover') }}" method="GET">
                    <select name="genre" id="genre-filter"
                        class="bg-white border border-gray-300 rounded-md px-2 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent">
                        <option value="all">Semua Genre</option>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
    </div>

    <!-- Recommended Books Section -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold mb-6 section-title">Buku Rekomendasi Untuk Anda</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <!-- Book 1 -->
            @if ($books->isEmpty())
                <div class="col-span-full flex justify-center items-center text-center text-gray-500">
                    <p>Tidak ada buku yang tersedia untuk Anda.</p>
                </div>
            @else
                @foreach ($books as $book)
                    @php
                        $isAdded = in_array($book->id, $wantToReadBookIds ?? []);
                    @endphp
                      <x-card.book-card :book="$book" :isAdded="$isAdded" />
                    {{-- <div class="book-card bg-white rounded-lg shadow-md overflow-hidden"
                        data-genre="{{ $book->categories->first()->name }}">
                        <div class="book-cover bg-violet-100 relative">
                            <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->name }}"
                                class="w-full h-full object-cover">
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
                                <div class="flex text-amber-400 text-sm">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <span class="text-gray-600 ml-1">4.8</span>
                                </div>

                                <a href="{{ route('home.book.detail', $book->id) }}"
                                    class="btn-outline px-3 py-1.5 rounded-md text-sm">
                                    Baca selengkapnya
                                </a>
                            </div>
                        </div>
                    </div> --}}
                @endforeach
            @endif
        </div>

        {{-- <div class="mt-6 text-center">
            <button class="btn-primary px-4 py-2 rounded-md font-medium">
                View More Recommendations
            </button>
        </div> --}}
    </div>

    <!-- Trending Communities Section -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold mb-6 section-title">Komunitas yang Sedang Tren</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @if ($exploreCommunities->isEmpty())
                <div class="col-span-3 text-center text-gray-500">
                    <p>Tidak ada komunitas yang tersedia untuk dijelajahi.</p>
                </div>
            @else
                @foreach ($exploreCommunities as $community)
                        <x-card.community-card :community="$community" />
                @endforeach
            @endif
        </div>

        {{-- <div class="mt-6 text-center">
            <button class="btn-outline px-4 py-2 rounded-md font-medium">
                Explore All Communities
            </button>
        </div> --}}
    </div>

    <!-- Bookstores Near You Section -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold mb-6 section-title">Toko Buku di Dekat Anda</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @if ($bookStores->isEmpty())
                <div class="col-span-full flex justify-center items-center text-center text-gray-500">
                    <p>Tidak ada buku yang tersedia untuk Anda.</p>
                </div>
            @else
                @foreach ($bookStores as $bookStore)
                    @php
                        $isAdded = in_array($book->id, $wantToReadBookIds ?? []);
                    @endphp
            
                    <x-card.bookstore-card :bookStore="$bookStore" />
                @endforeach
            @endif

            <!-- Bookstore 3 -->
            {{-- <div class="bookstore-card bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <div class="flex items-start space-x-4 mb-4">
                        <div class="bookstore-logo"
                            style="background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"200\" height=\"200\" viewBox=\"0 0 200 200\"><rect fill=\"%2310b981\" width=\"200\" height=\"200\"/><path fill=\"%23ffffff\" d=\"M60,60 L140,60 L100,140 Z\" /><text x=\"50%\" y=\"50%\" font-family=\"Arial\" font-size=\"24\" text-anchor=\"middle\" fill=\"%2310b981\">LB</text></svg>');">
                        </div>
                        <div>
                            <h3 class="font-bold text-lg mb-1">Literary Lighthouse</h3>
                            <div class="flex items-center mb-1">
                                <i class="fas fa-map-marker-alt text-gray-500 mr-1"></i>
                                <span class="text-sm text-gray-600">5.7 miles away</span>
                            </div>
                            <div class="flex text-amber-400 text-sm">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <span class="text-gray-600 ml-1">4.9 (203 reviews)</span>
                            </div>
                        </div>
                    </div>

                    <p class="text-gray-700 text-sm mb-4">A modern bookstore with a focus on contemporary literature and
                        book clubs. Features a reading lounge and writing workshops.</p>

                    <div class="mb-4">
                        <h4 class="text-sm font-medium text-gray-600 mb-2">Popular Genres</h4>
                        <div class="flex flex-wrap gap-2">
                            <span
                                class="genre-pill bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Contemporary</span>
                            <span
                                class="genre-pill bg-emerald-100 text-emerald-800 text-xs px-2 py-1 rounded-full">Poetry</span>
                            <span class="genre-pill bg-teal-100 text-teal-800 text-xs px-2 py-1 rounded-full">Memoir</span>
                            <span class="genre-pill bg-cyan-100 text-cyan-800 text-xs px-2 py-1 rounded-full">Essays</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="far fa-clock mr-1"></i>
                            <span>Open until 9:00 PM</span>
                        </div>

                        <button class="btn-outline px-3 py-1.5 rounded-md text-sm">
                            View Store
                        </button>
                    </div>
                </div>
            </div> --}}
        </div>

        {{-- <div class="mt-6 text-center">
            <button class="btn-outline px-4 py-2 rounded-md font-medium">
                Find More Bookstores
            </button>
        </div> --}}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Filter pills functionality
            const filterPills = document.querySelectorAll('.filter-pill');

            filterPills.forEach(pill => {
                pill.addEventListener('click', function() {
                    // Remove active class from all pills
                    filterPills.forEach(p => p.classList.remove('active'));

                    // Add active class to clicked pill
                    this.classList.add('active');
                });
            });

            const genreFilter = document.getElementById('genre-filter');
            if (genreFilter) {
                genreFilter.addEventListener('change', function() {
                    document.getElementById('genre-filter-form').submit();
                });
            }

            // Wishlist button functionality
            const wishlistButtons = document.querySelectorAll('.wishlist-btn');

            wishlistButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const icon = this.querySelector('i');

                    if (icon.classList.contains('far')) {
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                        this.classList.add('active');
                    } else {
                        icon.classList.remove('fas');
                        icon.classList.add('far');
                        this.classList.remove('active');
                    }
                });
            });

            // Community join button functionality
            const joinButtons = document.querySelectorAll('.community-card .btn-primary');

            joinButtons.forEach(button => {
                button.addEventListener('click', function() {
                    if (this.textContent.trim() === 'Join Community') {
                        this.textContent = 'Joined';
                        this.classList.remove('btn-primary');
                        this.classList.add('btn-secondary');

                        // After a delay, change back to "View Community"
                        setTimeout(() => {
                            this.textContent = 'View Community';
                            this.classList.remove('btn-secondary');
                            this.classList.add('btn-outline');
                        }, 1500);
                    } else if (this.textContent.trim() === 'View Community') {
                        // In a real app, this would navigate to the community page
                        alert('Navigating to community page...');
                    }
                });
            });

            // Search functionality (simplified for demo)
            const searchInput = document.querySelector('.search-input');

            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    alert(`Searching for: ${this.value}`);
                }
            });


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
                                button.innerHTML = '<i class="fas fa-check mr-1"></i> Ditambahkan';
                                button.classList.add('added', 'bg-violet-600', 'text-white');
                                button.classList.remove('bg-white', 'text-violet-600');
                            } else if (data.status === 'removed') {
                                button.innerHTML =
                                    '<i class="fas fa-bookmark mr-1"></i> Ingin Membaca';
                                button.classList.remove('added', 'bg-violet-600', 'text-white');
                                button.classList.add('bg-white', 'text-violet-600');
                            }
                        });
                });
            });
        });
    </script>

@endsection
