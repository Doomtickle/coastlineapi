<?php

namespace App;

use App\Rate;
use App\Photo;
use App\Amenity;
use App\ApiCall;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $guarded = [];

    /**
     * A property has many photos
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    /**
     * A property has many rates
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    /**
     * A property has many amenities
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function amenities()
    {
        return $this->hasMany(Amenity::class);
    }

    /**
     * Add images to the property
     *
     * @param array $images
     * @return void
     */
    public function addImages($images)
    {
        foreach ($images as $image) {
            Photo::create([
            'caption'     => $image->caption,
            'original'    => $image->urlRaw,
            'medium'      => $image->urlMed,
            'thumbnail'   => $image->urlThumb,
            'property_id' => $this->id
            ]);
        }
    }

    /**
     * Add rates to a property
     *
     * @param array $rates
     * @return void
     */
    public function addRates($rates)
    {
        foreach ($rates as $rate) {
            Rate::create([
                'date'        => $rate->date,
                'price'       => $rate->price,
                'property_id' => $this->id
            ]);
        }
    }

    /**
     * Add rates to a property
     *
     * @param array $amenities
     * @return void
     */
    public function addAmenities($amenities)
    {
        foreach ($amenities as $amenity) {
            Amenity::create([
                'text'            => $amenity->text,
                'kigo_id'         => $this->kigo_id,
                'property_id'     => $this->id,
                'kigo_amenity_id' => $amenity->id,
            ]);
        }
    }

    /**
     * Find the lowest rate for the given property
     *
     * @return \Illuminate\Database\Eloquent\Collection;
     */
    public function getLowestRate()
    {
        return Rate::where('property_id', $this->id)
                   ->where('price', '!=', 0)
                   ->min('price');
    }

    /**
     * Return info for the property with the given ID
     *
     * @param integer $propertyId
     * @return string
     */
    public static function info($propertyId)
    {
        $kigo     = new ApiCall();
        $response = $kigo->get(
            'https://www.kigoapis.com/core/v0.7/properties/'.
            $propertyId.
            '?options=Rates,AllImages,Amenities,Visibility,Reviews'
        );

        return json_decode($response->getBody());
    }

    /**
     * Return a list of property IDs
     *
     * @return string
     */
    public static function list()
    {
        $kigo     = new ApiCall();
        $response = $kigo->get('https://www.kigoapis.com/core/v0.7/properties');

        return json_decode($response->getBody());
    }

    /**
     * Persist the property to the database
     *
     * @param array $propertyInfo
     * @return \App\Property
     */
    public static function add($propertyDetails)
    {
        $property = Property::create([
            'beds'               => $propertyDetails->bedrooms,
            'city'               => $propertyDetails->address->city,
            'name'               => $propertyDetails->privateName,
            'baths'              => $propertyDetails->bathrooms,
            'rating'             => $propertyDetails->visibility->score,
            'sleeps'             => $propertyDetails->sleeps,
            'kigo_id'            => $propertyDetails->id,
            'summary'            => $propertyDetails->resourceStrings[0]->summary,
            'category'           => $propertyDetails->category,
            'is_active'          => $propertyDetails->isActive,
            'description'        => $propertyDetails->resourceStrings[0]->description,
            'public_name'        => $propertyDetails->resourceStrings[0]->publicName,
            'kigo_last_modified' => $propertyDetails->lastModifiedDate
        ]);

        return $property;
    }
}
