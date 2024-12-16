<?php

namespace App\Models;

use App\Models\Team;
use Illuminate\Database\Eloquent\Model;

class RunningText extends Model
{
    protected $table = 'running_texts';

    protected $fillable = [
        'text',
        'team_id',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
