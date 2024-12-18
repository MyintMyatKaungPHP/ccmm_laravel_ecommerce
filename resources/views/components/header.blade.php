<div
    class="flex items-center justify-between xl:px-32 sm:px-5 px-2 bg-secondary">
    <a href="{{ route('home.page') }}">
        <img
            src="{{ asset('Logo.png') }}"
            class="md:w-[150px] w-[100px] h-[80px] object-cover md:h-[12 0px]" alt="logo" />
    </a>
    <div class="flex items-center gap-5">
        <x-cart-icon />
        <!-- <UserDropDown  /> -->
        <div v-else class="md:flex hidden items-center gap-3">
            @if (auth()->check())
            <div class="flex items-center gap-2">
                <p class="text-white pr-2 font-semibold"> Hello! {{ auth()->user()->name }}</p>
                <a
                    href="{{ route('logout') }}"
                    class="px-8 py-4 font-bold rounded-lg bg-red-500 text-white">
                    Logout
                </a>
                @if (auth()->user()->is_admin)
                <a
                    href="{{ route('admin.dashboard') }}"
                    class="px-8 py-4 font-bold rounded-lg bg-primary text-white">
                    Admin Dashboard
                </a>
                @endif
            </div>
            @else
            <a
                href="{{ route('login.page') }}"
                class="px-8 py-4 font-bold rounded-lg bg-primary text-white">
                Login
            </a>
            <a
                href="{{ route('register.page') }}"
                class="px-8 py-4 font-bold rounded-lg text-primary border-2 border-primary">
                Register
            </a>
            @endif
        </div>
    </div>
</div>