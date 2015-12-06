<?php

namespace App\Models;
use SleepingOwl\Models\SleepingOwlModel;

/**
 * City
 *
 * @package App\Model
 */
class City extends SleepingOwlModel
{
    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Indicates if the model should be timestamped
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get dealer salons
     */
    public function salons()
    {
        return $this->hasMany(Salon::class);
    }
}
