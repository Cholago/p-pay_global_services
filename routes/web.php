<?php

//Dashboard controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\BanksController;
use App\Http\Controllers\Admin\DealersController;
use App\Http\Controllers\Admin\SignInLogsController;

//Test controller
use App\Http\Controllers\Test;

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect('/login');

    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/test', [Test::class, 'index'])->name('test'); 


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //admin routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //user routes
    Route::get('/users', [UsersController::class, 'index'])->name('users'); 
    Route::get('/users/{user}/view', [UsersController::class, 'show'])->name('users.view');
    Route::get('/users/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::post('/users/{user}/edit', [UsersController::class, 'update'])->name('users.update');
    Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
    Route::post('/users', [UsersController::class, 'store'])->name('users.store'); 
    //bank routes
    Route::get('/banks', [BanksController::class, 'index'])->name('banks'); 
    Route::get('/banks/{bank}/view', [BanksController::class, 'show'])->name('banks.view');
    Route::get('/banks/{bank}/edit', [BanksController::class, 'edit'])->name('banks.edit');
    Route::post('/banks/{bank}/edit', [BanksController::class, 'update'])->name('banks.update');
    Route::get('/banks/create', [BanksController::class, 'create'])->name('banks.create');
    Route::post('/banks', [BanksController::class, 'store'])->name('banks.store'); 
    //Dealers routes
    /*
    •	GET /dealers → index
	•	GET /dealers/create → create
	•	POST /dealers → store
	•	GET /dealers/{dealer} → show
	•	GET /dealers/{dealer}/edit → edit
	•	PUT/PATCH /dealers/{dealer} → update
	•	DELETE /dealers/{dealer} → destroy
    */
    Route::resource('dealers', DealersController::class);

    //signin logs routes
    Route::get('/signinlogs', [SignInLogsController::class, 'index'])->name('signinlogs'); 


    Route::get('/settings', [SettingsController::class, 'index'])->name('settings'); 

});

require __DIR__.'/auth.php';