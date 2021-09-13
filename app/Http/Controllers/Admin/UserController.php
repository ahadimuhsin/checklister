<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::where('is_admin', 0)->latest()->paginate(10);

        return view('admin.users.index', compact('users'));

    }
}
