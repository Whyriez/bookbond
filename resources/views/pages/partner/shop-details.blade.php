@extends('layouts.app')
@section('title', 'Admin Home')
@section('partnershop', 'active')

@section('content')

    <div id="step-2" class="step-content">
        <h2 class="text-2xl font-bold mb-2">Detail Toko</h2>
        <p class="text-gray-600 mb-6">Ceritakan lebih lanjut tentang spesialisasi dan layanan toko buku Anda.
        </p>

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

        <form id="bookshop-form" method="POST" action="{{ route('partner.shop.details.update') }}"
            enctype="multipart/form-data">
            @csrf
            @method('put')

            <div id="step-2-form" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Logo Toko (opsional)</label>
                    <div class="file-upload">
                        @if ($detail?->logo)
                            <img src="{{ asset('storage/' . $detail->logo) }}" alt="Logo" class="h-20 mb-2">
                        @endif
                        <div class="file-upload-button">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                viewBox="0 0 48 48" aria-hidden="true">
                                <path
                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="mt-1 text-sm text-gray-600">Seret dan lepas atau klik untuk mengunggah</p>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                        </div>
                        <input type="file" class="file-upload-input" name="logo" accept="image/*">
                    </div>
                </div>

                <div>
                    <label for="owner-name" class="block text-sm font-medium text-gray-700 mb-1">Nama Pemilik/Manajer</label>
                    <input type="text" id="owner-name" name="owner-name"
                        value="{{ old('owner-name', $user->name ?? '') }}"
                        class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none"
                        placeholder="Your full name" required>
                </div>

                <div>
                    <label for="owner-email" class="block text-sm font-medium text-gray-700 mb-1">Email Pribadi</label>
                    <input type="email" id="owner-email" name="owner-email"
                        value="{{ old('owner-email', $detail->personal_email ?? '') }}"
                        class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none"
                        placeholder="your@email.com" required>
                </div>

                <div>
                    <label for="shop-website" class="block text-sm font-medium text-gray-700 mb-1">Website
                        (optional)</label>
                    <input type="url" id="shop-website" name="shop-website"
                        value="{{ old('shop-website', $detail->website ?? '') }}"
                        class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none"
                        placeholder="https://yourbookshop.com">
                </div>

                <div>
                    <label for="shop-description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Toko</label>
                    <textarea id="shop-description" name="shop-description" rows="3"
                        class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none"
                        placeholder="Tell readers about your bookshop, its history, and what makes it special..." required>{{ old('shop-description', $detail->short_description ?? '') }}</textarea>

                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                       Kategori Buku (Pilih semua yang berlaku)
                    </label>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach ($categories as $category)
                            <label class="checkbox-custom flex items-center space-x-2">
                                <input type="checkbox" name="categories[]" value="{{ $category->name }}"
                                    {{ in_array($category->name, $selectedCategories ?? []) ? 'checked' : '' }}>
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
                                <input type="checkbox" name="services[]" value="{{ $service->name }}"
                                    {{ in_array($service->name, $selectedServices ?? []) ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                                <span>{{ $service->name }}</span>
                            </label>
                        @endforeach

                    </div>
                </div>


                <div>
                    <label for="shop-hours" class="block text-sm font-medium text-gray-700 mb-1">Jam Operasional</label>
                    <textarea id="shop-hours" name="shop-hours" rows="3"
                        class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none"
                        placeholder="Mon-Fri: 9am-6pm, Sat: 10am-5pm, Sun: Closed" required>{{ old('shop-hours', $detail->bussiness_hours ?? '') }}</textarea>

                </div>
            </div>
            <button class="read-btn mt-3 flex items-center justify-center space-x-2 btn-outline w-full py-2 rounded-md">
                <i class="far fa-edit"></i>
                <span>Perbarui</span>
            </button>
        </form>

    </div>


@endsection
