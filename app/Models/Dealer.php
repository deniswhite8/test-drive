<?php

namespace App\Models;
use SleepingOwl\Models\Interfaces\ModelWithImageFieldsInterface;
use SleepingOwl\Models\SleepingOwlModel;
use SleepingOwl\Models\Traits\ModelWithImageOrFileFieldsTrait;

/**
 * Dealer
 *
 * @package App\Models
 */
class Dealer extends SleepingOwlModel implements ModelWithImageFieldsInterface
{
    use ModelWithImageOrFileFieldsTrait;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'image'];

    /**
     * Get dealer salons
     */
    public function salons()
    {
        return $this->hasMany(Salon::class);
    }

    /**
     * Get image fields
     *
     * @return array
     */
    public function getImageFields() {
        return [
            'image' => 'dealers/'
        ];
    }
}
