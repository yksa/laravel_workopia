<x-layout>
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-4">
        <!-- Job Details Column -->
        <section class="lg:col-span-3">
            <div class="rounded-lg bg-white p-3 shadow-md">
                <div class="flex items-center justify-between">
                    <a class="block p-4 text-blue-700" href="{{ route('jobs.index') }}">
                        <i class="fa fa-arrow-alt-circle-left"></i>
                        Back To Listings
                    </a>
                    @can('update', $job)
                        <div class="ml-4 flex space-x-3">
                            <a href="{{ route('jobs.edit', $job->id) }}"
                                class="rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-600">Edit</a>
                            <!-- Delete Form -->
                            <form method="POST" action="{{ route('jobs.destroy', $job->id) }}"
                                onsubmit="return confirm('Are you sure that you want to delete this job?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded bg-red-500 px-4 py-2 text-white hover:bg-red-600">
                                    Delete
                                </button>
                            </form>
                            <!-- End Delete Form -->
                        </div>
                    @endcan
                </div>
                <div class="p-4">
                    <h2 class="text-xl font-semibold">
                        {{ $job->title }}
                    </h2>
                    <p class="mt-2 text-lg text-gray-700">
                        {{ $job->description }}
                    </p>
                    <ul class="my-4 bg-gray-100 p-4">
                        <li class="mb-2">
                            <strong>Job Type:</strong> {{ $job->job_type }}
                        </li>
                        <li class="mb-2">
                            <strong>Remote:</strong> {{ $job->remote ? 'Yes' : 'No' }}
                        </li>
                        <li class="mb-2">
                            <strong>Salary:</strong> ${{ number_format($job->salary) }}
                        </li>
                        <li class="mb-2">
                            <strong>Site Location:</strong> {{ $job->city }}, {{ $job->state }}
                        </li>
                        @if ($job->tags)
                            <li class="mb-2">
                                <strong>Tags:</strong>
                                <span>
                                    {{ implode(', ', array_map('ucfirst', explode(',', $job->tags))) }}
                                </span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="container mx-auto p-4">
                @if ($job->requirements || $job->benefits)
                    <h2 class="mb-4 text-xl font-semibold">Job Details</h2>
                    <div class="rounded-lg bg-white p-4 shadow-md">
                        <h3 class="mb-2 text-lg font-semibold text-blue-500">
                            Job Requirements
                        </h3>
                        <p>
                            {{ $job->requirements }}
                        </p>
                        <h3 class="mb-2 mt-4 text-lg font-semibold text-blue-500">
                            Benefits
                        </h3>
                        <p>
                            {{ $job->benefits }}
                        </p>
                    </div>
                @endif

                @auth
                    <p class="my-5">
                        Put "Job Application" as the subject of your email
                        and attach your resume.
                    </p>

                    <div x-data="{ open: @json(session()->has('errors')) }" class="relative z-10">
                        {{-- <div x-data="{ open: false }"> --}}
                        <button @click="open = true"
                            class="block w-full cursor-pointer rounded border bg-indigo-100 px-5 py-2.5 text-center text-base font-medium text-indigo-700 shadow-sm hover:bg-indigo-200">
                            Apply Now
                        </button>

                        <dialog x-show="open"
                            class="fixed inset-0 flex h-full w-full items-center justify-center bg-gray-900/50" x-cloak>
                            <!-- Modal Container -->
                            <div @click.away="open = false"
                                class="mx-4 my-6 max-h-[90vh] w-full max-w-lg overflow-y-auto rounded-lg bg-white p-6 shadow-lg">
                                <h3 class="mb-4 text-lg font-semibold">
                                    Apply For {{ $job->title }}
                                </h3>

                                <form enctype="multipart/form-data" method="POST"
                                    action="{{ route('applicant.store', $job->id) }}">
                                    @csrf
                                    <x-inputs.text id="full_name" name="full_name" label="Full Name" :required="false" />
                                    <x-inputs.text id="contact_phone" name="contact_phone" label="Contact Phone" />
                                    <x-inputs.text type="contact_email" id="contact_email" name="contact_email"
                                        label="Contact Email" :required="true" />
                                    <x-inputs.text-area id="message" name="message" label="Message" :rows="5" />
                                    <x-inputs.text id="location" name="location" label="Location" />
                                    <x-inputs.file id="resume" name="resume" label="Resume" :required="true" />

                                    <button type="submit"
                                        class="mt-4 rounded-md bg-blue-500 px-4 py-2 text-center font-bold text-white hover:bg-blue-600">Submit
                                        Application</button>
                                    <button @click="open = false"
                                        class="mt-4 rounded-md bg-gray-300 px-4 py-2 text-center font-bold text-black hover:bg-gray-400">Cancel
                                    </button>
                                </form>
                            </div>
                        </dialog>
                    </div>
                @else
                    <p class="my-5 rounded-xl bg-gray-200 p-3">
                        <i class="fas fa-info-circle mr-3"></i> You must be logged in to apply for this job
                    </p>
                @endauth
            </div>

            <div class="mt-6 rounded-lg bg-white p-6 shadow-md">
                <div id="map"></div>
            </div>
        </section>

        <!-- Sidebar -->
        <aside class="rounded-lg bg-white p-3 shadow-md">
            <h3 class="mb-4 text-center text-xl font-bold">
                Company Info
            </h3>
            @if ($job->company_logo)
                <img src="/storage/{{ $job->company_logo }}" alt="Ad" class="m-auto mb-4 w-full rounded-lg" />
            @endif
            <h4 class="text-lg font-bold">{{ $job->company_name }}</h4>
            @if ($job->description)
                <p class="my-3 text-lg text-gray-700">
                    {{ $job->company_description }}
                </p>
            @endif
            @if ($job->company_website)
                <a href="{{ $job->company_website }}" target="_blank" class="text-blue-500">Visit Website</a>
            @endif

            @guest
                <p class="mt-10 w-full rounded-full bg-gray-200 px-4 py-2 text-center font-bold text-gray-700">
                    <i class="fas fa-info-circle mr-3"></i>
                    You must be logged in to bookmark a job
                </p>
            @else
                <form
                    action="{{ auth()->user()->bookmarkedJobs()->where('job_id', $job->id)->exists()? route('bookmarks.destroy', $job->id): route('bookmarks.store', $job->id) }}"
                    method="POST">
                    @csrf
                    @if (auth()->user()->bookmarkedJobs()->where('job_id', $job->id)->exists())
                        @method('DELETE')
                        <button type="submit"
                            class="mt-8 w-full rounded-full bg-red-500 px-4 py-2 text-center font-bold text-white hover:bg-red-600">
                            <i class="fas fa-bookmark mr-3"></i>
                            Remove Bookmark
                        </button>
                    @else
                        <button type="submit"
                            class="mt-8 w-full rounded-full bg-blue-500 px-4 py-2 text-center font-bold text-white hover:bg-blue-600">
                            <i class="fas fa-bookmark mr-3"></i>
                            Bookmark This Job
                        </button>
                    @endif
                </form>
            @endguest
        </aside>
    </div>
