<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use App\Models\Checklist;
use Illuminate\Http\Request;
use Psy\VersionUpdater\Checker;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskStoreRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{

    public function store(TaskStoreRequest $request, Checklist $checklist) :RedirectResponse
    {
        //
        $position = $checklist->tasks()->max('position') + 1;
        $checklist->tasks()->create($request->validated() + ['position' => $position]);

        return redirect()->route('admin.checklist-groups.checklists.edit', [
            $checklist->checklist_group_id, $checklist
        ]);
    }

    public function edit(Checklist $checklist, Task $task): View
    {
        //
        return view('admin.tasks.edit', compact('checklist','task'));
    }

    public function update(TaskStoreRequest $request, Checklist $checklist, Task $task) :RedirectResponse
    {
        //

        $task->update($request->validated());
        return redirect()->route('admin.checklist-groups.checklists.edit', [
            $checklist->checklist_group_id, $checklist
        ]);
    }

    public function destroy(Checklist $checklist, Task $task) :RedirectResponse
    {
        //
        //reorder posisi dari task saat ada task yg dihapus
        $checklist->tasks()->where('position', '>', $task->position)
        ->update(['position' => DB::raw('position - 1')]);

        //hapus task
        $task->delete();

        return redirect()->route('admin.checklist-groups.checklists.edit', [
            $checklist->checklist_group_id, $checklist
        ]);
    }
}
