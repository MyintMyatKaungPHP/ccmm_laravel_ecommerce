<div class="cursor-pointer">
    <a href="{{route('product.detail.page', ['id' => $product -> id])}}">
        <div
            class="w-full h-auto bg-[#F7F8F9] group rounded-xl overflow-hidden">
            <img
                class="w-full h-full group-hover:scale-[1.1] transition-all duration-200"
                src="https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f6a67c4666f047ada3ba87_image-10-shop-product-shopwave-template-p-500.png" />
        </div>
        <p class="mt-3 font-semibold">{{$product -> name}}</p>
        <div class="flex gap-2 text-sm items-center font-semibold mt-1">
            <p class="text-primary">{{$product -> price}}</p> MMK

        </div>
        <p>{{$product -> category -> name}}</p>
    </a>
</div>