<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaveLastAction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {


        return $next($request);
    }


    public function terminate($request, $response)
    {
        if($request->user())
        {
            // dd($request->user()->id);
            $request->user()->update(['last_action_at' => now()]);
            // $user = User::findOrFail($request->user()->id);
            // $user->last_action_at = now();
            // $user->save();
        }
        // ...
    }
}
