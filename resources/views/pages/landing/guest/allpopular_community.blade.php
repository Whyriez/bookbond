@extends('layouts.landing')
@section('title', 'All Community - BookBond')

@section('content')
    <section id="communities" class="py-16 bg-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">
                        Komunitas Populer
                    </h2>
                    <p class="text-gray-600 max-w-2xl">
                        Bergabunglah dengan komunitas pembaca yang berkembang pesat ini yang memiliki minat sastra yang sama dengan Anda.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($allCommunities as $community)
                    <div class="community-card bg-white shadow-md">
                        <div class="h-40 relative overflow-hidden"
                            style="background-color: {{ $community->random_color }};">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg viewBox="0 0 200 80" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                                    <path fill="#ffffff" fill-opacity="0.2" d="{{ $community->random_shape }}"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-3">
                                <h3 class="text-xl font-bold">{{ $community->name }}</h3>
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                    {{ number_format($community->users_count) }} anggota</span>
                            </div>
                            <p class="text-gray-600 mb-4">
                                {{ $community->description }}
                            </p>
                            <div class="flex items-center justify-between">
                                <div class="flex -space-x-2">
                                    @foreach ($community->users->take(3) as $user)
                                        <div
                                            class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center text-white text-xs">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                    @endforeach
                                    @if ($community->users_count > 3)
                                        <div
                                            class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 text-xs">
                                            +{{ $community->users_count - 3 }}
                                        </div>
                                    @endif
                                </div>

                                <a href="{{ route('login') }}"
                                    class="text-indigo-600 font-medium hover:text-indigo-800">Bergabung</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="p-3 text-gray-500 italic w">tidak ada komunitas yang populer.</p>
                @endforelse
            </div>

            <div class="text-center mt-10 md:hidden">
                <a href="#" class="inline-flex items-center text-indigo-600 font-medium hover:text-indigo-800">
                    Lihat Semua Komunitas
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

@endsection
