@props(['url' => '/', 'icon' => null])

@php
    // Remove leading slash, if it exists
    $urlPath = ltrim($url, '/');
@endphp

<a href="{{ url($url) }}"
    class="{{ request()->is($urlPath) ? 'font-bold text-yellow-500' : '' }} py-2 text-white hover:underline">
    @if ($icon)
        <i class="fa fa-{{ $icon }} mr-1"></i>
    @endif
    {{ $slot }}
</a>
