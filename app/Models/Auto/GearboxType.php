<?php

namespace App\Model\Auto;
use Illuminate\Database\Eloquent\Model;

/**
 * Gearbox type
 *
 * @package App\Model\Auto
 */
class GearboxType extends Model
{
    /**
     * The table associated with the model
     *
     * @var string
     */
    protected $table = 'auto_gearbox_types';

    /**
     * Indicates if the model should be timestamped
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['name'];
}
