<?php

namespace App;

use App\Property;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    protected $guarded = [];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
