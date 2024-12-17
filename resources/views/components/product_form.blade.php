@props(['categories', 'type', 'product'])

<div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
    <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10 bg-gray-50">
            <h1 class="text-3xl font-bold">Product {{ $type === 'create' ? 'Create' : 'Update' }}</h1>
            <div class="border p-10 bg-white rounded-md">
                <form
                    class="space-y-4 md:space-y-6"
                    method="POST"
                    action="{{ $type === 'create' ? route('admin.products.store') : route('admin.products.update', $product->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method($type === 'create' ? 'POST' : 'PUT')
                    <!-- Image Upload -->
                    <div class="flex flex-col">
                        <label class="font-semibold text-sm">Product Images</label>
                        <div class="image-wrapper mt-2">
                            <input
                                name="images"
                                type="file"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                multiple />
                        </div>
                        @error('images')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Product Name & Slug -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Product Name -->
                        <div class="flex flex-col">
                            <label class="font-semibold text-sm">Product Name</label>
                            <input
                                name="name"
                                id="product-name"
                                value="{{ isset($product) ? $product->name : old('name') }}"
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
                                id="product-slug"
                                value="{{ isset($product) ? $product->slug : old('slug') }}"
                                class="outline-none px-4 focus:ring-0 border-[1px] border-black/10 py-4 rounded-lg focus:border-primary transition-all mt-2"
                                type="text"
                                placeholder="Auto-generated slug"
                                readonly />
                            @error('slug')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Price -->
                        <div class="flex flex-col">
                            <label class="font-semibold text-sm">Price</label>
                            <input
                                name="price"
                                value="{{ isset($product) ? $product->price : old('price') }}"
                                class="outline-none px-4 focus:ring-0 border-[1px] border-black/10 py-4 rounded-lg focus:border-primary transition-all mt-2"
                                type="text"
                                placeholder="Enter product price" />
                            @error('price')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="flex flex-col">
                            <label class="font-semibold text-sm">Category</label>
                            <select
                                name="category_id"
                                class="w-full border-[1px] mt-2 px-3 border-black/20 focus:border-primary transition-all py-3 rounded-lg">
                                <option value="" disabled selected>Select category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ isset($product) && $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <!-- Description -->
                    <div class="flex flex-col">
                        <label class="font-semibold text-sm">Description</label>
                        <textarea
                            name="description"
                            class="w-full border-[1px] border-black/10 py-3 px-3 rounded-[5px]"
                            placeholder="Enter product description"
                            rows="5">{{ isset($product) ? $product->description : old('description') }}</textarea>
                        @error('description')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
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
    </main>
</div>

<!-- JavaScript for Auto-Generating Slug -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const nameInput = document.getElementById('product-name');
        const slugInput = document.getElementById('product-slug');

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