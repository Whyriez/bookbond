@extends('layouts.app')
@section('title', 'Discover')
@section('discover', 'active')

@section('content')
    <!-- Book Information Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="flex flex-col md:flex-row book-info-container">
            <!-- Book Cover -->
            <div class="flex flex-col items-start book-cover-container md:w-1/3 lg:w-1/4">
                <div class="w-full h-96 rounded-lg overflow-hidden mb-4">
                    <img src="{{ asset('storage/' . $book->image) }}" alt="The Midnight Library by Matt Haig"
                        class="w-full h-full object-cover">
                </div>


                <div class="flex flex-col space-y-3 w-full">
                    @php
                        $isAdded = in_array($book->id, $wantToReadBookIds ?? []);
                    @endphp
                    <button onclick="toggleWantToRead(this)" data-book-id="{{ $book->id }}"
                        class=" flex items-center justify-center space-x-2 btn-outline w-full py-2 rounded-md
                        {{ $isAdded ? ' bg-violet-600 text-white' : 'bg-white text-violet-600 hover:bg-violet-50' }}">
                      {!! $isAdded
    ? '<i class="fas fa-check mr-1 text-white"></i><span class="text-white">Ditambahkan</span>'
    : '<i class="far fa-bookmark mr-1"></i><span>Tambahkan ke Daftar Bacaan</span>' !!}

                    </button>


                    <button class="flex items-center justify-center space-x-2 btn-primary w-full py-2 rounded-md">
                        <i class="fas fa-share-alt"></i>
                        <span>Bagikan</span>
                    </button>
                </div>
            </div>

            <!-- Book Details -->
            <div class="md:w-2/3 lg:w-3/4 md:pl-8">
                <div class="flex flex-wrap gap-2 mb-3">
                    @foreach ($book->categories as $category)
                        <span
                            class="genre-pill bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded-full">{{ $category->name }}</span>
                    @endforeach
                    {{-- <span class="genre-pill bg-violet-100 text-violet-800 text-xs px-2 py-1 rounded-full">Fiction</span>
                    <span class="genre-pill bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">Contemporary</span>
                    <span class="genre-pill bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded-full">Fantasy</span>
                    <span class="genre-pill bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded-full">Philosophy</span> --}}
                </div>

                <h1 class="text-3xl md:text-4xl font-bold mb-2">{{ $book->name }}</h1>
                <p class="text-gray-600 text-lg mb-4">by <a href="#"
                        class="text-violet-600 hover:underline">{{ $book->author }}</a></p>

                {{-- <div class="flex items-center mb-6">
                    <div class="flex text-amber-400 mr-2">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span class="text-gray-600">4.5 (2,387 ratings)</span>
                </div> --}}

                <div class="mb-6">
                    <div class="flex space-x-6 border-b border-gray-200">
                        <button class="tab-button py-3 px-1 font-medium active" data-tab="synopsis">Sinopsis</button>
                        <button class="tab-button py-3 px-1 font-medium" data-tab="details">Detail Buku</button>
                        {{-- <button class="tab-button py-3 px-1 font-medium" data-tab="author">About the Author</button> --}}
                    </div>

                    <div class="py-4">
                        <div class="tab-content active" id="synopsis">
                            {{ $book->description }}
                            {{-- <p class="text-gray-700 mb-4">Between life and death there is a library, and within that
                                library, the shelves go on forever. Every book provides a chance to try another life you
                                could have lived. To see how things would be if you had made other choices... Would you have
                                done anything different, if you had the chance to undo your regrets?</p>

                            <p class="text-gray-700 mb-4">Nora Seed finds herself faced with this decision. Faced with the
                                possibility of changing her life for a new one, following a different career, undoing old
                                breakups, realizing her dreams of becoming a glaciologist; she must search within herself as
                                she travels through the Midnight Library to decide what is truly fulfilling in life, and
                                what makes it worth living in the first place.</p>

                            <p class="text-gray-700">A dazzling novel about all the choices that go into a life well lived,
                                from the internationally bestselling author of Reasons to Stay Alive and How To Stop Time.
                            </p> --}}
                        </div>

                        <div class="tab-content" id="details">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <h3 class="font-medium text-gray-900 mb-2">Publication Details</h3>
                                    <ul class="space-y-2 text-gray-700">
                                        <li><span class="font-medium">Publisher:</span> {{ $book->publisher }}</li>
                                        <li><span class="font-medium">Publication Date:</span>
                                            {{ $book->created_at->format('F j, Y') }}</li>
                                        <li><span class="font-medium">Language:</span> {{ $book->language }}</li>
                                        <li><span class="font-medium">Print Length:</span> {{ $book->print_length }} pages
                                        </li>
                                        <li><span class="font-medium">ISBN-10:</span> {{ $book['ISBN-10'] }}</li>
                                        <li><span class="font-medium">ISBN-13:</span> {{ $book['ISBN-13'] }}</li>
                                    </ul>
                                </div>

                                {{-- <div>
                                    <h3 class="font-medium text-gray-900 mb-2">Awards & Recognition</h3>
                                    <ul class="space-y-2 text-gray-700">
                                        <li>Goodreads Choice Award for Fiction (2020)</li>
                                        <li>British Book Awards: Fiction Book of the Year (2021)</li>
                                        <li>Waterstones Book of the Year Shortlist (2020)</li>
                                    </ul>
                                </div> --}}
                            </div>
                        </div>

                        {{-- <div class="tab-content" id="author">
                            <div class="flex items-start space-x-4">
                                <div class="w-20 h-20 rounded-full bg-gray-200 flex-shrink-0"
                                    style="background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"200\" height=\"200\" viewBox=\"0 0 200 200\"><rect fill=\"%23475569\" width=\"200\" height=\"200\"/><circle cx=\"100\" cy=\"80\" r=\"40\" fill=\"%23cbd5e1\"/><path d=\"M50,200 L50,150 C50,120 80,100 100,100 C120,100 150,120 150,150 L150,200 Z\" fill=\"%23cbd5e1\"/></svg>'); background-size: cover;">
                                </div>

                                <div>
                                    <h3 class="font-bold text-lg mb-1">Matt Haig</h3>
                                    <p class="text-gray-700 mb-3">Matt Haig is a British author for children and adults. His
                                        memoir Reasons to Stay Alive was a number one bestseller, staying in the British top
                                        ten for 46 weeks. His children's book A Boy Called Christmas was a runaway hit and
                                        is translated in over 40 languages.</p>

                                    <a href="#" class="text-violet-600 hover:underline">View all books by Matt
                                        Haig</a>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Where to Buy Section -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold mb-6 section-title">Dimana bisa membeli buku ini</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Store 1 -->
            @if ($bookStore->isEmpty())
                <div class="col-span-full flex justify-center items-center text-center text-gray-500">
                    <p>Tidak ada toko buku yang tersedia untuk Anda.</p>
                </div>
            @else
                @foreach ($bookStore as $bookStore)
                    @php
                        $isAdded = in_array($book->id, $wantToReadBookIds ?? []);
                    @endphp

                    <x-card.bookstore-card :bookStore="$bookStore" />
                @endforeach
            @endif
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('home.discover') }}" class="btn-outline px-4 py-2 rounded-md font-medium">
                Lihat Semua Toko
            </a>
        </div>
    </div>

    <!-- Reviews Section -->
    {{-- <div class="mb-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold section-title">Reader Reviews</h2>

            <button class="btn-outline px-4 py-2 rounded-md text-sm font-medium">
                Write a Review
            </button>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="flex flex-col md:flex-row mb-6">
                <div class="md:w-1/4 mb-6 md:mb-0 flex flex-col items-center justify-center">
                    <div class="text-5xl font-bold text-violet-600 mb-2">4.5</div>
                    <div class="flex text-amber-400 mb-2">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <div class="text-gray-600 text-sm">Based on 2,387 reviews</div>
                </div>

                <div class="md:w-3/4 md:pl-8 md:border-l border-gray-200">
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <div class="w-1/4 text-sm text-gray-600">5 stars</div>
                            <div class="w-2/4">
                                <div class="h-2 bg-gray-200 rounded-full">
                                    <div class="h-2 bg-amber-400 rounded-full" style="width: 72%"></div>
                                </div>
                            </div>
                            <div class="w-1/4 text-sm text-gray-600 pl-2">72%</div>
                        </div>

                        <div class="flex items-center">
                            <div class="w-1/4 text-sm text-gray-600">4 stars</div>
                            <div class="w-2/4">
                                <div class="h-2 bg-gray-200 rounded-full">
                                    <div class="h-2 bg-amber-400 rounded-full" style="width: 18%"></div>
                                </div>
                            </div>
                            <div class="w-1/4 text-sm text-gray-600 pl-2">18%</div>
                        </div>

                        <div class="flex items-center">
                            <div class="w-1/4 text-sm text-gray-600">3 stars</div>
                            <div class="w-2/4">
                                <div class="h-2 bg-gray-200 rounded-full">
                                    <div class="h-2 bg-amber-400 rounded-full" style="width: 7%"></div>
                                </div>
                            </div>
                            <div class="w-1/4 text-sm text-gray-600 pl-2">7%</div>
                        </div>

                        <div class="flex items-center">
                            <div class="w-1/4 text-sm text-gray-600">2 stars</div>
                            <div class="w-2/4">
                                <div class="h-2 bg-gray-200 rounded-full">
                                    <div class="h-2 bg-amber-400 rounded-full" style="width: 2%"></div>
                                </div>
                            </div>
                            <div class="w-1/4 text-sm text-gray-600 pl-2">2%</div>
                        </div>

                        <div class="flex items-center">
                            <div class="w-1/4 text-sm text-gray-600">1 star</div>
                            <div class="w-2/4">
                                <div class="h-2 bg-gray-200 rounded-full">
                                    <div class="h-2 bg-amber-400 rounded-full" style="width: 1%"></div>
                                </div>
                            </div>
                            <div class="w-1/4 text-sm text-gray-600 pl-2">1%</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-200 pt-6">
                <div class="carousel">
                    <div class="carousel-inner">
                        <!-- Review 1 -->
                        <div class="carousel-item">
                            <div class="review-card bg-gray-50 rounded-lg p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="flex items-center">
                                        <div class="avatar mr-3"
                                            style="background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"200\" height=\"200\" viewBox=\"0 0 200 200\"><rect fill=\"%23a78bfa\" width=\"200\" height=\"200\"/><circle cx=\"100\" cy=\"80\" r=\"40\" fill=\"%23ffffff\"/><path d=\"M50,200 L50,150 C50,120 80,100 100,100 C120,100 150,120 150,150 L150,200 Z\" fill=\"%23ffffff\"/></svg>');">
                                        </div>
                                        <div>
                                            <h4 class="font-medium">Sarah Johnson</h4>
                                            <div class="text-sm text-gray-600">Posted 2 weeks ago</div>
                                        </div>
                                    </div>

                                    <div class="flex text-amber-400">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>

                                <h3 class="font-bold text-lg mb-2">A life-changing read</h3>

                                <p class="text-gray-700 mb-4">This book came to me at exactly the right time in my life.
                                    The concept of the Midnight Library - a place between life and death where you can try
                                    out all the lives you could have lived - is both thought-provoking and emotionally
                                    resonant. Matt Haig has a way of discussing deep philosophical concepts in an
                                    accessible, heartfelt manner.</p>

                                <p class="text-gray-700">The protagonist's journey through her regrets and alternate lives
                                    is beautifully crafted, and the ultimate message about appreciating the life you have is
                                    delivered without being preachy. I've recommended this book to everyone I know. It's the
                                    kind of story that stays with you long after you've turned the final page.</p>

                                <div class="mt-4 flex justify-between items-center">
                                    <div class="text-sm text-gray-600">
                                        <span>Was this review helpful?</span>
                                    </div>

                                    <div class="flex space-x-2">
                                        <button
                                            class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-md text-sm flex items-center">
                                            <i class="far fa-thumbs-up mr-1"></i>
                                            <span>Yes (42)</span>
                                        </button>

                                        <button
                                            class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-md text-sm flex items-center">
                                            <i class="far fa-thumbs-down mr-1"></i>
                                            <span>No (3)</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Review 2 -->
                        <div class="carousel-item">
                            <div class="review-card bg-gray-50 rounded-lg p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="flex items-center">
                                        <div class="avatar mr-3"
                                            style="background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"200\" height=\"200\" viewBox=\"0 0 200 200\"><rect fill=\"%2310b981\" width=\"200\" height=\"200\"/><circle cx=\"100\" cy=\"80\" r=\"40\" fill=\"%23ffffff\"/><path d=\"M50,200 L50,150 C50,120 80,100 100,100 C120,100 150,120 150,150 L150,200 Z\" fill=\"%23ffffff\"/></svg>');">
                                        </div>
                                        <div>
                                            <h4 class="font-medium">Michael Chen</h4>
                                            <div class="text-sm text-gray-600">Posted 1 month ago</div>
                                        </div>
                                    </div>

                                    <div class="flex text-amber-400">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                </div>

                                <h3 class="font-bold text-lg mb-2">Thoughtful but slightly predictable</h3>

                                <p class="text-gray-700 mb-4">The Midnight Library presents an intriguing premise that
                                    immediately drew me in. The idea of exploring different life paths is something most of
                                    us have wondered about, and Haig creates a compelling framework for this exploration.
                                </p>

                                <p class="text-gray-700">While I found the book engaging and emotionally resonant, I did
                                    feel that the ultimate message became somewhat predictable halfway through. That said,
                                    the journey was still worthwhile, and several of the alternate lives Nora experiences
                                    are beautifully imagined. The writing is accessible and warm, making complex
                                    philosophical ideas digestible. A solid 4-star read that I'd recommend, especially to
                                    anyone going through a period of reflection or regret.</p>

                                <div class="mt-4 flex justify-between items-center">
                                    <div class="text-sm text-gray-600">
                                        <span>Was this review helpful?</span>
                                    </div>

                                    <div class="flex space-x-2">
                                        <button
                                            class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-md text-sm flex items-center">
                                            <i class="far fa-thumbs-up mr-1"></i>
                                            <span>Yes (28)</span>
                                        </button>

                                        <button
                                            class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-md text-sm flex items-center">
                                            <i class="far fa-thumbs-down mr-1"></i>
                                            <span>No (5)</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Review 3 -->
                        <div class="carousel-item">
                            <div class="review-card bg-gray-50 rounded-lg p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="flex items-center">
                                        <div class="avatar mr-3"
                                            style="background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"200\" height=\"200\" viewBox=\"0 0 200 200\"><rect fill=\"%23f59e0b\" width=\"200\" height=\"200\"/><circle cx=\"100\" cy=\"80\" r=\"40\" fill=\"%23ffffff\"/><path d=\"M50,200 L50,150 C50,120 80,100 100,100 C120,100 150,120 150,150 L150,200 Z\" fill=\"%23ffffff\"/></svg>');">
                                        </div>
                                        <div>
                                            <h4 class="font-medium">Emma Rodriguez</h4>
                                            <div class="text-sm text-gray-600">Posted 3 months ago</div>
                                        </div>
                                    </div>

                                    <div class="flex text-amber-400">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>

                                <h3 class="font-bold text-lg mb-2">Beautiful exploration of life's possibilities</h3>

                                <p class="text-gray-700 mb-4">I devoured this book in a single sitting. The Midnight
                                    Library is one of those rare books that manages to be both a page-turner and deeply
                                    philosophical. Matt Haig has created a concept that feels both magical and grounded in
                                    real human emotions.</p>

                                <p class="text-gray-700">What I appreciated most was how the book doesn't shy away from
                                    mental health issues, presenting them with compassion and nuance. Nora's journey through
                                    depression and regret to eventual self-acceptance feels authentic. The writing style is
                                    accessible without being simplistic, and there are passages I've highlighted to return
                                    to when I need a reminder about what truly matters in life. Highly recommended for
                                    anyone who enjoys thoughtful fiction with a touch of magical realism.</p>

                                <div class="mt-4 flex justify-between items-center">
                                    <div class="text-sm text-gray-600">
                                        <span>Was this review helpful?</span>
                                    </div>

                                    <div class="flex space-x-2">
                                        <button
                                            class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-md text-sm flex items-center">
                                            <i class="far fa-thumbs-up mr-1"></i>
                                            <span>Yes (36)</span>
                                        </button>

                                        <button
                                            class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-md text-sm flex items-center">
                                            <i class="far fa-thumbs-down mr-1"></i>
                                            <span>No (2)</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="carousel-control prev">
                        <i class="fas fa-chevron-left"></i>
                    </button>

                    <button class="carousel-control next">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <div class="mt-6 text-center">
                    <button class="btn-outline px-4 py-2 rounded-md font-medium">
                        View All Reviews
                    </button>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Similar Books Section -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold mb-6 section-title">Kamu mungkin suka</h2>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @if ($books->isEmpty())
                <div class="col-span-full flex justify-center items-center text-center text-gray-500">
                    <p>Tidak ada buku yang tersedia untuk Anda.</p>
                </div>
            @else
                @foreach ($books as $book)
                    @php
                        $isAdded = in_array($book->id, $wantToReadBookIds ?? []);
                    @endphp
                    <x-card.book-card :book="$book" :isAdded="$isAdded" />
                @endforeach
            @endif
        </div>
    </div>

    <script>
        function toggleWantToRead(button) {
            const bookId = button.dataset.bookId;

            fetch(`/books/${bookId}/want-to-read`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        bookId: bookId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'added') {
                button.innerHTML = '<i class="fas fa-check mr-1 text-white"></i><span class="text-white">Ditambahkan</span>';
                button.classList.add('added', 'bg-violet-600', 'text-white');
                button.classList.remove('bg-white', 'text-violet-600');
            } else if (data.status === 'removed') {
                button.innerHTML = '<i class="far fa-bookmark mr-1 text-violet-600"></i><span class="text-violet-600">Ingin Membaca</span>';
                button.classList.remove('added', 'bg-violet-600', 'text-white');
                button.classList.add('bg-white', 'text-violet-600');
            }
                });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Tab functionality
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabContents = document.querySelectorAll('.tab-content');

            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const tabId = this.getAttribute('data-tab');

                    // Remove active class from all buttons and contents
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    tabContents.forEach(content => content.classList.remove('active'));

                    // Add active class to current button and content
                    this.classList.add('active');
                    document.getElementById(tabId).classList.add('active');
                });
            });

            // Wishlist button functionality
            const wishlistBtn = document.querySelector('.wishlist-btn');

            wishlistBtn.addEventListener('click', function() {
                const icon = this.querySelector('i');

                if (icon.classList.contains('far')) {
                    icon.classList.remove('far');
                    icon.classList.add('fas');
                    this.classList.add('active');
                    this.querySelector('span').textContent = 'Added to Wishlist';
                } else {
                    icon.classList.remove('fas');
                    icon.classList.add('far');
                    this.classList.remove('active');
                    this.querySelector('span').textContent = 'Add to Wishlist';
                }
            });

            // Read button functionality
            const readBtn = document.querySelector('#asas');

            readBtn.addEventListener('click', function() {
                console.log("asas")
            });

            // const wantToReadBtns = document.querySelectorAll('.read-btn');

            // wantToReadBtns.forEach(btn => {
            //     btn.addEventListener('click', function(e) {
            //         e.preventDefault();
            //         const bookId = this.dataset.bookId;
            //         const button = this;

            //         fetch(`/books/${bookId}/want-to-read`, {
            //                 method: 'POST',
            //                 headers: {
            //                     'X-CSRF-TOKEN': document.querySelector(
            //                         'meta[name="csrf-token"]').getAttribute('content'),
            //                     'Content-Type': 'application/json',
            //                 },
            //                 body: JSON.stringify({
            //                     bookId: bookId
            //                 })
            //             })
            //             .then(response => response.json())
            //             .then(data => {
            //                 if (data.status === 'added') {
            //                     button.innerHTML = '<i class="fas fa-check mr-1"></i> Ditambahkan';
            //                     button.classList.add('added', 'bg-violet-600', 'text-white');
            //                     button.classList.remove('bg-white', 'text-violet-600');
            //                 } else if (data.status === 'removed') {
            //                     button.innerHTML =
            //                         '<i class="fas fa-bookmark mr-1"></i> Ingin Membaca';
            //                     button.classList.remove('added', 'bg-violet-600', 'text-white');
            //                     button.classList.add('bg-white', 'text-violet-600');
            //                 }
            //             });
            //     });
            // });

            // Review carousel functionality
            const carousel = document.querySelector('.carousel');
            const carouselInner = carousel.querySelector('.carousel-inner');
            const carouselItems = carousel.querySelectorAll('.carousel-item');
            const prevBtn = carousel.querySelector('.carousel-control.prev');
            const nextBtn = carousel.querySelector('.carousel-control.next');

            let currentIndex = 0;
            const itemCount = carouselItems.length;

            function updateCarousel() {
                const translateValue = -currentIndex * 100 + '%';
                carouselInner.style.transform = 'translateX(' + translateValue + ')';
            }

            prevBtn.addEventListener('click', function() {
                currentIndex = (currentIndex - 1 + itemCount) % itemCount;
                updateCarousel();
            });

            nextBtn.addEventListener('click', function() {
                currentIndex = (currentIndex + 1) % itemCount;
                updateCarousel();
            });

            // Initialize carousel
            updateCarousel();
        });
    </script>

@endsection
