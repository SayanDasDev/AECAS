<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnergySource extends Model
{
    public function particular()
    {
        return $this->belongsTo(Particular::class);
    }
}
