<x-app-layout>
    
    <div class="p-6 bg-white border border-gray-300 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
        <div id="calendar"></div>
    </div>

    <!-- Modal hiển thị thông tin sự kiện -->
    <div id="eventModal" class="fixed inset-0 flex items-center justify-center hidden bg-gray-900 bg-opacity-60 z-50">
        <div class="bg-white p-6 rounded-lg shadow-2xl w-[400px] relative">
            <h3 class="text-xl font-bold text-gray-800 mb-3" id="modalTitle"></h3>
            <p class="text-gray-700 mb-2" id="modalDescription"></p>
            <p class="text-sm text-gray-600" id="modalDeadline"></p>
            <p class="text-sm font-semibold text-blue-600 mt-2" id="modalStatus"></p>
            <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-800">✖</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 'auto',
                contentHeight: 600,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                buttonText: {
                    today: 'Hôm nay',
                    month: 'Tháng',
                    week: 'Tuần',
                    day: 'Ngày'
                },
                eventDisplay: 'block',
                eventBorderColor: 'transparent',
                eventTextColor: '#fff',
                dayMaxEvents: true,
                events: [
                    @foreach ($tasks as $task)
                    {
                        id: "{{ $task->id }}",
                        title: "{{ $task->title }}",
                        start: "{{ $task->deadline }}",
                        description: "{{ $task->description }}",
                        status: "{{ $task->status }}",
                        color: "{{ 
                            $task->status == 'Đã hoàn thành' ? '#22c55e' : 
                            ($task->deadline < now() ? '#ef4444' : 
                            ($task->deadline <= now()->addDays(3) ? '#eab308' : '#3b82f6')) 
                        }}",
                    },
                    @endforeach
                ],
                eventClick: function (info) {
                    // Hiển thị thông tin sự kiện khi nhấn vào
                    document.getElementById('modalTitle').innerText = info.event.title;
                    document.getElementById('modalDescription').innerText = "📄 Mô tả: " + (info.event.extendedProps.description || "Không có");
                    document.getElementById('modalDeadline').innerText = "🕒 Hạn chót: " + info.event.start.toLocaleDateString();
                    document.getElementById('modalStatus').innerText = "📌 Trạng thái: " + info.event.extendedProps.status;
                    
                    // Hiển thị modal
                    document.getElementById('eventModal').classList.remove('hidden');
                }
            })

            calendar.render();
        });

        // Đóng modal khi nhấn nút "✖"
        function closeModal() {
            document.getElementById('eventModal').classList.add('hidden');
        }
    </script>

    
</x-app-layout>
