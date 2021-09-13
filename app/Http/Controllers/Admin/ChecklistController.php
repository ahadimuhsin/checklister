<?php

namespace App\Http\Controllers\Admin;

use App\Models\Checklist;
use Illuminate\Http\Request;
use App\Models\ChecklistGroup;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class ChecklistController extends Controller
{

    public function create(ChecklistGroup $checklistGroup) :View
    {
        //
        // dd(ChecklistGroup::all());
        return view('admin.checklists.create', compact('checklistGroup'));
    }

    public function store(Request $request, ChecklistGroup $checklistGroup) :RedirectResponse
    {
        //
        $this->validate($request, [
            'name' => 'required'
        ]);

        $checklistGroup->checklists()->create($request->all());

        return redirect()->route('welcome');
    }

    public function edit(ChecklistGroup $checklist_group, Checklist $checklist) :View
    {
        return view('admin.checklists.edit', compact('checklist_group', 'checklist'));
    }

    public function update(Request $request, ChecklistGroup $checklist_group, Checklist $checklist) :RedirectResponse
    {
        //
        $this->validate($request, [
            'name' => 'required'
        ]);
        $checklist->update($request->all());

        return redirect()->route('welcome');
    }

    public function destroy(ChecklistGroup $checklist_group, Checklist $checklist) :RedirectResponse
    {
        //
        $checklist->delete();

        return redirect()->route('welcome');
    }
}
