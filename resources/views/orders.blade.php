<x-layout>
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Your Orders</h1>



        @if ($orders->count() > 0)
        <div class="h-screen">
            <div class="overflow-x-auto bg-white shadow rounded-lg">
                <table class="min-w-full table-auto border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border-b text-left text-sm text-gray-600">Order Number</th>
                            <th class="px-4 py-2 border-b text-left text-sm text-gray-600">Grand Total</th>
                            <th class="px-4 py-2 border-b text-left text-sm text-gray-600">Status</th>
                            <th class="px-4 py-2 border-b text-left text-sm text-gray-600">Phone Number</th>
                            <th class="px-4 py-2 border-b text-left text-sm text-gray-600">Shipping Address</th>
                            <th class="px-4 py-2 border-b text-left text-sm text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td class="px-4 py-2 border-b text-sm text-gray-700">{{ $order->order_number }}</td>
                            <td class="px-4 py-2 border-b text-sm text-gray-700">${{ number_format($order->grand_total, 2) }}</td>
                            <td class="px-4 py-2 border-b text-sm text-gray-700">
                                <span class="px-3 py-1 inline-block text-white bg-{{ $order->status === 'completed' ? 'green' : ($order->status === 'processing' ? 'blue' : 'yellow') }}-500 rounded-full">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 border-b text-sm text-gray-700">{{ $order->phone_number }}</td>
                            <td class="px-4 py-2 border-b text-sm text-gray-700">{{ $order->shipping_address }}</td>
                            <td class="px-4 py-2 border-b text-sm text-gray-700">
                                <a href="" class="text-blue-500 hover:text-blue-700">View</a>
                                <form action="" method="POST" class="inline-block ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div class="mt-4">
            {{ $orders->links() }} <!-- Pagination links -->
        </div>
        @else
        <div class="h-screen">
            <div class="overflow-x-auto bg-white shadow rounded-lg py-10">
                <p class="text-center">You have no orders. <br>
                    <a href="{{route('home.page')}}" class="text-primary">Browse Products</a>
                </p>

            </div>
        </div>
        @endif
    </div>
</x-layout>