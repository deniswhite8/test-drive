<?php

namespace App\Models\Auto;
use SleepingOwl\Models\SleepingOwlModel;

/**
 * Auto models
 *
 * @package App\Models\Auto
 */
class Model extends SleepingOwlModel
{
    /**
     * The table associated with the model
     *
     * @var string
     */
    protected $table = 'auto_models';

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
    protected $fillable = ['name', 'mark_id'];

    /**
     * Get mark
     */
    public function mark()
    {
        return $this->belongsTo(Mark::class);
    }

    /**
     * Get mark generations
     */
    public function generations()
    {
        return $this->hasMany(Generation::class);
    }
}
