<x-dashboard_layout>
    <div class="p-6">
        <h2 class="text-lg font-bold">{{ $product->name }}</h2>
        <p class="text-gray-600">{{ $product->description }}</p>
        <p class="font-semibold">Price: {{ $product->price }} MMK</p>
        <img src="{{ $product->images }}" alt="Product Image" class="w-32 h-32 object-cover">
        <a href="{{ route('admin.products.index') }}" class="text-blue-600">Back to products</a>
    </div>
</x-dashboard_layout>