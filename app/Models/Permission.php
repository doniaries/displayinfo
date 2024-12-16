<?php
// app/Models/Permission.php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
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
