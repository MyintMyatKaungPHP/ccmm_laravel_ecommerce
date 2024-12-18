<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCMM Laravel Ecomerce</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#0285FF",
                        secondary: "#20283F",
                    },
                },
            },
        };
    </script>
</head>

<body>
    <x-header />

    <!-- Toast Notification -->
    @if(session('success'))
    <div id="toast" class="fixed top-40 right-4 bg-green-200 text-green-800 border-2 border-green-800 px-6 py-3 rounded-lg shadow-md flex items-center space-x-4 transition-all transform opacity-0" style="z-index: 9999;">
        <!-- Check Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
        </svg>
        <span>{{ session('success') }}</span>
    </div>
    <script>
        // Show toast notification and fade it out after 3 seconds
        const toast = document.getElementById('toast');
        toast.classList.remove('opacity-0');
        toast.classList.add('opacity-100');
        setTimeout(() => {
            toast.classList.add('opacity-0');
            setTimeout(() => {
                toast.style.display = 'none';
            }, 500); // Hide the toast after fade-out
        }, 3000); // Show for 3 seconds
    </script>
    @endif

    {{ $slot }}
    <x-footer />
</body>

</html>