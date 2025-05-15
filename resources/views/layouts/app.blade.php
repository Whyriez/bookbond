<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BookBond - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.min.css">


    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.0/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet" />

    <style>
        /* Add these styles to constrain the editor width */
        .ck-editor,
        .ck-editor__editable,
        .ck-editor__main,
        .ck-toolbar,
        .ck-toolbar__items,
        .ck-content,
        .ck.ck-editor__editable_inline {
            max-width: 100% !important;
            width: 100% !important;
            overflow-x: hidden !important;
        }

        /* Ensure the toolbar items wrap properly */
        .ck-toolbar__items {
            flex-wrap: wrap !important;
        }
    </style>


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background-color: #fcfaf7;
            color: #333;
        }

        h1,
        h2,
        h3,
        h4 {
            font-family: 'Playfair Display', serif;
        }

        .book-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23f0e6d2' fill-opacity='0.4'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .modal-form::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for other browsers */
        .modal-form {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .sidebar {
            background-color: #ffffff;
            transition: all 0.3s ease;
        }

        .sidebar-link {
            transition: all 0.2s ease;
            border-radius: 0.5rem;
        }

        .sidebar-link:hover {
            background-color: #f3f4f6;
        }

        .sidebar-link.active {
            background-color: #8b5cf6;
            color: white;
        }

        .sidebar-link.active:hover {
            background-color: #7c3aed;
        }

        .book-card {
            transition: all 0.3s ease;
            border-radius: 0.75rem;
            overflow: hidden;
            height: 100%;
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .book-cover {
            height: 200px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .want-to-read-btn {
            position: absolute;
            bottom: 10px;
            right: 10px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .book-card:hover .want-to-read-btn {
            opacity: 1;
        }

        .genre-tab {
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .genre-tab.active {
            color: #8b5cf6;
            border-bottom: 2px solid #8b5cf6;
        }

        .reading-stats {
            background: linear-gradient(to right, #8b5cf6, #6366f1);
            border-radius: 0.75rem;
        }

        .stat-card {
            background-color: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
            border-radius: 0.5rem;
        }

        .book-club-card {
            border-radius: 0.75rem;
            transition: all 0.3s ease;
        }

        .book-club-card:hover {
            transform: translateY(-3px);
        }

        .community-card {
            transition: all 0.3s ease;
            border-radius: 0.75rem;
            overflow: hidden;
            height: 100%;
        }

        .community-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .community-banner {
            height: 80px;
            background-size: cover;
            background-position: center;
        }

        .modal {
            transition: opacity 0.3s ease;
        }

        .modal-content {
            transition: transform 0.3s ease;
        }

        .badge {
            transition: all 0.2s ease;
        }

        .badge:hover {
            transform: scale(1.05);
        }

        .btn-primary {
            background-color: #8b5cf6;
            color: white;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #7c3aed;
        }

        .btn-secondary {
            background-color: #f3f4f6;
            color: #4b5563;
            transition: all 0.2s ease;
        }

        .btn-secondary:hover {
            background-color: #e5e7eb;
        }

        .btn-danger {
            background-color: #ef4444;
            color: white;
            transition: all 0.2s ease;
        }

        .btn-danger:hover {
            background-color: #dc2626;
        }

        .btn-success {
            background-color: #10b981;
            color: white;
            transition: all 0.2s ease;
        }

        .btn-success:hover {
            background-color: #059669;
        }

        .genre-pill {
            transition: all 0.2s ease;
        }

        .genre-pill:hover {
            transform: translateY(-2px);
        }

        .multiselect-dropdown {
            position: relative;
        }

        .dropdown-options {
            max-height: 200px;
            overflow-y: auto;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -100%;
                top: 0;
                height: 100%;
                z-index: 50;
                width: 250px;
            }

            .sidebar.open {
                left: 0;
            }

            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 40;
                display: none;
            }

            .overlay.active {
                display: block;
            }
        }

        .book-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23f0e6d2' fill-opacity='0.4'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .community-banner {
            height: 240px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .community-banner::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.6) 100%);
        }

        .banner-content {
            position: relative;
            z-index: 10;
        }

        .post-card {
            transition: all 0.3s ease;
            border-radius: 0.75rem;
            overflow: hidden;
        }

        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .btn-primary {
            background-color: #8b5cf6;
            color: white;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #7c3aed;
        }

        .btn-secondary {
            background-color: #f3f4f6;
            color: #4b5563;
            transition: all 0.2s ease;
        }

        .btn-secondary:hover {
            background-color: #e5e7eb;
        }

        .btn-danger {
            background-color: #ef4444;
            color: white;
            transition: all 0.2s ease;
        }

        .btn-danger:hover {
            background-color: #dc2626;
        }

        .btn-outline {
            border: 1px solid #8b5cf6;
            color: #8b5cf6;
            transition: all 0.2s ease;
        }

        .btn-outline:hover {
            background-color: #8b5cf6;
            color: white;
        }

        .genre-pill {
            transition: all 0.2s ease;
        }

        .genre-pill:hover {
            transform: translateY(-2px);
        }

        .editor-toolbar {
            border-top-left-radius: 0.375rem;
            border-top-right-radius: 0.375rem;
            border: 1px solid #e5e7eb;
            border-bottom: none;
        }

        .editor-content {
            border: 1px solid #e5e7eb;
            border-top: none;
            border-bottom-left-radius: 0.375rem;
            border-bottom-right-radius: 0.375rem;
            min-height: 150px;
        }

        .contributor-avatar {
            transition: all 0.2s ease;
        }

        .contributor-avatar:hover {
            transform: scale(1.05);
        }

        .related-community {
            transition: all 0.2s ease;
        }

        .related-community:hover {
            transform: translateX(5px);
        }

        @media (max-width: 768px) {
            .community-banner {
                height: 180px;
            }
        }

        .genre-pill {
            transition: all 0.2s ease;
        }

        .genre-pill:hover {
            transform: translateY(-2px);
        }

        .filter-pill {
            transition: all 0.2s ease;
        }

        .filter-pill.active {
            background-color: #8b5cf6;
            color: white;
        }

        .filter-pill:hover:not(.active) {
            background-color: #e5e7eb;
        }

        .book-cover {
            height: 200px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .community-banner {
            height: 120px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .community-banner::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.6) 100%);
        }

        .banner-content {
            position: relative;
            z-index: 10;
        }

        .bookstore-logo {
            width: 80px;
            height: 80px;
            background-size: cover;
            background-position: center;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .wishlist-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: rgba(255, 255, 255, 0.9);
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            z-index: 10;
        }

        .wishlist-btn:hover {
            transform: scale(1.1);
        }

        .wishlist-btn.active i {
            color: #ef4444;
        }

        .search-container {
            position: relative;
        }

        .search-container i {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            color: #9ca3af;
        }

        .search-input {
            padding-left: 40px;
        }

        @media (max-width: 768px) {
            .book-cover {
                height: 180px;
            }

            .community-banner {
                height: 100px;
            }
        }



        .book-cover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .book-cover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .store-card {
            transition: all 0.3s ease;
        }

        .store-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .review-card {
            transition: all 0.3s ease;
        }

        .review-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .wishlist-btn.active i {
            color: #ef4444;
        }

        .read-btn.active {
            background-color: #10b981;
            color: white;
            border-color: #10b981;
        }

        .read-btn.active:hover {
            background-color: #059669;
        }

        .tab-button {
            transition: all 0.2s ease;
        }

        .tab-button.active {
            color: #8b5cf6;
            border-bottom: 3px solid #8b5cf6;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .carousel {
            position: relative;
            overflow: hidden;
        }

        .carousel-inner {
            display: flex;
            transition: transform 0.5s ease;
        }

        .carousel-item {
            flex: 0 0 100%;
        }

        .carousel-control {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
        }

        .carousel-control:hover {
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .carousel-control.prev {
            left: 10px;
        }

        .carousel-control.next {
            right: 10px;
        }

        .store-logo {
            width: 50px;
            height: 50px;
            background-size: cover;
            background-position: center;
            border-radius: 50%;
            border: 2px solid white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .price-tag {
            position: relative;
            background-color: #8b5cf6;
            color: white;
            padding: 4px 12px;
            border-radius: 4px;
            font-weight: 600;
        }

        .price-tag::after {
            content: '';
            position: absolute;
            top: 50%;
            right: -6px;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-top: 6px solid transparent;
            border-bottom: 6px solid transparent;
            border-left: 6px solid #8b5cf6;
        }

        .stock-badge {
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .stock-badge.in-stock {
            background-color: #d1fae5;
            color: #065f46;
        }

        .stock-badge.low-stock {
            background-color: #fef3c7;
            color: #92400e;
        }

        .stock-badge.out-of-stock {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-size: cover;
            background-position: center;
            border: 2px solid white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .book-info-container {
                flex-direction: column;
            }

            .book-cover-container {
                margin-bottom: 2rem;
                align-items: center;
            }

            .book-cover {
                max-width: 200px;
            }
        }

        .file-upload {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .file-upload-input {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .file-upload-button {
            display: inline-block;
            border: 1px dashed #d1d5db;
            border-radius: 0.5rem;
            padding: 2rem 1rem;
            text-align: center;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-upload-button:hover {
            border-color: #8b5cf6;
            background-color: rgba(139, 92, 246, 0.05);
        }
    </style>
</head>

<body class="book-pattern min-h-screen">
    <div class="flex h-screen overflow-hidden">
        @include('components.landing.sidebar')
        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Mobile Header -->
            <header class="md:hidden bg-white p-4 sticky top-0 z-30 shadow-sm">
                <div class="flex justify-between items-center">
                    <button id="menu-toggle" class="text-gray-600 focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>

                    <div class="flex items-center space-x-2">
                        <svg class="w-7 h-7 text-violet-600" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M21,4H3C2.4,4,2,4.4,2,5v14c0,0.6,0.4,1,1,1h18c0.6,0,1-0.4,1-1V5C22,4.4,21.6,4,21,4z M20,18H4V6h16V18z"
                                fill="currentColor" />
                            <path d="M9,8H7v8h2c2.2,0,4-1.8,4-4S11.2,8,9,8z M9,14H9V10h0c1.1,0,2,0.9,2,2S10.1,14,9,14z"
                                fill="currentColor" />
                            <path d="M17,8h-4v8h4c1.1,0,2-0.9,2-2v-4C19,8.9,18.1,8,17,8z M17,14h-2v-4h2V14z"
                                fill="currentColor" />
                        </svg>
                        <span class="font-bold text-lg">BookBond</span>
                    </div>

                    <div class="w-8 h-8 rounded-full bg-violet-100 flex items-center justify-center">
                        <span
                            class="text-violet-600 font-medium">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</span>
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-4 md:p-8">
                @yield('content')

                <!-- Footer -->
                <footer class="mt-12 border-t border-gray-200 pt-6 pb-4">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <div class="flex items-center space-x-2 mb-4 md:mb-0">
                            <svg class="w-6 h-6 text-violet-600" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M21,4H3C2.4,4,2,4.4,2,5v14c0,0.6,0.4,1,1,1h18c0.6,0,1-0.4,1-1V5C22,4.4,21.6,4,21,4z M20,18H4V6h16V18z"
                                    fill="currentColor" />
                                <path
                                    d="M9,8H7v8h2c2.2,0,4-1.8,4-4S11.2,8,9,8z M9,14H9V10h0c1.1,0,2,0.9,2,2S10.1,14,9,14z"
                                    fill="currentColor" />
                                <path d="M17,8h-4v8h4c1.1,0,2-0.9,2-2v-4C19,8.9,18.1,8,17,8z M17,14h-2v-4h2V14z"
                                    fill="currentColor" />
                            </svg>
                            <span class="text-sm text-gray-600">© 2023 BookBond. All rights reserved.</span>
                        </div>

                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-600 hover:text-violet-600">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="text-gray-600 hover:text-violet-600">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="text-gray-600 hover:text-violet-600">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle
            // const btnToggle = document.getElementById('menu-toggle');
            // const sidebar = document.getElementById('sidebar');
            // const overlay = document.getElementById('overlay');

            // btnToggle.addEventListener('click', () => {
            //     sidebar.classList.toggle('-translate-x-full');
            //     overlay.classList.toggle('hidden');
            // });

            // overlay.addEventListener('click', () => {
            //     sidebar.classList.add('-translate-x-full');
            //     overlay.classList.add('hidden');
            // });

            const menuToggle = document.getElementById('menu-toggle');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('-translate-x-full');
                sidebar.classList.toggle('open');
                overlay.classList.toggle('active');
                overlay.classList.toggle('hidden');
            });

            overlay.addEventListener('click', function() {
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('open');
                overlay.classList.remove('active');
                overlay.classList.add('hidden');
            });

            // const menuToggle = document.getElementById('menu-toggle');
            // const sidebar = document.getElementById('sidebar');
            // const overlay = document.getElementById('overlay');

            // menuToggle.addEventListener('click', function() {
            //     sidebar.classList.toggle('open');
            //     overlay.classList.toggle('active');
            // });

            // overlay.addEventListener('click', function() {
            //     sidebar.classList.remove('open');
            //     overlay.classList.remove('active');
            // });
        });
    </script>

</html>
