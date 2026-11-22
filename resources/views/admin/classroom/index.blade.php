<x-admin.layout>

    <div class="mb-6 p-6 bg-white dark:bg-gray-800">    
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $title }}</h1>
    </div>

    <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
        <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 p-4">
            <div class="flex items-center gap-2">
                {{-- Tombol Modal Create --}}
                <button data-modal-target="create-classroom-modal" data-modal-toggle="create-classroom-modal" type="button" class="inline-flex items-center justify-center text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-base text-sm px-4 py-2 focus:outline-none">
                    + Add Classroom
                </button>
            </div>

            {{-- Form Search --}}
            <form action="{{ route('admin.classroom.index') }}" method="GET">
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" class="block w-full max-w-96 ps-9 pe-3 py-2 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body" placeholder="Search classroom...">
                </div>
            </form>
        </div>

        <table class="w-full text-sm text-left rtl:text-right text-body">
            <thead class="text-sm text-body bg-neutral-secondary-medium border-b border-t border-default-medium">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium">No</th>
                    <th scope="col" class="px-6 py-3 font-medium">Class Name</th>
                    <th scope="col" class="px-6 py-3 font-medium">Major</th>
                    <th scope="col" class="px-6 py-3 font-medium">Students List</th>
                    <th scope="col" class="px-6 py-3 font-medium">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($classrooms as $index => $classroom)
                    <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
                        <td class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            {{ $index + 1 }}
                        </td>
                        <td class="px-6 py-4 font-semibold text-heading">
                            {{ $classroom->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $classroom->major }}
                        </td>
                        <td class="px-6 py-4">
                            @foreach ($classroom->students as $student)
                                {{ $student->name }}<br>
                            @endforeach
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                {{-- Tombol Edit Modal --}}
                                <button data-modal-target="edit-classroom-modal-{{ $classroom->id }}" data-modal-toggle="edit-classroom-modal-{{ $classroom->id }}" type="button" class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-xs px-3 py-2">
                                    Edit
                                </button>

                                {{-- Tombol Delete --}}
                                <form action="{{ route('admin.classroom.destroy', $classroom->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kelas ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white bg-red-600 hover:bg-red-700 font-medium rounded-lg text-xs px-3 py-2">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            Classroom tidak ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Memanggil Modal Edit yang sudah berisi foreach --}}
    @include('admin.classroom.edit')

    {{-- Memanggil Modal Create --}}
    @include('admin.classroom.create')
    
    @if ($errors->any())
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modalEl = document.getElementById('create-classroom-modal');
            if (modalEl) {
                modalEl.classList.remove('hidden');
                modalEl.classList.add('flex');
            }
        });
    </script>
@endif


</x-admin.layout>