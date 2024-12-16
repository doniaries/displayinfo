<?php

namespace App\Models;

use App\Models\Team;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agendas';

    protected $fillable = [
        'nama_agenda',
        'tanggal',
        'waktu',
        'lokasi',
        'keterangan',
        'team_id',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
