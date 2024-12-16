<?php

namespace App\Models;

use App\Models\Team;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    protected $table = 'informasis';

    protected $fillable = [
        'judul',
        'isi',
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
