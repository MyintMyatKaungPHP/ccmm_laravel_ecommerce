@props(['products'])

<x-dashboard_layout>

    <h1 class="text-3xl font-bold">Trashed Products</h1>
    <div class="border p-10 bg-white rounded-md">
        <table class="w-full text-sm text-left border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Image</th>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Price</th>
                    <th class="px-6 py-3">Category</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr class="border-b">
                    <td class="px-6 py-4">{{ $product->id }}</td>
                    <td class="px-6 py-4">
                        <img
                            src="{{ $product->images }}"
                            alt="{{ $product->name }}"
                            class="w-16 h-16 object-cover rounded-md" />
                    </td>
                    <td class="px-6 py-4">{{ $product->name }}</td>
                    <td class="px-6 py-4">{{ $product->price }} MMK</td>
                    <td class="px-6 py-4">{{ $product->category->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4 flex space-x-2">
                        <!-- Restore Button -->
                        <form method="POST" action="{{ route('admin.products.restore', $product->id) }}">
                            @csrf
                            @method('PUT')
                            <button
                                type="submit"
                                class="text-blue-500 hover:text-blue-700 font-semibold">
                                Restore
                            </button>
                        </form>
                        <!-- Force Delete Button -->
                        <form method="POST" action="{{ route('admin.products.forceDelete', $product->id) }}">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="text-red-500 hover:text-red-700 font-semibold">
                                Delete Permanently
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                        No trashed products found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>

</x-dashboard_layout>