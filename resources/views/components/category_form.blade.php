@props(['category','type'])


<div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10 bg-gray-50">
    <h1 class="text-3xl font-bold">Category {{ $type === 'create' ? 'Create' : 'Update' }}</h1>
    <div class="border p-10 bg-white rounded-md">
        <form
            class="space-y-4 md:space-y-6"
            method="POST"
            action="{{ $type === 'create' ? route('admin.categories.store') : route('admin.categories.update', $category->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method($type === 'create' ? 'POST' : 'PUT')

            <!-- Category Name & Slug -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Category Name -->
                <div class="flex flex-col">
                    <label class="font-semibold text-sm">Category Name</label>
                    <input
                        name="name"
                        id="category-name"
                        value="{{ isset($category) ? $category->name : old('name') }}"
                        class="outline-none px-4 focus:ring-0 border-[1px] border-black/10 py-4 rounded-lg focus:border-primary transition-all mt-2"
                        type="text"
                        placeholder="Enter product name" />
                    @error('name')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Slug -->
                <div class="flex flex-col">
                    <label class="font-semibold text-sm">Slug</label>
                    <input
                        name="slug"
                        id="category-slug"
                        value="{{ isset($category) ? $category->slug : old('slug') }}"
                        class="outline-none px-4 focus:ring-0 border-[1px] border-black/10 py-4 rounded-lg focus:border-primary transition-all mt-2"
                        type="text"
                        placeholder="Auto-generated slug"
                        readonly />
                    @error('slug')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>


            <!-- Buttons -->
            <div class="flex items-center justify-end space-x-5">
                <button
                    type="reset"
                    class="text-sm px-4 bg-gray-600 hover:bg-gray-700 text-white flex items-center gap-3 shadow-md py-3 font-semibold rounded-md transition-all active:animate-press">
                    Reset
                </button>
                <button
                    type="submit"
                    class="text-sm px-4 flex items-center gap-3 shadow-md py-3 text-white bg-primary hover:bg-blue-900 font-semibold rounded-md transition-all active:animate-press">
                    {{$type == 'create' ? 'Create' : 'Update'}}
                </button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript for Auto-Generating Slug -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const nameInput = document.getElementById('category-name');
        const slugInput = document.getElementById('category-slug');

        nameInput.addEventListener('input', () => {
            const slug = nameInput.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '') // Remove invalid characters
                .replace(/\s+/g, '-') // Replace spaces with dashes
                .replace(/^-+|-+$/g, ''); // Trim leading/trailing dashes
            slugInput.value = slug;
        });
    });
</script>