<?php


namespace App\Models;

use App\Models\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Banner extends Model
{
    protected $fillable = [
        'gambar',
        'keterangan_gambar',
        'team_id',
    ];

    protected static function boot()
    {
        parent::boot();

        // Hapus file saat record dihapus
        static::deleting(function ($banner) {
            if ($banner->gambar) {
                Storage::disk('public')->delete($banner->gambar);
            }
        });
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
