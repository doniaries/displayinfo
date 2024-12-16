<?php

use Illuminate\Support\Facades\Route;
use App\Models\Setting;
use App\Models\Team;

// Route::get('/', function () {
//     return view('welcome');
// });


// Redirect root ke tenant dashboard jika user sudah login
Route::get('/', function () {
    if (auth()->check() && auth()->user()->currentTeam) {
        return redirect()->route('filament.admin.pages.dashboard', [
            'tenant' => auth()->user()->currentTeam->slug
        ]);
    }

    return redirect()->route('filament.admin.auth.login');
});

// Route untuk display dengan tenant awareness
Route::get('/display/{team:slug?}', function (Team $team = null) {
    if (auth()->check()) {
        $team = auth()->user()->currentTeam;
    }

    if (!$team) {
        $team = Team::first();
    }

    $setting = Setting::where('team_id', $team->id)->first();

    return view('display', [
        'team' => $team,
        'setting' => $setting
    ]);
})->name('display');