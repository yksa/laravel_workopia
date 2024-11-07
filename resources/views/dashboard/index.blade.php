<x-layout>
    <x-slot name="title">Dashboard</x-slot>
    <h1 class="mb-2 text-3xl font-semibold">Dashboard</h1>
    <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
        @if (count($jobs) === 0)
            <p>No jobs available</p>
        @else
            @foreach ($jobs as $job)
                <x-job-card :job="$job" />
            @endforeach
        @endif
    </div>
</x-layout>
