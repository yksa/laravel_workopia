<x-layout>
    <x-slot name="title">Bookmarked Jobs</x-slot>
    <h2 class="mb-4 border-gray-300 p-3 text-center text-3xl font-bold">Bookmarked Jobs</h2>

    <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
        @forelse($bookmarks as $bookmark)
            <x-job-card :job="$bookmark" />
        @empty
            <p class="text-center text-gray-500">No jobs available</p>
        @endforelse
    </div>

</x-layout>
