<?php

namespace App\Models;

use App\Models\Team;
use Illuminate\Database\Eloquent\Model;

class Quotes extends Model
{
    protected $table = 'quotes';

    protected $fillable = [
        'quote',
        'aktif',
        'team_id',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
