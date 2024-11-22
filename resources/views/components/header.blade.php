<div
    class="flex items-center justify-between xl:px-32 sm:px-5 px-2 bg-secondary">
    <a href="/">
        <img
            src="{{ asset('Logo.png') }}"
            class="md:w-[150px] w-[100px] h-[80px] object-cover md:h-[12 0px]" alt="logo" />
    </a>
    <div class="flex items-center gap-5">
        <div class="flex items-center cursor-pointer text-white">
            <div class="flex items-center">
                <p
                    class="w-[25px] rounded-full flex text-sm items-center justify-center h-[25px] bg-primary">
                    0
                </p>
                <svg
                    class="md:w-[50px] w-[30px] h-[50px] md:h-[80px]"
                    xmlns="http://www.w3.org/2000/svg"
                    width="32"
                    height="32"
                    viewBox="0 0 24 24">
                    <path
                        fill="currentColor"
                        d="M6.616 21q-.691 0-1.153-.462T5 19.385V8.615q0-.69.463-1.152T6.616 7H8.5v-.5q0-1.458 1.021-2.479T12 3t2.479 1.021T15.5 6.5V7h1.885q.69 0 1.152.463T19 8.616v10.769q0 .69-.463 1.153T17.385 21zM9.5 7h5v-.5q0-1.056-.722-1.778T12 4t-1.778.722T9.5 6.5zm5.5 4q.214 0 .357-.143t.143-.357V8h-1v2.5q0 .214.143.357T15 11m-6 0q.214 0 .357-.143T9.5 10.5V8h-1v2.5q0 .214.143.357T9 11" />
                </svg>
            </div>
            <p>Your Cart</p>
        </div>
        <!-- <UserDropDown  /> -->
        <div v-else class="md:flex hidden items-center gap-3">
            <a
                href="/login"
                class="px-8 py-4 font-bold rounded-lg bg-primary text-white">
                Login
            </a>
            <a
                href="/register"
                class="px-8 py-4 font-bold rounded-lg text-primary border-2 border-primary">
                Register
            </a>
        </div>
    </div>
</div>