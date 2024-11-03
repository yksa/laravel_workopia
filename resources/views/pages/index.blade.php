<x-layout>
    <h2 class="mb-4 border-gray-300 p-3 text-center text-3xl font-bold">Welcome To Workopia</h2>

    <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
        @if (count($jobs) === 0)
            <p>No jobs available</p>
        @else
            @foreach ($jobs as $job)
                <x-job-card :job="$job" />
            @endforeach
        @endif
    </div>
    <a href="{{ route('jobs.index') }}" class="block text-center text-xl">
        <i class="fa fa-arrow-alt-circle-right"></i> Show All Jobs
    </a>

    <x-bottom-banner />
</x-layout>
