<x-layout>
    <x-slot name="title">Login</x-slot>
    <div class="mx-auto mt-12 w-full rounded-lg bg-white p-8 py-12 shadow-md md:max-w-xl">
        <h2 class="mb-4 text-center text-4xl font-bold">
            Login
        </h2>

        <form action="{{ route('login.authenticate') }}" method="POST">
            @csrf
            <x-inputs.text type="email" id="email" name="email" placeholder="Email address" />
            <x-inputs.text type="password" id="password" name="password" placeholder="Password" />

            <button type="submit"
                class="my-3 w-full rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-600 focus:outline-none">
                Login
            </button>

            <p class="mt-4 text-gray-500">
                Don't have an account?
                <a class="text-blue-900" href="{{ route('register') }}">Register</a>
            </p>
        </form>
    </div>
</x-layout>
