<x-layout>
    <x-slot name="title">Create New Job</x-slot>

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
            Create Job Listing
        </h2>
        <form method="POST" action="/jobs" enctype="multipart/form-data">
            @csrf
            <h2 class="mb-6 text-center text-2xl font-bold text-gray-500">
                Job Info
            </h2>


            <x-inputs.text id="title" name="title" label="Job Title" placeholder="Software Engineer" />

            <div class="mb-4">
                <label class="block text-gray-700" for="description">Job Description</label>
                <textarea cols="30" rows="7" id="description" name="description"
                    class="@error('description') border-red-500 @enderror w-full rounded border px-4 py-2 focus:outline-none"
                    placeholder="We are seeking a skilled and motivated Software Developer to join our growing development team...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <x-inputs.text id="salary" name="salary" label="Annual Salary" placeholder="90000" type="number" />


            <div class="mb-4">
                <label class="block text-gray-700" for="requirements">Requirements</label>
                <textarea id="requirements" name="requirements" class="w-full rounded border px-4 py-2 focus:outline-none"
                    placeholder="Bachelor's degree in Computer Science"></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700" for="benefits">Benefits</label>
                <textarea id="benefits" name="benefits" class="w-full rounded border px-4 py-2 focus:outline-none"
                    placeholder="Health insurance, 401k, paid time off"></textarea>
            </div>

            <x-inputs.text id="tags" name="tags" label="Tags (comma-separated)"
                placeholder="development,coding,java,python" />

            <div class="mb-4">
                <label class="block text-gray-700" for="job_type">Job Type</label>
                <select id="job_type" name="job_type"
                    class="@error('job_type') border-red-500 @enderror w-full rounded border px-4 py-2 focus:outline-none">
                    <option value="Full-Time" {{ old('job_type') == 'Full-Time' ? 'selected' : '' }}>
                        Full-Time
                    </option>
                    <option value="Part-Time" {{ old('job_type') == 'Part-Time' ? 'selected' : '' }}>Part-Time</option>
                    <option value="Contract" {{ old('job_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                    <option value="Temporary" {{ old('job_type') == 'Temporary' ? 'selected' : '' }}>Temporary</option>
                    <option value="Internship" {{ old('job_type') == 'Internship' ? 'selected' : '' }}>Internship
                    </option>
                    <option value="Volunteer" {{ old('job_type') == 'Volunteer' ? 'selected' : '' }}>Volunteer</option>
                    <option value="On-Call" {{ old('job_type') == 'On-Call' ? 'selected' : '' }}>On-Call</option>
                </select>
                @error('job_type')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- <div class="mb-4">
                <label class="block text-gray-700" for="remote">Remote</label>
                <select id="remote" name="remote" class="w-full rounded border px-4 py-2 focus:outline-none">
                    <option value="{{ old('remote') ?? 'false' }}">No</option>
                    <option value="{{ old('remote') ?? 'true' }}">Yes</option>
                </select>
            </div> --}}

            <div class="mb-4">
                <label class="block text-gray-700" for="remote">Remote</label>
                <select id="remote" name="remote" class="w-full rounded border px-4 py-2 focus:outline-none">
                    <option value="0" {{ old('remote') == '0' ? 'selected' : '' }}>No</option>
                    <option value="1" {{ old('remote') == '1' ? 'selected' : '' }}>Yes</option>
                </select>
            </div>


            <x-inputs.text id="address" name="address" label="Address" placeholder="123 Main St" />

            <x-inputs.text id="city" name="city" label="City" placeholder="Albany" />

            <x-inputs.text id="state" name="state" label="State" placeholder="NY" />

            <x-inputs.text id="zipcode" name="zipcode" label="ZIP Code" placeholder="12201" />

            <h2 class="mb-6 text-center text-2xl font-bold text-gray-500">
                Company Info
            </h2>

            <x-inputs.text id="company_name" name="company_name" label="Company Name"
                placeholder="Enter Company Name" />

            <div class="mb-4">
                <label class="block text-gray-700" for="company_description">Company Description</label>
                <textarea id="company_description" name="company_description" class="w-full rounded border px-4 py-2 focus:outline-none"
                    placeholder="Company Description"></textarea>
            </div>

            <x-inputs.text id="company_website" name="company_website" label="Company Website"
                placeholder="Enter Website" type="url" />

            <x-inputs.text id="contact_phone" name="contact_phone" label="Contact Phone"
                placeholder="Enter Contact Phone" />

            <x-inputs.text id="contact_email" name="contact_email" label="Contact Email"
                placeholder="Enter Contact Email" type="email" />

            <div class="mb-4">
                <label class="block text-gray-700" for="company_logo">Company Logo</label>
                <input id="company_logo" type="file" name="company_logo"
                    class="@error('company_logo') border-red-500 @enderror w-full rounded border px-4 py-2 focus:outline-none" />
                @error('company_logo')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="my-3 w-full rounded bg-green-500 px-4 py-2 text-white hover:bg-green-600 focus:outline-none">
                Save
            </button>
        </form>
    </div>
</x-layout>
