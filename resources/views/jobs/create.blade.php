<x-layout>
    <x-slot name="title">Create New Job</x-slot>
    <h1>Create New Job</h1>
    <form action="/jobs" method="POST">
        @csrf
        <input type="text" name="title" placeholder="title" class="mt-4 block" value="{{ old('title') }}" />
        @error('title')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
        <input type="text" name="description" placeholder="description" class="mt-4 block"
            value="{{ old('description') }}" />
        @error('description')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
        <button type="submit" class="mt-4">Submit</button>
    </form>
</x-layout>
