@props(['type', 'message', 'timeout' => 3000])

<div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
    x-transition:enter="transform transition ease-out duration-300" x-transition:enter-start="translate-x-full opacity-0"
    x-transition:enter-end="translate-x-0 opacity-100" x-transition:leave="transform transition ease-in duration-300"
    x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="translate-x-full opacity-0"
    class="{{ $type == 'success' ? 'bg-green-500' : 'bg-red-500' }} mb-4 rounded p-4 text-sm text-white shadow-lg">
    {{ $message }}
</div>
