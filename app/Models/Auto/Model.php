<?php

namespace App\Models\Auto;
use Illuminate\Database\Eloquent\Model as EloquentModel;

/**
 * Auto models
 *
 * @package App\Models\Auto
 */
class Model extends EloquentModel
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
    protected $fillable = ['name'];

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
