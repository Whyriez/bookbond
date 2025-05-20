@extends('layouts.landing')
@section('title', 'BookBond - Terhubung dengan Buku dan Pembaca')

@section('content')

    <!-- Hero Section -->
    <section class="hero-pattern py-20 md:py-28">
        <div class="container mx-auto px-4 md:px-6">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6">
                        Temukan Buku yang Kamu Sukai,
                        <span class="text-indigo-600">Bergabunglah dengan Pembaca</span> yang Memiliki
                        Semangat yang Sama
                    </h1>
                    <p class="text-lg md:text-xl text-gray-600 mb-8 max-w-lg">
                        Terhubung dengan sesama pecinta buku, temukan bacaan seru berikutnya,
                        dan cari toko buku lokal yang menyediakan buku favoritmu.
                    </p>

                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="#"
                            class="btn-primary px-8 py-3 rounded-lg font-semibold text-white text-center shadow-lg">
                            Bergabung Sekarang
                        </a>
                        <a href="#how-it-works" class="btn-secondary px-8 py-3 rounded-lg font-semibold text-center">
                            Pelajari lebih lanjut
                        </a>
                    </div>
                </div>
                <div class="md:w-1/2 relative">
                    <div class="relative z-10">
                        <svg class="w-full h-auto" viewBox="0 0 500 400" xmlns="http://www.w3.org/2000/svg">
                            <!-- Bookshelf -->
                            <rect x="50" y="100" width="400" height="20" fill="#8b5a2b" />
                            <rect x="50" y="120" width="400" height="10" fill="#6d4423" />
                            <rect x="50" y="250" width="400" height="20" fill="#8b5a2b" />
                            <rect x="50" y="270" width="400" height="10" fill="#6d4423" />

                            <!-- Books on top shelf -->
                            <rect x="60" y="30" width="30" height="70" fill="#5046e5" />
                            <rect x="95" y="40" width="25" height="60" fill="#e53e3e" />
                            <rect x="125" y="25" width="35" height="75" fill="#38a169" />
                            <rect x="165" y="35" width="28" height="65" fill="#d69e2e" />
                            <rect x="198" y="45" width="32" height="55" fill="#805ad5" />
                            <rect x="235" y="20" width="30" height="80" fill="#3182ce" />
                            <rect x="270" y="40" width="25" height="60" fill="#e53e3e" />
                            <rect x="300" y="30" width="40" height="70" fill="#38a169" />
                            <rect x="345" y="25" width="30" height="75" fill="#d69e2e" />
                            <rect x="380" y="35" width="35" height="65" fill="#805ad5" />
                            <rect x="420" y="40" width="25" height="60" fill="#3182ce" />

                            <!-- Books on bottom shelf -->
                            <rect x="60" y="180" width="35" height="70" fill="#3182ce" />
                            <rect x="100" y="190" width="28" height="60" fill="#38a169" />
                            <rect x="133" y="175" width="32" height="75" fill="#e53e3e" />
                            <rect x="170" y="185" width="30" height="65" fill="#5046e5" />
                            <rect x="205" y="195" width="25" height="55" fill="#d69e2e" />
                            <rect x="235" y="170" width="40" height="80" fill="#805ad5" />
                            <rect x="280" y="190" width="30" height="60" fill="#3182ce" />
                            <rect x="315" y="180" width="35" height="70" fill="#38a169" />
                            <rect x="355" y="175" width="28" height="75" fill="#e53e3e" />
                            <rect x="388" y="185" width="32" height="65" fill="#5046e5" />
                            <rect x="425" y="190" width="20" height="60" fill="#d69e2e" />

                            <!-- Person silhouette -->
                            <circle cx="250" cy="350" r="30" fill="#4a5568" />
                            <rect x="235" y="380" width="30" height="50" fill="#4a5568" />
                            <rect x="220" y="390" width="15" height="40" fill="#4a5568" />
                            <rect x="265" y="390" width="15" height="40" fill="#4a5568" />
                        </svg>
                    </div>
                    <div
                        class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-indigo-100 rounded-full w-64 h-64 opacity-50 blur-xl -z-10">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="bg-white py-12">
        <div class="container mx-auto px-4 md:px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="p-4">
                    <p class="text-3xl md:text-4xl font-bold text-indigo-600 mb-2">
                        10k+
                    </p>
                    <p class="text-gray-600">Pembaca Aktif</p>
                </div>
                <div class="p-4">
                    <p class="text-3xl md:text-4xl font-bold text-indigo-600 mb-2">
                        500+
                    </p>
                    <p class="text-gray-600">Komunitas Membaca</p>
                </div>
                <div class="p-4">
                    <p class="text-3xl md:text-4xl font-bold text-indigo-600 mb-2">
                        50k+
                    </p>
                    <p class="text-gray-600">Buku-buku yang Ditemukan</p>
                </div>
                <div class="p-4">
                    <p class="text-3xl md:text-4xl font-bold text-indigo-600 mb-2">
                        200+
                    </p>
                    <p class="text-gray-600">Toko Buku Mitra</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 md:px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    Cara Kerja BookBond
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Bergabunglah dengan komunitas kami dalam tiga langkah mudah dan mulailah perjalanan Anda untuk menemukan
                    buku dan terhubung dengan pembaca lainnya.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-md text-center">
                    <div class="bg-indigo-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-indigo-600" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Buat Profil Anda</h3>
                    <p class="text-gray-600 mb-4">
                        Ceritakan kepada kami tentang preferensi bacaan Anda, genre favorit, dan buku yang Anda nikmati.
                    </p>
                    <a href="{{ route('register') }}"
                        class="text-indigo-600 font-medium hover:text-indigo-800 inline-flex items-center">
                        Ayo Mulai
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-md text-center">
                    <div class="bg-indigo-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-indigo-600" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Bergabunglah dengan Komunitas</h3>
                    <p class="text-gray-600 mb-4">
                        Terhubung dengan pembaca yang memiliki minat yang sama dan ikut berdiskusi tentang buku-buku
                        favoritmu.
                    </p>
                    <a href="#" class="text-indigo-600 font-medium hover:text-indigo-800 inline-flex items-center">
                        Temukan Komunitas
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-md text-center">
                    <div class="bg-indigo-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-indigo-600" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10.496 2.132a1 1 0 00-.992 0l-7 4A1 1 0 003 8v7a1 1 0 100 2h14a1 1 0 100-2V8a1 1 0 00.496-1.868l-7-4zM6 9a1 1 0 00-1 1v3a1 1 0 102 0v-3a1 1 0 00-1-1zm3 1a1 1 0 012 0v3a1 1 0 11-2 0v-3zm5-1a1 1 0 00-1 1v3a1 1 0 102 0v-3a1 1 0 00-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Temukan & Beli</h3>
                    <p class="text-gray-600 mb-4">
                        Temukan buku-buku baru sesuai dengan preferensi Anda dan belilah dari toko buku mitra kami.
                    </p>
                    <a href="#" class="text-indigo-600 font-medium hover:text-indigo-800 inline-flex items-center">
                        Mulai Menjelajah
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Communities Section -->
    <section id="communities" class="py-16 bg-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">
                        Komunitas Populer
                    </h2>
                    <p class="text-gray-600 max-w-2xl">
                        Bergabunglah dengan komunitas pembaca yang berkembang pesat ini yang memiliki minat sastra yang sama
                        dengan Anda.
                    </p>
                </div>
                <a href="{{ route('guest.all.popular.community') }}"
                    class="hidden md:inline-flex items-center text-indigo-600 font-medium hover:text-indigo-800">
                    Lihat Semua Komunitas
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                        </path>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($allCommunities as $community)
                    <div class="community-card bg-white shadow-md">
                        <div class="h-40 relative overflow-hidden"
                            style="background-color: {{ $community->random_color }};">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg viewBox="0 0 200 80" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                                    <path fill="#ffffff" fill-opacity="0.2" d="{{ $community->random_shape }}"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-3">
                                <h3 class="text-xl font-bold">{{ $community->name }}</h3>
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                    {{ number_format($community->users_count) }} anggota</span>
                            </div>
                            <p class="text-gray-600 mb-4">
                                {{ $community->description }}
                            </p>
                            <div class="flex items-center justify-between">
                                <div class="flex -space-x-2">
                                    @foreach ($community->users->take(3) as $user)
                                        <div
                                            class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center text-white text-xs">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                    @endforeach
                                    @if ($community->users_count > 3)
                                        <div
                                            class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 text-xs">
                                            +{{ $community->users_count - 3 }}
                                        </div>
                                    @endif
                                </div>

                                <a href="{{ route('login') }}"
                                    class="text-indigo-600 font-medium hover:text-indigo-800">Gabung</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="p-3 text-gray-500 italic w">tidak ada komunitas yang populer.</p>
                @endforelse
            </div>

            <div class="text-center mt-10 md:hidden">
                <a href="{{ route('guest.all.popular.community') }}"
                    class="inline-flex items-center text-indigo-600 font-medium hover:text-indigo-800">
                    Lihat Semua Komunitas
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Books Section -->
    <section id="books" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 md:px-6">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Buku Pilihan</h2>
                    <p class="text-gray-600 max-w-2xl">
                        Temukan buku yang paling banyak dibicarakan di komunitas kami bulan ini.
                    </p>
                </div>
                <a href="{{ route('guest.all.books') }}"
                    class="hidden md:inline-flex items-center text-indigo-600 font-medium hover:text-indigo-800">
                    Telusuri Semua Buku
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                        </path>
                    </svg>
                </a>
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
            </div>

            <div class="text-center mt-10 md:hidden">
                <a href="{{ route('guest.all.books') }}"
                    class="inline-flex items-center text-indigo-600 font-medium hover:text-indigo-800">
                    Telusuri Semua Buku
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </section>


    <!-- Partner Bookstores Section -->
    <section id="bookstores" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 md:px-6">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-4"> Toko Buku Mitra</h2>
                    <p class="text-gray-600 max-w-2xl">
                        Dukung bisnis lokal dengan membeli buku dari toko buku mitra kami.
                    </p>
                </div>
                <a href="{{ route('guest.all.book.store') }}"
                    class="hidden md:inline-flex items-center text-indigo-600 font-medium hover:text-indigo-800">
                    Telusuri Semua Toko Buku
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                        </path>
                    </svg>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @if ($bookStore->isEmpty())
                    <div class="col-span-full flex justify-center items-center text-center text-gray-500">
                        <p>Tidak ada toko buku yang tersedia untuk Anda.</p>
                    </div>
                @else
                    @foreach ($bookStore as $bookStore)
                        <x-card.bookstore-card :bookStore="$bookStore" />
                    @endforeach
                @endif
            </div>

            <div class="text-center mt-10 md:hidden">
                <a href="{{ route('guest.all.book.store') }}"
                    class="inline-flex items-center text-indigo-600 font-medium hover:text-indigo-800">
                    Telusuri Semua Toko Buku
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                        </path>
                    </svg>
                </a>
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('register.partner') }}"
                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                    Menjadi Mitra Toko Buku
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-indigo-700 text-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">
                    Siap bergabung dengan komunitas pembaca kami?
                </h2>
                <p class="text-xl mb-8 opacity-90">
                    Daftar hari ini dan mulailah menemukan buku favorit Anda berikutnya sambil terhubung dengan sesama
                    pecinta buku.
                </p>
                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('register') }}"
                        class="px-8 py-3 bg-white text-indigo-700 rounded-lg font-semibold hover:bg-gray-100 transition-colors shadow-lg">
                        Daftar Gratis
                    </a>
                    <a href="#"
                        class="px-8 py-3 border-2 border-white text-white rounded-lg font-semibold hover:bg-white hover:bg-opacity-10 transition-colors">
                        Pelajari lebih lanjut
                    </a>
                </div>
            </div>
        </div>
    </section>

  

@endsection
