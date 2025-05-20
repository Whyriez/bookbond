<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookBond - Sign In</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background-color: #fcfaf7;
            color: #333;
        }

        h1,
        h2,
        h3,
        h4 {
            font-family: 'Playfair Display', serif;
        }

        .book-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23f0e6d2' fill-opacity='0.4'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .form-input:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2);
        }

        .btn-primary {
            background-color: #8b5cf6;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #7c3aed;
            transform: translateY(-2px);
        }

        .social-btn {
            transition: all 0.2s ease;
        }

        .social-btn:hover {
            transform: translateY(-2px);
        }

        .book-icon {
            fill: #8b5cf6;
        }

        .book-stack {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .book {
            position: absolute;
            border-radius: 2px;
            transform: rotate(0deg);
            transition: all 0.4s ease;
        }

        .book:hover {
            transform: translateY(-5px) rotate(0deg);
        }

        .book-1 {
            width: 60%;
            height: 180px;
            background: #8b5cf6;
            bottom: 0;
            left: 20%;
            z-index: 3;
        }

        .book-2 {
            width: 70%;
            height: 200px;
            background: #ec4899;
            bottom: 15px;
            left: 15%;
            z-index: 2;
            transform: rotate(-8deg);
        }

        .book-2:hover {
            transform: translateY(-5px) rotate(-8deg);
        }

        .book-3 {
            width: 65%;
            height: 190px;
            background: #3b82f6;
            bottom: 30px;
            left: 25%;
            z-index: 1;
            transform: rotate(5deg);
        }

        .book-3:hover {
            transform: translateY(-5px) rotate(5deg);
        }

        .book-spine {
            position: absolute;
            width: 20px;
            height: 100%;
            left: 0;
            background: rgba(0, 0, 0, 0.1);
        }

        .book-title {
            position: absolute;
            transform: rotate(90deg);
            transform-origin: left bottom;
            bottom: 20px;
            left: 10px;
            font-family: 'Playfair Display', serif;
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
            white-space: nowrap;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4 md:p-6 lg:p-8 book-pattern">
    <div class="w-full max-w-3xl bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="flex flex-col md:flex-row">
            <!-- Left side - Illustration/Branding -->
            <div
                class="md:w-2/5 bg-gradient-to-br from-violet-500 to-purple-700 p-8 text-white flex flex-col justify-between">
                <div>
                    <div class="flex items-center space-x-2 mb-8">
                        <svg class="w-8 h-8 text-white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M21,4H3C2.4,4,2,4.4,2,5v14c0,0.6,0.4,1,1,1h18c0.6,0,1-0.4,1-1V5C22,4.4,21.6,4,21,4z M20,18H4V6h16V18z"
                                fill="currentColor" />
                            <path d="M9,8H7v8h2c2.2,0,4-1.8,4-4S11.2,8,9,8z M9,14H9V10h0c1.1,0,2,0.9,2,2S10.1,14,9,14z"
                                fill="currentColor" />
                            <path d="M17,8h-4v8h4c1.1,0,2-0.9,2-2v-4C19,8.9,18.1,8,17,8z M17,14h-2v-4h2V14z"
                                fill="currentColor" />
                        </svg>
                        <span class="font-bold text-xl">BookBond</span>
                    </div>
                    <h1 class="text-3xl font-bold mb-4">Selamat Datang kembali!</h1>
                    <p class="mb-6 opacity-90">Masuk untuk melanjutkan perjalanan sastra Anda dengan sesama pecinta
                        buku.</p>
                </div>

                <div class="hidden md:block h-64 relative">
                    <div class="book-stack">
                        <div class="book book-3">
                            <div class="book-spine"></div>
                            <div class="book-title">The Great Adventure</div>
                        </div>
                        <div class="book book-2">
                            <div class="book-spine"></div>
                            <div class="book-title">Midnight Tales</div>
                        </div>
                        <div class="book book-1">
                            <div class="book-spine"></div>
                            <div class="book-title">The Silent Echo</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right side - Form -->
            <div class="md:w-3/5 p-8">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold mb-2">Masuk ke akun Anda</h2>
                    <p class="text-gray-600">Selamat datang kembali! Silakan masukkan detail Anda.</p>
                </div>
                @if (session('success'))
                    <div class="mb-4 rounded-md bg-green-100 p-4 text-sm text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 rounded-md bg-red-100 p-4 text-sm text-red-700">
                        {{ session('error') }}
                    </div>
                @endif
                <form id="login-form" method="POST" class="space-y-6" action="{{ route('login.post') }}">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                        <input type="email" id="email" name="email"
                            class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none"
                            placeholder="you@example.com" required>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label for="password" class="block text-sm font-medium text-gray-700">Kata sandi</label>
                            <a href="#" class="text-sm font-medium text-violet-600 hover:text-violet-800">Lupa
                                kata sandi?</a>
                        </div>
                        <input type="password" id="password" name="password"
                            class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none"
                            placeholder="Masukkan kata sandi Anda" required>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember"
                            class="h-4 w-4 text-violet-600 focus:ring-violet-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">Ingat saya selama 30 hari</label>
                    </div>

                    <div>
                        <button type="submit" class="btn-primary w-full py-3 px-4 rounded-lg text-white font-medium">
                            Sign in
                        </button>
                    </div>
                </form>

                {{-- <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">Or continue with</span>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-3 gap-3">
                        <button type="button"
                            class="social-btn flex justify-center items-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white hover:bg-gray-50">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20.283 10.356h-8.327v3.451h4.792c-.446 2.193-2.313 3.453-4.792 3.453a5.27 5.27 0 0 1-5.279-5.28 5.27 5.27 0 0 1 5.279-5.279c1.259 0 2.397.447 3.29 1.178l2.6-2.599c-1.584-1.381-3.615-2.233-5.89-2.233a8.908 8.908 0 0 0-8.934 8.934 8.907 8.907 0 0 0 8.934 8.934c4.467 0 8.529-3.249 8.529-8.934 0-.528-.081-1.097-.202-1.625z">
                                </path>
                            </svg>
                        </button>

                        <button type="button"
                            class="social-btn flex justify-center items-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white hover:bg-gray-50">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13.397 20.997v-8.196h2.765l.411-3.209h-3.176V7.548c0-.926.258-1.56 1.587-1.56h1.684V3.127A22.336 22.336 0 0 0 14.201 3c-2.444 0-4.122 1.492-4.122 4.231v2.355H7.332v3.209h2.753v8.202h3.312z">
                                </path>
                            </svg>
                        </button>

                        <button type="button"
                            class="social-btn flex justify-center items-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white hover:bg-gray-50">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div> --}}

                <div class="mt-6 text-center text-sm text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-medium text-violet-600 hover:text-violet-800">Buat akun</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('login-form');

            // Form submission
            // loginForm.addEventListener('submit', function(event) {
            //     event.preventDefault();

            //     // Get form values
            //     const email = document.getElementById('email').value;
            //     const password = document.getElementById('password').value;
            //     const remember = document.getElementById('remember').checked;

            //     // In a real application, you would submit the form here
            //     // For demo purposes, we'll just show an alert
            //     alert(`Sign in successful!\nEmail: ${email}\nRemember me: ${remember ? 'Yes' : 'No'}`);

            //     // You could also use:
            //     // this.submit();
            // });

            // Add subtle animation to the form
            const formInputs = document.querySelectorAll('.form-input');
            formInputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('scale-105');
                    setTimeout(() => {
                        this.parentElement.classList.remove('scale-105');
                    }, 200);
                });
            });

            // Animate books on hover
            const books = document.querySelectorAll('.book');
            books.forEach(book => {
                book.addEventListener('mouseover', function() {
                    books.forEach(b => {
                        if (b !== this) {
                            b.style.opacity = '0.7';
                        }
                    });
                });

                book.addEventListener('mouseout', function() {
                    books.forEach(b => {
                        b.style.opacity = '1';
                    });
                });
            });
        });
    </script>

</html>
