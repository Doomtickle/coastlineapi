<?php

namespace App;

use App\Property;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rate extends Model
{
    protected $guarded = [];

    /**
     * A Rate belongs to a property
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
