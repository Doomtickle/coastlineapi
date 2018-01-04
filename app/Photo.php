<?php

namespace App;

use App\Property;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $guarded = [];

    /**
     * A photo belongs to a property
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
