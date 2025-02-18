<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class TaskController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $tasks = Task::query()
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%");
            })
            ->get();

        return view('tasks.index', compact('tasks'));
    }


    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'nullable|date',
            'status' => 'nullable|string',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'status' => $request->status ?? 'Chưa hoàn thành',
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Thêm công việc thành công!');
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'nullable|date',
            'status' => 'nullable|string',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Cập nhật công việc thành công!');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Xóa công việc thành công!');
    }

    public function toggleStatus(Task $task)
    {
        $this->authorize('update', $task);

        $newStatus = $task->status === 'Đã hoàn thành' ? 'Chưa hoàn thành' : 'Đã hoàn thành';

        $task->update(['status' => $newStatus]);

        return redirect()->route('tasks.index')->with('success', 'Cập nhật trạng thái công việc thành công!');
    }
}
