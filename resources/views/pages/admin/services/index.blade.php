@extends('layouts.app')
@section('title', 'Admin Service Offer Partner')
@section('adminserviceoffer', 'active')

@section('content')

    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold mb-2">Penawaran Layanan</h1>
            <p class="text-gray-600">Add Penawaran Layanan</p>
        </div>

        <div class="mt-4 md:mt-0">
            <button id="create-books-btn" class="btn-primary px-4 py-2 rounded-full font-medium flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Buat Penawaran Layanan
            </button>
        </div>
    </div>

    <div class="mb-8">
        @if (session('success'))
            <div class="mb-4 rounded-md bg-green-100 p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @error('service-name')
            <div class="mb-4 rounded-md bg-red-100 p-4 text-sm text-red-700">
                {{ $message }}
            </div>
        @enderror
        @if (session('error'))
            <div class="mb-4 rounded-md bg-red-100 p-4 text-sm text-red-700">
                {{ session('error') }}
            </div>
        @endif
        <table id="example" class="min-w-full divide-y divide-gray-200 border border-gray-300 rounded-md">
            <thead class="bg-violet-600 text-white">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Nama</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 text-sm">
                @foreach ($data as $category)
                    <tr>
                        <td class="px-4 py-2">{{ $category->name }}</td>
                        <td class="px-4 py-2">
                            <a href="#" class="text-violet-600 hover:underline mr-2 edit-btn"
                                data-id="{{ $category->id }}" data-name="{{ $category->name }}">
                                Edit
                            </a>

                            <form action="{{ route('admin.service.offer.destroy', $category->id) }}" method="POST"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus?')"
                                    class="text-red-600 hover:underline">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>

    <div id="create-books-modal" class="modal fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="modal-overlay absolute inset-0 bg-black opacity-50"></div>

        <div
            class="modal-content bg-white w-full max-w-md mx-4 rounded-lg shadow-xl z-50 transform scale-95 opacity-0 transition-all duration-300">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold">Buat Penawaran Layanan Baru</h3>
                    <button id="close-modal" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form id="create-category-form" method="POST" action="{{ route('admin.service.offer.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="books-name" class="block text-sm font-medium text-gray-700 mb-1">Nama Layanan</label>
                        <input type="text" id="books-name"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                            placeholder="Masukkan nama layanan" name="service-name" required>
                    </div>

                    <div class="flex justify-end">
                        <button type="button" id="cancel-create"
                            class="btn-secondary px-4 py-2 rounded-md mr-2">Batal</button>
                        <button type="submit" class="btn-primary px-4 py-2 rounded-md">Buat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="edit-books-modal" class="modal fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="modal-overlay absolute inset-0 bg-black opacity-50"></div>

        <div
            class="modal-content bg-white w-full max-w-md mx-4 rounded-lg shadow-xl z-50 transform scale-95 opacity-0 transition-all duration-300">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold">Edit Penawaran Layanan</h3>
                    <button id="close-edit-modal" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form id="edit-category-form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="edit-name" class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                        <input type="text" id="edit-name" name="name"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                            required>
                    </div>

                    <div class="flex justify-end">
                        <button type="button" id="cancel-edit"
                            class="btn-secondary px-4 py-2 rounded-md mr-2">Batal</button>
                        <button type="submit" class="btn-primary px-4 py-2 rounded-md">Perbarui</button>
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

            const editModal = document.getElementById('edit-books-modal');
            const closeEditModalBtn = document.getElementById('close-edit-modal');
            const cancelEditBtn = document.getElementById('cancel-edit');
            const editModalContent = editModal.querySelector('.modal-content');
            const editForm = document.getElementById('edit-category-form');
            const editNameInput = document.getElementById('edit-name');

            function openEditModal(id, name) {
                editNameInput.value = name;
                editForm.action = `/services-offer/${id}`;
                editModal.classList.remove('hidden');
                setTimeout(() => {
                    editModalContent.classList.remove('scale-95', 'opacity-0');
                    editModalContent.classList.add('scale-100', 'opacity-100');
                }, 10);
            }

            function closeEditModal() {
                editModalContent.classList.remove('scale-100', 'opacity-100');
                editModalContent.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    editModal.classList.add('hidden');
                }, 300);
            }

            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const id = this.dataset.id;
                    const name = this.dataset.name;
                    openEditModal(id, name);
                });
            });

            closeEditModalBtn.addEventListener('click', closeEditModal);
            cancelEditBtn.addEventListener('click', closeEditModal);
            editModal.addEventListener('click', function(e) {
                if (e.target === editModal) {
                    closeEditModal();
                }
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
