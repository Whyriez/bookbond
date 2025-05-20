@extends('layouts.app')
@section('title', 'Admin Books')
@section('adminbook', 'active')

@section('content')

    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold mb-2">Buku</h1>
            <p class="text-gray-600">Tambahkan lebih banyak buku</p>
        </div>

        <div class="mt-4 md:mt-0">
            <button id="create-books-btn" class="btn-primary px-4 py-2 rounded-full font-medium flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Buat Buku Baru
            </button>
        </div>
    </div>

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

    <!-- Book Recommendations -->
    <div class="mb-8">
        <div class="overflow-x-auto">
             <div class="hidden md:block">
        <table id="example" class="min-w-full divide-y divide-gray-200 border border-gray-300 rounded-md">
            <thead class="bg-violet-600 text-white">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Nama Buku</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Gambar</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Pengarang</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Penerbit</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Tanggal penerbitan</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Bahasa</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">ISBN-10</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">ISBN-13</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Kategori</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Tindakan</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 text-sm">
                @foreach ($books as $book)
                    <tr>
                        <td class="px-4 py-2">{{ $book->name }}</td>
                        <td class="px-4 py-2">
                            <img src="{{ asset('storage/' . $book->image) }}" alt="Book Image"
                                class="w-16 h-auto rounded">
                        </td>
                        <td class="px-4 py-2">{{ $book->author }}</td>
                        <td class="px-4 py-2">{{ $book->publisher }}</td>
                        <td class="px-4 py-2">{{ $book->publication_date }}</td>
                        <td class="px-4 py-2">{{ $book->language }}</td>
                        <td class="px-4 py-2">{{ $book->{'ISBN-10'} }}</td>
                        <td class="px-4 py-2">{{ $book->{'ISBN-13'} }}</td>
                        <td class="px-4 py-2">
                          @foreach ($book->categories as $cat)
        <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded mr-1 mb-1">
            {{ $cat->name }}
        </span>
    @endforeach
                        </td>
                        <td class="px-4 py-2">
                            <button class="edit-book-btn text-blue-500" data-book-id="{{ $book->id }}">Edit</button>
                            <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus?')"
                                    class="text-red-600 hover:underline">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Card view for mobile -->
    <div class="grid grid-cols-1 gap-4 md:hidden">
        @foreach ($books as $book)
            <div class="bg-white p-4 rounded-lg shadow">
                <div class="flex items-center mb-4">
                    <img src="{{ asset('storage/' . $book->image) }}" alt="Book Image" class="w-20 h-auto rounded mr-4">
                    <div>
                        <h3 class="font-bold">{{ $book->name }}</h3>
                        <p class="text-sm text-gray-600">{{ $book->author }}</p>
                    </div>
                </div>
                
                <div class="space-y-2 text-sm">
                    <div class="grid grid-cols-2">
                        <span class="font-semibold">Penerbit:</span>
                        <span>{{ $book->publisher }}</span>
                    </div>
                    
                    <div class="grid grid-cols-2">
                        <span class="font-semibold">Tanggal:</span>
                        <span>{{ $book->publication_date }}</span>
                    </div>
                    
                    <div class="grid grid-cols-2">
                        <span class="font-semibold">Bahasa:</span>
                        <span>{{ $book->language }}</span>
                    </div>
                    
                    <div class="grid grid-cols-2">
                        <span class="font-semibold">ISBN-10:</span>
                        <span>{{ $book->{'ISBN-10'} }}</span>
                    </div>
                    
                    <div class="grid grid-cols-2">
                        <span class="font-semibold">ISBN-13:</span>
                        <span>{{ $book->{'ISBN-13'} }}</span>
                    </div>
                    
                    <div>
                        <span class="font-semibold block mb-1">Kategori:</span>
                        <div>
                            @foreach ($book->categories as $cat)
                                <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded mr-1 mb-1">
                                    {{ $cat->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 flex justify-between pt-3 border-t border-gray-200">
                    <button class="edit-book-btn text-white bg-blue-500 px-3 py-1 rounded" data-book-id="{{ $book->id }}">Edit</button>
                    <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin menghapus?')"
                            class="text-white bg-red-600 px-3 py-1 rounded">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
        </div>
    </div>


    <div id="create-books-modal" class="modal fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="modal-overlay absolute inset-0 bg-black opacity-50"></div>

        <div
            class="modal-content bg-white w-full max-w-md mx-4 rounded-lg shadow-xl z-50 transform scale-95 opacity-0 transition-all duration-300 max-h-[90vh] ">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold">Buat Buku Baru</h3>
                    <button id="close-modal" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form id="create-books-form" action="{{ route('admin.books.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-form p-2 overflow-y-auto max-h-[70vh]">
                        <!-- Book Name -->
                        <div class="mb-4">
                            <label for="books-name" class="block text-sm font-medium text-gray-700 mb-1">Nama Buku</label>
                            <input type="text" id="books-name" name="name"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                                placeholder="Masukkan nama buku" required>
                        </div>

                        <!-- Author -->
                        <div class="mb-4">
                            <label for="books-author" class="block text-sm font-medium text-gray-700 mb-1">Pengarang</label>
                            <input type="text" id="books-author" name="author"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                                placeholder="Masukkan nama penulis" required>
                        </div>

                        <!-- Publisher -->
                        <div class="mb-4">
                            <label for="books-publisher"
                                class="block text-sm font-medium text-gray-700 mb-1">Penerbit</label>
                            <input type="text" id="books-publisher" name="publisher"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                                placeholder="Masukkan nama penerbit" required>
                        </div>

                        <!-- Publication Date -->
                        <div class="mb-4">
                            <label for="publication_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal penerbitan</label>
                            <input type="date" id="publication_date" name="publication_date"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                                required>
                        </div>

                        <!-- Language -->
                        <div class="mb-4">
                            <label for="books-language"
                                class="block text-sm font-medium text-gray-700 mb-1">Bahasa</label>
                            <input type="text" id="books-language" name="language"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                                placeholder="Masukkan bahasa" required>
                        </div>
                        <!-- Print Lenght -->
                        <div class="mb-4">
                            <label for="print_length" class="block text-sm font-medium text-gray-700 mb-1">Panjang Cetak</label>
                            <input type="number" id="print_length" name="print_length"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                                placeholder="Masukkan panjang cetak" required>
                        </div>

                        <!-- ISBN-10 -->
                        <div class="mb-4">
                            <label for="isbn-10" class="block text-sm font-medium text-gray-700 mb-1">ISBN-10</label>
                            <input type="text" id="isbn-10" name="ISBN-10"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                                placeholder="Masukkan ISBN-10" required>
                        </div>

                        <!-- ISBN-13 -->
                        <div class="mb-4">
                            <label for="isbn-13" class="block text-sm font-medium text-gray-700 mb-1">ISBN-13</label>
                            <input type="text" id="isbn-13" name="ISBN-13"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                                placeholder="Masukkan ISBN-13" required>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="books-description"
                                class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                            <textarea id="books-description" name="description" rows="4"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                                placeholder="Masukkan deskripsi buku" required></textarea>
                        </div>

                        <!-- Category (Genres) -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Kategori</label>
                            <div class="multiselect-dropdown relative">
                                <button type="button" id="genre-dropdown-btn"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md bg-white text-left flex justify-between items-center focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent">
                                    <span id="selected-genres-text">Pilih kategori</span>
                                    <i class="fas fa-chevron-down text-gray-400"></i>
                                </button>

                                <div id="genre-options"
                                    class="dropdown-options absolute left-0 right-0 mt-1 bg-white border border-gray-300 rounded-md shadow-lg z-10 hidden">
                                    <div class="p-2">
                                        @foreach ($category as $genre)
                                            <div class="flex items-center p-2 hover:bg-gray-100 rounded">
                                                <input type="checkbox" id="genre-{{ $genre->id }}"
                                                    name="categoryId[]" class="genre-checkbox mr-2"
                                                    value="{{ $genre->id }}">
                                                <label for="genre-{{ $genre->id }}" class="cursor-pointer w-full">
                                                    {{ $genre->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div id="selected-genres-container" class="flex flex-wrap gap-2 mt-2"></div>
                        </div>

                        <!-- Image Upload -->
                        <div class="mb-4">
                            <label for="book-image" class="block text-sm font-medium text-gray-700 mb-1">Gambar Buku</label>
                            <input type="file" id="book-image" name="image"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                                accept="image/*" required>
                        </div>
                    </div>


                    <div class="flex justify-end">
                        <button type="button" id="cancel-create"
                            class="btn-secondary px-4 py-2 rounded-md mr-2">Batal</button>
                        <button type="submit" class="btn-primary px-4 py-2 rounded-md">Buat Buku</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="edit-books-modal" class="modal fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="modal-overlay absolute inset-0 bg-black opacity-50"></div>

        <div
            class="modal-content bg-white w-full max-w-md mx-4 rounded-lg shadow-xl z-50 transform scale-95 opacity-0 transition-all duration-300 max-h-[90vh]">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold">Edit Buku</h3>
                    <button id="close-edit-modal" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form id="edit-books-form" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-form p-2 overflow-y-auto max-h-[70vh]">
                        <!-- Book Name -->
                        <div class="mb-4">
                            <label for="edit-books-name" class="block text-sm font-medium text-gray-700 mb-1">Nama Buku</label>
                            <input type="text" id="edit-books-name" name="name"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                                placeholder="Masukkan nama buku" required>
                        </div>

                        <!-- Author -->
                        <div class="mb-4">
                            <label for="edit-books-author"
                                class="block text-sm font-medium text-gray-700 mb-1">Pengarang</label>
                            <input type="text" id="edit-books-author" name="author"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                                placeholder="Masukkan nama penulis" required>
                        </div>

                        <!-- Publisher -->
                        <div class="mb-4">
                            <label for="edit-books-publisher"
                                class="block text-sm font-medium text-gray-700 mb-1">Penerbit</label>
                            <input type="text" id="edit-books-publisher" name="publisher"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                                placeholder="Masukkan nama penerbit" required>
                        </div>

                        <!-- Publication Date -->
                        <div class="mb-4">
                            <label for="edit-publication_date"
                                class="block text-sm font-medium text-gray-700 mb-1">Tanggal penerbitan</label>
                            <input type="date" id="edit-publication_date" name="publication_date"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                                required>
                        </div>

                        <!-- Language -->
                        <div class="mb-4">
                            <label for="edit-books-language"
                                class="block text-sm font-medium text-gray-700 mb-1">Bahasa</label>
                            <input type="text" id="edit-books-language" name="language"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                                placeholder="Masukkan bahasa" required>
                        </div>

                        <!-- Print Length -->
                        <div class="mb-4">
                            <label for="edit-print_length" class="block text-sm font-medium text-gray-700 mb-1">Panjang Cetak</label>
                            <input type="number" id="edit-print_length" name="print_length"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                                placeholder="Masukkan panjang cetak" required>
                        </div>

                        <!-- ISBN-10 -->
                        <div class="mb-4">
                            <label for="edit-isbn-10" class="block text-sm font-medium text-gray-700 mb-1">ISBN-10</label>
                            <input type="text" id="edit-isbn-10" name="ISBN-10"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                                placeholder="Masukkan ISBN-10" required>
                        </div>

                        <!-- ISBN-13 -->
                        <div class="mb-4">
                            <label for="edit-isbn-13" class="block text-sm font-medium text-gray-700 mb-1">ISBN-13</label>
                            <input type="text" id="edit-isbn-13" name="ISBN-13"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                                placeholder="Masukkan ISBN-13" required>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="edit-books-description"
                                class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                            <textarea id="edit-books-description" name="description" rows="4"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                                placeholder="Masukkan deskripsi buku" required></textarea>
                        </div>

                        <!-- Category (Genres) -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Kategori</label>
                            <div class="multiselect-dropdown relative">
                                <button type="button" id="edit-genre-dropdown-btn"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md bg-white text-left flex justify-between items-center focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent">
                                    <span id="edit-selected-genres-text">Pilih kategori</span>
                                    <i class="fas fa-chevron-down text-gray-400"></i>
                                </button>

                                <div id="edit-genre-options"
                                    class="dropdown-options absolute left-0 right-0 mt-1 bg-white border border-gray-300 rounded-md shadow-lg z-10 hidden">
                                    <div class="p-2">
                                        @foreach ($category as $genre)
                                            <div class="flex items-center p-2 hover:bg-gray-100 rounded">
                                                <input type="checkbox" id="edit-genre-{{ $genre->id }}"
                                                    name="categoryId[]" class="edit-genre-checkbox mr-2"
                                                    value="{{ $genre->id }}">
                                                <label for="edit-genre-{{ $genre->id }}"
                                                    class="cursor-pointer w-full">
                                                    {{ $genre->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div id="edit-selected-genres-container" class="flex flex-wrap gap-2 mt-2"></div>
                        </div>

                        <!-- Image Upload -->
                        <div class="mb-4">
                            <label for="edit-book-image" class="block text-sm font-medium text-gray-700 mb-1">Gambar Buku</label>
                            <input type="file" id="edit-book-image" name="image"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                                accept="image/*">
                            <div id="current-image-container" class="mt-2">
                                <p class="text-sm text-gray-500">Gambar Saat Ini:</p>
                                <img id="current-image" src="" class="w-16 h-auto rounded mt-1">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="button" id="cancel-edit"
                            class="btn-secondary px-4 py-2 rounded-md mr-2">Batal</button>
                        <button type="submit" class="btn-primary px-4 py-2 rounded-md">Perbarui Buku</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {
            const createBooksBtn = document.getElementById('create-books-btn');
            const createBooksModal = document.getElementById('create-books-modal');
            const closeModalBtn = document.getElementById('close-modal');
            const cancelCreateBtn = document.getElementById('cancel-create');
            const modalContent = document.querySelector('.modal-content');

            function openModal() {
                createBooksModal.classList.remove('hidden');
                setTimeout(() => {
                    modalContent.classList.remove('scale-95', 'opacity-0');
                    modalContent.classList.add('scale-100', 'opacity-100');
                }, 10);
            }

            function closeModal() {
                modalContent.classList.remove('scale-100', 'opacity-100');
                modalContent.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    createBooksModal.classList.add('hidden');
                }, 300);
            }

            createBooksBtn.addEventListener('click', openModal);
            closeModalBtn.addEventListener('click', closeModal);
            cancelCreateBtn.addEventListener('click', closeModal);

            createBooksModal.addEventListener('click', function(e) {
                if (e.target === createBooksModal) {
                    closeModal();
                }
            });

            const genreDropdownBtn = document.getElementById('genre-dropdown-btn');
            const genreOptions = document.getElementById('genre-options');
            const selectedGenresText = document.getElementById('selected-genres-text');
            const selectedGenresContainer = document.getElementById('selected-genres-container');
            const genreForm = document.getElementById('genre-form'); // Assuming your form has this ID

            // Hidden input to store selected genre IDs
            function createHiddenInputs() {
                // Remove any existing hidden inputs first
                document.querySelectorAll('input[name="categoryId[]"]').forEach(input => {
                    if (input.type === 'hidden') {
                        input.remove();
                    }
                });

                // Create new hidden inputs for each selected genre
                document.querySelectorAll('.genre-checkbox:checked').forEach(checkbox => {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'categoryId[]';
                    hiddenInput.value = checkbox.value; // This is the ID
                    genreForm.appendChild(hiddenInput);
                });
            }

            genreDropdownBtn.addEventListener('click', function() {
                genreOptions.classList.toggle('hidden');
            });

            document.querySelectorAll('.genre-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateSelectedGenres();
                    createHiddenInputs();
                });
            });

            function updateSelectedGenres() {
                const selectedGenreLabels = [];

                document.querySelectorAll('.genre-checkbox:checked').forEach(checkbox => {
                    selectedGenreLabels.push(checkbox.nextElementSibling.innerText.trim());
                });

                // Display selected genres in the container
                selectedGenresContainer.innerHTML = '';
                selectedGenreLabels.forEach(label => {
                    const genreItem = document.createElement('span');
                    genreItem.classList.add('px-3', 'py-1', 'bg-violet-200', 'rounded', 'text-sm', 'mr-2',
                        'mb-2');
                    genreItem.textContent = label;
                    selectedGenresContainer.appendChild(genreItem);
                });

                // Update button text if genres are selected
                if (selectedGenreLabels.length > 0) {
                    selectedGenresText.textContent = selectedGenreLabels.join(', ');
                } else {
                    selectedGenresText.textContent = 'Select genres';
                }
            }

            // Edit Book Functionality
            const editButtons = document.querySelectorAll('.edit-book-btn');
            const editBooksModal = document.getElementById('edit-books-modal');
            const closeEditModalBtn = document.getElementById('close-edit-modal');
            const cancelEditBtn = document.getElementById('cancel-edit');
            const editModalContent = document.querySelector('#edit-books-modal .modal-content');

            function openEditModal() {
                editBooksModal.classList.remove('hidden');
                setTimeout(() => {
                    editModalContent.classList.remove('scale-95', 'opacity-0');
                    editModalContent.classList.add('scale-100', 'opacity-100');
                }, 10);
            }

            function closeEditModal() {
                editModalContent.classList.remove('scale-100', 'opacity-100');
                editModalContent.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    editBooksModal.classList.add('hidden');
                }, 300);
            }

            // Add event listeners for edit modal
            closeEditModalBtn.addEventListener('click', closeEditModal);
            cancelEditBtn.addEventListener('click', closeEditModal);

            editBooksModal.addEventListener('click', function(e) {
                if (e.target === editBooksModal) {
                    closeEditModal();
                }
            });

            // Edit genre dropdown functionality
            const editGenreDropdownBtn = document.getElementById('edit-genre-dropdown-btn');
            const editGenreOptions = document.getElementById('edit-genre-options');
            const editSelectedGenresText = document.getElementById('edit-selected-genres-text');
            const editSelectedGenresContainer = document.getElementById('edit-selected-genres-container');

            editGenreDropdownBtn.addEventListener('click', function() {
                editGenreOptions.classList.toggle('hidden');
            });

            function updateEditSelectedGenres() {
                const selectedGenreLabels = [];

                document.querySelectorAll('.edit-genre-checkbox:checked').forEach(checkbox => {
                    selectedGenreLabels.push(checkbox.nextElementSibling.innerText.trim());
                });

                // Display selected genres in the container
                editSelectedGenresContainer.innerHTML = '';
                selectedGenreLabels.forEach(label => {
                    const genreItem = document.createElement('span');
                    genreItem.classList.add('px-3', 'py-1', 'bg-violet-200', 'rounded', 'text-sm', 'mr-2',
                        'mb-2');
                    genreItem.textContent = label;
                    editSelectedGenresContainer.appendChild(genreItem);
                });

                // Update button text if genres are selected
                if (selectedGenreLabels.length > 0) {
                    editSelectedGenresText.textContent = selectedGenreLabels.join(', ');
                } else {
                    editSelectedGenresText.textContent = 'Select genres';
                }
            }

            document.querySelectorAll('.edit-genre-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateEditSelectedGenres();
                });
            });

            // Function to populate edit modal with book data
            function populateEditModal(book) {
                // Set form action URL
                document.getElementById('edit-books-form').action = `/books/${book.id}`;

                // Fill form fields
                document.getElementById('edit-books-name').value = book.name;
                document.getElementById('edit-books-author').value = book.author;
                document.getElementById('edit-books-publisher').value = book.publisher;
                document.getElementById('edit-publication_date').value = book.publication_date;
                document.getElementById('edit-books-language').value = book.language;
                document.getElementById('edit-print_length').value = book.print_length;
                document.getElementById('edit-isbn-10').value = book['ISBN-10'];
                document.getElementById('edit-isbn-13').value = book['ISBN-13'];
                document.getElementById('edit-books-description').value = book.description;

                // Set current image
                const currentImage = document.getElementById('current-image');
                currentImage.src = book.image ? `/storage/${book.image}` : '';
                document.getElementById('current-image-container').style.display = book.image ? 'block' : 'none';

                // Reset all genre checkboxes
                document.querySelectorAll('.edit-genre-checkbox').forEach(checkbox => {
                    checkbox.checked = false;
                });

                // Check the book's categories
                book.categories.forEach(category => {
                    const checkbox = document.getElementById(`edit-genre-${category.id}`);
                    if (checkbox) {
                        checkbox.checked = true;
                    }
                });

                // Update selected genres display
                updateEditSelectedGenres();
            }

            // Add event listeners to edit buttons
            document.querySelectorAll('.edit-book-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const bookId = this.getAttribute('data-book-id');

                    // Fetch book data via AJAX
                    fetch(`/books/${bookId}/edit`)
                        .then(response => response.json())
                        .then(book => {
                            populateEditModal(book);
                            openEditModal();
                        })
                        .catch(error => {
                            console.error('Error fetching book data:', error);
                        });
                });
            });

            $('#example').DataTable({
                language: {
                    search: "",
                    searchPlaceholder: "Search...",
                    lengthMenu: "_MENU_ rows per page",
                    paginate: {
                        previous: "←",
                        next: "→"
                    }
                },
                dom: "<'flex items-center justify-between mb-4'<'text-sm'l><'text-sm'f>>" +
                    "<'overflow-x-auto'tr>" +
                    "<'flex items-center justify-between mt-4'<'text-sm'i><'text-sm'p>>"
            });

            // Tailwind style for search & length dropdown
            $('div.dataTables_filter input').addClass(
                'border border-gray-300 rounded-md px-3 py-1 focus:outline-none focus:ring focus:border-violet-500'
            );
            $('div.dataTables_length select').addClass('border border-gray-300 rounded-md px-2 py-1 ml-2');
        });
    </script>

@endsection
