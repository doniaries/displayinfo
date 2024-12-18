<?php

use Illuminate\Support\Facades\Route;
use App\Models\Setting;
use App\Models\Team;
use Illuminate\Support\Facades\URL;



// Welcome page route
Route::get('/', function () {
    // If user is logged in, redirect to dashboard
    if (auth()->check() && auth()->user()->currentTeam) {
        return redirect()->route('filament.admin.pages.dashboard', [
            'tenant' => auth()->user()->currentTeam->slug
        ]);
    }

    // Show welcome page for guests
    return view('welcome');
})->name('welcome');

// Login route (ensure it uses HTTPS)
Route::get('/login', function () {
    return redirect()->route('filament.admin.auth.login');
})->name('login');

// Display route with tenant awareness
Route::get('/display/{team:slug?}', function (Team $team = null) {
    // Try to get team from authenticated user
    if (auth()->check()) {
        $team = auth()->user()->currentTeam;
    }

    // Fallback to first team if no team specified
    if (!$team) {
        $team = Team::first();
    }

    // Get team settings
    $setting = Setting::where('team_id', $team->id)->first();

    // Return display view with data
    return view('display', [
        'team' => $team,
        'setting' => $setting
    ]);
})->name('display');