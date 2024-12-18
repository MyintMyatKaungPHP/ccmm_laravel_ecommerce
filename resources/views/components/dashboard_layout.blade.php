<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
    <div class="flex h-screen overflow-hidden font-roboto">
        <x-dashboard_sidebar />
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            <main>
                <div class="mx-auto max-w-screen-2xl h-screen p-4 md:p-6 2xl:p-10 bg-gray-50">


                    <!-- Centering the slot content -->

                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</body>

</html>