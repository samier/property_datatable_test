<?php

namespace App\Model\Property;

use App\Model\Country\Region;
use App\Model\Project\Project;
use App\Model\Status\Status;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public function region() {
        return $this->belongsTo(Region::class);
    }

    public function type() {
        return $this->belongsTo(PropertyType::class, 'property_type_id', 'id');
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }
}
