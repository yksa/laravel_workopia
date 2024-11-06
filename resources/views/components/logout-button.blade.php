@props([
    'mobile' => false,
])

<form method="POST" action="{{ route('logout') }}" class="flex items-center">
    @csrf
    <button type="submit" class="{{ $mobile ? 'px-4 mb-4' : '' }} text-white">
        <i class="fa fa-sign-out"></i> Logout
    </button>
</form>
