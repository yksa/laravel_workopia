@props(['url' => '/', 'icon' => null, 'mobile' => false])

@php
    // Remove leading slash, if it exists
    $urlPath = ltrim($url, '/');
@endphp

@if ($mobile)
    <a href="{{ url($url) }}"
        class="{{ request()->is($urlPath) ? 'font-bold text-yellow-500' : '' }} block px-4 py-2 hover:bg-blue-700">
        @if ($icon)
            <i class="fa fa-{{ $icon }} mr-1"></i>
        @endif
        {{ $slot }}
    </a>
@else
    <a href="{{ url($url) }}"
        class="{{ request()->is($urlPath) ? 'font-bold text-yellow-500' : '' }} py-2 text-white hover:underline">
        @if ($icon)
            <i class="fa fa-{{ $icon }} mr-1"></i>
        @endif
        {{ $slot }}
    </a>
@endif
