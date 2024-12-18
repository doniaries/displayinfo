<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Step 1: Create Teams
        $teamsData = [
            [
                'name' => 'Dinas Pendidikan',
                'admin' => [
                    'name' => 'User One',
                    'email' => 'user1@gmail.com'
                ]
            ],
            [
                'name' => 'Dinas Kesehatan',
                'admin' => [
                    'name' => 'User Two',
                    'email' => 'user2@gmail.com'
                ]
            ]
        ];

        // Step 2: Create teams
        $createdTeams = [];
        foreach ($teamsData as $teamData) {
            $team = Team::create([
                'name' => $teamData['name'],
                'slug' => Str::slug($teamData['name']),
            ]);
            $createdTeams[] = $team;
        }

        // Step 3: Create Super Admin user
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'current_team_id' => $createdTeams[0]->id,
            'is_admin' => true
        ]);

        // Attach super admin to all teams
        foreach ($createdTeams as $team) {
            $superAdmin->teams()->attach($team->id);
        }

        // Step 4: Create admin users for each team
        foreach ($teamsData as $index => $teamData) {
            $team = $createdTeams[$index];

            $admin = User::create([
                'name' => $teamData['admin']['name'],
                'email' => $teamData['admin']['email'],
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'current_team_id' => $team->id,
                'is_admin' => false
            ]);

            // Attach admin to their specific team
            $admin->teams()->attach($team->id);

            // Create settings for the team
            Setting::create([
                'team_id' => $team->id,
                'nama_aplikasi' => 'Display Informasi',
                'nama_institusi' => $team->name,
                'alamat' => 'Alamat Default',
                'logo' => 'logo-default.png',
                'lokasi' => '0309', // Kode lokasi default
                'kecepatan_teks' => 5,
            ]);
        }
    }
}
