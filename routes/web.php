<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SettingsPrivacyController;
use App\Http\Controllers\Inventory\RabbitsController;
use App\Http\Controllers\Inventory\BreedingController;
use App\Http\Controllers\OptionsController;
use App\Http\Controllers\Inventory\RabbitFormController;
use App\Http\Controllers\Inventory\BreedingFormController;
use App\Http\Controllers\DefaultController;

Auth::routes();

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::prefix('defaults')->group(function () {
        Route::post('/', [DefaultController::class, 'index'])->name('defaults');
    });

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('home');
    });

    Route::prefix('rabbits')->group(function () {
        Route::get('/', [RabbitsController::class, 'index'])->name('rabbits');
        Route::post('/table', [RabbitsController::class, 'table'])->name('rabbits.table');
    });

    Route::prefix('rabbit-form')->group(function () {
        Route::get('/', [RabbitFormController::class, 'index'])->name('rabbit.form');
        Route::post('/find/litter', [RabbitFormController::class, 'findLitter'])->name('rabbit.litter');
        Route::post('/store', [RabbitFormController::class, 'store'])->name('rabbit.store.litter');
        Route::get('/edit/{id}', [RabbitFormController::class, 'index'])->name('rabbit.edit.litter');
        Route::get('/delete/{id}', [RabbitFormController::class, 'destroy'])->name('rabbit.form.delete');
    });

    Route::prefix('breeding')->group(function () {
        Route::get('/', [BreedingController::class, 'index'])->name('breeding');
        Route::post('/table', [BreedingController::class, 'table'])->name('breeding.table');
    });

    Route::prefix('breeding-form')->group(function () {
        Route::get('/', [BreedingFormController::class, 'index'])->name('breeding.form');
        Route::post('/store', [BreedingFormController::class, 'store'])->name('breeding.form.store');
        Route::get('/edit/{id}', [BreedingFormController::class, 'index'])->name('breeding.form.edit');
        Route::get('/delete/{id}', [BreedingFormController::class, 'destroy'])->name('breeding.form.delete');
    });

    Route::prefix('options')->group(function () {
        Route::get('/', [OptionsController::class, 'index'])->name('options')->middleware(['can:options']);
        Route::post('/breeds', [OptionsController::class, 'breeds'])->name('options.breeds');
        Route::post('/add/breed', [OptionsController::class, 'addBreed'])->name('options.add.breed');
        Route::post('/remove/breed', [OptionsController::class, 'removeBreed'])->name('options.remove.breed');
        Route::post('/rabbit/statuses', [OptionsController::class, 'rabbitStatuses'])->name('options.rabbit.statuses');
        Route::post('/rs/add', [OptionsController::class, 'addRabbitStatus'])->name('options.rs.add');
        Route::post('/rs/remove', [OptionsController::class, 'removeRabbitStatus'])->name('options.rs.remove');
        Route::post('/cateogries', [OptionsController::class, 'categories'])->name('options.category');
        Route::post('/add/category', [OptionsController::class, 'addCategory'])->name('options.add.category');
        Route::post('/remove/category', [OptionsController::class, 'removeCategory'])->name('options.remove.category');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('users')->middleware(['can:users']);
        Route::post('/table', [UsersController::class, 'usersTable'])->name('users.table');
        Route::post('/update', [UsersController::class, 'update'])->name('users.update');
        Route::post('/store', [UsersController::class, 'store'])->name('users.store');
        Route::post('/cp', [UsersController::class, 'changePassword'])->name('users.cp');
        Route::post('/destroy', [UsersController::class, 'destroy'])->name('users.destroy');
    });
    Route::prefix('roles')->group(function () {
        Route::get('/', [RolesController::class, 'index'])->name('roles')->middleware(['can:roles']);
        Route::post('/store', [RolesController::class, 'store'])->name('roles.store');
        Route::post('/update', [RolesController::class, 'update'])->name('roles.update');
        Route::post('/destroy', [RolesController::class, 'destroy'])->name('roles.delete');
        Route::post('/table', [RolesController::class, 'table'])->name('roles.table');
    });

    Route::prefix('settings-privacy')->group(function () {
        Route::get('/', [SettingsPrivacyController::class, 'index'])->name('settings-privacy');
        Route::post('/upload-photo', [SettingsPrivacyController::class, 'uploadPhoto'])->name('settings-privacy.up');
    });
});
