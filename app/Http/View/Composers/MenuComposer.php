<?php

namespace App\Http\View\Composers;

use App\Models\Checklist;
use Illuminate\View\View;
use App\Models\ChecklistGroup;
use App\Repositories\UserRepository;
use Carbon\Carbon;

class MenuComposer
{


    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $menu = ChecklistGroup::with(['checklists' => function($query){
            $query->whereNull('user_id');
        }])
        ->get();

        $view->with('admin_menu', $menu);

        $last_action_at = auth()->user()->last_action_at;
        if(is_null($last_action_at))
        {
            $last_action_at = now()->subYears(10);
        }

        $user_checklists = Checklist::where('user_id', auth()->id())->get();
        // dd(now());
        $groups = [];
        foreach($menu->toArray() as $group)
        {
            if(count($group['checklists']) > 0)
            {
                $group_updated_at = $user_checklists->where('checklist_group_id', $group['id'])->max('updated_at');
                $group['is_new'] = Carbon::create($group['created_at'])->greaterThan($group_updated_at);
                $group['is_updated'] = !($group['is_new']) && Carbon::create($group['updated_at'])->greaterThan($group_updated_at);

                foreach($group['checklists'] as &$checklist)
                {
                    $checklist_updated_at = $user_checklists->where('checklist_id', $checklist['id'])->max('updated_at');

                    // dd( Carbon::create($checklist['updated_at']));
                    $checklist['is_new'] = !($group['is_new']) && Carbon::create($checklist['created_at'])->greaterThan($checklist_updated_at);
                    $checklist['is_updated'] = !($group['is_updated']) && !($group['is_new']) && !($checklist['is_new']) && Carbon::create($checklist['updated_at'])
                    ->greaterThan($group_updated_at);
                    // dd(Carbon::create($checklist['updated_at'])->greaterThan($last_action_at));
                    $checklist['tasks'] = 1;
                    $checklist['completed_tasks'] = 0;
                }
                $groups[] = $group;
            }
        }
        $view->with('user_menu', $groups);
    }
}
