<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
 
    <title>Layout</title>
</head>
<body>
    <div class="antialiased bg-white-50 dark:bg-gray-900">
    <x-admin.navbar></x-admin.navbar>
    <x-admin.sidebar></x-admin.sidebar>

    <main class="p-4 md:ml-64 h-auto pt-20">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            {{ $slot }}
      </div>
    </main>
  </div>
</body>
</html>