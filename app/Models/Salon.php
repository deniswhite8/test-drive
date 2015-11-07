<?php

namespace App\Models;
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
        $this->belongsTo(Dealer::class);
    }
}
