@extends('layouts.landing')
@section('title', 'All BookStores - BookBond')

@section('content')
    <section id="bookstores" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 md:px-6">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-4"> Toko Buku Mitra</h2>
                    <p class="text-gray-600 max-w-2xl">
                        Dukung bisnis lokal dengan membeli buku dari toko buku mitra kami.
                    </p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @if ($bookStore->isEmpty())
                    <div class="col-span-full flex justify-center items-center text-center text-gray-500">
                        <p>Tidak ada buku yang tersedia untuk Anda.</p>
                    </div>
                @else
                    @foreach ($bookStore as $bookStore)
                        <x-card.bookStore-card :bookStore="$bookStore" />
                    @endforeach
                @endif
            </div>

        </div>
    </section>

@endsection
