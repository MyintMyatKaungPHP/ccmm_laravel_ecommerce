@props(['user', 'type'])

<div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
    <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10 bg-gray-50">
            <h1 class="text-3xl font-bold">User {{ $type === 'create' ? 'Create' : 'Update' }}</h1>
            <div class="border p-10 bg-white rounded-md">
                <form
                    class="space-y-4 md:space-y-6"
                    method="POST"
                    action="{{ $type === 'create' ? route('admin.users.store') : route('admin.users.update', $user->id) }}">
                    @csrf
                    @method($type === 'create' ? 'POST' : 'PUT')

                    <!-- Name -->
                    <div class="flex flex-col">
                        <label class="font-semibold text-sm">Name</label>
                        <input
                            name="name"
                            value="{{ isset($user) ? $user->name : old('name') }}"
                            class="outline-none px-4 focus:ring-0 border-[1px] border-black/10 py-4 rounded-lg focus:border-primary transition-all mt-2"
                            type="text"
                            placeholder="Enter user name" />
                        @error('name')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="flex flex-col">
                        <label class="font-semibold text-sm">Email</label>
                        <input
                            name="email"
                            value="{{ isset($user) ? $user->email : old('email') }}"
                            class="outline-none px-4 focus:ring-0 border-[1px] border-black/10 py-4 rounded-lg focus:border-primary transition-all mt-2"
                            type="email"
                            placeholder="Enter user email" />
                        @error('email')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="flex flex-col">
                        <label class="font-semibold text-sm">Password</label>
                        <input
                            name="password"
                            class="outline-none px-4 focus:ring-0 border-[1px] border-black/10 py-4 rounded-lg focus:border-primary transition-all mt-2"
                            type="password"
                            placeholder="Enter password (leave blank if not changing)" />
                        @error('password')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Confirmation -->
                    <div class="flex flex-col">
                        <label class="font-semibold text-sm">Confirm Password</label>
                        <input
                            name="password_confirmation"
                            class="outline-none px-4 focus:ring-0 border-[1px] border-black/10 py-4 rounded-lg focus:border-primary transition-all mt-2"
                            type="password"
                            placeholder="Confirm password" />
                        @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Is Admin -->
                    <div class="flex flex-col">
                        <label class="font-semibold text-sm">Role</label>
                        <select
                            name="is_admin"
                            class="w-full border-[1px] mt-2 px-3 border-black/20 focus:border-primary transition-all py-3 rounded-lg">
                            <option value="0" {{ isset($user) && $user->is_admin == 0 ? 'selected' : '' }}>User</option>
                            <option value="1" {{ isset($user) && $user->is_admin == 1 ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('is_admin')
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
                            {{ $type === 'create' ? 'Create' : 'Update' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>