<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $taskCounts = [
            'completed' => Task::where('status', 'Đã hoàn thành')->count(),

            'overdue' => Task::where('deadline', '<', now()->startOfDay()) // Chỉ lấy những task có hạn trước hôm nay
                ->where('status', '!=', 'Đã hoàn thành')
                ->count(),

            'upcoming' => Task::whereBetween('deadline', [now()->startOfDay(), now()->addDays(3)->endOfDay()])
                ->where('status', '!=', 'Đã hoàn thành')
                ->count(),

            'not_due' => Task::where('deadline', '>', now()->addDays(3)->endOfDay()) // Chỉ lấy task có hạn sau 3 ngày nữa
                ->where('status', '!=', 'Đã hoàn thành')
                ->count(),
        ];

        $recentTasks = Task::latest()->take(5)->get();

        return view('tasks.dashboard', compact('taskCounts', 'recentTasks'));
    }
}
