<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookBond - Join Our Community</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap');

        :root {
            --mystery: #6b5b95;
            --romance: #ff6f61;
            --science-fiction: #00a9e0;
            --fantasy: #b39ddb;
            --thriller: #ef5350;
            --historical-fiction: #8d6e63;
            --biography: #26a69a;
            --poetry: #ba68c8;
            --horror: #c62828;
            --philosophy: #5c6bc0;
            --classics: #fbc02d;
            --young-adult: #ffb74d;
        }


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

        .genre-tag {
            transition: all 0.2s ease;
        }

        .genre-tag:hover {
            transform: translateY(-2px);
        }

        .dropdown-menu {
            max-height: 250px;
            overflow-y: auto;
            scrollbar-width: thin;
        }

        .dropdown-menu::-webkit-scrollbar {
            width: 6px;
        }

        .dropdown-menu::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .dropdown-menu::-webkit-scrollbar-thumb {
            background: #c7c7c7;
            border-radius: 10px;
        }

        .dropdown-menu::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
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

        .book-icon {
            fill: #8b5cf6;
        }

        .genre-colors {
            --mystery: #f97316;
            --romance: #ec4899;
            --scifi: #3b82f6;
            --fantasy: #8b5cf6;
            --thriller: #ef4444;
            --historical: #a16207;
            --biography: #10b981;
            --poetry: #6366f1;
            --horror: #1e293b;
            --philosophy: #64748b;
            --classics: #854d0e;
            --young-adult: #0ea5e9;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4 md:p-6 lg:p-8 book-pattern genre-colors">
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
                    <h1 class="text-3xl font-bold mb-4">Bergabunglah dengan komunitas buku kami</h1>
                    <p class="mb-6 opacity-90">Terhubung dengan pembaca lain, temukan buku baru, dan bagikan perjalanan sastra Anda.</p>
                </div>

                <div class="hidden md:block">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-medium">Temukan Buku</h3>
                            <p class="text-sm opacity-80">Temukan bacaan favorit Anda berikutnya</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-medium">Bergabunglah dengan Komunitas</h3>
                            <p class="text-sm opacity-80">Terhubung dengan pembaca yang berpikiran sama</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-medium">Berbagi Pikiran</h3>
                            <p class="text-sm opacity-80">Tulis ulasan dan diskusikan buku</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right side - Form -->
            <div class="md:w-3/5 p-8">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold mb-2">Buat akun Anda</h2>
                    <p class="text-gray-600">Ceritakan sedikit tentang diri Anda dan preferensi bacaan Anda.</p>
                </div>

                <form id="registration-form" method="POST" action="{{ route('register.create') }}" class="space-y-6">
                    @error('error')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" id="name" name="name"
                            class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none"
                            placeholder="Masukkan nama Anda" required>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                        <input type="email" id="email" name="email"
                            class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none"
                            placeholder="you@example.com" required>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata sandi</label>
                        <input type="password" id="password" name="password"
                            class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none"
                            placeholder="Buat kata sandi" required minlength="8">
                        <p class="text-xs text-gray-500 mt-1">Harus minimal 8 karakter</p>
                    </div>

                    <div class="relative">
                        <label for="genres" class="block text-sm font-medium text-gray-700 mb-1">Minat Buku (Pilih beberapa)</label>
                        <div class="relative">
                            <button type="button" id="genre-dropdown-btn"
                                class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none text-left flex justify-between items-center">
                                <span id="dropdown-placeholder">Pilih genre favorit Anda</span>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <div id="genre-dropdown"
                                class="dropdown-menu absolute z-10 mt-1 w-full bg-white rounded-lg shadow-lg border border-gray-200 hidden">
                                <div class="p-2">
                                    @foreach ($category as $cat)
                                        <div class="genre-option p-2 hover:bg-purple-50 rounded-md cursor-pointer"
                                            data-genre="{{ $cat->id }}" data-color="{{ $cat->color }}">
                                            {{ $cat->name }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Genre Pilihan</label>
                        <div id="selected-genres" class="flex flex-wrap gap-2 min-h-[40px]">
                            <!-- Selected genres will appear here -->
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="btn-primary w-full py-3 px-4 rounded-lg text-white font-medium">
                            Buat Akun
                        </button>
                    </div>
                </form>

                <div class="mt-6 text-center text-sm text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-medium text-violet-600 hover:text-violet-800">Masuk</a>
                </div>
                <div class="mt-2 text-center text-sm text-gray-600">
                    Ingin menjadi mitra?
                    <a href="{{ route('register.partner') }}"
                        class="font-medium text-violet-600 hover:text-violet-800">Menjadi mitra</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownBtn = document.getElementById('genre-dropdown-btn');
            const dropdown = document.getElementById('genre-dropdown');
            const genreOptions = document.querySelectorAll('.genre-option');
            const selectedGenresContainer = document.getElementById('selected-genres');
            const dropdownPlaceholder = document.getElementById('dropdown-placeholder');
            const registrationForm = document.getElementById('registration-form');

            // Store selected genres
            const selectedGenres = new Set();

            // Toggle dropdown
            dropdownBtn.addEventListener('click', function() {
                dropdown.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!dropdownBtn.contains(event.target) && !dropdown.contains(event.target)) {
                    dropdown.classList.add('hidden');
                }
            });

            function getRandomColor() {
                const colors = [
                    '#6b5b95', '#ff6f61', '#00a9e0', '#b39ddb', '#ef5350',
                    '#8d6e63', '#26a69a', '#ba68c8', '#c62828', '#5c6bc0',
                    '#fbc02d', '#ffb74d', '#81c784', '#9575cd', '#4db6ac'
                ];
                return colors[Math.floor(Math.random() * colors.length)];
            }


            // Handle genre selection
            genreOptions.forEach(option => {
                option.addEventListener('click', function() {
                    const genre = this.dataset.genre;
                    const genreName = this.textContent;
                    // const color = this.dataset.color;

                    const color = getRandomColor();


                    if (!selectedGenres.has(genre)) {
                        selectedGenres.add(genre);
                        addGenreTag(genre, genreName, color);
                        updateDropdownPlaceholder();
                    }
                });
            });

            // Add genre tag to the selected genres container
            function addGenreTag(genre, genreName, color) {
                const tag = document.createElement('div');
                tag.className = 'genre-tag flex items-center rounded-full px-3 py-1 text-sm text-white';
                tag.style.backgroundColor = color;
                tag.dataset.genre = genre;

                tag.innerHTML = `
                    ${genreName}
                    <button type="button" class="ml-1 focus:outline-none" aria-label="Remove ${genreName}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                `;

                // Add remove functionality
                const removeBtn = tag.querySelector('button');
                removeBtn.addEventListener('click', function() {
                    selectedGenres.delete(genre);
                    tag.remove();
                    updateDropdownPlaceholder();
                });

                selectedGenresContainer.appendChild(tag);
            }

            // Update dropdown placeholder text based on selection
            function updateDropdownPlaceholder() {
                if (selectedGenres.size === 0) {
                    dropdownPlaceholder.textContent = 'Select your favorite genres';
                } else {
                    dropdownPlaceholder.textContent =
                        `${selectedGenres.size} genre${selectedGenres.size > 1 ? 's' : ''} selected`;
                }
            }

            // Form submission
            // Form submission
            registrationForm.addEventListener('submit', function(event) {
                event.preventDefault();

                // Get form values
                const name = document.getElementById('name').value;
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;

                // Create hidden input for genres
                const genresInput = document.createElement('input');
                genresInput.type = 'hidden';
                genresInput.name = 'genres[]'; // Ensure this is an array
                genresInput.value = Array.from(selectedGenres).join(',');
                this.appendChild(genresInput);

                // In a real application, you would submit the form here
                // For demo purposes, we'll just show an alert
                // Uncomment this line to submit the form
                this.submit();
            });


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
        });
    </script>

</html>
