<x-app-layout>
    <div class="p-6 max-w-xl mx-auto">

        <h1 class="text-2xl font-bold mb-4">{{ $post->title }}</h1>

        <p class="text-gray-700">
            {{ $post->body }}
        </p>

    </div>
</x-app-layout>
