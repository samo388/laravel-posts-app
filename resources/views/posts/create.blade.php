<x-app-layout>
    <div class="p-6 max-w-xl mx-auto">

        <h1 class="text-2xl font-bold mb-4">Create Post</h1>

        {{-- Validation errors --}}
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('posts.store') }}">
            @csrf

            <input
                type="text"
                name="title"
                value="{{ old('title') }}"
                placeholder="Post title"
                class="w-full border rounded p-2 mb-3"
            />

            <textarea
                name="body"
                rows="5"
                placeholder="Post content"
                class="w-full border rounded p-2 mb-3"
            >{{ old('body') }}</textarea>

            <button class="bg-green-600 text-white px-4 py-2 rounded">
                Save
            </button>
        </form>

    </div>
</x-app-layout>
