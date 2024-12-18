<x-dashboard_layout>

    <div
        class="relative border border-gray-300 bg-white rounded-md shadow-sm shadow-gray-200 px-5 py-3">
        <div class="flex gap-3 justify-end mb-3">
            <a
                class="text-sm px-4 flex items-center gap-3 shadow-md py-3 text-white bg-primary hover:bg-blue-900 font-semibold rounded-md transition-all active:animate-press"
                href="{{ route('admin.categories.create') }}">
                Create
            </a>
            <a
                class="text-sm px-4 bg-gray-600 hover:bg-gray-700 text-white flex items-center gap-3 shadow-md py-3 font-semibold rounded-md transition-all active:animate-press"
                href="{{ route('admin.categories.trashed') }}">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24">
                    <path
                        fill="currentColor"
                        d="M5 21V6H4V4h5V3h6v1h5v2h-1v15zm2-2h10V6H7zm2-2h2V8H9zm4 0h2V8h-2zM7 6v13z" />
                </svg>
                Trashed
            </a>
        </div>
        <div
            class="relative flex flex-col min-w-0 break-words w-full mb-6 rounded-md overflow-hidden border">
            <div class="overflow-x-auto w-full">
                <table class="w-full text-sm text-left">
                    <thead class="text-white bg-primary">
                        <tr>
                            <th scope="col" class="px-6 py-3 min-w-[100px]">
                                <span class="capitalize p-1.5"> ID </span>
                            </th>
                            <th scope="col" class="px-6 py-3 min-w-[100px]">
                                <span class="capitalize p-1.5"> Name </span>
                            </th>
                            <th scope="col" class="px-6 py-3 min-w-[100px]">
                                <span class="capitalize p-1.5"> Actions </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr class="border-b">
                            <td class="px-6 py-4">
                                <span class="text-darkGray p-1.5 font-semibold block">
                                    {{ $category->id }}
                                </span>
                            </td>

                            <td class="px-6 py-4 min-w-[150px]">
                                <span class="text-darkGray p-1.5 font-semibold block">
                                    {{ $category->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div
                                    class="space-x-3 flex items-center min-w-[200px] w-auto max-w-[500px]">
                                    <a
                                        href="{{ route('admin.categories.edit', $category->id) }}"
                                        class="text-sm px-4 flex items-center gap-3 shadow-md py-3 text-white bg-primary hover:bg-blue-900 font-semibold rounded-md transition-all active:animate-press">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="20"
                                            height="20"
                                            viewBox="0 0 24 24">
                                            <path
                                                fill="currentColor"
                                                d="M5 19h1.425L16.2 9.225L14.775 7.8L5 17.575zm-2 2v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM19 6.4L17.6 5zm-3.525 2.125l-.7-.725L16.2 9.225z" />
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{route('admin.categories.destroy',$category->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"

                                            class="text-sm px-4 flex items-center gap-3 shadow-md py-3 text-white bg-red-500 hover:bg-blue-900 font-semibold rounded-md transition-all active:animate-press">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="20"
                                                height="20"
                                                viewBox="0 0 24 24">
                                                <path
                                                    fill="currentColor"
                                                    d="M5 21V6H4V4h5V3h6v1h5v2h-1v15zm2-2h10V6H7zm2-2h2V8H9zm4 0h2V8h-2zM7 6v13z" />
                                            </svg>
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{ $categories->links() }}
    </div>

</x-dashboard_layout>