<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap");

        body {
            font-family: "Poppins", sans-serif;
            color: #333;
        }

        h1,
        h2,
        h3,
        h4 {
            font-family: "Playfair Display", serif;
        }

        .hero-pattern {
            background-color: #f8f5f2;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23e0d9d1' fill-opacity='0.4'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .book-card {
            transition: transform 0.3s ease;
        }

        .book-card:hover {
            transform: translateY(-5px);
        }

        .testimonial-card {
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .btn-primary {
            background-color: #5046e5;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #4238c2;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background-color: #f8f5f2;
            color: #5046e5;
            border: 2px solid #5046e5;
            transition: all 0.3s ease;
        }

        .btn-outline {
            border: 1px solid #8b5cf6;
            color: #8b5cf6;
            transition: all 0.2s ease;
        }

        .btn-outline:hover {
            background-color: #8b5cf6;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5046e5;
            color: white;
            transform: translateY(-2px);
        }

        .community-card {
            transition: all 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
        }

        .community-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .bookstore-logo {
            filter: grayscale(100%);
            opacity: 0.7;
            transition: all 0.3s ease;
        }

        .bookstore-logo:hover {
            filter: grayscale(0%);
            opacity: 1;
        }

        /* Book icon SVG */
        .book-icon {
            fill: #5046e5;
        }

        .no-scrollbar::-webkit-scrollbar {
    display: none;
}

.no-scrollbar {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;     /* Firefox */
}
    </style>
</head>

<body class="antialiased">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 md:px-6 flex justify-between items-center py-4">
            <div class="flex items-center space-x-2">
                <svg class="w-8 h-8 book-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M21,4H3C2.4,4,2,4.4,2,5v14c0,0.6,0.4,1,1,1h18c0.6,0,1-0.4,1-1V5C22,4.4,21.6,4,21,4z M20,18H4V6h16V18z" />
                    <path d="M9,8H7v8h2c2.2,0,4-1.8,4-4S11.2,8,9,8z M9,14H9V10h0c1.1,0,2,0.9,2,2S10.1,14,9,14z" />
                    <path d="M17,8h-4v8h4c1.1,0,2-0.9,2-2v-4C19,8.9,18.1,8,17,8z M17,14h-2v-4h2V14z" />
                </svg>
                <span class="font-bold text-xl text-gray-800">BookBond</span>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('welcome') }}" class="text-gray-600 hover:text-indigo-600 transition-colors">Home</a>
                <a href="#how-it-works" class="text-gray-600 hover:text-indigo-600 transition-colors">Cara Kerjanya</a>
                <a href="#communities" class="text-gray-600 hover:text-indigo-600 transition-colors">Komunitas</a>
                <a href="#books" class="text-gray-600 hover:text-indigo-600 transition-colors">Buku</a>
                <a href="#bookstores" class="text-gray-600 hover:text-indigo-600 transition-colors">Toko Buku</a>
            </div>

            <!-- Desktop Login/Register -->
            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ route('login') }}"
                    class="px-4 py-2 text-indigo-600 hover:text-indigo-800 font-medium transition-colors">Masuk</a>
                <a href="{{ route('register') }}"
                    class="px-5 py-2 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition-colors shadow-md hover:shadow-lg">Daftar</a>
            </div>

            <!-- Mobile Menu Button -->
            <button id="menu-toggle" class="md:hidden text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white shadow-md">
            <div class="px-4 pt-4 pb-6 space-y-3">
                <a href="{{ route('welcome') }}" class="block text-gray-600 hover:text-indigo-600">Home</a>
                <a href="#how-it-works" class="block text-gray-600 hover:text-indigo-600">Cara Kerjanya</a>
                <a href="#communities" class="block text-gray-600 hover:text-indigo-600">Komunitas</a>
                <a href="#books" class="block text-gray-600 hover:text-indigo-600">Buku</a>
                <a href="#bookstores" class="block text-gray-600 hover:text-indigo-600">Toko Buku</a>
                <a href="{{ route('login') }}" class="block text-indigo-600 hover:text-indigo-800 font-medium">Masuk</a>
                <a href="{{ route('register') }}"
                    class="block bg-indigo-600 text-white rounded px-4 py-2 font-medium hover:bg-indigo-700">Daftar</a>
            </div>
        </div>
    </nav>
    {{-- <nav class="bg-white shadow-sm py-4 sticky top-0 z-50">
        <div class="container mx-auto px-4 md:px-6 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <svg class="w-8 h-8 book-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M21,4H3C2.4,4,2,4.4,2,5v14c0,0.6,0.4,1,1,1h18c0.6,0,1-0.4,1-1V5C22,4.4,21.6,4,21,4z M20,18H4V6h16V18z" />
                    <path d="M9,8H7v8h2c2.2,0,4-1.8,4-4S11.2,8,9,8z M9,14H9V10h0c1.1,0,2,0.9,2,2S10.1,14,9,14z" />
                    <path d="M17,8h-4v8h4c1.1,0,2-0.9,2-2v-4C19,8.9,18.1,8,17,8z M17,14h-2v-4h2V14z" />
                </svg>
                <span class="font-bold text-xl text-gray-800">BookBond</span>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('welcome') }}" class="text-gray-600 hover:text-indigo-600 transition-colors">Home</a>
                <a href="#how-it-works" class="text-gray-600 hover:text-indigo-600 transition-colors">Cara Kerjanya</a>
                <a href="#communities" class="text-gray-600 hover:text-indigo-600 transition-colors">Komunitas</a>
                <a href="#books" class="text-gray-600 hover:text-indigo-600 transition-colors">Buku</a>
                <a href="#bookstores" class="text-gray-600 hover:text-indigo-600 transition-colors">Toko Buku</a>
            </div>

            <div class="flex items-center space-x-4">
                <a href="{{ route('login') }}"
                    class="hidden md:inline-block px-4 py-2 text-indigo-600 hover:text-indigo-800 font-medium transition-colors">Masuk</a>
                <a href="{{ route('register') }}"
                    class="px-5 py-2 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition-colors shadow-md hover:shadow-lg">Daftar</a>
            </div>

            <button class="md:hidden text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </div>
    </nav> --}}

    @yield('content')

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-16 pb-8">
        <div class="container mx-auto px-4 md:px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <div>
                    <div class="flex items-center space-x-2 mb-6">
                        <svg class="w-8 h-8 text-indigo-400" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M21,4H3C2.4,4,2,4.4,2,5v14c0,0.6,0.4,1,1,1h18c0.6,0,1-0.4,1-1V5C22,4.4,21.6,4,21,4z M20,18H4V6h16V18z" />
                            <path
                                d="M9,8H7v8h2c2.2,0,4-1.8,4-4S11.2,8,9,8z M9,14H9V10h0c1.1,0,2,0.9,2,2S10.1,14,9,14z" />
                            <path d="M17,8h-4v8h4c1.1,0,2-0.9,2-2v-4C19,8.9,18.1,8,17,8z M17,14h-2v-4h2V14z" />
                        </svg>
                        <span class="font-bold text-xl">BookBond</span>
                    </div>
                    <p class="text-gray-400 mb-6">
                        Menghubungkan pembaca dengan buku yang mereka sukai dan komunitas yang memiliki minat yang sama.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-goodreads"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-6">Explore</h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">Home</a>
                        </li>
                        <li>
                            <a href="#how-it-works" class="text-gray-400 hover:text-white transition-colors">Cara
                                Kerjanya</a>
                        </li>
                        <li>
                            <a href="#communities"
                                class="text-gray-400 hover:text-white transition-colors">Komunitas</a>
                        </li>
                        <li>
                            <a href="#books" class="text-gray-400 hover:text-white transition-colors">Buku</a>
                        </li>
                        <li>
                            <a href="#bookstores" class="text-gray-400 hover:text-white transition-colors">Toko buku</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-6">Company</h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">Tentang
                                Kami</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">Karier</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">Tekan</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">Kontak</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">Blog</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-6">Support</h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">Pusat
                                Bantuan</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">Pedoman
                                Komunitas</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">Kebijakan
                                Privasi</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">Ketentuan
                                Layanan</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">Kebijakan
                                Cookie</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 mb-4 md:mb-0">
                    © 2023 BookBond. Semua hak dilindungi undang-undang.
                </p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors text-sm">Kebijakan
                        Privasi</a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors text-sm">Ketentuan
                        Layanan</a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors text-sm">Kebijakan
                        Cookie</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

    @stack('scripts')
</body>

</html>
