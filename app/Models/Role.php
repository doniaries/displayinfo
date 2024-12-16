<?php
// app/Models/Role.php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;


class Role extends SpatieRole
{
    public static string $tenantOwnershipRelationshipName = 'team';
    protected $fillable = [
        'name',
        'guard_name',
        'team_id',
    ];


    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
