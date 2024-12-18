<x-dashboard_layout>
    <!-- Dashboard Header -->
    <div class="border p-6 bg-white rounded-md shadow-md flex flex-col gap-6">
        <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>

        <!-- Counter Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Orders Counter -->
            <div class="bg-blue-100 p-6 rounded-md shadow-md flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-blue-700">Orders</h2>
                    <p class="text-3xl font-bold text-blue-900">120</p>
                </div>
                <div class="bg-blue-500 text-white p-4 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2Zm3 12h-2v3a1 1 0 0 1-2 0v-3H9a1 1 0 0 1 0-2h2V9a1 1 0 0 1 2 0v3h2a1 1 0 0 1 0 2Z" />
                    </svg>
                </div>
            </div>

            <!-- Products Counter -->
            <div class="bg-green-100 p-6 rounded-md shadow-md flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-green-700">Products</h2>
                    <p class="text-3xl font-bold text-green-900">56</p>
                </div>
                <div class="bg-green-500 text-white p-4 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2Zm4.6 11.2l-4 4a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.4l1.3 1.3 3.3-3.3a1 1 0 0 1 1.4 1.4Z" />
                    </svg>
                </div>
            </div>

            <!-- Users Counter -->
            <div class="bg-yellow-100 p-6 rounded-md shadow-md flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-yellow-700">Users</h2>
                    <p class="text-3xl font-bold text-yellow-900">75</p>
                </div>
                <div class="bg-yellow-500 text-white p-4 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2Zm1 13h-2v-2h2Zm0-4h-2V7h2Z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Simple Chart -->
        <div class="bg-gray-100 p-6 rounded-md shadow-md">
            <h2 class="text-lg font-bold mb-4">Sales Chart</h2>
            <div class="grid grid-cols-7 gap-2 items-end h-48">
                <!-- Bar for each day of the week -->
                <div class="flex flex-col items-center">
                    <div class="w-8 bg-blue-500 h-20 rounded-t"></div>
                    <p class="text-sm text-gray-500 mt-1">Mon</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-8 bg-blue-500 h-32 rounded-t"></div>
                    <p class="text-sm text-gray-500 mt-1">Tue</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-8 bg-blue-500 h-16 rounded-t"></div>
                    <p class="text-sm text-gray-500 mt-1">Wed</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-8 bg-blue-500 h-40 rounded-t"></div>
                    <p class="text-sm text-gray-500 mt-1">Thu</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-8 bg-blue-500 h-24 rounded-t"></div>
                    <p class="text-sm text-gray-500 mt-1">Fri</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-8 bg-blue-500 h-36 rounded-t"></div>
                    <p class="text-sm text-gray-500 mt-1">Sat</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-8 bg-blue-500 h-28 rounded-t"></div>
                    <p class="text-sm text-gray-500 mt-1">Sun</p>
                </div>
            </div>
        </div>
    </div>
</x-dashboard_layout>