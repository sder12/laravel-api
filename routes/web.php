<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/admin', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.dashboard');
Route::middleware(['auth', 'verified'])
    ->prefix('admin')   //url 
    ->name('admin.')    //name
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard'); // URL:/admin DEV:admin.dashbard
        Route::resource('projects', ProjectController::class)->parameters(['projects' => 'project:slug']);
        Route::resource('technologies', TechnologyController::class)->except(['create', 'edit']);
        Route::resource('types', TypeController::class)->except(['create', 'edit']);
    });

require __DIR__ . '/auth.php';
