<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\Setting;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Data teams
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

        // Step 1: Buat teams
        $createdTeams = [];
        foreach ($teamsData as $teamData) {
            $team = Team::create([
                'name' => $teamData['name'],
                'slug' => Str::slug($teamData['name']),
            ]);
            $createdTeams[] = $team;

            // Base permissions tanpa prefix
            $basePermissions = [
                // User Management
                'view_any_user',
                'view_user',
                'create_user',
                'update_user',
                'delete_user',
                'restore_user',
                'force_delete_user',

                // Setting Management
                'view_any_setting',
                'view_setting',
                'create_setting',
                'update_setting',
                'delete_setting',

                // Content Management
                'view_any_banner',
                'view_banner',
                'create_banner',
                'update_banner',
                'delete_banner',

                'view_any_informasi',
                'view_informasi',
                'create_informasi',
                'update_informasi',
                'delete_informasi',

                'view_any_agenda',
                'view_agenda',
                'create_agenda',
                'update_agenda',
                'delete_agenda',

                'view_any_running_text',
                'view_running_text',
                'create_running_text',
                'update_running_text',
                'delete_running_text',

                'view_any_quote',
                'view_quote',
                'create_quote',
                'update_quote',
                'delete_quote',

                'view_any_video',
                'view_video',
                'create_video',
                'update_video',
                'delete_video',
            ];

            // Buat permission dengan prefix team_id
            foreach ($basePermissions as $permission) {
                Permission::create([
                    'name' => "team_{$team->id}_{$permission}",
                    'guard_name' => 'web',
                    'team_id' => $team->id
                ]);
            }

            // Tambahkan permission untuk Role dan Permission Management
            $rolePermissions = [
                'view_any_role',
                'view_role',
                'create_role',
                'update_role',
                'delete_role',
                'view_any_permission',
                'view_permission',
                'create_permission',
                'update_permission',
                'delete_permission',
            ];

            foreach ($rolePermissions as $permission) {
                Permission::create([
                    'name' => "team_{$team->id}_{$permission}",
                    'guard_name' => 'web',
                    'team_id' => $team->id
                ]);
            }

            // Buat roles dengan prefix team_id
            $superAdminRole = Role::create([
                'name' => "team_{$team->id}_super_admin",
                'guard_name' => 'web',
                'team_id' => $team->id
            ]);

            // Super Admin mendapatkan semua permission
            $superAdminRole->givePermissionTo(Permission::where('team_id', $team->id)->get());

            $adminRole = Role::create([
                'name' => "team_{$team->id}_admin",
                'guard_name' => 'web',
                'team_id' => $team->id
            ]);

            // Filter permissions untuk admin (exclude Role & Permission Management)
            $adminPermissions = Permission::where('team_id', $team->id)
                ->where(function ($query) {
                    $query->where('name', 'not like', '%_role%')
                        ->where('name', 'not like', '%_permission%')
                        ->where('name', 'not like', '%_user%');
                })
                ->get();

            $adminRole->givePermissionTo($adminPermissions);
        }

        // Step 2: Buat Super Admin
        $superadmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('password'),
            'current_team_id' => $createdTeams[0]->id
        ]);

        // Attach super admin ke semua team dengan full permissions
        foreach ($createdTeams as $team) {
            $superadmin->teams()->attach($team->id);
            $superadmin->assignRole("team_{$team->id}_super_admin");
        }

        // Step 3: Buat admin per team
        foreach ($teamsData as $index => $teamData) {
            $team = $createdTeams[$index];

            $admin = User::create([
                'name' => $teamData['admin']['name'],
                'email' => $teamData['admin']['email'],
                'password' => bcrypt('password'),
                'current_team_id' => $team->id
            ]);

            $admin->teams()->attach($team->id);
            $admin->assignRole("team_{$team->id}_admin");

            // Buat setting untuk team
            Setting::create([
                'team_id' => $team->id,
                'nama_aplikasi' => "Display Informasi Digital {$team->name}",
                'nama_institusi' => $team->name,
                'logo' => 'logo-default.png',
                'alamat' => $teamData['alamat'],
                'lokasi' => '0309',
                'kecepatan_teks' => 5,
            ]);
        }
    }
}
