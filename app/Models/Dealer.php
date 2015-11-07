<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Dealer
 *
 * @package App
 */
class Dealer extends Model
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
