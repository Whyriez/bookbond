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
            <div
                class="scroll-container flex flex-wrap gap-2 overflow-x-auto overflow-y-hidden max-h-[3.5rem] pb-1 no-scrollbar cursor-grab active:cursor-grabbing select-none">
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
                <div
                    class="scroll-container flex flex-wrap gap-2 overflow-x-auto overflow-y-hidden max-h-[3.5rem] pb-1 no-scrollbar cursor-grab active:cursor-grabbing select-none">
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

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Script drag scroll loaded');

            const containers = document.querySelectorAll('.scroll-container');
            console.log('Found containers:', containers.length);

            containers.forEach(container => {
                let isDown = false;
                let startX;
                let scrollLeft;

                container.addEventListener('mousedown', (e) => {
                    isDown = true;
                    container.classList.add('active');
                    startX = e.pageX - container.offsetLeft;
                    scrollLeft = container.scrollLeft;
                    console.log('Mouse down at', startX);
                });

                container.addEventListener('mouseleave', () => {
                    if (isDown) console.log('Mouse leave (cancel drag)');
                    isDown = false;
                    container.classList.remove('active');
                });

                container.addEventListener('mouseup', () => {
                    if (isDown) console.log('Mouse up (end drag)');
                    isDown = false;
                    container.classList.remove('active');
                });

                container.addEventListener('mousemove', (e) => {
                    if (!isDown) return;
                    e.preventDefault();
                    const x = e.pageX - container.offsetLeft;
                    const walk = (x - startX) * 1.5;
                    container.scrollLeft = scrollLeft - walk;
                    console.log('Dragging... scrollLeft:', container.scrollLeft);
                });
            });
        });
    </script>
@endpush
