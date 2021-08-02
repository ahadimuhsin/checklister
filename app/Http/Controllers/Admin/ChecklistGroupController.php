<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Checklist;
use App\Models\ChecklistGroup;
use Illuminate\Http\Request;

class ChecklistGroupController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.checklist-group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|unique:checklist_groups,name'
        ]);

        ChecklistGroup::create($request->all());

        return redirect()->route('home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ChecklistGroup $checklist_group)
    {
        //
        // $checklist_group = ChecklistGroup::findOrFail($id);

        return view('admin.checklist-group.edit', compact('checklist_group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,ChecklistGroup $checklist_group)
    {
        //
        // $checklist_group = ChecklistGroup::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|unique:checklist_groups,name,'.$checklist_group->id
        ]);

        $checklist_group->update([
            'name' => $request->name
        ]);

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChecklistGroup $checklist_group)
    {
        //
        $checklist_group->delete();

        return redirect()->route('home');
    }
}
