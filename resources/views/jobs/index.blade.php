<x-layout>
    <h1>Available Jobs</h1>
    <ul>
        @foreach ($jobs as $job)
            <li>{{ $job['title'] }} - {{ $job['description'] }}</li>
        @endforeach
    </ul>
</x-layout>
