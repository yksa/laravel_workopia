<x-layout>
    <section class="flex flex-col gap-4 md:flex-row">
        {{-- Job Listings --}}
        <div class="w-full rounded-lg bg-white p-8 shadow-md">
            <h3 class="mb-4 text-center text-3xl font-bold">
                My Job Listings
            </h3>
            @forelse($jobs as $job)
                <div class="flex items-center justify-between border-b-2 border-gray-200 py-2">
                    <div>
                        <h3 class="text-xl font-semibold">{{ $job->title }}</h3>
                        <p class="text-gray-700">{{ $job->job_type }}</p>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('jobs.edit', $job->id) }}"
                            class="rounded bg-blue-500 px-4 py-2 text-sm text-white">Edit</a>
                        <!-- Delete Form -->
                        <form method="POST" action="{{ route('jobs.destroy', $job->id) }}?from=dashboard"
                            onsubmit="return confirm('Are you sure that you want to delete this job?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="rounded bg-red-500 px-4 py-2 text-sm text-white hover:bg-red-600">
                                Delete
                            </button>
                        </form>
                        <!-- End Delete Form -->
                    </div>
                </div>

            @empty
                <p class="text-gray-700">You have not job listings</p>
            @endforelse
        </div>
    </section>
    <x-bottom-banner />
</x-layout>
