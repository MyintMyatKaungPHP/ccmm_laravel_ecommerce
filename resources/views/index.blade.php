<x-layout>
    <div class="xl:px-32 sm:px-5 px-2">
        <div
            class="bg-[#F7F8F9] py-24 my-10 rounded-xl flex flex-col items-center justify-center">
            <h1 class="text-3xl font-bold">Shop</h1>
            <p class="lg:w-[50%] w-[70%] text-center mt-2">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                eiusmod tempor incididunt ut labore et dolore magna.
            </p>
        </div>
        <div class="flex md:flex-row flex-col top-0 mb-[100px]">
            <div class="lg:w-[25%] md:w-[35%] w-full md:sticky self-start top-16">
                <!-- Search bar -->
                <div class="flex items-center pl-2 rounded-full bg-white border-[1px] h-[50px]">
                    <svg class="text-black/50" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M15.5 14h-.79l-.28-.27A6.47 6.47 0 0 0 16 9.5A6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5S14 7.01 14 9.5S11.99 14 9.5 14" />
                    </svg>
                    <form action="">
                        @if (request('category'))
                        <!-- Keep the selected category in the hidden input -->
                        <input name="category" value="{{ request('category') }}" type="hidden" class="w-full p-0 pl-2 border-none bg-transparent outline-none focus:ring-0" />
                        @endif

                        <!-- Search input -->
                        <input name="search" value="{{ request('search') }}" type="text" class="w-full p-0 pl-2 border-none bg-transparent outline-none focus:ring-0" placeholder="Search for products" />
                    </form>
                </div>

                <!-- Category filter -->
                <div>
                    <p class="text mt-8 mb-3 font-bold">Product By Category</p>
                    <div>
                        @if ($categories->count() > 0)
                        <!-- Link to show all products (without any category filter) -->
                        <a href="{{ request('search') ? '/?search=' . request('search') : '/' }}" class="flex items-center cursor-pointer gap-2 py-3 px-2 border-t-[1px] border-t-black/10">
                            <p class="text-sm hover:text-primary transition-all">All</p>
                        </a>

                        <!-- Loop through the categories and generate filter links -->
                        @foreach ($categories as $category)
                        <a href="{{ request()->fullUrlWithQuery(['category' => $category->slug]) }}" class="flex items-center cursor-pointer gap-2 py-3 px-2 border-t-[1px] border-t-black/10">
                            <p class="text-sm hover:text-primary transition-all">{{ $category->name }}</p>
                        </a>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div
                class="lg:w-[75%] md:w-[65%] md:mt-0 mt-10 w-full mb-12 md:pl-[8%]">
                <div
                    class="grid lg:grid-cols-4 md:grid-cols-2 mb-14 gap-x-5 gap-y-10">
                    @foreach ($products as $product)
                    <x-product_card :product="$product" />
                    @endforeach
                </div>
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-layout>