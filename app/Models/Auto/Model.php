<?php

namespace App\Models\Auto;
use Illuminate\Database\Eloquent\Model as EloquentModel;

/**
 * Auto brand models
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
     * Get brand
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
