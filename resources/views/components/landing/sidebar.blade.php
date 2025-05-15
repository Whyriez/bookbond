<!-- Sidebar -->
<div id="sidebar" class="sidebar fixed top-0 left-0 z-40 w-64 h-screen bg-white shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:shadow-none md:block">
    <div class="p-6">
        <div class="flex items-center space-x-2 mb-8">
            <svg class="w-8 h-8 text-violet-600" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M21,4H3C2.4,4,2,4.4,2,5v14c0,0.6,0.4,1,1,1h18c0.6,0,1-0.4,1-1V5C22,4.4,21.6,4,21,4z M20,18H4V6h16V18z"
                    fill="currentColor" />
                <path d="M9,8H7v8h2c2.2,0,4-1.8,4-4S11.2,8,9,8z M9,14H9V10h0c1.1,0,2,0.9,2,2S10.1,14,9,14z"
                    fill="currentColor" />
                <path d="M17,8h-4v8h4c1.1,0,2-0.9,2-2v-4C19,8.9,18.1,8,17,8z M17,14h-2v-4h2V14z" fill="currentColor" />
            </svg>
            <span class="font-bold text-xl">BookBond</span>
        </div>

        <nav class="space-y-2">
            @if (Auth::user()->role == 'admin')
                <a href="{{ route('admin') }}"
                    class="sidebar-link @yield('adminhome') flex items-center space-x-3 p-3 w-full">
                    <i class="fas fa-home w-5 text-center"></i>
                    <span>Beranda</span>
                </a>
                <a href="{{ route('admin.books.index') }}"
                    class="sidebar-link @yield('adminbook') flex items-center space-x-3 p-3 w-full">
                    <i class="fas fa-book w-5 text-center"></i>
                    <span>Buku</span>
                </a>
                <a href="{{ route('admin.book.category.index') }}"
                    class="sidebar-link @yield('admincategorybook') flex items-center space-x-3 p-3 w-full">
                    <i class="fas fa-list-alt w-5 text-center"></i>
                    <span>Kategori Buku</span>
                </a>
                <a href="{{ route('admin.service.offer.index') }}"
                    class="sidebar-link @yield('adminserviceoffer') flex items-center space-x-3 p-3 w-full">
                    <i class="fas fa-wrench w-5 text-center"></i>
                    <span>Mitra Penawaran Layanan</span>
                </a>
            @elseif (Auth::user()->role == 'partner')
                <a href="{{ route('partner.dashboard') }}"
                    class="sidebar-link @yield('partnerhome') flex items-center space-x-3 p-3 w-full">
                    <i class="fas fa-home w-5 text-center"></i>
                    <span>Beranda</span>
                </a>
                <a href="{{ route('partner.bookshop') }}"
                    class="sidebar-link @yield('partnerbookshop') flex items-center space-x-3 p-3 w-full">
                    <i class="fas fa-store w-5 text-center"></i>
                    <span>Informasi Toko Buku</span>
                </a>
                <a href="{{ route('partner.shop.details') }}"
                    class="sidebar-link @yield('partnershop') flex items-center space-x-3 p-3 w-full">
                    <i class="fas fa-store w-5 text-center"></i>
                    <span>Detail Toko</span>
                </a>
            @else
                <a href="{{ url('home') }}"
                    class="sidebar-link @yield('home') flex items-center space-x-3 p-3 w-full">
                    <i class="fas fa-home w-5 text-center"></i>
                    <span>Beranda</span>
                </a>
                <a href="{{ route('home.community.index') }}"
                    class="sidebar-link @yield('communities') flex items-center space-x-3 p-3 w-full">
                    <i class="fas fa-users w-5 text-center"></i>
                    <span>Komunitas</span>
                </a>
                {{-- <a href="#" class="sidebar-link flex items-center space-x-3 p-3 w-full">
                    <i class="fas fa-book w-5 text-center"></i>
                    <span>My Books</span>
                </a> --}}
                <a href="{{ route('want.read') }}"
                    class="sidebar-link @yield('wantRead') flex items-center space-x-3 p-3 w-full">
                    <i class="fas fa-bookmark w-5 text-center"></i>
                    <span>Daftar Bacaan</span>
                </a>
                {{-- <a href="#" class="sidebar-link flex items-center space-x-3 p-3 w-full">
                    <i class="fas fa-calendar-alt w-5 text-center"></i>
                    <span>Book Clubs</span>
                </a> --}}
                <a href="{{ url('discover') }}"
                    class="sidebar-link @yield('discover') flex items-center space-x-3 p-3 w-full">
                    <i class="fas fa-search w-5 text-center"></i>
                    <span>Jelajahi</span>
                </a>
            @endif
        </nav>

        <hr class="my-6 border-gray-200">

        <nav class="space-y-2">
            {{-- <a href="#" class="sidebar-link flex items-center space-x-3 p-3 w-full">
                <i class="fas fa-cog w-5 text-center"></i>
                <span>Settings</span>
            </a>
            <a href="#" class="sidebar-link flex items-center space-x-3 p-3 w-full">
                <i class="fas fa-question-circle w-5 text-center"></i>
                <span>Help</span>
            </a> --}}
            <a href="{{ route('logout') }}" class="sidebar-link flex items-center space-x-3 p-3 w-full text-red-500">
                <i class="fas fa-sign-out-alt w-5 text-center"></i>
                <span>Keluar</span>
            </a>
        </nav>
    </div>
</div>

<!-- Mobile sidebar overlay -->
<div id="overlay" class="overlay"></div>
