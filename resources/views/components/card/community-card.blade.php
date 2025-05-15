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
            @php
                $hasJoined = $community->users->contains(fn($u) => $u->id === auth()->id());
            @endphp

            @if ($hasJoined)
                <a href="{{ route('home.community.show', $community->id) }}"
                    class="btn-primary px-3 mr-3  py-1.5 rounded-full text-sm font-medium">
                    <i class="fas fa-eye mr-1"></i> Lihat
                </a>
                <form action="{{ route('home.community.leave', $community->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to leave this community?');">
                    @csrf
                    <button type="submit" class="btn-danger px-3 py-1.5 rounded-full text-sm font-medium">
                        <i class="fas fa-sign-out-alt mr-1"></i> Keluar
                    </button>
                </form>
            @else
                <form action="{{ route('home.community.join', $community->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-success px-3 py-1.5 rounded-full text-sm font-medium">
                        <i class="fas fa-plus mr-1"></i> Join
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
