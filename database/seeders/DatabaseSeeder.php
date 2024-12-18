<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Teams
        $team1 = Team::create([
            'name' => 'Dinas Pendidikan',
            'slug' => Str::slug('Dinas Pendidikan'),
        ]);

        $team2 = Team::create([
            'name' => 'Dinas Kesehatan',
            'slug' => Str::slug('Dinas-Kesehatan'),
        ]);

        // Create SuperAdmin dengan hak akses penuh
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'is_admin' => true,
            'current_team_id' => $team1->id, // Set default team untuk superadmin
        ]);

        // Assign all teams to superadmin
        $superAdmin->teams()->attach([$team1->id, $team2->id]);

        // Create User 1 with limited access
        $user1 = User::create([
            'name' => 'User One',
            'email' => 'user1@gmail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'is_admin' => false,
            'current_team_id' => $team1->id,
        ]);

        // Create User 2 with limited access
        $user2 = User::create([
            'name' => 'User Two',
            'email' => 'user2@gmail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'is_admin' => false,
            'current_team_id' => $team2->id,
        ]);

        // Assign teams to regular users
        $user1->teams()->attach($team1->id);
        $user2->teams()->attach($team2->id);

        // Create settings for each team
        foreach ([$team1, $team2] as $team) {
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