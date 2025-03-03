<x-app-layout>


    <div class="p-6 bg-white border border-gray-300 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Danh sách các công việc</h3>
            <a href="{{ route('tasks.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded no-underline">Thêm công việc</a>
        </div>

        <!-- Form tìm kiếm + lọc trạng thái -->
        <form method="GET" action="{{ route('tasks.index') }}" class="mb-4 flex items-center gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm công việc..."
                class="border border-gray-300 px-4 py-2 rounded w-1/3 bg-white text-black dark:bg-gray-800 dark:text-gray-200">

            <select name="filter" id="filter" class="border border-gray-300 rounded px-2 py-1 w-40 text-black dark:text-white bg-white dark:bg-gray-800"
                onchange="this.form.submit()">
                <option value="">Tất cả</option>
                <option value="Chưa đến hạn" {{ request('filter') == 'Chưa đến hạn' ? 'selected' : '' }}>Chưa đến hạn</option>
                <option value="Sắp đến hạn" {{ request('filter') == 'Sắp đến hạn' ? 'selected' : '' }}>Sắp đến hạn</option>
                <option value="Quá hạn" {{ request('filter') == 'Quá hạn' ? 'selected' : '' }}>Quá hạn</option>
                <option value="Đã hoàn thành" {{ request('filter') == 'Đã hoàn thành' ? 'selected' : '' }}>Đã hoàn thành</option>
            </select>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Tìm</button>
        </form>

        <table class="min-w-full bg-white border border-gray-200 dark:bg-gray-800 dark:border-gray-700 rounded-lg overflow-hidden table-fixed">
            <thead class="bg-gray-100 light:bg-gray-700">
                <tr>
                    <th class="border px-4 py-2 w-1/6">Tiêu đề</th>
                    <th class="border px-4 py-2 w-1/4">Mô tả</th>
                    <th class="border px-4 py-2 w-1/6">Ngày hết hạn</th>
                    <th class="border px-4 py-2 w-1/6">Tình trạng hạn</th>
                    <th class="border px-4 py-2 w-1/6">Trạng thái</th>
                    <th class="border px-4 py-2 w-1/6">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tasks as $task)
                @php
                $today = now();
                $deadline = \Carbon\Carbon::parse($task->deadline);
                $diffInDays = $today->diffInDays($deadline, false);

                if ($task->status === 'Đã hoàn thành') {
                $statusColor = 'text-green-500';
                $statusText = 'Đã hoàn thành';
                } elseif ($diffInDays < 0) {
                    $statusColor='text-red-500' ;
                    $statusText='Quá hạn' ;
                    } elseif ($diffInDays < 3) {
                    $statusColor='text-yellow-500' ;
                    $statusText='Sắp đến hạn' ;
                    } else {
                    $statusColor='text-blue-500' ;
                    $statusText='Chưa đến hạn' ;
                    }
                    @endphp

                    @if((request('filter')=='' || request('filter')==$statusText) &&
                    (request('search')=='' || str_contains(strtolower($task->title), strtolower(request('search')))))
                    <tr>
                        <td class="border px-4 py-2 break-words">{{ $task->title }}</td>
                        <td class="border px-4 py-2 break-words">{{ $task->description }}</td>
                        <td class="border px-4 py-2 text-center">{{ $task->deadline }}</td>
                        <td class="border px-4 py-2 text-center font-bold {{ $statusColor }}">{{ $statusText }}</td>
                        <td class="border px-4 py-2 text-center">
                            <form action="{{ route('tasks.toggleStatus', $task->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="px-3 py-1 rounded {{ $task->status === 'Đã hoàn thành' ? 'bg-green-500 text-white' : 'bg-yellow-500 text-black' }} w-full">
                                    {{ $task->status }}
                                </button>
                            </form>
                        </td>
                        <td class="border px-4 py-2">
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
                    @endif
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-gray-500">Chưa có công việc nào</td>
                    </tr>
                    @endforelse
            </tbody>
        </table>
    </div>

    <footer class="mt-6 bg-gray-100 dark:bg-gray-700 text-center py-4 text-gray-600 dark:text-gray-300">
        © {{ date('Y') }} Quản lý công việc. All rights reserved.
    </footer>

</x-app-layout>