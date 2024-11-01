<x-layout>
    <h1>Available Jobs</h1>
    @if (count($jobs) === 0)
        <p>No jobs available</p>
    @else
        <ul>
            @foreach ($jobs as $job)
                <li><a href="{{ route('jobs.show', $job->id) }}">{{ $job->title }} - {{ $job['description'] }}</a>
                </li>
            @endforeach
        </ul>
    @endif
</x-layout>
