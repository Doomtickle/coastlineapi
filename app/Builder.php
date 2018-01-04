<?php

namespace App;

use App\ApiCall;
use App\Property;
use Illuminate\Database\Eloquent\Model;

class Builder extends Model
{
    /**
     * Populate the database
     *
     * @return void
     */
    public function execute()
    {
        $properties = Property::list();
        foreach ($properties->value as $property) {
            $propertyInfo    = Property::info($property->id)->value;
            $createdProperty = Property::add($propertyInfo);
            $createdProperty->addImages($propertyInfo->images);
            $createdProperty->addRates($propertyInfo->rates);
            $createdProperty->addAmenities($propertyInfo->amenities);
        }
    }
}
