<?php

namespace App\Models;
use SleepingOwl\Models\SleepingOwlModel;

/**
 * Salon
 *
 * @package App
 */
class Salon extends SleepingOwlModel
{
    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'city', 'address',
        'phone', 'work_time', 'latitude', 'longitude', 'image'];


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
}
