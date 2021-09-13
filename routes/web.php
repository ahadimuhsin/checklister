<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ChecklistController;
use App\Http\Controllers\Admin\ChecklistGroupController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', 'welcome');

Auth::routes();
Route::group(['middleware' => ['auth', 'save_last_action']] ,function () {
    Route::get('welcome', [\App\Http\Controllers\PageController::class, 'welcome'])->name('welcome');
    Route::get('consultation', [\App\Http\Controllers\PageController::class, 'consultation'])->name('consultation');
    Route::get('checklist/{checklist}', [\App\Http\Controllers\User\ChecklistController::class, 'show'])->name('users.checklists.show');
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'],function () {
        Route::resource('pages', PageController::class)->only(['edit', 'update']);
        Route::resource('checklist-groups', ChecklistGroupController::class)->except(['index', 'show']);
        Route::resource('checklist-groups.checklists', ChecklistController::class);
        Route::resource('checklists.tasks', TaskController::class);

        Route::get('users', [UserController::class, 'index'])->name('user.index');
    });
});
