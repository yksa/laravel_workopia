<x-layout>
    <h1>Available Jobs</h1>
    <ul>
        @foreach ($jobs as $job)
            <li>{{ $job }}</li>
        @endforeach
    </ul>
</x-layout>
