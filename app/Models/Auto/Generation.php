<?php

namespace App\Models\Auto;
use Illuminate\Database\Eloquent\Model;

/**
 * Auto generation
 *
 * @package App\Models\Auto
 */
class Generation extends Model
{
    /**
     * The table associated with the model
     *
     * @var string
     */
    protected $table = 'auto_generation';

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
     * Get model
     */
    public function model()
    {
        return $this->belongsTo(\App\Models\Auto\Model::class);
    }
}
