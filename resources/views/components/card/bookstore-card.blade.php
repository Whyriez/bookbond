<div class="bookstore-card bg-white rounded-lg shadow-md overflow-hidden">
    <div class="p-6">
        <div class="flex items-start space-x-4 mb-4">
            <div class="bookstore-logo">
                <img src="{{ asset('storage/' . $bookStore->logo) }}" alt="Bookstore Logo" class="w-16 h-16 rounded-full">
            </div>
            <div>
                <h3 class="font-bold text-lg mb-1">{{ $bookStore->shop_name }}</h3>
                <div class="flex items-center text-sm text-gray-600">
                    <i class="far fa-clock mr-1"></i>
                    <span>Buka {{ $bookStore->bussiness_hours }}</span>
                </div>
            </div>
        </div>

        <p class="text-gray-700 text-sm mb-4">{{ $bookStore->short_description }}</p>

        <div class="mb-4">
            <h4 class="text-sm font-medium text-gray-600 mb-2">Genre</h4>
            <div class="flex flex-wrap gap-2">
                @foreach ($bookStore->bookCategories as $category)
                    <span class="genre-pill bg-pink-100 text-pink-800 text-xs px-2 py-1 rounded-full">
                        {{ $category->name }}
                    </span>
                @endforeach
            </div>
        </div>

        @if ($bookStore->serviceOffers->isNotEmpty())
            <div class="mb-4">
                <h4 class="text-sm font-medium text-gray-600 mb-2">Layanan yang tersedia</h4>
                <div class="flex flex-wrap gap-2">
                    @foreach ($bookStore->serviceOffers as $service)
                        <span class="genre-pill bg-pink-100 text-pink-800 text-xs px-2 py-1 rounded-full">
                            {{ $service->name }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endif


        <div class="flex justify-between items-center">
            <a href="{{ route('partner.visit', $bookStore) }}" target="_blank" rel="noopener noreferrer"
                class="border border-gray-300 text-gray-700 hover:bg-gray-100 px-3 py-1.5 rounded-md text-sm">
                Lihat Toko
            </a>

        </div>
    </div>
</div>
