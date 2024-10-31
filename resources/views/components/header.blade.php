<header class="bg-blue-900 p-4 text-white">
    <div class="container mx-auto flex items-center justify-between">
        <h1 class="text-3xl font-semibold">
            <a href="{{ url('/') }}">Workopia</a>
        </h1>
        <nav class="hidden items-center space-x-4 md:flex">
            <x-nav-link url="/jobs">All Jobs</x-nav-link>
            <x-nav-link url="/jobs/saved">Saved Jobs</x-nav-link>
            <x-nav-link url="/login" icon="user">Login</x-nav-link>
            <x-nav-link url="/register">Register</x-nav-link>
            <x-nav-link url="/dashboard" icon="gauge">Dashboard</x-nav-link>

            <x-button-link url="/jobs/create" icon="edit">Create Job</x-button-link>
        </nav>
        <button id="hamburger" class="flex items-center text-white md:hidden">
            <i class="fa fa-bars text-2xl"></i>
        </button>
    </div>
    <!-- Mobile Menu -->
    <nav id="mobile-menu" class="mt-5 hidden space-y-2 bg-blue-900 pb-4 text-white md:hidden">
        <x-nav-link url="/jobs" mobile={{ true }}>All Jobs</x-nav-link>
        <x-nav-link url="/jobs/saved" :mobile="true">Saved Jobs</x-nav-link>
        <x-nav-link url="/login" icon="user" mobile={{ true }}>Login</x-nav-link>
        <x-nav-link url="/register" mobile={{ true }}>Register</x-nav-link>
        <x-nav-link url="/dashboard" icon="gauge" mobile={{ true }}>Dashboard</x-nav-link>

        <x-button-link url="/jobs/create" icon="edit" mobile={{ true }}>Create Job</x-button-link>
    </nav>
</header>
