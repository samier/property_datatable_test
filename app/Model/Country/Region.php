<?php

namespace App\Model\Country;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public function country() {
        return $this->belongsTo(Country::class);
    }
}
