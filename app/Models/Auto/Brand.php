<?php

namespace App\Models\Auto;
use Illuminate\Database\Eloquent\Model;

/**
 * Auto brand
 *
 * @package App\Models\Auto
 */
class Brand extends Model
{
    /**
     * The table associated with the model
     *
     * @var string
     */
    protected $table = 'auto_brands';

    /**
     * Get brand models
     */
    public function models()
    {
        return $this->hasMany(\App\Models\Auto\Model::class);
    }
}
