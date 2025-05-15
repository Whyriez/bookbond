@extends('layouts.app')
@section('title', 'Communities')
@section('communities', 'active')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold mb-2">Komunitas Anda</h1>
            <p class="text-gray-600">Terhubung dengan sesama pecinta buku dan bergabung dalam percakapan</p>
        </div>

        <div class="mt-4 md:mt-0">
            <button id="create-community-btn" class="btn-primary px-4 py-2 rounded-full font-medium flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Buat Komunitas Baru
            </button>
        </div>
    </div>

    <!-- Your Communities Section -->
    <div class="mb-12">
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
        <h2 class="text-xl font-bold mb-6 flex items-center">
            <i class="fas fa-users text-violet-600 mr-2"></i>
            Komunitas yang Anda Ikuti
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($allCommunities as $community)

                <div class="community-card bg-white shadow-md relative">
                    <div class="community-banner" style="background-color: {{ $community->random_color }};">
                        <svg viewBox="0 0 200 80" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                            <path fill="#ffffff" fill-opacity="0.2" d="{{ $community->random_shape }}"></path>
                        </svg>
                    </div>

                    <div class="p-5">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="font-bold text-lg">{{ $community->name }}</h3>
                            <span class="text-xs px-2 py-1 rounded-full"
                                style="background-color: {{ $community->light_background_color }}; color: {{ $community->random_text_color }};">
                                <i class="fas fa-users mr-1"></i> {{ $community->users->count() }}
                            </span>

                        </div>
                        <p class="community-description text-sm text-gray-600 mb-4">{{ $community->description }}</p>

                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach ($community->categories as $category)
                                @php
                                    $color = $community->category_colors[$category->id] ?? $community->random_color;
                                @endphp
                                <span class="community-genre text-xs px-2 py-1 rounded-full"
                                    style="background-color: {{ $color }}; color: white;">
                                    {{ $category->name }}
                                </span>
                            @endforeach


                        </div>
                        <div class="flex justify-between items-center">
                            <a href="{{ route('home.community.show', $community->id) }}"
                                class="btn-primary px-3 py-1.5 rounded-full text-sm font-medium">
                                <i class="fas fa-eye mr-1"></i> Lihat
                            </a>
                            <form action="{{ route('home.community.leave', $community->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to leave this community?');">
                                @csrf
                                <button type="submit" class="btn-danger px-3 py-1.5 rounded-full text-sm font-medium">
                                    <i class="fas fa-sign-out-alt mr-1"></i> Keluar
                                </button>
                            </form>

                        </div>
                    </div>
                    @if ($community->user_id === $user->id)
                        <div class="absolute top-4 right-4 flex gap-2">
                            <button id="edit-community-btn"
                                class="text-gray-500 hover:text-indigo-600 transition-all text-lg" title="Edit"
                                data-id="{{ $community->id }}">
                                <i class="fas fa-edit"></i>
                            </button>

                            <form action="{{ route('home.community.destroy', $community->id) }}" method="POST"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="text-gray-500 hover:text-red-600 transition-all text-lg"
                                    onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>

                        </div>
                    @endif
                </div>

            @empty
                <p class="p-3 text-gray-500 italic w">Anda belum bergabung atau membuat komunitas apa pun.</p>
            @endforelse
        </div>
    </div>

    <!-- Explore Communities Section -->
    <div class="mb-8">
        <h2 class="text-xl font-bold mb-6 flex items-center">
            <i class="fas fa-compass text-violet-600 mr-2"></i>
            Jelajahi Komunitas Lain
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Explore Community Card 1 -->
            @if ($exploreCommunities->isEmpty())
                <div class="col-span-3 text-center text-gray-500">
                    <p>Tidak ada komunitas yang tersedia untuk dijelajahi.</p>
                </div>
            @else
                @foreach ($exploreCommunities as $community)
                    <div class="community-card bg-white shadow-md">
                        <div class="community-banner" style="background-color: {{ $community->random_color }};">
                            <svg viewBox="0 0 200 80" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                                <path fill="#ffffff" fill-opacity="0.2" d="{{ $community->random_shape }}"></path>
                            </svg>
                        </div>
                        <div class="p-5">
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="font-bold text-lg">{{ $community->name }}</h3>
                                <span class="text-xs px-2 py-1 rounded-full"
                                    style="background-color: {{ $community->light_background_color }}; color: {{ $community->random_text_color }};">
                                    <i class="fas fa-users mr-1"></i> {{ $community->users->count() }}
                                </span>
                            </div>
                            <p class="community-description text-sm text-gray-600 mb-4">{{ $community->description }}</p>
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach ($community->categories as $category)
                                    @php
                                        $color = $community->category_colors[$category->id] ?? $community->random_color;
                                    @endphp
                                    <span class="community-genre text-xs px-2 py-1 rounded-full"
                                        style="background-color: {{ $color }}; color: white;">
                                        {{ $category->name }}
                                    </span>
                                @endforeach
                            </div>
                            <div class="flex justify-end">
                                <form action="{{ route('home.community.join', $community->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-success px-3 py-1.5 rounded-full text-sm font-medium">
                                        <i class="fas fa-plus mr-1"></i> Gabung
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Create Community Modal -->
    <div id="create-community-modal" class="modal fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="modal-overlay absolute inset-0 bg-black opacity-50"></div>

        <div
            class="modal-content bg-white w-full max-w-md mx-4 rounded-lg shadow-xl z-50 transform scale-95 opacity-0 transition-all duration-300">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold">Buat Komunitas Baru</h3>
                    <button id="close-modal" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form id="create-community-form" method="POST" action="{{ route('home.community.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="community-name" class="block text-sm font-medium text-gray-700 mb-1">Nama Komunitas</label>
                        <input type="text" id="community-name"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                            placeholder="Masukkan nama komunitas" name="name" required>
                    </div>

                    <div class="mb-4">
                        <label for="community-description"
                            class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                        <textarea id="community-description" rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                            placeholder="Apa komunitas Anda tentang?" name="description" required></textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Genre</label>
                        <div class="multiselect-dropdown relative">
                            <button type="button" id="genre-dropdown-btn"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md bg-white text-left flex justify-between items-center focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent">
                                <span id="selected-genres-text">Pilih Genre</span>
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </button>

                            <div id="genre-options"
                                class="dropdown-options absolute left-0 right-0 mt-1 bg-white border border-gray-300 rounded-md shadow-lg z-10 hidden">
                                <div class="p-2">
                                    @foreach ($categories as $category)
                                        <div class="flex items-center p-2 hover:bg-gray-100 rounded">
                                            <input type="checkbox" id="genre-{{ Str::slug($category->name) }}"
                                                class="genre-checkbox mr-2" name="categories[]"
                                                value="{{ $category->id }}"> <!-- GANTI KE ID -->
                                            <label for="genre-{{ Str::slug($category->name) }}"
                                                class="cursor-pointer w-full">
                                                {{ $category->name }}
                                            </label>
                                        </div>
                                    @endforeach

                                </div>
                            </div>

                        </div>
                        <div id="selected-genres-container" class="flex flex-wrap gap-2 mt-2"></div>
                    </div>

                    <div class="flex justify-end">
                        <button type="button" id="cancel-create"
                            class="btn-secondary px-4 py-2 rounded-md mr-2">Batal</button>
                        <button type="submit" class="btn-primary px-4 py-2 rounded-md">Buat Komunitas</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Community Modal -->
    <div id="edit-community-modal" class="modal fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="modal-overlay absolute inset-0 bg-black opacity-50"></div>

        <div
            class="modal-content bg-white w-full max-w-md mx-4 rounded-lg shadow-xl z-50 transform scale-95 opacity-0 transition-all duration-300">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold">Edit Komunitas</h3>
                    <button id="close-edit-modal" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form id="edit-community-form" method="POST" action="{{ route('home.community.update', ':id') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit-community-id" name="id">

                    <div class="mb-4">
                        <label for="edit-community-name" class="block text-sm font-medium text-gray-700 mb-1">Nama Komunitas</label>
                        <input type="text" id="edit-community-name"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                            placeholder="Masukkan nama komunitas" name="name" required>
                    </div>

                    <div class="mb-4">
                        <label for="edit-community-description"
                            class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                        <textarea id="edit-community-description" rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                            placeholder="Apa komunitas Anda tentang??" name="description" required></textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Genre</label>
                        <div class="multiselect-dropdown relative">
                            <button type="button" id="edit-genre-dropdown-btn"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md bg-white text-left flex justify-between items-center focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent">
                                <span id="edit-selected-genres-text">Pilih Genre</span>
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </button>

                            <div id="edit-genre-options"
                                class="dropdown-options absolute left-0 right-0 mt-1 bg-white border border-gray-300 rounded-md shadow-lg z-10 hidden">
                                <div class="p-2">
                                    @foreach ($categories as $category)
                                        <div class="flex items-center p-2 hover:bg-gray-100 rounded">
                                            <input type="checkbox" id="edit-genre-{{ Str::slug($category->name) }}"
                                                class="edit-genre-checkbox mr-2" name="categories[]"
                                                value="{{ $category->id }}">
                                            <label for="edit-genre-{{ Str::slug($category->name) }}"
                                                class="cursor-pointer w-full">
                                                {{ $category->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                        <div id="edit-selected-genres-container" class="flex flex-wrap gap-2 mt-2"></div>
                    </div>

                    <div class="flex justify-end">
                        <button type="button" id="cancel-edit"
                            class="btn-secondary px-4 py-2 rounded-md mr-2">Batal</button>
                        <button type="submit" class="btn-primary px-4 py-2 rounded-md">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const createCommunityBtn = document.getElementById('create-community-btn');
            const createCommunityModal = document.getElementById('create-community-modal');
            const closeModalBtn = document.getElementById('close-modal');
            const cancelCreateBtn = document.getElementById('cancel-create');
            const modalContent = document.querySelector('.modal-content');

            function openModal() {
                createCommunityModal.classList.remove('hidden');
                setTimeout(() => {
                    modalContent.classList.remove('scale-95', 'opacity-0');
                    modalContent.classList.add('scale-100', 'opacity-100');
                }, 10);
            }

            function closeModal() {
                modalContent.classList.remove('scale-100', 'opacity-100');
                modalContent.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    createCommunityModal.classList.add('hidden');
                }, 300);
            }

            createCommunityBtn.addEventListener('click', openModal);
            closeModalBtn.addEventListener('click', closeModal);
            cancelCreateBtn.addEventListener('click', closeModal);

            createCommunityModal.addEventListener('click', function(e) {
                if (e.target === createCommunityModal) {
                    closeModal();
                }
            });

            // Genre dropdown functionality
            const genreDropdownBtn = document.getElementById('genre-dropdown-btn');
            const genreOptions = document.getElementById('genre-options');
            const genreCheckboxes = document.querySelectorAll('.genre-checkbox');
            const selectedGenresText = document.getElementById('selected-genres-text');
            const selectedGenresContainer = document.getElementById('selected-genres-container');

            genreDropdownBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                genreOptions.classList.toggle('hidden');
                // Tutup edit dropdown jika terbuka
                editGenreOptions.classList.add('hidden');
            });


            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!genreDropdownBtn.contains(e.target) && !genreOptions.contains(e.target)) {
                    genreOptions.classList.add('hidden');
                }

                if (!editGenreDropdownBtn.contains(e.target) && !editGenreOptions.contains(e.target)) {
                    editGenreOptions.classList.add('hidden');
                }
            });

            // Handle genre selection
            genreCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateSelectedGenres);
            });

            // Di dalam fungsi updateSelectedGenres() untuk create modal, ganti dengan:
            function updateSelectedGenres() {
                const selectedGenres = Array.from(genreCheckboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => {
                        return {
                            id: checkbox.value,
                            name: checkbox.nextElementSibling.textContent.trim()
                        };
                    });

                selectedGenresContainer.innerHTML = '';

                if (selectedGenres.length === 0) {
                    selectedGenresText.textContent = 'Select genres';
                } else {
                    selectedGenresText.textContent = `${selectedGenres.length} selected`;

                    selectedGenres.forEach(genre => {
                        const pill = document.createElement('span');
                        pill.className =
                            'genre-pill bg-violet-100 text-violet-800 text-xs px-2 py-1 rounded-full flex items-center';
                        pill.innerHTML = `
                ${genre.name}
                <button type="button" class="ml-1 text-violet-600 hover:text-violet-800 focus:outline-none" data-genre-id="${genre.id}">
                    <i class="fas fa-times"></i>
                </button>
            `;
                        selectedGenresContainer.appendChild(pill);

                        // Add remove functionality
                        const removeBtn = pill.querySelector('button');
                        removeBtn.addEventListener('click', function() {
                            const genreIdToRemove = this.getAttribute('data-genre-id');
                            const checkbox = Array.from(genreCheckboxes).find(cb => cb.value ===
                                genreIdToRemove);
                            if (checkbox) {
                                checkbox.checked = false;
                                updateSelectedGenres();
                            }
                        });
                    });
                }
            }


            const editCommunityBtns = document.querySelectorAll('#edit-community-btn');
            const editCommunityModal = document.getElementById('edit-community-modal');
            const closeEditModalBtn = document.getElementById('close-edit-modal');
            const cancelEditBtn = document.getElementById('cancel-edit');
            const editGenreDropdownBtn = document.getElementById('edit-genre-dropdown-btn');
            const editGenreOptions = document.getElementById('edit-genre-options');
            const editModalContent = document.querySelector('#edit-community-modal .modal-content');
            const editCommunityForm = document.getElementById('edit-community-form');
            const editGenreCheckboxes = document.querySelectorAll('.edit-genre-checkbox');
            const editSelectedGenresContainer = document.getElementById('edit-selected-genres-container');
            const editSelectedGenresText = document.getElementById('edit-selected-genres-text');

            // Open edit modal and load data into form
            editCommunityBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const communityCard = this.closest('.community-card');
                    const communityId = this.getAttribute('data-id'); // Ambil dari tombol edit
                    const communityName = communityCard.querySelector('h3').textContent;
                    const communityDescription = communityCard.querySelector(
                        '.community-description').textContent;
                    const communityGenres = communityCard.querySelectorAll('.community-genre');

                    // Set form action URL dengan ID yang benar
                    editCommunityForm.action = editCommunityForm.action.replace(':id', communityId);
                    document.getElementById('edit-community-id').value = communityId;
                    document.getElementById('edit-community-name').value = communityName;
                    document.getElementById('edit-community-description').value =
                        communityDescription;

                    // Reset semua checkbox terlebih dahulu
                    editGenreCheckboxes.forEach(checkbox => {
                        checkbox.checked = false;
                    });

                    // Set checkbox berdasarkan genre yang sudah ada
                    communityGenres.forEach(genreElement => {
                        const genreName = genreElement.textContent.trim();
                        // Cari checkbox yang labelnya sesuai dengan nama genre
                        const correspondingCheckbox = Array.from(editGenreCheckboxes).find(
                            checkbox => {
                                const label = checkbox.nextElementSibling.textContent
                                    .trim();
                                return label === genreName;
                            });

                        if (correspondingCheckbox) {
                            correspondingCheckbox.checked = true;
                        }
                    });

                    // Panggil fungsi update untuk menampilkan genre yang terpilih
                    updateEditSelectedGenres();
                    openEditModal();
                });
            });

            editGenreDropdownBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                editGenreOptions.classList.toggle('hidden');
                // Tutup create dropdown jika terbuka
                genreOptions.classList.add('hidden');
            });


            // Close edit dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!editGenreDropdownBtn.contains(e.target) && !editGenreOptions.contains(e.target)) {
                    editGenreOptions.classList.add('hidden');
                }
            });

            // Open the modal
            function openEditModal() {
                editCommunityModal.classList.remove('hidden');
                setTimeout(() => {
                    editModalContent.classList.remove('scale-95', 'opacity-0');
                    editModalContent.classList.add('scale-100', 'opacity-100');
                }, 10);
            }

            // Close the modal
            function closeEditModal() {
                editModalContent.classList.remove('scale-100', 'opacity-100');
                editModalContent.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    editCommunityModal.classList.add('hidden');
                }, 300);
            }

            closeEditModalBtn.addEventListener('click', closeEditModal);
            cancelEditBtn.addEventListener('click', closeEditModal);

            // Handle genre selection for edit modal
            editGenreCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateEditSelectedGenres);
            });

            function updateEditSelectedGenres() {
                const selectedGenres = Array.from(editGenreCheckboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => {
                        return {
                            id: checkbox.value,
                            name: checkbox.nextElementSibling.textContent.trim()
                        };
                    });

                editSelectedGenresContainer.innerHTML = '';

                if (selectedGenres.length === 0) {
                    editSelectedGenresText.textContent = 'Select genres';
                } else {
                    editSelectedGenresText.textContent = `${selectedGenres.length} selected`;

                    selectedGenres.forEach(genre => {
                        const pill = document.createElement('span');
                        pill.className =
                            'genre-pill bg-violet-100 text-violet-800 text-xs px-2 py-1 rounded-full flex items-center';
                        pill.innerHTML = `
                    ${genre.name}
                    <button type="button" class="ml-1 text-violet-600 hover:text-violet-800 focus:outline-none" data-genre="${genre}">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                        editSelectedGenresContainer.appendChild(pill);

                        // Add remove functionality
                        const removeBtn = pill.querySelector('button');
                        removeBtn.addEventListener('click', function() {
                            const genreToRemove = this.getAttribute('data-genre');
                            const checkbox = Array.from(editGenreCheckboxes).find(cb => cb.value ===
                                genreToRemove);
                            if (checkbox) {
                                checkbox.checked = false;
                                updateEditSelectedGenres();
                            }
                        });
                    });
                }
            }
            editCommunityModal.addEventListener('click', function(e) {
                if (e.target === editCommunityModal) {
                    closeEditModal();
                }
            });
        });
    </script>

@endsection
