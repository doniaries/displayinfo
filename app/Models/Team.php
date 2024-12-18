<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];




    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function settings(): HasMany
    {
        return $this->hasMany(Setting::class);
    }

    public function agendas(): HasMany
    {
        return $this->hasMany(Agenda::class);
    }

    public function banners(): HasMany
    {
        return $this->hasMany(Banner::class);
    }

    public function informasis(): HasMany
    {
        return $this->hasMany(Informasi::class);
    }

    public function quotes(): HasMany
    {
        return $this->hasMany(Quotes::class);
    }

    public function runningTexts(): HasMany
    {
        return $this->hasMany(RunningText::class);
    }

    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }

    // -------------------//


}