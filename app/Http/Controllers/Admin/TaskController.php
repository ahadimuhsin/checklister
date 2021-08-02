<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use App\Models\Checklist;
use Illuminate\Http\Request;
use Psy\VersionUpdater\Checker;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskStoreRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskStoreRequest $request, Checklist $checklist)
    {
        //
        $checklist->tasks()->create($request->validated());

        return redirect()->route('admin.checklist-groups.checklists.edit', [
            $checklist->checklist_group_id, $checklist
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Checklist $checklist, Task $task)
    {
        //
        return view('admin.tasks.edit', compact('checklist','task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskStoreRequest $request, Checklist $checklist, Task $task)
    {
        //
        $task->update($request->validated());
        return redirect()->route('admin.checklist-groups.checklists.edit', [
            $checklist->checklist_group_id, $checklist
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checklist $checklist, Task $task)
    {
        //
        $task->delete();

        return redirect()->route('admin.checklist-groups.checklists.edit', [
            $checklist->checklist_group_id, $checklist
        ]);
    }
}
