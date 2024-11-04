<x-layout>
    <x-slot name="title">Edit Job</x-slot>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mx-auto w-full rounded-lg bg-white p-8 shadow-md md:max-w-3xl">
        <h2 class="mb-4 text-center text-4xl font-bold">
            Edit Job Listing
        </h2>
        <form method="POST" action="{{ route('jobs.update', $job->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h2 class="mb-6 text-center text-2xl font-bold text-gray-500">
                Job Info
            </h2>


            <x-inputs.text id="title" name="title" label="Job Title" placeholder="Software Engineer"
                :value="old('title', $job->title)" />

            <x-inputs.text-area id="description" name="description" label="Job Description"
                placeholder="We are seeking a skilled and motivated Software Developer to join our growing development team..."
                :value="old('description', $job->description)" />

            <x-inputs.text id="salary" name="salary" label="Annual Salary" placeholder="90000" type="number"
                :value="old('salary', $job->salary)" />

            <x-inputs.text-area id="requirements" name="requirements" label="Requirements"
                placeholder="Bachelor's degree in Computer Science" :value="old('requirements', $job->requirements)" />

            <x-inputs.text-area id="benefits" name="benefits" label="Benefits"
                placeholder="Health insurance, 401k, paid time off" :value="old('benefits', $job->benefits)" />

            <x-inputs.text id="tags" name="tags" label="Tags (comma-separated)"
                placeholder="development,coding,java,python" :value="old('tags', $job->tags)" />

            <x-inputs.select id="job_type" name="job_type" label="Job Type" :options="[
                'Full-Time' => 'Full-Time',
                'Part-Time' => 'Part-Time',
                'Contract' => 'Contract',
                'Temporary' => 'Temporary',
                'Internship' => 'Internship',
                'Volunteer' => 'Volunteer',
                'On-Call' => 'On-Call',
            ]" :value="old('job_type', $job->job_type)" />

            <x-inputs.select id="remote" name="remote" label="Remote" :options="[
                '0' => 'No',
                '1' => 'Yes',
            ]" :value="old('remote', $job->remote)" />

            <x-inputs.text id="address" name="address" label="Address" placeholder="123 Main St" :value="old('address', $job->address)" />

            <x-inputs.text id="city" name="city" label="City" placeholder="Albany" :value="old('city', $job->city)" />

            <x-inputs.text id="state" name="state" label="State" placeholder="NY" :value="old('state', $job->state)" />

            <x-inputs.text id="zipcode" name="zipcode" label="ZIP Code" placeholder="12201" :value="old('zipcode', $job->zipcode)" />

            <h2 class="mb-6 text-center text-2xl font-bold text-gray-500">
                Company Info
            </h2>

            <x-inputs.text id="company_name" name="company_name" label="Company Name" placeholder="Enter Company Name"
                :value="old('company_name', $job->company_name)" />

            <x-inputs.text-area id="company_description" name="company_description" label="Company Description"
                placeholder="Enter Company Description" :value="old('company_description', $job->company_description)" />

            <x-inputs.text id="company_website" name="company_website" label="Company Website"
                placeholder="Enter Website" type="url" :value="old('company_website', $job->company_website)" />

            <x-inputs.text id="contact_phone" name="contact_phone" label="Contact Phone"
                placeholder="Enter Contact Phone" :value="old('contact_phone', $job->contact_phone)" />

            <x-inputs.text id="contact_email" name="contact_email" label="Contact Email"
                placeholder="Enter Contact Email" type="email" :value="old('contact_email', $job->contact_email)" />

            <x-inputs.file id="company_logo" name="company_logo" label="Company Logo" />

            <button type="submit"
                class="my-3 w-full rounded bg-green-500 px-4 py-2 text-white hover:bg-green-600 focus:outline-none">
                Save
            </button>
        </form>
    </div>
</x-layout>
