@extends('layouts.app')
@section('title', 'Admin Home')
@section('partnerbookshop', 'active')

@section('content')

    <div id="step-1" class="step-content">
        <h2 class="text-2xl font-bold mb-2">Informasi Toko Buku</h2>
        <p class="text-gray-600 mb-6">Ceritakan kepada kami tentang toko buku Anda dan lokasinya.</p>

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

        <form id="bookshop-form" method="POST" action="{{ route('partner.bookshop.update') }}" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div id="step-1-form" class="space-y-6">
                <div>
                    <label for="shop-name" class="block text-sm font-medium text-gray-700 mb-1">Nama Toko</label>
                    <input type="text" id="shop-name" name="shop-name"
                        value="{{ old('shop-name', $partner->shop_name ?? '') }}"
                        class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none"
                        placeholder="Enter your bookshop name" required>
                </div>

                <div>
                    <label for="shop-email" class="block text-sm font-medium text-gray-700 mb-1">Email Bisnis</label>
                    <input type="email" id="shop-email" name="shop-email"
                        value="{{ old('shop-email', $user->email ?? '') }}"
                        class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none"
                        placeholder="contact@yourbookshop.com" required>
                </div>

                <div>
                    <label for="shop-phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor telepon</label>
                    <input type="tel" id="shop-phone" name="shop-phone"
                        value="{{ old('shop-phone', $partner->phone_number ?? '') }}"
                        class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none"
                        placeholder="(123) 456-7890" required>
                </div>

                <div>
                    <label for="shop-address" class="block text-sm font-medium text-gray-700 mb-1">Alamat Jalan</label>
                    <input type="text" id="shop-address" name="shop-address"
                        value="{{ old('shop-address', $partner->address ?? '') }}"
                        class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none"
                        placeholder="123 Bookshop Street" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="shop-city" class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                        <input type="text" id="shop-city" name="shop-city"
                            value="{{ old('shop-city', $partner->city ?? '') }}"
                            class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none"
                            placeholder="City" required>
                    </div>
                    <div>
                        <label for="shop-zip" class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
                        <input type="text" id="shop-zip" name="shop-zip"
                            value="{{ old('shop-zip', $partner->zip ?? '') }}"
                            class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none"
                            placeholder="ZIP Code" required>
                    </div>
                </div>
            </div>

            <button class="read-btn mt-3 flex items-center justify-center space-x-2 btn-outline w-full py-2 rounded-md">
                <i class="far fa-edit"></i>
                <span>Perbarui</span>
            </button>
        </form>

    </div>


@endsection
