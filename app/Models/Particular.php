<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Particular extends Model
{
    public function energySources() : HasMany
    {
        return $this->hasMany(EnergySource::class);
    }
}
