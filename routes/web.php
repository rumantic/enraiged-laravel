<?php

use Illuminate\Support\Facades\Route;

require base_path('routes/web/auth.php');
require base_path('routes/web/avatars.php');
require base_path('routes/web/files.php');
require base_path('routes/web/users.php');

Route::namespace('\App\Http\Controllers\State')
    ->group(function () {
        Route::get('api/app/state', 'AppState')->middleware(['auth', 'enraiged', 'verified'])->name('app.state');
        Route::get('api/guest/state', 'GuestState')->name('guest.state');
    });

Route::middleware(['auth', 'verified', 'enraiged'])
    ->get('/dashboard', '\App\Http\Controllers\Dashboard\Show')
    ->name('dashboard');

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return inertia('Welcome');
});


Route::middleware(['auth', 'verified', 'enraiged'])
    ->namespace('\App\Http\Controllers\Realty')
    ->group(function(){

        Route::prefix('realty')
            ->as('realty.')
            ->group(function () {
                Route::get('', 'Index')->name('index');
                /*
                Route::get('create', 'Create')->name('create');
                Route::get('{user}/edit', 'Edit')->name('edit');
                Route::patch('{user}/update', 'Update')->name('update');
                Route::get('{user}', 'Show')->name('show');
                Route::post('', 'Store')->name('store');

                //  User Avatar
                Route::get('{user}/avatar/edit', 'Avatars\Edit')->name('avatar.edit');

                //  User Login
                Route::get('{user}/login/edit', 'Login\Edit')->name('login.edit');
                Route::patch('{user}/login/update', 'Login\Update')->name('login.update');

                //  User Profile
                Route::get('{user}/profile', 'Profiles\Show')->name('profile.show');
                Route::get('{user}/profile/edit', 'Profiles\Edit')->name('profile.edit');
                Route::patch('{user}/profile/update', 'Profiles\Update')->name('profile.update');

                //  User Settings
                Route::get('{user}/settings/edit', 'Settings\Edit')->name('settings.edit');
                Route::patch('{user}/settings/update', 'Settings\Update')->name('settings.update');

                //  Impersonate User
                Route::namespace('Impersonate')
                    ->prefix('impersonate')
                    ->group(function () {
                        Route::get('stop', 'Stop')->name('impersonate.stop');
                        Route::get('{user}', 'Start')->name('impersonate');
                    });
                */
            });
        Route::prefix('api/realty')
            ->as('realty.')
            ->group(function () {
                Route::namespace('Index')
                    ->prefix('index')
                    ->as('index.')
                    ->group(function () {
                        Route::match(['GET', 'POST'], 'data', 'Data')->name('data');
                        Route::match(['GET', 'POST'], 'export', 'Export')->name('export');
                    });
/*
                Route::match(['GET', 'POST'], 'available', 'Available')->name('available');
                Route::delete('{user}', 'Destroy')->name('delete');
                Route::patch('{user}', 'Restore')->name('restore');
*/
            });
    });
