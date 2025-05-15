@extends('layouts.app')
@section('title', 'Discover')
@section('discover', 'active')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="search-container w-full md:w-1/3">
                    <form action="{{ route('home.discover.search') }}" method="GET">
                        <div class="relative">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            <input type="text" name="search" value="{{ $search }}"
                                placeholder="Cari buku, komunitas, atau toko"
                                class="search-input w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent">
                        </div>
                    </form>
                </div>

                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('home.discover.search', ['search' => $search, 'type' => 'all']) }}"
                        class="filter-pill px-3 py-1.5 rounded-full bg-gray-100 text-sm font-medium {{ $type == 'all' ? 'bg-violet-600 text-white' : '' }}">
                        Semua
                    </a>
                    <a href="{{ route('home.discover.search', ['search' => $search, 'type' => 'books']) }}"
                        class="filter-pill px-3 py-1.5 rounded-full bg-gray-100 text-sm font-medium {{ $type == 'books' ? 'bg-violet-600 text-white' : '' }}">
                        Buku
                    </a>
                    <a href="{{ route('home.discover.search', ['search' => $search, 'type' => 'communities']) }}"
                        class="filter-pill px-3 py-1.5 rounded-full bg-gray-100 text-sm font-medium {{ $type == 'communities' ? 'bg-violet-600 text-white' : '' }}">
                        Komunitas
                    </a>
                    <a href="{{ route('home.discover.search', ['search' => $search, 'type' => 'bookstores']) }}"
                        class="filter-pill px-3 py-1.5 rounded-full bg-gray-100 text-sm font-medium {{ $type == 'bookstores' ? 'bg-violet-600 text-white' : '' }}">
                        Toko buku
                    </a>
                </div>

                <div class="flex items-center">
                    <span class="text-sm text-gray-600 mr-2">Filter by:</span>
                    <form id="genre-filter-form" action="{{ route('home.discover.search') }}" method="GET">
                        <input type="hidden" name="search" value="{{ $search }}">
                        <input type="hidden" name="type" value="{{ $type }}">
                        <select name="genre" id="genre-filter"
                            class="bg-white border border-gray-300 rounded-md px-2 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent">
                            <option value="all">Semua Genre</option>
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}"
                                    {{ request('genre') == $genre->id ? 'selected' : '' }}>
                                    {{ $genre->name }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
        </div>

        <!-- Search Results -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-6 section-title">Hasil Pencarian untuk "{{ $search }}"</h2>

            @if (($type == 'all' || $type == 'books') && count($books) > 0)
                <div class="mb-8">
                    <h3 class="text-xl font-semibold mb-4">Books</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach ($books as $book)
                            @php
                                $isAdded = in_array($book->id, $wantToReadBookIds ?? []);
                            @endphp
                            <x-card.book-card :book="$book" :isAdded="$isAdded" />
                        @endforeach
                    </div>

                    @if ($books->hasPages())
                        <div class="mt-6">
                            {{ $books->appends(['search' => $search, 'type' => $type])->links() }}
                        </div>
                    @endif
                </div>
            @endif

            @if (($type == 'all' || $type == 'communities') && count($communities) > 0)
                <div class="mb-8">
                    <h3 class="text-xl font-semibold mb-4">Communities</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($communities as $community)
                            <x-card.community-card :community="$community" />
                        @endforeach
                    </div>

                    @if ($communities->hasPages())
                        <div class="mt-6">
                            {{ $communities->appends(['search' => $search, 'type' => $type])->links() }}
                        </div>
                    @endif
                </div>
            @endif

            @if (($type == 'all' || $type == 'bookstores') && count($bookstores) > 0)
                <div class="mb-8">
                    <h3 class="text-xl font-semibold mb-4">Bookstores</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach ($bookstores as $bookStore)
                            <x-card.bookstore-card :bookStore="$bookStore" />
                        @endforeach
                    </div>

                    @if ($bookstores->hasPages())
                        <div class="mt-6">
                            {{ $bookstores->appends(['search' => $search, 'type' => $type])->links() }}
                        </div>
                    @endif
                </div>
            @endif

            @if (
                ($type == 'all' && count($books) == 0 && count($communities) == 0 && count($bookstores) == 0) ||
                    ($type == 'books' && count($books) == 0) ||
                    ($type == 'communities' && count($communities) == 0) ||
                    ($type == 'bookstores' && count($bookstores) == 0))
                <div class="text-center py-12">
                    <i class="fas fa-search text-gray-300 text-5xl mb-4"></i>
                    <h3 class="text-xl font-medium text-gray-600 mb-2">No results found</h3>
                    <p class="text-gray-500">We couldn't find any results for "{{ $search }}"</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Filter by genre functionality
            const genreFilter = document.getElementById('genre-filter');
            if (genreFilter) {
                genreFilter.addEventListener('change', function() {
                    document.getElementById('genre-filter-form').submit();
                });
            }

            // Want to read button functionality
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
