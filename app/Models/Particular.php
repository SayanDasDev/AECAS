<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Particular extends Model
{
    public function energySource()
    {
        return $this->hasMany(EnergySource::class);
    }
}
