<?php

namespace App\Models;

use Filament\Models\Contracts\HasTenants;  // Tambahkan ini
use Filament\Panel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable implements HasTenants  // Tambahkan implements
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'current_team_id', // Tambahkan ini
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getTenants(Panel $panel): array|\Illuminate\Support\Collection
    {
        return $this->teams;
    }

    public function canAccessTenant(Model $tenant): bool
    {
        // Check if user belongs to the team
        return $this->teams->contains($tenant);
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }

    public function currentTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'current_team_id');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'current_team_id');
    }
}
