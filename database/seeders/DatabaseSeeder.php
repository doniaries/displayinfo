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

        // Step 1: Create base permissions (without team prefix)
        $basePermissions = [
            // Resource permissions
            'view_agenda',
            'view_any_agenda',
            'create_agenda',
            'update_agenda',
            'restore_agenda',
            'restore_any_agenda',
            'replicate_agenda',
            'reorder_agenda',
            'delete_agenda',
            'delete_any_agenda',
            'force_delete_agenda',
            'force_delete_any_agenda',

            'view_banner',
            'view_any_banner',
            'create_banner',
            'update_banner',
            'restore_banner',
            'restore_any_banner',
            'replicate_banner',
            'reorder_banner',
            'delete_banner',
            'delete_any_banner',
            'force_delete_banner',
            'force_delete_any_banner',

            'view_informasi',
            'view_any_informasi',
            'create_informasi',
            'update_informasi',
            'restore_informasi',
            'restore_any_informasi',
            'replicate_informasi',
            'reorder_informasi',
            'delete_informasi',
            'delete_any_informasi',
            'force_delete_informasi',
            'force_delete_any_informasi',

            'view_quotes',
            'view_any_quotes',
            'create_quotes',
            'update_quotes',
            'restore_quotes',
            'restore_any_quotes',
            'replicate_quotes',
            'reorder_quotes',
            'delete_quotes',
            'delete_any_quotes',
            'force_delete_quotes',
            'force_delete_any_quotes',

            'view_role',
            'view_any_role',
            'create_role',
            'update_role',
            'delete_role',
            'delete_any_role',

            'view_running::text',
            'view_any_running::text',
            'create_running::text',
            'update_running::text',
            'restore_running::text',
            'restore_any_running::text',
            'replicate_running::text',
            'reorder_running::text',
            'delete_running::text',
            'delete_any_running::text',
            'force_delete_running::text',
            'force_delete_any_running::text',

            'view_setting',
            'view_any_setting',
            'create_setting',
            'update_setting',
            'restore_setting',
            'restore_any_setting',
            'replicate_setting',
            'reorder_setting',
            'delete_setting',
            'delete_any_setting',
            'force_delete_setting',
            'force_delete_any_setting',

            'view_team',
            'view_any_team',
            'create_team',
            'update_team',
            'restore_team',
            'restore_any_team',
            'replicate_team',
            'reorder_team',
            'delete_team',
            'delete_any_team',
            'force_delete_team',
            'force_delete_any_team',

            'view_user',
            'view_any_user',
            'create_user',
            'update_user',
            'restore_user',
            'restore_any_user',
            'replicate_user',
            'reorder_user',
            'delete_user',
            'delete_any_user',
            'force_delete_user',
            'force_delete_any_user',

            'view_video',
            'view_any_video',
            'create_video',
            'update_video',
            'restore_video',
            'restore_any_video',
            'replicate_video',
            'reorder_video',
            'delete_video',
            'delete_any_video',
            'force_delete_video',
            'force_delete_any_video',

            // Custom permissions
            'page_DisplayButton'
        ];

        // Create base permissions
        foreach ($basePermissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create global roles
        $superAdminRole = Role::create(['name' => 'super_admin', 'guard_name' => 'web']);
        $superAdminRole->givePermissionTo(Permission::all());

        $userRole = Role::create(['name' => 'user', 'guard_name' => 'web']);
        // Assign basic permissions to user role as needed

        // Step 2: Create teams and their specific permissions/roles
        $createdTeams = [];
        foreach ($teamsData as $teamData) {
            $team = Team::create([
                'name' => $teamData['name'],
                'slug' => Str::slug($teamData['name']),
            ]);
            $createdTeams[] = $team;

            // Create team-specific permissions
            $teamPermissions = [];
            foreach ($basePermissions as $permission) {
                if (!str_contains($permission, 'team') && !str_contains($permission, 'role')) {
                    $teamPermission = Permission::create([
                        'name' => "team_{$team->id}_{$permission}",
                        'guard_name' => 'web',
                        'team_id' => $team->id,
                    ]);
                    $teamPermissions[] = $teamPermission->name;
                }
            }

            // Create team-specific roles
            $teamSuperAdminRole = Role::create([
                'name' => "team_{$team->id}_super_admin",
                'guard_name' => 'web',
                'team_id' => $team->id,
            ]);
            $teamSuperAdminRole->givePermissionTo($teamPermissions);

            $teamAdminRole = Role::create([
                'name' => "team_{$team->id}_admin",
                'guard_name' => 'web',
                'team_id' => $team->id,
            ]);

            // Filter permissions for regular admin (exclude user management)
            $adminPermissions = collect($teamPermissions)->filter(function ($permission) {
                return !str_contains($permission, '_user_') &&
                    !str_contains($permission, '_role_') &&
                    !str_contains($permission, '_permission_');
            })->toArray();

            $teamAdminRole->givePermissionTo($adminPermissions);
        }

        // Step 3: Create Super Admin user
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('password'),
            'current_team_id' => $createdTeams[0]->id,
        ]);

        // Assign global super_admin role
        $superAdmin->assignRole('super_admin');

        // Attach super admin to all teams
        foreach ($createdTeams as $team) {
            $superAdmin->teams()->attach($team->id);
            $superAdmin->assignRole("team_{$team->id}_super_admin");
        }

        // Step 4: Create admin users for each team
        foreach ($teamsData as $index => $teamData) {
            $team = $createdTeams[$index];

            $admin = User::create([
                'name' => $teamData['admin']['name'],
                'email' => $teamData['admin']['email'],
                'password' => bcrypt('password'),
                'current_team_id' => $team->id,
            ]);

            // Attach admin to their specific team only
            $admin->teams()->attach($team->id);
            $admin->assignRole("team_{$team->id}_admin");

            // Create settings for the team
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
