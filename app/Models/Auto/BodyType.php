<?php

namespace App\Model\Auto;
use Illuminate\Database\Eloquent\Model;

/**
 * Body type
 *
 * @package App\Model\Auto
 */
class BodyType extends Model
{
    /**
     * The table associated with the model
     *
     * @var string
     */
    protected $table = 'auto_body_types';

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
