<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Auto model
 *
 * @package App\Models
 */
class Auto extends Model
{
    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['description', 'image'];


    /**
     * Auto salons
     */
    public function salons()
    {
        return $this->belongsToMany(Salon::class, 'salon_auto');
    }
}
