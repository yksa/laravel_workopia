@props(['id', 'name', 'label' => null, 'placeholder' => '', 'rows' => 7])

<div class="mb-4">
    @if ($label)
        <label class="block text-gray-700" for="{{ $id }}">{{ $label }}</label>
    @endif
    <textarea cols="30" rows="{{ $rows }}" id="{{ $id }}" name="{{ $name }}"
        class="@error($name) border-red-500 @enderror w-full rounded border px-4 py-2 focus:outline-none"
        placeholder="{{ $placeholder }}">{{ old($name) }}</textarea>
    @error($name)
        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>
