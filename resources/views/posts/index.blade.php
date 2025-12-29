<x-app-layout>
    <div class="p-6 max-w-5xl mx-auto">

        <h1 class="text-2xl font-bold mb-4">My Posts</h1>

        {{-- Flash message --}}
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('posts.create') }}"
           class="inline-block mb-4 bg-blue-600 text-white px-4 py-2 rounded">
            + New Post
        </a>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @forelse ($posts as $post)
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="text-xl font-semibold mb-2">{{ $post->title }}</h2>

                    <p class="text-gray-600 mb-4">
                        {{ \Illuminate\Support\Str::limit($post->body, 120) }}
                    </p>

                    <div class="flex gap-4">
                        <a href="{{ route('posts.edit', $post) }}"
                           class="text-blue-600 hover:underline">
                            Edit
                        </a>

                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button
                                onclick="return confirm('Delete this post?')"
                                class="text-red-600 hover:underline">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p>No posts yet.</p>
            @endforelse
        </div>

    </div>
</x-app-layout>
