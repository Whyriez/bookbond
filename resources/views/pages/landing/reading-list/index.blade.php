@extends('layouts.app')
@section('title', 'Want To Read')
@section('wantRead', 'active')

@section('content')

    <!-- Welcome Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
        <div>
            {{-- <h1 class="text-2xl md:text-3xl font-bold mb-2">Selamat datang kembali, {{ Auth::user()->name }}!</h1> --}}
            {{-- <p class="text-gray-600">Ready to discover your next favorite book?</p> --}}
        </div>

        <div class="mt-4 md:mt-0 flex items-center space-x-4">
            <div class="relative">
                <input type="text" placeholder="Search books, authors, genres..."
                    class="pl-10 pr-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent w-full md:w-64">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>

            <div class="w-10 h-10 rounded-full bg-violet-100 flex items-center justify-center">
                <span class="text-violet-600 font-medium">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</span>
            </div>
        </div>
    </div>

    <!-- Book Recommendations -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
            <h2 class="text-2xl font-bold">Daftar Ingin membaca</h2>

            <!-- Genre Tabs -->
            <div class="flex space-x-4 mt-4 md:mt-0 overflow-x-auto pb-2">
                <div class="genre-tab active whitespace-nowrap px-2 py-1 font-medium" data-genre="all">Semua
                </div>
                {{-- @foreach ($genres as $genre)
                    <div class="genre-tab whitespace-nowrap px-2 py-1 font-medium" data-genre="{{ strtolower($genre) }}">
                        {{ ucfirst($genre) }}
                    </div>
                @endforeach --}}
            </div>
        </div>

        <!-- Book Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
             @if ($books->isEmpty())
        <div class="col-span-full flex justify-center items-center text-center text-gray-500">
            <p>Tidak ada buku daftar yang tersedia.</p>
        </div>
    @else
            @foreach ($books as $book)
                @php
                    $isAdded = in_array($book->id, $wantToReadBookIds ?? []);
                @endphp

                <x-card.book-card :book="$book" :isAdded="$isAdded" />
            @endforeach
            @endif
        </div>

    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle
            

            // Genre filtering
            const genreTabs = document.querySelectorAll('.genre-tab');
            const bookCards = document.querySelectorAll('.book-card');

            genreTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active class from all tabs
                    genreTabs.forEach(t => t.classList.remove('active'));

                    // Add active class to clicked tab
                    this.classList.add('active');

                    const genre = this.getAttribute('data-genre');

                    // Show/hide books based on genre
                    bookCards.forEach(card => {
                        if (genre === 'all' || card.getAttribute('data-genre') === genre) {
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
                                const card = button.closest('.book-card');
                                if (card) {
                                    card.remove(); // langsung hapus elemen dari halaman
                                }
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
