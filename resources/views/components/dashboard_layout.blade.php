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
        {{ $slot }}
    </div>
</body>

</html>