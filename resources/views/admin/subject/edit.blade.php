@foreach ($subjects as $subject)
<div id="edit-subject-modal-{{ $subject->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-900/50">
    <div class="relative p-4 w-full max-w-lg max-h-full">
        <div class="relative bg-white border border-default rounded-lg shadow-xl dark:bg-gray-800 p-6">
            
            @if ($errors->any())
                <div class="flex items-center w-full p-4 mb-4 text-red-700 bg-red-100 rounded-lg border border-red-400 dark:bg-gray-800 dark:text-red-300" role="alert">
                    <div class="text-sm font-medium">
                        Gagal memperbarui mata pelajaran! Periksa kembali inputan Anda.
                    </div>
                </div>
            @endif

            <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-700 pb-4 mb-4">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                    Edit Subject: {{ $subject->name }}
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit-subject-modal-{{ $subject->id }}">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <form action="{{ route('admin.subject.update', $subject->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Subject Name</label>
                    <input type="text" name="name" value="{{ old('name', $subject->name) }}" class="block w-full p-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" required>
                    @error('name')
                        <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-2 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <button type="button" data-modal-hide="edit-subject-modal-{{ $subject->id }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg text-sm font-medium hover:bg-gray-400">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700">Update Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach