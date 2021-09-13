<?php

namespace App\Http\Controllers\User;

use App\Models\Checklist;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Services\ChecklistService;

class ChecklistController extends Controller
{
    //
    public function show(Checklist $checklist) :View
    {
        //sync checklist from admin
        (new ChecklistService())->sync_checklist($checklist, auth()->user()->id);

        return view('user.checklist.show', compact('checklist'));
    }
}
