<x-layout>
    <div
        class="flex lg:flex-row flex-col gap-5 xl:px-32 sm:px-5 px-2 mt-10 mb-10">
        <div class="basis-[60%]">
            <h1 class="font-bold text-2xl">Order Delivery Information</h1>
            <div class="mt-6 border-[1px] border-black/10 px-6 pt-8 pb-8">
                @if ($carts->isEmpty())
                <p class="text-center text-black/50 mt-4">No items selected.</p>
                <p class="text-center text-black/50 mt-4"><a href="{{ route('home.page') }}" class="text-center text-primary mt-4">See all products</a></p>
                @else
                <form class="md:grid md:grid-cols-2 flex flex-col gap-4" action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="md:col-span-2 flex flex-col justify-center">
                        <label class="font-semibold text-sm">Name</label>
                        <input
                            class="md:col-span-2 outline-none px-3 focus:ring-0 border-[1px] border-black/10 py-4 rounded-lg focus:border-primary transition-all mt-2"
                            value="{{ auth()->user()->name }}" readonly />
                    </div>
                    <div class="md:col-span-2 flex flex-col justify-center">
                        <label class="font-semibold text-sm">Email</label>
                        <input
                            f class="outline-none focus:ring-0 px-3 border-[1px] border-black/10 py-4 rounded-lg focus:border-primary transition-all mt-2"
                            value="{{ auth()->user()->email }}" readonly />
                    </div>
                    <div class="md:col-span-2 flex flex-col justify-center">
                        <label class="font-semibold text-sm">Phone Number</label>
                        <input
                            name="phone_number"
                            value="{{old('phone_number')}}"
                            type="text"
                            class="outline-none focus:ring-0 px-3 border-[1px] border-black/10 py-4 rounded-lg focus:border-primary transition-all mt-2"
                            placeholder="Enter your mobile phone number" />
                        @error('phone_number')
                        <p class="text-red-500 text-sm mt-2">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="flex md:col-span-2 flex-col">
                        <label class="font-semibold text-sm">Shipping Address</label>
                        <textarea
                            name="shipping_address"
                            rows="5"
                            class="outline-none focus:ring-0 border-[1px] border-black/10 py-4 rounded-lg focus:border-primary transition-all mt-2">
                        {{ old('shipping_address') }}
                        </textarea>
                        @error('shipping_address')
                        <p class="text-red-500 text-sm mt-2">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2 flex flex-col justify-center">
                        <label class="font-semibold text-sm">Transition Screenshot</label>
                        <input type="file" name="transition_screenshot" value="{{old('transition_screenshot')}}" />
                        @error('transition_screenshot')
                        <p class="text-red-500 text-sm mt-2">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="flex md:col-span-2 flex-col">
                        <label class="font-semibold text-sm">Order Notes (optional)</label>
                        <textarea
                            name="order_notes"
                            rows="5"
                            class="outline-none focus:ring-0 border-[1px] border-black/10 py-4 rounded-lg focus:border-primary transition-all mt-2">
                        {{ old('order_notes') }}
                        </textarea>
                        @error('order_notes')
                        <p class="text-red-500 text-sm mt-2">{{$message}}</p>
                        @enderror
                    </div>
                    <button
                        type="submit"
                        class="w-full h-full col-span-2 text-white bg-primary rounded-full py-4 font-bold mt-3">
                        Confirm Order
                    </button>

                </form>
                @endif
            </div>
        </div>
        <div class="basis-[40%]">
            <h1 class="font-bold text-2xl">Your Order</h1>
            <div class="mt-6 border-[1px] border-black/10 px-6 pt-8 pb-8">
                <p class="font-semibold">Products in cart</p>
                @forelse($carts as $cart)
                <div class="py-3 flex text-sm gap-4 border-b-[1px] border-b-black/10">
                    <div class="grid grid-cols-4 gap-4 w-full">
                        <!-- Trash Icon and Product Name Column -->
                        <div class="flex items-center col-span-2"> <!-- Increased space for product name -->
                            <!-- Trash Icon with Delete Form -->
                            <form action="{{ route('cart.destroy', $cart->id) }}" method="POST" class="mr-3">
                                @csrf
                                @method('DELETE') <!-- This makes it a DELETE request -->
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                        <path d="M3 6h18M19 6l-1.5 15H6.5L5 6M9 10v6M15 10v6"></path>
                                    </svg>
                                </button>
                            </form>
                            <!-- Product Name Link -->
                            <a href="{{ route('product.detail.page', $cart->product->slug) }}" class="col-span-2 flex items-center">
                                <p class="truncate">{{ $cart->product->name }}</p> <!-- Added truncation for long names -->
                            </a>
                        </div>

                        <!-- Price x Quantity Column -->
                        <div class="flex items-center justify-end col-span-1 gap-2">
                            <p class="ml-2">{{ number_format($cart->product->price, 2) }}</p>
                            <p> x </p>
                            <p class="text-black/50"> {{ $cart->quantity }}</p>
                        </div>

                        <!-- Total Column -->
                        <div class="flex items-center justify-end col-span-1">
                            <p class="font-bold">{{ number_format($cart->product->price * $cart->quantity, 2) }} <span class="font-normal text-black/50">MMK</span></p>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-center text-black/50 mt-4">No items selected.</p>
                @endforelse

                <!-- Total Calculation -->
                <div class="mt-8 pb-8 flex text-sm border-b-[1px] border-b-black/10 items-center justify-between">
                    <p class="font-semibold">Total</p>
                    <p class="font-bold text-primary">{{ number_format($grandTotal, 2) }} <span class="font-normal text-black/50">MMK</span></p>
                </div>

                <!-- Bank Transfer Section -->
                <div class="mt-8">
                    <p class="font-semibold mb-3">Bank Transfer</p>
                    <div class="grid grid-cols-5 gap-2">
                        <div class="border rounded-md overflow-hidden border-black/30">
                            <img class="w-full h-full object-cover" src="https://tbqmall.co/wp-content/uploads/2023/09/tbqhs-uabpay-checkout.png" />
                        </div>
                        <div class="border rounded-md overflow-hidden border-black/30">
                            <img class="w-full h-full object-cover" src="http://localhost:8000/storage/screenshot/YtolYlJ6uWPHWK30PbgbzktpvCYgnM7Y1hdMANXI.png" />
                        </div>
                    </div>
                    <p class="mt-4 text-sm font-bold text-black/50">
                        Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.
                    </p>
                    <div class="mt-5 flex-col gap-3">
                        <div>
                            <p class="font-semibold text-lg">Acc No.</p>
                            <p class="font-semibold text-black">09876322323</p>
                        </div>
                        <div>
                            <p class="font-semibold text-lg">Username.</p>
                            <p class="font-semibold text-black">Unknown</p>
                        </div>
                        <div>
                            <h1 class="font-semibold text-lg">QR Code.</h1>
                            <img class="w-[300px] mx-auto h-auto" src="https://www.narrativeindustries.com/wp-content/uploads/2020/05/PayPal-QR-Code-Scan-Me-2-862x523.png" />
                        </div>
                        <div v-if="payment?.description">
                            <h1 class="font-semibold text-lg">Description</h1>
                            <p class="font-semibold text-black">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consectetur odio error, placeat cum quo perspiciatis? Laudantium numquam necessitatibus quam dignissimos.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Terms and Conditions -->
                <div class="flex items-center cursor-pointer gap-2">
                    <input id="termandcondition" type="checkbox" class="outline-none focus:ring-0 border-2 border-black/10" name="" />
                    <label for="termandcondition" class="text-sm font-bold text-black/50 my-4">I have read and agree to the website
                        <span class="underline text-black">terms and conditions</span></label>
                </div>
            </div>
        </div>
    </div>
</x-layout>