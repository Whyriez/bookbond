@extends('layouts.landing')
@section('title', 'All Books - BookBond')

@section('content')

    <!-- Featured Books Section -->
    <section id="books" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 md:px-6">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Semua Buku</h2>
                    <p class="text-gray-600 max-w-2xl">
                        Temukan buku yang paling banyak dibicarakan di komunitas kami bulan ini.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @if ($books->isEmpty())
                    <div class="col-span-full flex justify-center items-center text-center text-gray-500">
                        <p>Tidak ada buku yang tersedia untuk Anda.</p>
                    </div>
                @else
                    @foreach ($books as $book)
                        @php
                            $isAdded = in_array($book->id, $wantToReadBookIds ?? []);
                        @endphp
                        <div class="book-card bg-white rounded-lg shadow-md overflow-hidden"
                            data-genre="{{ $book->categories->first()->name }}">
                            <div class="book-cover bg-violet-100 relative">
                                <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->name }}"
                                    class="w-full h-full object-cover">

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
                {{-- <div class="book-card">
                    <div class="bg-white p-3 rounded-lg shadow-md">
                        <div class="aspect-w-2 aspect-h-3 mb-4">
                            <div class="w-full h-64 bg-indigo-600 rounded-md"></div>
                        </div>
                        <h3 class="font-bold text-gray-800 mb-1 truncate">
                            The Silent Echo
                        </h3>
                        <p class="text-sm text-gray-600 mb-2">Sarah Johnson</p>
                        <div class="flex items-center">
                            <div class="flex text-yellow-400">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            </div>
                            <span class="text-sm text-gray-600 ml-1">(128)</span>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>

@endsection
