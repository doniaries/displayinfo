<?php

namespace App\Models;

use App\Models\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Setting extends Model
{
    protected $fillable = [
        'nama_aplikasi',
        'nama_institusi',
        'logo',
        'alamat',
        'lokasi',
        'kecepatan_teks',
        'team_id',
    ];

    protected $casts = [
        'kecepatan_teks' => 'integer',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
