<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookBond - Partner Bookshop Registration</title>
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

        .step-indicator {
            transition: all 0.3s ease;
        }

        .step-indicator.active {
            background-color: #8b5cf6;
            color: white;
        }

        .step-indicator.completed {
            background-color: #c4b5fd;
            color: white;
        }

        .step-line {
            height: 2px;
            background-color: #e5e7eb;
            flex-grow: 1;
            margin: 0 8px;
        }

        .step-line.active {
            background-color: #8b5cf6;
        }

        .bookshelf {
            position: relative;
            width: 100%;
            height: 300px;
            margin-top: 20px;
        }

        .shelf {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 15px;
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 5px 5px 0 0;
        }

        .shelf-shadow {
            position: absolute;
            bottom: -5px;
            width: 100%;
            height: 5px;
            background-color: rgba(0, 0, 0, 0.1);
            border-radius: 0 0 5px 5px;
        }

        .book-container {
            position: absolute;
            bottom: 15px;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: flex-end;
        }

        .bookstore-book {
            width: 30px;
            margin: 0 3px;
            border-radius: 2px 0 0 2px;
            position: relative;
            transition: transform 0.3s ease;
        }

        .bookstore-book:hover {
            transform: translateY(-10px);
        }

        .bookstore {
            position: absolute;
            bottom: 60px;
            width: 80%;
            left: 10%;
            height: 120px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 10px;
        }

        .bookstore-window {
            position: absolute;
            top: 20px;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.4);
            border-radius: 5px;
            left: calc(50% - 20px);
        }

        .bookstore-door {
            position: absolute;
            bottom: 0;
            width: 30px;
            height: 50px;
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 5px 5px 0 0;
            left: calc(50% - 15px);
        }

        .bookstore-sign {
            position: absolute;
            top: -15px;
            width: 60%;
            height: 20px;
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 5px;
            left: 20%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 10px;
            color: white;
            font-weight: bold;
        }

        .checkbox-custom {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
            cursor: pointer;
        }

        .checkbox-custom input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .checkmark {
            height: 20px;
            width: 20px;
            background-color: #fff;
            border: 2px solid #d1d5db;
            border-radius: 4px;
            margin-right: 1px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .checkbox-custom:hover input~.checkmark {
            border-color: #8b5cf6;
        }

        .checkbox-custom input:checked~.checkmark {
            background-color: #8b5cf6;
            border-color: #8b5cf6;
        }

        .checkmark:after {
            content: "";
            display: none;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .checkbox-custom input:checked~.checkmark:after {
            display: block;
        }

        .file-upload {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .file-upload-input {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .file-upload-button {
            display: inline-block;
            border: 1px dashed #d1d5db;
            border-radius: 0.5rem;
            padding: 2rem 1rem;
            text-align: center;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-upload-button:hover {
            border-color: #8b5cf6;
            background-color: rgba(139, 92, 246, 0.05);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4 md:p-6 lg:p-8 book-pattern">
    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="flex flex-col md:flex-row">
            <!-- Left side - Illustration/Branding -->
            <div class="md:w-2/5 bg-gradient-to-br from-violet-500 to-purple-700 p-8 text-white flex flex-col">
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
                    <h1 class="text-3xl font-bold mb-4">Pendaftaran Toko Buku Mitra</h1>
                    <p class="mb-6 opacity-90">Bergabunglah dengan jaringan toko buku independen kami dan terhubunglah
                        dengan ribuan pembaca di wilayah Anda.</p>
                </div>

                <div class="hidden md:block flex-grow">
                    <div class="bookshelf">
                        <div class="bookstore">
                            <div class="bookstore-sign">BOOKS</div>
                            <div class="bookstore-window"></div>
                            <div class="bookstore-door"></div>
                        </div>
                        <div class="book-container">
                            <div class="bookstore-book" style="height: 80px; background-color: #ef4444;"></div>
                            <div class="bookstore-book" style="height: 90px; background-color: #f97316;"></div>
                            <div class="bookstore-book" style="height: 75px; background-color: #eab308;"></div>
                            <div class="bookstore-book" style="height: 85px; background-color: #22c55e;"></div>
                            <div class="bookstore-book" style="height: 95px; background-color: #3b82f6;"></div>
                            <div class="bookstore-book" style="height: 70px; background-color: #8b5cf6;"></div>
                            <div class="bookstore-book" style="height: 80px; background-color: #ec4899;"></div>
                        </div>
                        <div class="shelf"></div>
                        <div class="shelf-shadow"></div>
                    </div>

                    <div class="mt-8">
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z">
                                    </path>
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-medium">Meningkatkan Pendapatan</h3>
                                <p class="text-sm opacity-80">Jangkau pelanggan baru dan tingkatkan penjualan</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4 mb-4">
                            <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm0 2h10v7h-2l-1 2H8l-1-2H5V5z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-medium">Kehadiran Online</h3>
                                <p class="text-sm opacity-80">Bangun etalase digital Anda</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-medium">Membangun Komunitas</h3>
                                <p class="text-sm opacity-80">Menjadi tuan rumah acara dan kelompok membaca</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right side - Form -->
            <div class="md:w-3/5 p-8">

                <div class="mb-6">

                    <!-- Step indicators -->
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex flex-col items-center">
                            <div id="step-1-indicator"
                                class="step-indicator active w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium">
                                1</div>
                            <span class="text-xs mt-1">Info Toko</span>
                        </div>

                        <div class="step-line" id="line-1-2"></div>

                        <div class="flex flex-col items-center">
                            <div id="step-2-indicator"
                                class="step-indicator w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-sm font-medium text-gray-600">
                                2</div>
                            <span class="text-xs mt-1">Rincian</span>
                        </div>

                        <div class="step-line" id="line-2-3"></div>

                        <div class="flex flex-col items-center">
                            <div id="step-3-indicator"
                                class="step-indicator w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-sm font-medium text-gray-600">
                                3</div>
                            <span class="text-xs mt-1">Selesai</span>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('register.partner.create') }}"
                        enctype="multipart/form-data">

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
                        @csrf
                        <!-- Form steps -->
                        <div id="step-1" class="step-content">
                            <h2 class="text-2xl font-bold mb-2">Informasi Toko Buku</h2>
                            <p class="text-gray-600 mb-6">Ceritakan kepada kami tentang toko buku Anda dan lokasinya.
                            </p>

                            <div id="step-1-form" class="space-y-6">
                                <div>
                                    <label for="shop-name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                        Toko Buku</label>
                                    <input type="text" id="shop-name" name="shop-name"
                                        class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none"
                                        placeholder="Masukkan nama toko buku Anda" required>
                                </div>

                                <div>
                                    <label for="shop-email" class="block text-sm font-medium text-gray-700 mb-1">Email
                                        Bisnis</label>
                                    <input type="email" id="shop-email" name="shop-email"
                                        class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none"
                                        placeholder="contact@yourbookshop.com" required>
                                </div>

                                <div>
                                    <label for="shop-phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor
                                        telepon</label>
                                    <input type="tel" id="shop-phone" name="shop-phone"
                                        class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none"
                                        placeholder="(123) 456-7890" required>
                                </div>

                                <div>
                                    <label for="shop-address"
                                        class="block text-sm font-medium text-gray-700 mb-1">Alamat Jalan</label>
                                    <input type="text" id="shop-address" name="shop-address"
                                        class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none"
                                        placeholder="Jalan Toko Buku 123" required>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="shop-city"
                                            class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                                        <input type="text" id="shop-city" name="shop-city"
                                            class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none"
                                            placeholder="Kota" required>
                                    </div>
                                    <div>
                                        <label for="shop-zip"
                                            class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
                                        <input type="text" id="shop-zip" name="shop-zip"
                                            class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none"
                                            placeholder="Kode pos" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="step-2" class="step-content hidden">
                            <h2 class="text-2xl font-bold mb-2">Detail Toko</h2>
                            <p class="text-gray-600 mb-6">Ceritakan lebih lanjut tentang spesialisasi dan layanan toko
                                buku Anda.
                            </p>

                            <div id="step-2-form" class="space-y-6">
                                <div>
                                    <label for="shop-website"
                                        class="block text-sm font-medium text-gray-700 mb-1">Situs web
                                        (opsional)</label>
                                    <input type="url" id="shop-website" name="shop-website"
                                        class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none"
                                        placeholder="https://yourbookshop.com">
                                </div>

                                <div>
                                    <label for="shop-description"
                                        class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Toko</label>
                                    <textarea id="shop-description" name="shop-description" rows="3"
                                        class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none"
                                        placeholder="Ceritakan kepada pembaca tentang toko buku Anda, sejarahnya, dan apa yang membuatnya istimewa..."
                                        required></textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">
                                        Kategori Buku (Pilih semua yang berlaku)
                                    </label>
                                    <div class="grid grid-cols-2 gap-2">
                                        @foreach ($categories as $category)
                                            <label class="checkbox-custom flex items-center space-x-2">
                                                <input type="checkbox" name="categories[]"
                                                    value="{{ $category->name }}">
                                                <span class="checkmark"></span>
                                                <span>{{ $category->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>


                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">
                                        Layanan yang Ditawarkan (Pilih semua yang berlaku)
                                    </label>
                                    <div class="grid grid-cols-2 gap-2">
                                        @foreach ($services as $service)
                                            <label class="checkbox-custom flex items-center space-x-2">
                                                <input type="checkbox" name="services[]"
                                                    value="{{ $service->name }}">
                                                <span class="checkmark"></span>
                                                <span>{{ $service->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>


                                <div>
                                    <label for="shop-hours" class="block text-sm font-medium text-gray-700 mb-1">Jam
                                        Kerja</label>
                                    <textarea id="shop-hours" name="shop-hours" rows="3"
                                        class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none"
                                        placeholder="Senin-Jumat: 09.00-18.00, Sabtu: 10.00-17.00, Minggu: Tutup" required></textarea>
                                </div>
                            </div>
                        </div>

                        <div id="step-3" class="step-content hidden">
                            <h2 class="text-2xl font-bold mb-2">Rincian Akhir</h2>
                            <p class="text-gray-600 mb-6">Unggah logo toko Anda dan atur akun Anda.</p>

                            <div id="step-3-form" class="space-y-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Logo Toko
                                        (opsional)</label>
                                    <div class="file-upload">
                                        <div class="file-upload-button">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                                fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                <path
                                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                    stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <p class="mt-1 text-sm text-gray-600">Seret dan lepas atau klik untuk
                                                mengunggah</p>
                                            <p class="text-xs text-gray-500">PNG, JPG, GIF hingga 2MB</p>
                                        </div>
                                        <input type="file" class="file-upload-input" name="logo"
                                            accept="image/*">
                                    </div>
                                </div>

                                <div>
                                    <label for="owner-name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                        Pemilik/Manajer</label>
                                    <input type="text" id="owner-name" name="owner-name"
                                        class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none"
                                        placeholder="Nama lengkap Anda" required>
                                </div>

                                <div>
                                    <label for="owner-email"
                                        class="block text-sm font-medium text-gray-700 mb-1">Email Pribadi</label>
                                    <input type="email" id="owner-email" name="owner-email"
                                        class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none"
                                        placeholder="your@email.com" required>
                                </div>

                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Buat
                                        Kata Sandi</label>
                                    <input type="password" id="password" name="password"
                                        class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none"
                                        placeholder="Buat kata sandi yang aman" required minlength="8">
                                    <p class="text-xs text-gray-500 mt-1">Harus minimal 8 karakter</p>
                                </div>

                                <div>
                                    <label for="password_confirmation"
                                        class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Kata
                                        Sandi</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none"
                                        placeholder="Konfirmasikan kata sandi Anda" required minlength="8">
                                </div>

                                <div>
                                    <label class="flex items-start gap-2 cursor-pointer">
                                        <input type="checkbox" name="terms" required class="mt-1">
                                        <div class="text-sm text-gray-700">
                                            Saya setuju dengan
                                            <a href="#" class="text-violet-600 hover:text-violet-800">Ketentuan
                                                Layanan</a>
                                            dan
                                            <a href="#" class="text-violet-600 hover:text-violet-800">Kebijakan
                                                Privasi</a>
                                        </div>
                                    </label>
                                </div>

                            </div>
                        </div>

                        <div class="flex pt-3 gap-4">
                            <button type="button" id="prev-step"
                                class="btn-primary flex-1 py-3 px-4 rounded-lg text-white font-medium hidden">Kembali</button>
                            <button type="button" id="next-step"
                                class="btn-primary flex-1 py-3 px-4 rounded-lg text-white font-medium">Berikutnya</button>
                            <button type="submit" id="submit-form"
                                class="btn-primary flex-1 py-3 px-4 rounded-lg text-white font-medium hidden">Kirim</button>
                        </div>

                    </form>

                    <div id="success-message" class="hidden text-center py-8">
                        <div class="w-16 h-16 bg-green-100 rounded-full mx-auto flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold mb-2">Pendaftaran Selesai!</h2>
                        <p class="text-gray-600 mb-6">Terima kasih telah mendaftarkan toko buku Anda di BookBond. Tim
                            kami akan meninjau aplikasi Anda dan segera menghubungi Anda.</p>
                        <a href="#"
                            class="btn-primary inline-block py-3 px-6 rounded-lg text-white font-medium">
                            Buka Dashboard Mitra
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elements
            const steps = Array.from(document.querySelectorAll(".step-content"));
            let currentStep = 0;

            const nextBtn = document.getElementById("next-step");
            const prevBtn = document.getElementById("prev-step");
            const submitBtn = document.getElementById("submit-form");

            const step1Indicator = document.getElementById('step-1-indicator');
            const step2Indicator = document.getElementById('step-2-indicator');
            const step3Indicator = document.getElementById('step-3-indicator');

            const line12 = document.getElementById('line-1-2');
            const line23 = document.getElementById('line-2-3');

            function showStep(index) {
                steps.forEach((step, i) => {
                    step.classList.toggle("hidden", i !== index);
                });

                prevBtn.classList.toggle("hidden", index === 0);
                nextBtn.classList.toggle("hidden", index === steps.length - 1);
                submitBtn.classList.toggle("hidden", index !== steps.length - 1);

                // Update indicators
                step1Indicator.classList.remove('active', 'completed');
                step2Indicator.classList.remove('active', 'completed');
                step3Indicator.classList.remove('active', 'completed');
                line12.classList.remove('active');
                line23.classList.remove('active');

                if (index === 0) {
                    step1Indicator.classList.add('active');
                } else if (index === 1) {
                    step1Indicator.classList.add('completed');
                    step2Indicator.classList.add('active');
                    line12.classList.add('active');
                } else if (index === 2) {
                    step1Indicator.classList.add('completed');
                    step2Indicator.classList.add('completed');
                    step3Indicator.classList.add('active');
                    line12.classList.add('active');
                    line23.classList.add('active');
                }
            }




            nextBtn.addEventListener("click", () => {
                if (currentStep < steps.length - 1) {
                    currentStep++;
                    showStep(currentStep);
                }
            });

            prevBtn.addEventListener("click", () => {
                if (currentStep > 0) {
                    currentStep--;
                    showStep(currentStep);
                }
            });

            showStep(currentStep);


            // File upload preview
            const fileUpload = document.querySelector('.file-upload-input');
            const fileUploadButton = document.querySelector('.file-upload-button');

            fileUpload.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        fileUploadButton.innerHTML = `
                            <img src="${e.target.result}" class="mx-auto h-24 w-24 object-cover rounded-lg" />
                            <p class="mt-2 text-sm text-gray-600">Click to change</p>
                        `;
                    }

                    reader.readAsDataURL(this.files[0]);
                }
            });

            // Animate books on hover
            const books = document.querySelectorAll('.bookstore-book');
            books.forEach(book => {
                book.addEventListener('mouseover', function() {
                    this.style.transform = 'translateY(-10px)';
                });

                book.addEventListener('mouseout', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>

</html>
