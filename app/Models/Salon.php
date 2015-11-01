<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

/**
 * Salon
 *
 * @package App
 */
class Salon extends Model
{
    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'city', 'address',
        'phone', 'work_time', 'latitude', 'longitude', 'image'];
}
