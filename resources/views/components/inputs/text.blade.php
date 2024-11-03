@props(['id', 'name', 'label' => null, 'type' => 'text', 'placeholder' => ''])

<div class="mb-4">
    @if ($label)
        <label class="block text-gray-700" for="{{ $id }}">{{ $label }}</label>
    @endif
    <input id="{{ $id }}" name="{{ $name }}" type="{{ $type }}"
        class="@error($name) border-red-500 @enderror w-full rounded border px-4 py-2 focus:outline-none"
        placeholder="{{ $placeholder }}" value="{{ old($name) }}" />
    @error($name)
        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>
