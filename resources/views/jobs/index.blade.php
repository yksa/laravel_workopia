<x-layout>
    <div class="mb-4 flex h-24 items-center justify-center rounded bg-blue-900 px-4">
        <x-search />
    </div>
    <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
        @if (count($jobs) === 0)
            <p>No jobs available</p>
        @else
            @foreach ($jobs as $job)
                <x-job-card :job="$job" />
            @endforeach
        @endif
    </div>

    {{-- Pagination --}}
    {{ $jobs->links() }}
</x-layout>
