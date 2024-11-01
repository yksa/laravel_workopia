<x-layout>
    <h1>Available Jobs</h1>
    @if (count($jobs) === 0)
        <p>No jobs available</p>
    @else
        <ul>
            @foreach ($jobs as $job)
                <li>{{ $job->title }} - {{ $job['description'] }}</li>
            @endforeach
        </ul>
    @endif
</x-layout>
