<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Video extends Model
{
    protected $table = 'videos';

    protected $fillable = [
        'file',
        'aktif',
        'team_id',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];

    // Scope untuk mendapatkan video aktif
    public function scopeActive($query)
    {
        return $query->where('aktif', true);
    }

    public function getFileUrlAttribute()
    {
        return Storage::url($this->file);
    }

    public function scopeNewest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
