<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class CalendarController extends Controller
{

    public function index()
    {
        $tasks = Task::all(); // Lấy toàn bộ công việc hoặc lọc theo điều kiện bạn muốn
        return view('tasks.calendar', compact('tasks')); // Truyền biến $tasks vào view
    }
}
