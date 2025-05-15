<div class="post-card bg-white shadow-md rounded-lg mb-6 overflow-hidden">
    <div class="p-6">
        <div class="flex items-center mb-4">
            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                <span class="text-blue-600 font-medium">
                    {{ strtoupper(substr($post->user->name, 0, 2)) }}
                </span>
            </div>
            <div>
                <p class="font-medium">{{ $post->user->name }}</p>
                <p class="text-xs text-gray-500">Posted {{ $post->created_at->diffForHumans() }}
                </p>
            </div>
        </div>

        <h3 class="text-xl font-bold mb-3">{{ $post->title }}</h3>

        <div class="mb-4">
            <p class="text-gray-700" id="content-limited-{{ $post->id }}">
                {{ Str::limit(strip_tags($post->content), 200) }}</p>
            <p class="text-gray-700 hidden" id="content-full-{{ $post->id }}">
                {{ strip_tags($post->content) }}</p>
        </div>

        @if ($post->book && $post->book->image)
            <a href="{{ route('home.book.detail', $post->book->id) }}" class="mb-4">
                <div class="flex items-start space-x-4 mb-4">
                    <div class="w-16 h-24 bg-blue-100 rounded-md flex-shrink-0 flex items-center justify-center">
                        <img src="{{ asset('storage/' . $post->book->image) }}" alt="{{ $post->book->name }}"
                            class="w-full h-full object-cover rounded-md">
                    </div>
                    <div>
                        <p class="font-medium">{{ $post->book->name }}</p>
                        <p class="text-sm text-gray-600">oleh {{ $post->book->author }}</p>
                    </div>
                </div>
            </a>
        @endif


        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <form action="{{ route('home.community.post.like', $post->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center text-gray-500 hover:text-violet-600">
                        <i
                            class="{{ $post->usersWhoLiked->contains(Auth::user()) ? 'fas' : 'far' }} fa-heart mr-1"></i>
                        <span>{{ $post->usersWhoLiked->count() }}</span>
                    </button>
                </form>
                {{-- Placeholder komentar --}}
                {{-- <button class="flex items-center text-gray-500 hover:text-violet-600">
                    <i class="far fa-comment mr-1"></i>
                    <span>0</span>
                </button> --}}
            </div>

            @if (strlen(strip_tags($post->content)) > 200)
                <button id="toggle-btn-{{ $post->id }}" onclick="toggleContent({{ $post->id }})"
                    class="btn-outline px-3 py-1.5 rounded-md text-sm">
                    Baca selengkapnya
                </button>
            @endif
        </div>
    </div>
</div>
