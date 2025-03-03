<x-app-layout>


    <div class="p-6 space-y-6">

        <!-- Thống kê số lượng công việc -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="p-4 bg-green-100 border border-green-400 rounded-lg text-center">
                <h4 class="text-lg font-semibold text-green-700">Đã hoàn thành</h4>
                <p class="text-2xl font-bold">{{ $taskCounts['completed'] }}</p>
            </div>
            <div class="p-4 bg-red-100 border border-red-400 rounded-lg text-center">
                <h4 class="text-lg font-semibold text-red-700">Quá hạn</h4>
                <p class="text-2xl font-bold">{{ $taskCounts['overdue'] }}</p>
            </div>
            <div class="p-4 bg-yellow-100 border border-yellow-400 rounded-lg text-center">
                <h4 class="text-lg font-semibold text-yellow-700">Sắp đến hạn</h4>
                <p class="text-2xl font-bold">{{ $taskCounts['upcoming'] }}</p>
            </div>
            <div class="p-4 bg-blue-100 border border-blue-400 rounded-lg text-center">
                <h4 class="text-lg font-semibold text-blue-700">Chưa đến hạn</h4>
                <p class="text-2xl font-bold">{{ $taskCounts['not_due'] }}</p>
            </div>
        </div>

        <!-- Biểu đồ công việc -->
        <div class="bg-white border border-gray-300 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold mb-4">Thống kê công việc</h3>
            <div class="flex justify-center">
                <div style="width: 300px; height: 300px;">
                    <canvas id="taskChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Danh sách công việc gần đây -->
        <div class="bg-gray-100 border border-gray-300 rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Công việc gần đây</h3>
                <select id="task-filter" class="border p-2 rounded">
                    <option value="all">Tất cả</option>
                    <option value="completed">Đã hoàn thành</option>
                    <option value="overdue">Quá hạn</option>
                    <option value="upcoming">Sắp đến hạn</option>
                    <option value="not_due">Chưa đến hạn</option>
                </select>
            </div>

            <ul id="task-list">
                @foreach ($recentTasks as $task)
                <li class="py-2 border-b last:border-b-0 flex justify-between">
                    <span class="font-semibold">{{ $task->title }}</span>
                    <span class="{{ $task->status === 'completed' ? 'text-green-600' : ($task->status === 'overdue' ? 'text-red-600' : 'text-gray-600') }}">
                        {{ ucfirst($task->status) }}
                    </span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Biểu đồ Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Biểu đồ
            const taskData = @json($taskCounts);
            const ctx = document.getElementById('taskChart').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Đã hoàn thành', 'Quá hạn', 'Sắp đến hạn', 'Chưa đến hạn'],
                    datasets: [{
                        data: [taskData.completed, taskData.overdue, taskData.upcoming, taskData.not_due],
                        backgroundColor: ['#22c55e', '#ef4444', '#eab308', '#3b82f6']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // Bộ lọc công việc gần đây
            document.getElementById('task-filter').addEventListener('change', function() {
                let status = this.value;
                let tasks = document.querySelectorAll('#task-list li');
                tasks.forEach(task => {
                    let taskStatus = task.querySelector('span:last-child').textContent.toLowerCase();
                    task.style.display = (status === 'all' || taskStatus.includes(status)) ? 'flex' : 'none';
                });
            });
        });
    </script>

    <footer class="mt-6 bg-gray-100 dark:bg-gray-700 text-center py-4 text-gray-600 dark:text-gray-300">
        © {{ date('Y') }} Quản lý công việc. All rights reserved.
    </footer>

</x-app-layout>