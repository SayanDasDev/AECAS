<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Operation extends Model
{
    public function particular() : BelongsTo
    {
        return $this->belongsTo(Particular::class);
    }

    public function energySource() : BelongsTo
    {
        return $this->belongsTo(EnergySource::class);
    }
}
