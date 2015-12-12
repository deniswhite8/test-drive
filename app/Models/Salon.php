<?php

namespace App\Models;
use SleepingOwl\Models\Interfaces\ModelWithImageFieldsInterface;
use SleepingOwl\Models\SleepingOwlModel;
use SleepingOwl\Models\Traits\ModelWithImageOrFileFieldsTrait;

/**
 * Salon
 *
 * @package App
 */
class Salon extends SleepingOwlModel implements ModelWithImageFieldsInterface
{
    use ModelWithImageOrFileFieldsTrait;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'city', 'address', 'autos', 'email',
        'phone', 'work_time', 'latitude', 'longitude', 'image', 'dealer_id', 'city_id'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image_thumbnail'];

    /**
     * Salon autos
     */
    public function autos()
    {
        return $this->belongsToMany(Auto::class, 'salon_auto');
    }

    /**
     * Get dealer
     */
    public function dealer()
    {
        return $this->belongsTo(Dealer::class);
    }

    /**
     * Get city
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Set autos
     *
     * @param array $autoIds
     */
    public function setAutosAttribute($autoIds)
    {
        if (is_array($autoIds)) {
            $this->autos()->sync($autoIds);
        }
    }

    /**
     * Get image fields
     *
     * @return array
     */
    public function getImageFields()
    {
        return [
            'image' => 'salons/'
        ];
    }

    /**
     * Get image thumbnail attribute
     *
     * @return string
     */
    public function getImageThumbnailAttribute()
    {
        return $this->image->thumbnail('original');
    }
}
