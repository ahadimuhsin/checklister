<?php

namespace App\Http\Controllers\Admin;

use App\Models\Checklist;
use Illuminate\Http\Request;
use App\Models\ChecklistGroup;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class ChecklistGroupController extends Controller
{

    public function create() :View
    {
        //
        return view('admin.checklist-group.create');
    }

    public function store(Request $request) :RedirectResponse
    {
        //
        $this->validate($request, [
            'name' => 'required|unique:checklist_groups,name'
        ]);

        ChecklistGroup::create($request->all());

        return redirect()->route('home');
    }

    public function edit(ChecklistGroup $checklist_group) :View
    {
        //
        // $checklist_group = ChecklistGroup::findOrFail($id);

        return view('admin.checklist-group.edit', compact('checklist_group'));
    }

    public function update(Request $request,ChecklistGroup $checklist_group) :RedirectResponse
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

    public function destroy(ChecklistGroup $checklist_group) :RedirectResponse
    {
        //
        $checklist_group->delete();

        return redirect()->route('home');
    }
}
