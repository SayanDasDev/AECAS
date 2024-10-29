<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    public function particular()
    {
        return $this->belongsTo(Particular::class);
    }

    public function energySource()
    {
        return $this->belongsTo(EnergySource::class);
    }
}
