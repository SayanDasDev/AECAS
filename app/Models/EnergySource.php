<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EnergySource extends Model
{
    public function particular() : BelongsTo
    {
        return $this->belongsTo(Particular::class);
    }
}
