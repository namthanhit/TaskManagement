<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Chỉnh sửa công việc
        </h2>
    </x-slot>

    <div class="p-6 bg-white border border-gray-300 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
        <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Tiêu đề</label>
                <input type="text" name="title" id="title" value="{{ $task->title }}" required class="mt-1 block w-full">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Mô tả</label>
                <textarea name="description" id="description" rows="3" class="mt-1 block w-full">{{ $task->description }}</textarea>
            </div>

            <div>
                <label for="deadline" class="block text-sm font-medium text-gray-700">Ngày hết hạn</label>
                <input type="date" name="deadline" id="deadline" value="{{ $task->deadline }}" class="mt-1 block w-full">
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Trạng thái</label>
                <select name="status" id="status" class="mt-1 block w-full">
                    <option value="Chưa hoàn thành" {{ $task->status == 'Chưa hoàn thành' ? 'selected' : '' }}>Chưa hoàn thành</option>
                    <option value="Đã hoàn thành" {{ $task->status == 'Đã hoàn thành' ? 'selected' : '' }}>Đã hoàn thành</option>
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Cập nhật</button>
            </div>
        </form>
    </div>

    <footer class="mt-6 bg-gray-100 dark:bg-gray-700 text-center py-4 text-gray-600 dark:text-gray-300">
        © {{ date('Y') }} Quản lý công việc. All rights reserved.
    </footer>

</x-app-layout>