<x-layout>
    <div class="xl:px-32 sm:px-5 px-2">
        <div class="mt-10 flex md:flex-row flex-col xl:gap-10 gap-5">
            <div class="lg:basis-[65%] md:basis-[60%] overflow-hidden">
                <div class="flex lg:flex-row flex-col-reverse gap-5">
                    <div class="basis-[10%] flex lg:flex-col flex-row gap-4">
                        <div
                            class="w-full h-auto rounded-lg overflow-hidden group cursor-pointer">
                            <img
                                class="w-full h-full group-hover:scale-[1.1] transition-all"
                                src="https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f6a67c4666f047ada3ba87_image-10-shop-product-shopwave-template-p-500.png" />
                        </div>
                        <div
                            class="w-full h-auto rounded-lg overflow-hidden group cursor-pointer">
                            <img
                                class="w-full h-full group-hover:scale-[1.1] transition-all"
                                src="https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f6a777d6557d526b9dba47_image-12-shop-product-shopwave-template.png" />
                        </div>
                        <div
                            class="w-full h-auto rounded-lg overflow-hidden group cursor-pointer">
                            <img
                                class="w-full h-full group-hover:scale-[1.1] transition-all"
                                src="https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f697b6ea32fefb0084af2c_more-image-3-shop-product-shopwave-template.png" />
                        </div>
                    </div>
                    <div class="basis-[90%]">
                        <div
                            class="w-full h-auto cursor-pointer group rounded-xl overflow-hidden">
                            <img
                                class="w-full h-full group-hover:scale-[1.1] transition-all duration-200"
                                src="https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f697b6ea32fefb0084af2c_more-image-3-shop-product-shopwave-template.png" />
                        </div>
                    </div>
                </div>
                <div class="w-full bg-black/10 my-16"></div>

            </div>

            <!-- desktop right aside-->
            <div class="lg:basis-[35%] md:basis-[40%]">
                <div
                    class="border-[1px] md:block hidden border-black/10 rounded-xl py-6 px-6">
                    <div
                        class="inline-block px-3 py-1 bg-primary rounded-full text-white font-semibold text-sm">
                        Hot
                    </div>
                    <h1 class="text-2xl mt-3 font-medium">{{$product -> name}}</h1>
                    <a
                        href="#description"
                        class="mt-2 text-[16px] mb-5 text-black/70 line-clamp-3 font-medium">{{$product -> description}}</a>
                    <div class="flex items-end mt-1 gap-2">
                        <p class="font-bold text-2xl">{{$product -> price}} MMK</p>

                    </div>
                    <div class="my-8 h-[1px] w-full bg-black/20"></div>
                    <p class="font-semibold text-lg">Product information</p>
                    <div class="flex flex-col gap-2 mt-3">
                        <div class="flex items-center">
                            <p class="basis-[35%] font-semibold">Category:</p>
                            <p class="basis-[65%] text-black/70">{{$product -> category -> name}}</p>
                        </div>
                    </div>
                    <div class="my-8 h-[1px] w-full bg-black/20"></div>
                    <div
                        class="flex lg:items-center lg:flex-row flex-col gap-3 mt-4 mb-2">
                        <div class="lg:basis-[40%]">
                            <p class="font-bold mb-2">Quantity</p>
                            <input
                                class="w-full border-black/10 border-2 rounded-full py-3 pl-5"
                                type="number"
                                value="1" />
                        </div>
                    </div>
                    <button
                        class="w-full h-full disabled:opacity-45 disabled:cursor-not-allowed text-white bg-primary rounded-full py-4 font-bold mt-3">
                        Add to Cart
                    </button>
                </div>

            </div>
        </div>
        <div class="w-full h-[1px] bg-black/10 mt-16"></div>
    </div>
</x-layout>