<?php

namespace Database\Seeders;

use App\Models\Agenda;
use App\Models\RunningText;
use App\Models\Setting;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat array teams terlebih dahulu
        $teamsData = [
            [
                'name' => 'Dinas 1',
                'alamat' => 'Jl. ABCDFG No. 123',
                'admin' => [
                    'name' => 'Admin Instansi 1',
                    'email' => 'admin.instansi1g@gmail.com',
                ]
            ],
            [
                'name' => 'Dinas 2',
                'alamat' => 'Jl. HIJKLM No. 456',
                'admin' => [
                    'name' => 'Admin Instansi 2',
                    'email' => 'admin.instansi2m@gmail.com',
                ]
            ],

        ];

        // Step 1: Buat teams terlebih dahulu
        $createdTeams = [];
        foreach ($teamsData as $teamData) {
            $team = Team::create([
                'name' => $teamData['name'],
                'slug' => Str::slug($teamData['name']),
            ]);
            $createdTeams[] = $team;
        }

        // Step 2: Buat superadmin dan set current_team ke team pertama
        $superadmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('password'),
            'current_team_id' => $createdTeams[0]->id // Set current team ke team pertama
        ]);

        // Attach superadmin ke semua team
        foreach ($createdTeams as $team) {
            $superadmin->teams()->attach($team->id);
        }

        // Step 3: Buat admin untuk masing-masing team
        foreach ($teamsData as $index => $teamData) {
            $team = $createdTeams[$index];

            // Buat admin untuk team ini
            $admin = User::create([
                'name' => $teamData['admin']['name'],
                'email' => $teamData['admin']['email'],
                'password' => bcrypt('password'),
                'current_team_id' => $team->id
            ]);

            // Attach admin ke teamnya
            $admin->teams()->attach($team->id);

            // Buat setting untuk team
            Setting::create([
                'team_id' => $team->id,
                'nama_aplikasi' => "Display Informasi Digital {$team->name}",
                'nama_institusi' => $team->name,
                'logo' => 'logo-default.png',
                'alamat' => $teamData['alamat'],
                'lokasi' => '0309', // Kode lokasi default
                'kecepatan_teks' => 5,
            ]);
        }
    }
}