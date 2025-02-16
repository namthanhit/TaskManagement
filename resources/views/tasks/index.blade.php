<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Task Management
        </h2>
    </x-slot>

    <div class="p-6 bg-white border border-gray-300 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Danh sách các công việc</h3>
            <a href="{{ route('tasks.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded no-underline">Thêm công việc</a>
        </div>

        <table class="min-w-full bg-white border border-gray-200 dark:bg-gray-800 dark:border-gray-700 rounded-lg overflow-hidden">
            <thead class="bg-gray-100 light:bg-gray-700">
                <tr>
                    <th class="border px-4 py-2">Tiêu đề</th>
                    <th class="border px-4 py-2">Mô tả</th>
                    <th class="border px-4 py-2">Ngày hết hạn</th>
                    <th class="border px-4 py-2">Trạng thái</th>
                    <th class="border px-4 py-2">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tasks as $task)
                <tr class="hover:bg-green-50 dark:hover:bg-green-500">
                    <td class="border px-4 py-2">{{ $task->title }}</td>
                    <td class="border px-4 py-2">{{ $task->description }}</td>
                    <td class="border px-4 py-2">{{ $task->deadline }}</td>
                    <td class="border px-4 py-2">{{ $task->status }}</td>
                    <td class="border px-4 py-2 flex gap-2">
                        <div class="flex space-x-2">
                            <a href="{{ route('tasks.edit', $task) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded no-underline">
                                Sửa
                            </a>


                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                    Xóa
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500">Chưa có công việc nào</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>