<?php

namespace App\Models;
use SleepingOwl\Models\SleepingOwlModel;

/**
 * Dealer
 *
 * @package App
 */
class Dealer extends SleepingOwlModel
{
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
}
