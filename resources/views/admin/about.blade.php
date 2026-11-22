<x-admin.layout>
    <div class="mb-6 p-6 bg-white">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ $title }}</h1>
        
        <div class="space-y-2 text-gray-700 dark:text-gray-300">
            <p><span class="font-semibold">Nama:</span> {{ $nama }}</p>
            <p><span class="font-semibold">Kelas:</span> {{ $kelas }}</p>
            <p>
                <span class="font-semibold">Repo Profile Github:</span> 
                <a href="{{ $github }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:underline">
                    {{ $github }}
                </a>
            </p>
        </div>
    </div>
</x-admin.layout>