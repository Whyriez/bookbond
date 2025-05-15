@extends('layouts.app')
@section('title', 'Communities')
@section('communities', 'active')

@section('content')
    <div class="relative overflow-hidden" style="background-color: #6366f1;">
        <!-- SVG background -->
        <svg viewBox="0 0 1440 80" xmlns="http://www.w3.org/2000/svg"
            class="absolute bottom-0 left-0 w-full h-16 pointer-events-none">
            <path fill="#ffffff" fill-opacity="0.2"
                d="M0,32L48,48L96,32L144,48L192,32L240,48L288,32L336,48L384,32L432,48L480,32L528,48L576,32L624,48L672,32L720,48L768,32L816,48L864,32L912,48L960,32L1008,48L1056,32L1104,48L1152,32L1200,48L1248,32L1296,48L1344,32L1392,48L1440,32L1440,0L0,0Z">
            </path>
        </svg>

        <!-- Banner content -->
        <div class="container mx-auto px-4 pt-12 pb-20 relative z-10 flex flex-col justify-end h-full banner-content">
            <div class="flex flex-col md:flex-row md:items-end justify-between">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">{{ $community->name }}</h1>
                    <p class="text-white text-opacity-90 mb-2 max-w-2xl">
                        {{ $community->description }}
                    </p>

                    <div class="flex items-center text-white text-opacity-90">
                        <span class="flex items-center mr-4">
                            <i class="fas fa-users mr-2"></i>
                            {{ $community->users->count() }} anggota
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            Dibuat {{ $community->created_at->format('M Y') }}
                        </span>
                    </div>
                </div>

                <div>
                    @if ($isMember)
                        {{-- <form action="{{ route('communities.leave', $community->id) }}" method="POST"> --}}
                        @csrf
                        <button
                            class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-full font-medium text-white transition">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Tinggalkan Komunitas
                        </button>
                        {{-- </form> --}}
                    @else
                        <form action="{{ route('home.community.join', $community->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-success px-3 py-1.5 rounded-full text-sm font-medium">
                                <i class="fas fa-plus mr-1"></i> Gabung
                            </button>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>



    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Content -->
            <div class="w-full lg:w-2/3">

                <!-- Create Post Section -->
                @if ($isMember)
                    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                        <h2 class="text-xl font-bold mb-4">Buat Postingan Baru</h2>

                        <form id="create-post-form" method="POST" action="{{ route('home.community.post.store') }}">
                            @csrf
                            <div class="mb-4">
                                <input type="text" placeholder="Judul Postingan" name="title"
                                    class="block w-full max-w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent overflow-x-hidden">

                            </div>

                            <div class="mb-4">
                                <textarea id="postContent" name="content"></textarea>
                            </div>
                            <input type="hidden" name="book_id" id="book-id">
                            <input type="hidden" name="community_id" value="{{ $community->id }}">
                            <div class="mb-6">
                                <div class="w-full" id="book-select-container">
                                    {{-- Dropdown --}}
                                    <div id="dropdown-wrapper" class="w-full">
                                        <select id="book-dropdown" class="w-full rounded-md border-gray-300 shadow-sm">
                                            <option value="">-- Pilih Buku --</option>
                                            @foreach ($books as $book)
                                                <option value="{{ $book->id }}" data-title="{{ $book->name }}"
                                                    data-author="{{ $book->author }}"
                                                    data-image="{{ asset('storage/' . $book->image) }}">
                                                    {{ $book->name }} oleh {{ $book->author }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Attached Book --}}
                                    <div id="attached-book"
                                        class="hidden w-full mt-2 flex items-center justify-between space-x-3 bg-violet-50 px-3 py-2 rounded-md">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-14 bg-violet-200 rounded flex items-center justify-center">
                                                {{-- <i class="fas fa-book text-violet-600"></i> --}}
                                                <div
                                                    class="w-10 h-14 bg-violet-200 rounded flex items-center justify-center overflow-hidden">
                                                    <img id="book-image" src="" alt="Book cover"
                                                        class="w-full h-full object-cover">
                                                </div>

                                            </div>
                                            <div>
                                                <p id="book-title" class="font-medium text-sm"></p>
                                                <p id="book-author" class="text-xs text-gray-600"></p>
                                            </div>
                                        </div>
                                        <button type="button" id="remove-book-btn"
                                            class="text-gray-400 hover:text-red-500">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="btn-primary md:w-full px-4 py-2 rounded-md font-medium">
                                    <i class="fas fa-paper-plane mr-2"></i>
                                    Publikasikan Postingan
                                </button>
                            </div>
                        </form>
                    </div>
                @endif

                <!-- Community Posts -->
                <div class="mb-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Postingan Komunitas</h2>

                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-600">Urutkan berdasarkan:</span>
                            <select onchange="location.href='?sort=' + this.value"
                                class="bg-white border border-gray-300 rounded-md px-2 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent">
                                <option value="recent" {{ request('sort') === 'recent' ? 'selected' : '' }}>Terkini
                                </option>
                                <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>Populer
                                </option>
                            </select>
                        </div>
                    </div>

                    @foreach ($communityPosts as $post)
                        <x-card.post-card :post="$post" />
                    @endforeach


                    <!-- Pagination -->
                    <div class="flex justify-center mt-8">
                        {{ $communityPosts->appends(['sort' => request('sort')])->links() }}
                        {{-- <nav class="flex items-center space-x-1">
                            <a href="#"
                                class="px-3 py-1 rounded-md bg-white border border-gray-300 text-gray-600 hover:bg-gray-50">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <a href="#" class="px-3 py-1 rounded-md bg-violet-600 text-white">1</a>
                            <a href="#"
                                class="px-3 py-1 rounded-md bg-white border border-gray-300 text-gray-600 hover:bg-gray-50">2</a>
                            <a href="#"
                                class="px-3 py-1 rounded-md bg-white border border-gray-300 text-gray-600 hover:bg-gray-50">3</a>
                            <span class="px-2 text-gray-500">...</span>
                            <a href="#"
                                class="px-3 py-1 rounded-md bg-white border border-gray-300 text-gray-600 hover:bg-gray-50">12</a>
                            <a href="#"
                                class="px-3 py-1 rounded-md bg-white border border-gray-300 text-gray-600 hover:bg-gray-50">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </nav> --}}
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:w-1/3">
                <!-- Community Info -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h3 class="text-lg font-bold mb-4">Tentang Komunitas Ini</h3>

                    <div class="mb-4">
                        <h4 class="text-sm font-medium text-gray-600 mb-2">Aliran</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($community->categories as $category)
                                <span
                                    class="genre-pill bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded-full">{{ $category->name }}</span>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-4">
                        <h4 class="text-sm font-medium text-gray-600 mb-2">Aturan Komunitas</h4>
                        <ul class="text-sm text-gray-700 space-y-2">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                <span>Hormatilah anggota lain</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                <span>Gunakan tag spoiler saat mendiskusikan poin plot</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                <span>Tidak ada promosi diri tanpa persetujuan mod</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                <span>Tetap pada topik - buku fantasi dan media terkait</span>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-sm font-medium text-gray-600 mb-2">Admin</h4>
                        <div class="flex flex-wrap gap-2">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 rounded-full bg-violet-100 flex items-center justify-center">
                                    @php
                                        $initials = strtoupper(substr($community->owner->name, 0, 2));
                                    @endphp
                                    <span class="text-violet-600 font-medium text-xs">{{ $initials }}</span>
                                </div>
                                <span class="text-sm">{{ $community->owner->name }}</span>
                            </div>
                        </div>
                    </div>

                </div>



                <!-- Related Communities -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h3 class="text-lg font-bold mb-4">Komunitas Terkait</h3>

                    <div class="space-y-4">
                        @if ($relatedCommunities->isEmpty())
                            <p class="text-center text-gray-500">Tidak ada komunitas terkait yang ditemukan.</p>
                        @else
                            @foreach ($relatedCommunities as $relatedCommunity)
                                <a href="{{ route('home.community.show', $relatedCommunity->id) }}"
                                    class="related-community flex items-center justify-between group">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                            <i class="fas fa-users text-indigo-600"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium group-hover:text-violet-600">
                                                {{ $relatedCommunity->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $relatedCommunity->users->count() }}
                                                anggota</p>
                                        </div>
                                    </div>
                                    <i class="fas fa-chevron-right text-gray-400 group-hover:text-violet-600"></i>
                                </a>
                            @endforeach
                        @endif
                    </div>
                    @if (!$relatedCommunities->isEmpty())
                        <div class="mt-4 text-center">
                            <a href="#" class="text-sm text-violet-600 hover:text-violet-800 font-medium">
                                Lihat Semua Komunitas Terkait
                            </a>
                        </div>
                    @endif
                </div>



                <!-- Community Events -->
                {{-- <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-bold mb-4">Acara Mendatang</h3>

                    <div class="space-y-4">
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="font-medium">Diskusi Buku Bulanan</h4>
                                <span class="bg-violet-100 text-violet-800 text-xs px-2 py-1 rounded-full">Virtual</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">Membahas "The Fifth Season" oleh N.K. Jemisin</p>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="far fa-calendar-alt mr-2"></i>
                                <span>May 25, 2023 • 7:00 PM EST</span>
                            </div>
                            <div class="mt-3">
                                <button class="btn-outline w-full py-1.5 rounded-md text-sm">
                                    <i class="far fa-calendar-plus mr-1"></i>
                                    Add to Calendar
                                </button>
                            </div>
                        </div>

                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="font-medium">Author Q&A Session</h4>
                                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Live</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">Live Q&A with fantasy author Rebecca Ross</p>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="far fa-calendar-alt mr-2"></i>
                                <span>June 3, 2023 • 3:00 PM EST</span>
                            </div>
                            <div class="mt-3">
                                <button class="btn-outline w-full py-1.5 rounded-md text-sm">
                                    <i class="far fa-calendar-plus mr-1"></i>
                                    Add to Calendar
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 text-center">
                        <a href="#" class="text-sm text-violet-600 hover:text-violet-800 font-medium">
                            View All Events
                        </a>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            ClassicEditor
                .create(document.querySelector('#postContent'), {
                    toolbar: [
                        'heading', '|', 'bold', 'italic', 'underline', '|',
                        'bulletedList', 'numberedList', '|',
                        'blockQuote', 'insertTable', '|', 'link',
                    ],
                })
                .then(editor => {
                    // Add resize handling
                    window.addEventListener('resize', () => {
                        editor.editing.view.change(writer => {
                            writer.setAttribute('style', 'width: 100%', editor.editing.view
                                .document.getRoot());
                        });
                    });
                })
                .catch(error => {
                    console.error(error);
                });


            // Attach book functionality
            new TomSelect("#book-dropdown", {
                placeholder: "Search a Book...",
                allowEmptyOption: true,
                create: false
            });

            const dropdown = document.getElementById('book-dropdown');
            const dropdownWrapper = document.getElementById('dropdown-wrapper');
            const attachedBook = document.getElementById('attached-book');
            const bookTitle = document.getElementById('book-title');
            const bookAuthor = document.getElementById('book-author');
            const bookImage = document.getElementById('book-image');
            const bookIdInput = document.getElementById('book-id');
            const removeBtn = document.getElementById('remove-book-btn');

            dropdown.addEventListener('change', function() {
                const selected = this.options[this.selectedIndex];
                if (selected.value !== "") {
                    bookTitle.textContent = selected.dataset.title;
                    bookAuthor.textContent = `by ${selected.dataset.author}`;
                    bookImage.src = selected.dataset.image;
                    bookIdInput.value = selected.value;

                    attachedBook.classList.remove('hidden');
                    dropdownWrapper.classList.add('hidden');
                }
            });

            removeBtn.addEventListener('click', function() {
                dropdown.selectedIndex = 0;
                bookIdInput.value = '';
                attachedBook.classList.add('hidden');
                dropdownWrapper.classList.remove('hidden');
            });

            // const attachBookBtn = document.getElementById('attach-book-btn');
            // const attachedBook = document.getElementById('attached-book');
            // const removeBookBtn = document.getElementById('remove-book-btn');

            // attachBookBtn.addEventListener('click', function() {
            //     attachedBook.classList.remove('hidden');
            //     attachBookBtn.classList.add('hidden');
            // });

            // removeBookBtn.addEventListener('click', function() {
            //     attachedBook.classList.add('hidden');
            //     attachBookBtn.classList.remove('hidden');
            // });

            // Like functionality
            const likeButtons = document.querySelectorAll('.far.fa-heart').forEach(button => {
                button.addEventListener('click', function() {
                    const isLiked = this.classList.contains('fas');
                    const countElement = this.nextElementSibling;
                    let count = parseInt(countElement.textContent);

                    if (isLiked) {
                        this.classList.remove('fas');
                        this.classList.add('far');
                        this.style.color = '';
                        countElement.textContent = count - 1;
                    } else {
                        this.classList.remove('far');
                        this.classList.add('fas');
                        this.style.color = '#ec4899';
                        countElement.textContent = count + 1;
                    }
                });
            });

            // Form submission
            // const createPostForm = document.getElementById('create-post-form');

            // createPostForm.addEventListener('submit', function(e) {
            //     e.preventDefault();

            //     const title = this.querySelector('input[type="text"]').value;
            //     const content = document.querySelector('.editor-content').innerHTML;

            //     if (title && content) {
            //         alert('Your post has been published!');
            //         this.reset();
            //         document.querySelector('.editor-content').innerHTML = '';
            //         attachedBook.classList.add('hidden');
            //         attachBookBtn.classList.remove('hidden');
            //     } else {
            //         alert('Please fill in both title and content for your post.');
            //     }
            // });

            // Editor placeholder functionality
            const editorContent = document.querySelector('.editor-content');

            editorContent.addEventListener('focus', function() {
                if (this.innerHTML === '<span class="text-gray-400">' + this.getAttribute('placeholder') +
                    '</span>') {
                    this.innerHTML = '';
                }
            });

            editorContent.addEventListener('blur', function() {
                if (this.innerHTML === '') {
                    this.innerHTML = '<span class="text-gray-400">' + this.getAttribute('placeholder') +
                        '</span>';
                }
            });

            // Initialize with placeholder
            if (editorContent.innerHTML === '') {
                editorContent.innerHTML = '<span class="text-gray-400">' + editorContent.getAttribute(
                    'placeholder') + '</span>';
            }

            // Editor toolbar functionality


            // Community membership toggle
            const membershipBtn = document.querySelector('.btn-danger');

            membershipBtn.addEventListener('click', function() {
                if (this.classList.contains('btn-danger')) {
                    if (confirm('Are you sure you want to leave this community?')) {
                        this.classList.remove('btn-danger');
                        this.classList.add('btn-primary');
                        this.innerHTML = '<i class="fas fa-plus mr-2"></i>Join Community';
                    }
                } else {
                    this.classList.remove('btn-primary');
                    this.classList.add('btn-danger');
                    this.innerHTML = '<i class="fas fa-sign-out-alt mr-2"></i>Leave Community';
                    alert('You have joined the Fantasy Book Club community!');
                }
            });
        });

        function toggleContent(postId) {
            var contentLimited = document.getElementById("content-limited-" + postId);
            var contentFull = document.getElementById("content-full-" + postId);
            var button = document.getElementById("toggle-btn-" + postId);

            if (contentFull.classList.contains("hidden")) {
                contentFull.classList.remove("hidden");
                contentLimited.classList.add("hidden");
                button.textContent = "Read Less";
            } else {
                contentFull.classList.add("hidden");
                contentLimited.classList.remove("hidden");
                button.textContent = "Read More";
            }
        }
    </script>

@endsection
