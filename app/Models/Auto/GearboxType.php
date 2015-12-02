<?php

namespace App\Models\Auto;
use SleepingOwl\Models\SleepingOwlModel;

/**
 * Gearbox type
 *
 * @package App\Model\Auto
 */
class GearboxType extends SleepingOwlModel
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

    /**
     * To option array
     *
     * @return array
     */
    public static function getList()
    {
        return self::lists('name', 'id')->all();
    }
}
