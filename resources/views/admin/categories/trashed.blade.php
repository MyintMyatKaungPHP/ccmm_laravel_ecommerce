<x-dashboard_layout>
    <div class="border p-10 bg-white rounded-md">
        <h1 class="text-2xl font-bold mb-6">Trashed Categories</h1>
        <table class="w-full text-sm text-left border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr class="border-b">
                    <td class="px-6 py-4">{{ $category->id }}</td>
                    <td class="px-6 py-4">{{ $category->name }}</td>
                    <td class="px-6 py-4 flex space-x-2">
                        <form method="POST" action="{{ route('categories.restore', $category->id) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-blue-500">Restore</button>
                        </form>
                        <form method="POST" action="{{ route('categories.forceDelete', $category->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Delete Permanently</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-4 text-center">No trashed categories found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $categories->links() }}
    </div>

</x-dashboard_layout>