<x-dashboard_layout>

    <div class="border p-10 bg-white rounded-md">
        <h1 class="text-2xl font-bold mb-6">Users</h1>
        <div class="mb-4 flex justify-between items-center">
            <a
                href="{{ route('admin.users.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded-md text-sm font-semibold hover:bg-blue-600">
                Add New User
            </a>
            <a
                href="{{ route('admin.users.trashed') }}"
                class="text-blue-500 hover:underline text-sm font-semibold">
                View Trashed Users
            </a>
        </div>
        <table class="w-full text-sm text-left border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Role</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr class="border-b">
                    <td class="px-6 py-4">{{ $user->id }}</td>
                    <td class="px-6 py-4">{{ $user->name }}</td>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        {{ $user->is_admin ? 'Admin' : 'User' }}
                    </td>
                    <td class="px-6 py-4 flex space-x-2">
                        <!-- Edit Button -->
                        <a
                            href="{{ route('admin.users.edit', $user->id) }}"
                            class="text-blue-500 hover:text-blue-700 font-semibold">
                            Edit
                        </a>
                        <!-- Delete Button -->
                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="text-red-500 hover:text-red-700 font-semibold">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        No users found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>


</x-dashboard_layout>