</x-layout>

<link href="https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.css" rel="stylesheet" />
<script src="https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // if we remove accessToken from the client it will not work, so we need to add it here
        // there are two options to remvoe the access token, 
        // one is to remove it from the client, and return static image from the server but it will loose the interactivity
        // two is don't remove, restrict the access token from mapbox token management
        mapboxgl.accessToken = "{{ env('MAPBOX_API_KEY') }}";
        // Initialize the map
        const map = new mapboxgl.Map({
            container: 'map', // ID of the container element
            style: 'mapbox://styles/mapbox/streets-v11', // Map style
            center: [-74.5, 40], // Default center
            zoom: 9, // Default zoom level
        });


        // Get address from Laravel view
        const city = '{{ $job->city }}';
        const state = '{{ $job->state }}';
        const address = city + ', ' + state;

        const url = `/geocode?address=${encodeURIComponent(address)}`;


        // Geocode the address
        fetch(url)
            .then((response) => response.json())
            .then((data) => {

                if (data.features.length > 0) {
                    const [longitude, latitude] = data.features[0].center;

                    // Center the map and add a marker
                    map.setCenter([longitude, latitude]);
                    map.setZoom(14);

                    new mapboxgl.Marker().setLngLat([longitude, latitude]).addTo(map);
                } else {
                    console.error('No results found for the address.');
                }
            })
            .catch((error) => console.error('Error geocoding address:', error));
    });
</script>
