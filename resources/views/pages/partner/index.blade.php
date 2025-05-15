@extends('layouts.app')
@section('title', 'Admin Home')
@section('partnerhome', 'active')

@section('content')

    <!-- Welcome Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold mb-2">Selamat Datang kembali, {{ Auth::user()->name }}!</h1>
        </div>

        <div class="mt-4 md:mt-0 flex items-center space-x-4">
            {{-- <div class="relative">
                <input type="text" placeholder="Search books, authors, genres..."
                    class="pl-10 pr-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent w-full md:w-64">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div> --}}

            <div class="w-10 h-10 rounded-full bg-violet-100 flex items-center justify-center">
                <span class="text-violet-600 font-medium">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</span>
            </div>
        </div>
    </div>

    <!-- Reading Stats -->
    <div class="reading-stats p-6 mb-8 text-white">
        <h2 class="text-xl font-bold mb-4">Dashboard</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="stat-card p-4">
                <p class="text-sm opacity-80">Total Kunjungan Website Hari Ini</p>
                <div class="flex items-end space-x-2">
                    <span class="text-3xl font-bold">{{ $totalToday }}</span>
                    <span class="text-sm opacity-80">klik</span>
                </div>
            </div>

            <div class="stat-card p-4">
                <p class="text-sm opacity-80">Total Kunjungan Website Bulan Ini</p>
                <div class="flex items-end space-x-2">
                    <span class="text-3xl font-bold">{{ $totalMonth }}</span>
                    <span class="text-sm opacity-80">klik</span>
                </div>
            </div>

            <div class="stat-card p-4">
                <p class="text-sm opacity-80">Total Kunjungan Website Tahun Ini</p>
                <div class="flex items-end space-x-2">
                    <span class="text-3xl font-bold">{{ $totalYear }}</span>
                    <span class="text-sm opacity-80">klik</span>
                </div>
            </div>

            <div class="stat-card p-4">
                <p class="text-sm opacity-80">Total Kunjungan Website Keseluruhan</p>
                <div class="flex items-end space-x-2">
                    <span class="text-3xl font-bold">{{ $totalAll }}</span>
                    <span class="text-sm opacity-80">klik</span>
                </div>
            </div>


            {{-- <div class="stat-card p-4">
                <p class="text-sm opacity-80">Currently Reading</p>
                <div class="flex items-end space-x-2">
                    <span class="text-3xl font-bold">2</span>
                    <span class="text-sm opacity-80">books</span>
                </div>
            </div>

            <div class="stat-card p-4">
                <p class="text-sm opacity-80">Reading Goal</p>
                <div class="flex items-end space-x-2">
                    <span class="text-3xl font-bold">48%</span>
                    <span class="text-sm opacity-80">completed</span>
                </div>
            </div>

            <div class="stat-card p-4">
                <p class="text-sm opacity-80">Want to Read</p>
                <div class="flex items-end space-x-2">
                    <span class="text-3xl font-bold">24</span>
                    <span class="text-sm opacity-80">books</span>
                </div>
            </div> --}}
        </div>
    </div>

    <!-- Book Recommendations -->
    <div class="mb-8">

    </div>


@endsection
